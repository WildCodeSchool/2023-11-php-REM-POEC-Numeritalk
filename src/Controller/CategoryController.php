<?php

namespace App\Controller;

use App\Model\CategoryManager;

class CategoryController extends AbstractController
{
    /**
     * Display category's list in admin's space
     */
    public function indexCategoryAdmin(): string
    {
        $categoryManager = new CategoryManager();
        $categoryList = $categoryManager->getCategoryList();
        return $this->twig->render('Admin/categoryAdmin.html.twig', ['categoryList' => $categoryList]);
    }
    /**
     * Get category's list
     * return : string, categoryList.html.twig
     */
    public function getCategoryList(): string
    {
        $categoryManager = new CategoryManager();
        $categoryList = $categoryManager->getCategoryList();
        return $this->twig->render('Home/Category/categoryList.html.twig', ['categoryList' => $categoryList]);
    }

    /**
     * Add a category, forward to indexCategoryAdmin
     */
    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credential = array_map('trim', $_POST);
            $categoryManager = new CategoryManager();
            $categoryManager->addCategory($credential);
            header('Location: /admin/category');
            exit();
        }
    }

    /**
     * Delete a category, forward to indexCategoryAdmin
     */
    public function deleteCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credential = array_map('trim', $_POST);
            $categoryManager = new CategoryManager();
            $categoryManager->deleteCategory($credential);
            header('Location: /admin/category');
            exit();
        }
    }
    /**
     * Change category's name and forward to indexCategoryAdmin
     */
    public function updateCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credential = array_map('trim', $_POST);
            $categoryManager = new CategoryManager();
            $categoryManager->updateCategory($credential);
            header('Location: /admin/category');
            exit();
        }
    }
}
