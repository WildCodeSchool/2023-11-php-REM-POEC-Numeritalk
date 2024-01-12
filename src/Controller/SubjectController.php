<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Controller\MessageController;
use App\Model\IMessageManager;

class SubjectController extends AbstractController
{
    private $messageController;

    public function __construct(IMessageManager $messageManager)
    {
        // Si vous avez besoin d'appeler le constructeur du parent
        parent::__construct();

        $this->messageController = new MessageController($messageManager);
    }
    /**
     * List subjects
     */
    public function index(int $id): string
    {
        $subjectManager = new SubjectManager();
        $subjectList = $subjectManager->getListSubject($id);
        // ou alors : $subjects = $subjectManager->selectAll();
        return $this->twig->render('Subject/index.html.twig', [
            'subjectList' => $subjectList
        ]);
    }

    /**
     * Add a new subject
     */
    public function add($categoryId): int
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $errors = [];
            $subject = array_map('trim', $_POST);

            // TODO validations (length, format...)
            if (
                empty($subject['subjectName']) || strlen($subject['subjectName']) > 255
            ) {
                $errors[] = "Veuillez saisir un sujet";
            }

            // get user's id session in $user
            $user = $_SESSION['user_id'] ?? null;
            if (empty($errors)) {
                $subjectManager = new SubjectManager();
                $subjectId = $subjectManager->insert($subject, $user, $categoryId);
                return $subjectId;
            }
        }
        return 0;
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

    /**
     * add a subject and message, and call
     */
    public function addSubjectAndMessage($categoryId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // call add method and return subject's id in subjectId
            $subjectId = $this->add($categoryId);
            //call postMessageForm method from MessageController
            $this->messageController->postMessageForm($subjectId);
        }
    }
}
