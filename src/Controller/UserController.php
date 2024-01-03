<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    public function login(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credential = array_map('trim', $_POST);
            $userManager = new UserManager();
            $username = $credential['username'];
            $passwords = $credential['password'];
            $user = $userManager->getUser($username);
            if (password_verify($passwords, $user['uti_password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /');
                exit();
            }
        }
        return $this->twig->render('User/authentification.html.twig');
    }

    /**
     * logout the user and delete the user's session
     */
    public function logout()
    {
        session_destroy();
        header('Location: /');
    }

    public function profil(): string
    {
        $userManager = new UserManager();
        $countMessage = $userManager->getCountMessage($_SESSION['user_id']);


        return $this->twig->render('User/profile.html.twig', ['countMessage' => $countMessage]);
    }

    public function register(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = $_POST;
            $userManager = new UserManager();
            if ($userManager->insertUser($credentials)) {
                header('Location: /user/login');
                exit();
            }
        }
        return $this->twig->render('User/user_form.html.twig');
    }
}
