<?php

namespace App\Model;

use PDO;
use DateTimeZone;
use DateTime;

class MessageManager implements IMessageManager
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get message's list from database
     */
    public function getListMessage($subjectId)
    {
        $sql = "SELECT message.id, message.mes_contenu, sujet.suj_name as sujet, 
        utilisateur.uti_name,sujet.id as id_sujet, DATE_FORMAT(date_publication,'%d/%m/%Y %H:%i:%s')
        AS date_formatee
         FROM message 
         INNER JOIN sujet ON message.sujet = sujet.id 
         INNER JOIN utilisateur ON message.utilisateur = utilisateur.id 
         WHERE message.sujet = :subjectId
         ORDER BY date_publication";
        $stmt = $this->pdo->prepare($sql);
        // execute request and check error
        if (!$stmt->execute(['subjectId' => $subjectId])) {
            return [];
        }
        // get result
        $results = $stmt->fetchAll();
        return $results;
    }

    /**
     * Get a message from the database
     */
    public function getMessageById($messageId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM message WHERE id = ?");
        $stmt->execute([$messageId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Add a message in the database
     */
    public function postMessage($subjectId, $messageContent, $userId)
    {
        $dateTimeZone = new DateTimeZone("Europe/Paris");
        $today = new DateTime('now', $dateTimeZone);
        $todayString = $today->format('Y-m-d H:i:s');
        $sql = "INSERT INTO message (mes_contenu, utilisateur, sujet,date_publication) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$messageContent, $userId, $subjectId,$todayString]);
    }

    /**
     * Edit a message in the database
     */
    public function editMessage($messageId, $newContent)
    {
        $sql = "UPDATE message SET mes_contenu = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$newContent, $messageId]);
    }

    /**
     * Delete a message in the database
     */
    public function deleteMessage($messageId)
    {
        $sql = "DELETE FROM message WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$messageId]);
    }
}
