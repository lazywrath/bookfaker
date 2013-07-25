<?php

use Application\Model\Entities;

class IndexController extends Bookfaker_Controller_Frontend_Action
{
    public function init() {
        parent::init();
        
        $sport        = $this->_request->getParam('sport', null);
        $idChampionship = $this->_request->getParam('championship', null);
        
        $repoSport = $this->_entityManager->getRepository('Application\Model\Entities\Sport');
        
        
        if(null != $sport){
            $idSport = $repoSport->findOneByName($sport)->getId();
        }else{
            $idSport = null;
        }
        
        
        $this->view->idSport = (int)$idSport;
        $this->view->idChampionship = (int)$idChampionship;
    }

    public function parisAction()
    {

    }
    
    public function indexAction(){
        
    }


}

