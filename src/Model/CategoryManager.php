<?php

namespace App\Model;

use PDO;

class CategoryManager extends AbstractManager
{
    public const TABLE = 'categorie';


    /**
     * Get a category object list to database
     */
    public function getCategoryList(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * add a category in database
     */
    public function addCategory(array $credential): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (cat_name) VALUES (:nameCategory)");
        $stmt->bindValue(':nameCategory', $credential['nameCategory']);
        $stmt->execute();

        return (int)$this->pdo->lastInsertId();
    }

    /**
     * delete a category in database
     */
    public function deleteCategory(array $credential)
    {
        $stmt = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id= :categoryId ");
        $stmt->bindValue(':categoryId', $credential['categoryId']);
        $stmt->execute();
    }

    public function updateCategory(array $credential)
    {
        $stmt = $this->pdo->prepare("UPDATE " . self::TABLE . " SET cat_name = :categoryName 
        WHERE id = :categoryId ");
        $stmt ->bindValue(':categoryName', $credential['nameCategory']);
        $stmt->bindValue(':categoryId', $credential['categoryId']);
        $stmt->execute();
    }
}
