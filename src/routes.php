<?php

return [
    '' => ['HomeController', 'index',],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],

    'messages' => ['MessageController', 'listMessages', ['subjectId']],
    'messages/post' => ['MessageController', 'postMessageForm'],
    // 'messages/edit' => ['MessageController', 'editMessageForm', ['messageId']],
    'messages/update' => ['MessageController', 'editMessage',],
    'messages/delete' => ['MessageController', 'deleteMessage', ['messageId']],
];
