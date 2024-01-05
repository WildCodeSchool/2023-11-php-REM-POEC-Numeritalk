<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{
    /**
     * Display admin's dashboard
     */
    public function index(): string
    {

        return $this->twig->render('Admin/dashboard.html.twig');
    }
}
