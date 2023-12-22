<?php

namespace App\Model;

use PDO;

class UserManager extends AbstractManager implements IUserManager
{
    public const TABLE = "utilisateur";

    public function insertUser(array $credentials): int
    {
        $role = 1;
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (uti_name,uti_password,role) VALUES (:username,:password,:role)");
        $statement->bindValue(':username', $credentials['username']);
        // hash le mdp pendant l'insertion dans la bdd
        $statement->bindValue(':password', password_hash($credentials['password'], PASSWORD_DEFAULT));
        $statement->bindValue(':role', $role);
        $statement->execute();

        echo "je passe dans ma fonction insertUser";
        // retourne le dernier id entrer
        return (int)$this->pdo->lastInsertId();
    }
}
