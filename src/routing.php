<?php

// Get the required route (without query string) and remove trailing slashes
$route = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '', '/');

// $routes comes from 'routes.php' required here
$routes = require_once __DIR__ . '/../src/routes.php';

// If required route is not in $routes, return a 404 Page not found error
if (!key_exists($route, $routes)) {
    header("HTTP/1.0 404 Not Found");
    echo '404 - Page not found';
    exit();
}

// Get the matching route in $routes array
$matchingRoute = $routes[$route];

// Instanciation des dépendances
require_once __DIR__ . '/../config/db.php';
$pdo = new PDO('mysql:host=' . APP_DB_HOST . ';dbname=' . APP_DB_NAME, APP_DB_USER, APP_DB_PASSWORD);
$messageManager = new App\Model\MessageManager($pdo);

// Instanciation de Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../src/view');
$twig = new \Twig\Environment($loader);

// Get the FQCN of controller associated to the matching route
$controllerName = 'App\\Controller\\' . $matchingRoute[0];

// Instanciation du contrôleur avec les dépendances
$controller = new $controllerName($messageManager, $twig);

// Get the method associated to the matching route
$method = $matchingRoute[1];

// Get the queryString values configured for the matching route (in $_GET superglobal).
$parameters = [];
foreach ($matchingRoute[2] ?? [] as $parameter) {
    if (isset($_GET[$parameter])) {
        $parameters[] = $_GET[$parameter];
    }
}

// Special handling for routes that require parameters
if ($controllerName === 'App\\Controller\\MessageController') {
    if ($method === 'editMessageForm' || $method === 'deleteMessage') {
        if (!isset($_GET['messageId'])) {
            // Handle error: messageId is required
            header("HTTP/1.0 400 Bad Request");
            echo '400 - Bad Request: messageId is required';
            exit();
        }
        $parameters[] = $_GET['messageId'];
    }
}

// Execute the controller method
try {
    echo call_user_func_array([$controller, $method], $parameters);
} catch (Exception $e) {
    header("HTTP/1.0 500 Internal Server Error");
    echo '500 - Internal Server Error: ' . $e->getMessage();
    exit();
}
