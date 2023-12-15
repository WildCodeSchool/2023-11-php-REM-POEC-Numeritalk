<?php

namespace App\Model;

use PDO;

class UserManager extends AbstractManager implements IUserManager
{
    public const TABLE = "utilisateur";

    public function getUser(string $username): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE uti_name = :username");
        $statement->bindValue(':username', $username, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}
