<?php

use Application\Model\Entities;

class Backend_IndexController extends Bookfaker_Controller_Backend_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$DateAujourdhui =  date('Y-m-d H:i:s',time());
    	$MatchRecents = file_get_contents("http://localhost/public/backend/api/match/?resultatNull=1&dateFin=".$DateAujourdhui);
        $this->view->MatchRecents = json_decode($MatchRecents);
    }

    public function crawlAction(){

    }

}

