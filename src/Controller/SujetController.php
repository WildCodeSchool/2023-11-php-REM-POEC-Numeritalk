<?php

namespace Src\Controller;

class SujetController
{
    private $sujetManager;

    public function __construct(\Src\Model\ISujetManager $sujetManager)
    {
        $this->sujetManager = $sujetManager;
    }

    public function listSujets()
    {
        return $this->sujetManager->getListSujet();
    }
}
