<?php

namespace App\Model;

use PDO;

class UserManager extends AbstractManager implements IUserManager
{
    public const TABLE = "utilisateur";
    /**
     * Get a user from the database
     */
    public function getUser(string $username): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE uti_name = :username");
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
    }

    /**
     * Get a user's message count from the database
     */
    public function getCountMessage(int $idUsername): int
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM " . self::TABLE . " 
        INNER JOIN message on utilisateur.id = message.utilisateur
         where utilisateur.id = :id");
        $stmt->bindValue(':id', $idUsername, PDO::PARAM_INT);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    /**
     * Add a user in the database
     */
    public function insertUser(array $credentials): int
    {
        $role = 1;
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (uti_name, uti_password, role, nom, 
        prenom, date_naissance, email, pays) 
        VALUES (:username, :password, :role, :lastname, :firstname, :birth, :mail, :country)");
        $statement->bindValue(':username', $credentials['username']);
        $statement->bindValue(':password', password_hash($credentials['password'], PASSWORD_DEFAULT));
        $statement->bindValue(':role', $role);
        $statement->bindValue(':lastname', $credentials['lastname']);
        $statement->bindValue(':firstname', $credentials['firstname']);
        $statement->bindValue(':birth', $credentials['dateOfBirth']);
        $statement->bindValue(':mail', $credentials['email']);
        $statement->bindValue(':country', $credentials['country']);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
