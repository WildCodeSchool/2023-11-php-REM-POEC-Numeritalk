<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    public function register(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = $_POST;

            $userManager = new UserManager();

            // appel la methode insert avec les post du formulaire contenu dans le tableau $_POST
            //  qui est dans credentials
            if ($userManager->insertUser($credentials)) {
                echo "je passe dans le controller register";
                header('Location: /user/login');
                exit();
            }
        }
        return $this->twig->render('User/user_form.html.twig');
    }
}
