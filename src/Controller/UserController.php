<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    /**
     * login user
     */
    public function login(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean POST
            $credential = array_map('trim', $_POST);
            $userManager = new UserManager();
            $username = $credential['username'];
            $passwords = $credential['password'];
            $user = $userManager->getUser($username);
            if (password_verify($passwords, $user['uti_password'])) {
                // create session with user's id
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

    /**
     * display user's profil with count's message
     */
    public function profil(): string
    {
        $userManager = new UserManager();
        $countMessage = $userManager->getCountMessage($_SESSION['user_id']);
        return $this->twig->render('User/profile.html.twig', ['countMessage' => $countMessage]);
    }


    /**
     * register a user
     */
    public function register(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = $_POST;
            if ($credentials["password"] === $credentials["passwordVerification"]) {
                $userManager = new UserManager();
                if ($userManager->insertUser($credentials)) {
                    header('Location: /user/login');
                    exit();
                }
            } else {
                return $this->twig->render('User/user_form.html.twig');
            }
        }
        return $this->twig->render('User/user_form.html.twig');
    }
}
