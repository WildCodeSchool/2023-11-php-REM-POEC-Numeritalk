<?php

namespace App\Controller;

use App\Model\CategoryManager;

class CategoryController extends AbstractController
{
    private $categoryManager;

    public function __construct(CategoryManager $categoryManager = null)
    {
        parent::__construct();
        $this->categoryManager = $categoryManager ?? new CategoryManager();
    }

    public function indexCategoryAdmin(): string
    {
        $categoryList = $this->categoryManager->getCategoryList();
        return $this->twig->render('Admin/categoryAdmin.html.twig', ['categoryList' => $categoryList]);
    }

    public function getCategoryList(): string
    {
        $categoryList = $this->categoryManager->getCategoryList();
        return $this->twig->render('Home/Category/categoryList.html.twig', ['categoryList' => $categoryList]);
    }

    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credential = array_map('trim', $_POST);
            $this->categoryManager->addCategory($credential);
            header('Location: /admin/category');
        }
    }

    public function deleteCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credential = array_map('trim', $_POST);
            $this->categoryManager->deleteCategory($credential);
            header('Location: /admin/category');
            exit();
        }
    }

    public function updateCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credential = array_map('trim', $_POST);
            $this->categoryManager->updateCategory($credential);
            header('Location: /admin/category');
            exit();
        }
    }
}
