<?php

namespace App\Controller;

use App\Model\CategoryManager;

// use App\Controller\SubjectController;
class CategoryController extends AbstractController
{
    public function getCategoryList(): string
    {
        $categoryManager = new CategoryManager();
        $categoryList = $categoryManager->getCategoryList();
        // var_dump($categoryList);
        return $this->twig->render(
            'Home/Category/categoryList.html.twig',
            ['categoryListe' => $categoryList]
        );
    }

    /**
     * Cette fonction va retourner une chaîne de caractère
     */
    public function getSubjectList(int $idCategory)
    {
        echo "je suis dans le controller " . $idCategory;

        // Appel de la méthode pour sujet Controller
        // $subjectController = new SubjectController();
        // $subjectList = $subjectController->getSubjectList($idCategory);

        // Page où il aura la liste des sujets
        // Je devrais mettre l'objet sujet avec l'objet
        // return $this->$twig->render('');
    }
}
