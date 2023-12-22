<?php

namespace App\Model;

use PDO;

class MessageManager implements IMessageManager
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getListMessage($subjectId)
    {

        
        $sql="SELECT message.id, message.mes_contenu, sujet.suj_name, utilisateur.uti_name
         FROM message 
         INNER JOIN sujet ON message.sujet = sujet.id 
         INNER JOIN utilisateur ON message.utilisateur = utilisateur.id 
         WHERE message.sujet = :subjectId";
        $stmt = $this->pdo->prepare($sql);

        // Exécutez la requête et vérifiez les erreurs
        if (!$stmt->execute(['subjectId' => $subjectId])) {
            return [];
        }

        // Récupérez les résultats
        $results = $stmt->fetchAll();

        // Affichez les résultats pour le débogage

        return $results;
    }

    public function getMessageById($messageId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM message WHERE id = ?");
        $stmt->execute([$messageId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function postMessage($subjectId, $messageContent, $userId)
    {
        $sql = "INSERT INTO message (mes_contenu, utilisateur, sujet) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$messageContent, $userId, $subjectId]);
    }

    public function editMessage($messageId, $newContent)
    {
        $sql = "UPDATE message SET mes_contenu = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$newContent, $messageId]);
    }

    public function deleteMessage($messageId)
    {
        $sql = "DELETE FROM message WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$messageId]);
    }
}
