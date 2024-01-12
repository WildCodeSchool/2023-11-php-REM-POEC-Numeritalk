<?php

return [
    // Path Home
    '' => ['HomeController', 'index',],

    // Path User
    'user/login' => ['UserController', 'login',],
    'user/logout' => ['UserController', 'logout',],
    'user/register' => ['UserController', 'register',],
    'user/profil' => ['UserController', 'profil',],

    // Path Category
    'category' => ['CategoryController', 'getCategoryList',],

    // Path Admin
    'admin' => ['AdminController', 'index',],
    'admin/category' => ['CategoryController', 'indexCategoryAdmin',],
    'admin/category/add' => ['CategoryController', 'addCategory',],
    'admin/category/delete' => ['CategoryController', 'deleteCategory',],
    'admin/category/edit' => ['CategoryController', 'updateCategory',],

    // Path Subject
    'subjects' => ['SubjectController', 'index', ['id']],
    'subjects/add' => ['SubjectController', 'addSubjectAndMessage',['categoryId']],
    'subjects/show' => ['SubjectController', 'show', ['id']],
    'subjects/edit' => ['SubjectController', 'edit', ['id']],
    'subjects/delete' => ['SubjectController', 'delete',],

    // Path Message
    'messages' => ['MessageController', 'listMessages', ['subjectId']],
    'messages/post' => ['MessageController', 'postMessageForm',['subjectId']],
    'messages/update' => ['MessageController', 'editMessage',],
    'messages/delete' => ['MessageController', 'deleteMessage', ['messageId']],
];
