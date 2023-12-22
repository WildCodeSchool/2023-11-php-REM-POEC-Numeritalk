<?php

namespace App\Controller;

use App\Model\CategoryManager;

class CategoryController extends AbstractController
{
    private $categoryManager;

    public function __construct(CategoryManager $categoryManager = null)
    {
        $this->categoryManager = $categoryManager ?? new CategoryManager();
    }

    /**
     * Display a category object list at Admin/categoryList
     */
    public function indexCategoryAdmin(): string
    {
        $categoryList = $this->categoryManager->getCategoryList();
        return $this->twig->render('Admin/categoryAdmin.html.twig', ['categoryList' => $categoryList]);
    }

    /**
     * Display a category object list at Home/Category/categoryList
     */
    public function getCategoryList(): string
    {
        $categoryList = $this->categoryManager->getCategoryList();
        return $this->twig->render('Home/Category/categoryList.html.twig', ['categoryList' => $categoryList]);
    }

    /**
     * Add a category, redirect to admin/category page
     */
    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credential = array_map('trim', $_POST);
            $this->categoryManager->addCategory($credential);
            header('Location: /admin/category');
        }
    }

    /**
     * Delete id category redirect to admin/category page
     */
    public function deleteCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credential = array_map('trim', $_POST);
            $this->categoryManager->deleteCategory($credential);
            header('Location: /admin/category');
            exit();
        }
    }

    /**
     * Update category redirect to admin/category page
     */
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
