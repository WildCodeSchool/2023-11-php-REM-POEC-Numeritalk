<?php

namespace Src\Controller;

class SubjectController 
{
    private $subjectManager;

    public function __construct(\Src\Model\ISubjectManager $subjectManager) 
    {
        $this->subjectManager = $subjectManager;
    }

    public function listSubjects() 
    {
        return $this->subjectManager->getListSubject();
    }
}
