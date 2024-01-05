<?php

namespace App\Controller;

use App\Model\UserManager;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

/**
 * Initialized some Controller common features (Twig...)
 */
abstract class AbstractController
{
    protected Environment $twig;
    protected array|false $user;


    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => false,
                'debug' => true,
            ]
        );
        $this->twig->addExtension(new DebugExtension());
        $userManager = new UserManager();
        // if user's session exist, call the method else false
        $this->user = isset($_SESSION['user_id']) ? $userManager->selectOneById($_SESSION['user_id']) : false;
        // add user's session in user and add in global to have user's session in all
        // twig render
        $this->twig->addGlobal('user', $this->user);
    }
}
