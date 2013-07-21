<?php

class BetController extends Bookfaker_Controller_Frontend_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
    
    public function saveBetsAction(){
        
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        $body = $this->getRequest()->getRawBody();
        $data = Zend_Json::decode($body);
    }
    
    // Mise en session des paris en cours
    public function setSessionAction(){
        
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        $bets = $this->getRequest()->getRawBody();
        $betsNamespace = new Zend_Session_Namespace('bets');
        $betsNamespace->bets = $bets;
        
        echo json_encode(array("state"=>1));
    }
    
    public function getSessionAction(){
        
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        $betsNamespace = new Zend_Session_Namespace('bets');
        
        echo json_encode(array("state"=>1, "bets"=> $betsNamespace->bets ));
    }
    
    public function clearSessionAction(){
        
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        $betsNamespace = new Zend_Session_Namespace('bets');
        unset($betsNamespace->bets);
        
        echo json_encode(array("state"=>1));
    }

    

}

