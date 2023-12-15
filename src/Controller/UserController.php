<?php


namespace App\Controller;



use App\Model\UserManager;

class UserController extends AbstractController
{

    // public function index(): string
    // {
    //     return $this->twig->render('Home/authentification.html.twig');
    // }

    public function login(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // permet de recuperer directement les valeurs du POST sans mettre de parametre dans la fonction
            $credential = array_map('trim', $_POST);

            $userManager = new UserManager();
            $username = $credential['username'];
            $passwords = $credential['password'];
            // appel de la methode avec en parametre l'email du POST
            $user = $userManager->getUser($username);
            // var_dump($user['password']);
            // verifie le password du POST et le password de l'user de la bdd
            if (password_verify($passwords, $user['uti_password'])) {
                // affecte l'id user à une session
                var_dump($user['id']);
                $_SESSION['user_id'] = $user['id'];
                header('Location: /');
                exit();
            }
        }

        return $this->twig->render('User/authentification.html.twig');
    }
}
