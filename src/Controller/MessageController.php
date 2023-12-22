<?php

namespace App\Controller;

use App\Model\IMessageManager;
use App\Model\MessageManager;
use Twig\Environment;

class MessageController
{
    private $messageManager;
    private $twig;

    public function __construct(IMessageManager $messageManager, Environment $twig)
    {
        $this->messageManager = $messageManager;
        $this->twig = $twig;
    }

    public function listMessages(string $subjectId)
    {
        $messages = $this->messageManager->getListMessage($subjectId);


        echo $this->twig->render('messages/list.html.twig', ['messages' => $messages]);
    }

    public function postMessageForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credential = array_map('trim', $_POST);
            $subjectId = $credential['subjectId'];
            $messageContent = $credential['messageContent'];
            $userId = $credential['userId'];


            $this->messageManager->postMessage($subjectId, $messageContent, $userId);
            echo"mon header";
            header('Location: /messages?subjectId=' . $subjectId);
        }
    }

    public function editMessageForm($messageId)
    {
        $message = $this->messageManager->getMessageById($messageId);
        echo $this->twig->render('messages/edit_form.html.twig', ['message' => $message]);
    }

    public function editMessage()
    {
        error_log("editMessage called");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            error_log("POST data: " . print_r($_POST, true));

            if (!isset($_POST['messageId']) || empty($_POST['newContent'])) {
                error_log("Error: Message ID or content missing");
                header('HTTP/1.1 400 Bad Request');
                echo json_encode(['error' => 'Message ID and content are required.']);
                return;
            }

            $messageId = $_POST['messageId'];
            $newContent = $_POST['newContent'];

            $message = $this->messageManager->getMessageById($messageId);
            if (!$message) {
                error_log("Error: Message not found");
                header('HTTP/1.1 404 Not Found');
                echo json_encode(['error' => 'Message not found.']);
                return;
            }
            $subjectId = $message['sujet'];

            $this->messageManager->editMessage($messageId, $newContent);
            header('Location: /messages?subjectId=' . $subjectId);
        }
    }




    public function deleteMessage($messageId)
    {
    // Récupérer le subjectId du message avant de le supprimer
        $message = $this->messageManager->getMessageById($messageId);
        if (!$message) {
        // Gérer l'erreur si le message n'existe pas
            header('HTTP/1.1 404 Not Found');
            echo 'Message not found';
            exit();
        }
        $subjectId = $message['sujet'];

    // Supprimer le message
        $this->messageManager->deleteMessage($messageId);

    // Rediriger vers la liste des messages pour le sujet concerné
        header('Location: /messages?subjectId=' . $subjectId);
    }
}
