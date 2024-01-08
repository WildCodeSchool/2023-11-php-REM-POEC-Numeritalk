<?php

namespace App\Controller;

use App\Model\IMessageManager;
use App\Model\MessageManager;
use Twig\Environment;

class MessageController extends AbstractController
{
    private $messageManager;

    public function __construct(IMessageManager $messageManager)
    {
        parent::__construct();
        $this->messageManager = $messageManager;
    }

    /**
     * Get message's list with a subject's id
     * type parameter : string subjectId
     * return string : list.html.twig
     * object : messages
     */
    public function listMessages(string $subjectId): string
    {
        $messages = $this->messageManager->getListMessage($subjectId);


        return $this->twig->render('messages/list.html.twig', ['messages' => $messages]);
    }
    /**
     * Add a message with a subject's id
     * parameter : string subjectId
     */
    public function postMessageForm($subjectId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credential = array_map('trim', $_POST);
            $messageContent = $credential['messageContent'];
            // get user's id session
            $userId = $_SESSION['user_id'] ?? null;
            $this->messageManager->postMessage($subjectId, $messageContent, $userId);
            header('Location: /messages?subjectId=' . $subjectId);
        }
    }

    /**
     * display edit message form with a message's id
     * parameter : string messageId
     * return : string edit_form.html.twig
     */
    public function editMessageForm($messageId): string
    {
        $message = $this->messageManager->getMessageById($messageId);
        return $this->twig->render('messages/edit_form.html.twig', ['message' => $message]);
    }

    /**
     * Edit a message
     */
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




    /**
     * Delete a message with message's id
     * parameter : string messageId
     */
    public function deleteMessage($messageId)
    {
        // Get subjectId message before delete them
        $message = $this->messageManager->getMessageById($messageId);
        if (!$message) {
            //if message not exist
            header('HTTP/1.1 404 Not Found');
            echo 'Message not found';
            exit();
        }
        $subjectId = $message['sujet'];

        // delete message
        $this->messageManager->deleteMessage($messageId);

        // redirect to message's list with subject's id
        header('Location: /messages?subjectId=' . $subjectId);
    }
}
