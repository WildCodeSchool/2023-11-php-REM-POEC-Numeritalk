<?php

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

   
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
  
    'messages' => ['MessageController', 'listMessages', ['subjectId']],
    'messages/post' => ['MessageController', 'postMessageForm'],
    'user/register' => ['UserController', 'register',],
    'subjects' => ['SubjectController', 'index', ['id']],
    'subjects/add' => ['SubjectController', 'add',],
    'subjects/show' => ['SubjectController', 'show', ['id']],
    'subjects/edit' => ['SubjectController', 'edit', ['id']],
    'subjects/delete' => ['SubjectController', 'delete',],
    'messages' => ['MessageController', 'listMessages', ['subjectId']],
    'messages/post' => ['MessageController', 'postMessageForm'],
    'messages/update' => ['MessageController', 'editMessage',],
    'messages/delete' => ['MessageController', 'deleteMessage', ['messageId']],
];
