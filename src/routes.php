<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'user/login' => ['UserController', 'login',],
    'user/logout' => ['UserController', 'logout',],
    'user/register' => ['UserController', 'register',],
    'user/profil' => ['UserController', 'profil',],
    'category' => ['CategoryController', 'getCategoryList',],
    'admin' => ['AdminController', 'index',],
    'admin/category' => ['CategoryController', 'indexCategoryAdmin',],
    'admin/category/add' => ['CategoryController', 'addCategory',],
    'admin/category/delete' => ['CategoryController', 'deleteCategory',],
    'admin/category/edit' => ['CategoryController', 'updateCategory',],

    // Routes from 'dev' branch
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],

    'messages' => ['MessageController', 'listMessages', ['subjectId']],
    'messages/post' => ['MessageController', 'postMessageForm'],
    'messages/update' => ['MessageController', 'editMessage',],
    'messages/delete' => ['MessageController', 'deleteMessage', ['messageId']],
];
