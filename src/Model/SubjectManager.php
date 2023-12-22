<?php

namespace App\Model;

use PDO;

class SubjectManager extends AbstractManager implements ISubjectManager
{
    public const TABLE = 'sujet';

    /**
     * Insert new subject in database
     */
    public function insert(array $subject, int $user): string
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (suj_name, categorie, utilisateur) VALUES (:name, :category, :user)");
        $statement->bindValue('name', $subject['suj_name'], PDO::PARAM_STR);
        $statement->bindValue('category', $subject['category'], PDO::PARAM_INT);
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

    // ajouter methode select (pour afficher listes de sujets) ?
}
