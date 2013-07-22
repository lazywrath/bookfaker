<?php

use Application\Model\Entities;

class IndexController extends Bookfaker_Controller_Frontend_Action
{
    public function init() {
        parent::init();
    }

    public function indexAction()
    {
        $idSport        = $this->_request->getParam('sport', null);
        $idChampionship = $this->_request->getParam('championship', null);
        
        $this->view->idSport = (int)$idSport;
        $this->view->idChampionship = (int)$idChampionship;

    }


}

