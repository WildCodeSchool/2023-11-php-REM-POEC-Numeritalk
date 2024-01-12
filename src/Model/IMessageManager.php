<?php

namespace App\Model;

interface IMessageManager
{
    public function getListMessage(string $subjectId);
    public function getMessageById($messageId);
    public function postMessage($subjectId, $messageContent, $userId);
    public function editMessage($messageId, $newContent);
    public function deleteMessage($messageId);
}
