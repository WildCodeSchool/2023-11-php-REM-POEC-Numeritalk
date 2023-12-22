<?php

namespace App\Model;

use PDO;

class CategoryManager extends AbstractManager
{
    public const TABLE = 'categorie';

    public function getCategoryList(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
