<?php

namespace Src\Controller;

class MessageController
{
    private $messageManager;

    public function __construct(\Src\Model\IMessageManager $messageManager)
    {
        $this->messageManager = $messageManager;
    }

    public function listMessages()
    {
        return $this->messageManager->getListMessage();
    }
}
