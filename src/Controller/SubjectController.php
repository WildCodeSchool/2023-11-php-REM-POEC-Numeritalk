<?php

namespace App\Controller;

use App\Model\SubjectManager;

class SubjectController extends AbstractController
{
    /**
     * List subjects
     */
    public function index(): string
    {
        $subjectManager = new SubjectManager();
        $subjectList = $subjectManager->selectAll();
        // ou alors : $subjects = $subjectManager->selectAll();
        return $this->twig->render('Subject/index.html.twig', [
            'subjectList' => $subjectList
        ]);
    }  

    /**
     * Add a new subject
     */
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $errors = [];
            $subject = array_map('trim', $_POST);

            // TODO validations (length, format...)
            if (empty($subject['suj_name']) || strlen($subject['suj_name']) === 0 || strlen($subject['suj_name']) >255) {
               $errors[] = "Veuillez saisir un sujet";
            } 
            
            $user = 1;
            // ligne du dessus à supprimer par la suite
            if(empty($errors)) {
                $subjectManager = new SubjectManager();
                $subjectManager->insert($subject, $user);
                header('Location:/subjects');
            }
            return $this->twig->render('Subject/add.html.twig');

            // if validation is ok, insert and redirection
            return null;
        }

        return $this->twig->render('Subject/add.html.twig');
    }

    /**
     * Show informations for a specific subject
     */
    public function show(int $id): string
    {
        $subjectManager = new SubjectManager();
        $subject = $subjectManager->selectOneById($id);

        return $this->twig->render('Subject/show.html.twig', [
            'subject' => $subject
        ]);
    }    

    /**
     * Edit a specific subject
     */
    public function edit(int $id): ?string
    {
        $subjectManager = new SubjectManager();
        $subject = $subjectManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $subject = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $subjectManager->update($subject, $id);

            header('Location: /subjects/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('Subject/edit.html.twig', [
            'subject' => $subject,
        ]);
    }

    /**
     * Delete a specific subject
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $subjectManager = new SubjectManager();
            $subjectManager->delete((int)$id);

            header('Location: /subjects');
        }
    }
}
