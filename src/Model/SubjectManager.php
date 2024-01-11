<?php

namespace App\Model;

use PDO;

class SubjectManager extends AbstractManager implements ISubjectManager
{
    public const TABLE = 'sujet';
    /**
     * Get a subject's list from the database
     */
    public function getListSubject($categoryId)
    {
        $sql = "SELECT sujet.suj_name,sujet.categorie,utilisateur.uti_name,sujet.id, 
        DATE_FORMAT(MAX(date_publication),'%d/%m/%Y %H:%i')
        AS date_formatee
         FROM " . self::TABLE . " 
         INNER JOIN utilisateur ON sujet.utilisateur = utilisateur.id
         INNER JOIN message ON sujet.id = message.sujet  
         WHERE sujet.categorie = :categoryId
         GROUP BY sujet.suj_name, sujet.categorie, utilisateur.uti_name, sujet.id 
         ORDER BY MAX(date_publication) DESC";
        $stmt = $this->pdo->prepare($sql);
        // execute request and check error
        if (!$stmt->execute(['categoryId' => $categoryId])) {
            return [];
        }
        // get result
        $results = $stmt->fetchAll();
        return $results;
    }

    /**
     * Insert new subject in database
     */
    public function insert(array $subject, int $user, $categoryId): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (suj_name, categorie, utilisateur) 
        VALUES (:name, :category, :user)");
        $statement->bindValue('name', $subject['subjectName'], PDO::PARAM_STR);
        $statement->bindValue('category', $categoryId, PDO::PARAM_INT);
        $statement->bindValue('user', $user, PDO::PARAM_INT);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update subject in database
     */
    public function update(array $subject, int $id): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `suj_name` = :name WHERE id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->bindValue('name', $subject['suj_name'], PDO::PARAM_STR);
        return $statement->execute();
    }
}
