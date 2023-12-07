<?php

namespace Src\Controller;

class CategorieController
{
    private $categorieManager;

    public function __construct(\Src\Model\ICategorieManager $categorieManager)
    {
        $this->categorieManager = $categorieManager;
    }

    public function listCategories()
    {
        return $this->categorieManager->getListCategorie();
    }
}
