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
        return $this->twig->render('Home/Category/categoryList.html.twig', ['categoryListe' => $categoryList]);
    }

    /**
     * cette fonction va retourner une chaine de caractere
     */
    public function getSubjectList(int $idCategory)
    {
        echo "je suis dans le controller " . $idCategory;

        //appel de la methode pour sujet Controller
        // $subjectController = new SubjectController();
        // $subjectList = $subjectController->getSubjectList($idCategory);

        // page où il aura la liste des sujets
        // je devrais mettre l'objet sujet avec l'objet
        // return $this->$twig->render('');
    }
}
