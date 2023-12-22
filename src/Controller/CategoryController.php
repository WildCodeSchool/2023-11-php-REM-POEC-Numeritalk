<?php

namespace Src\Controller;

class CategoryController
{
    private $categoryManager;

    public function __construct(\Src\Model\ICategoryManager $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    public function listCategories()
    {
        return $this->categoryManager->getListCategory();
    }
}
