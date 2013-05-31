<?php

use Application\Model\Entities;

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $em = Zend_Registry::get("entityManager");
        
//        $team1 = new Entities\Team();
//        $team1->setName("PSG");
//        $team2 = new Entities\Team();
//        $team2->setName("OM");
//        $em->persist($team1);
//        $em->persist($team2);
//        
//        $ch1 = new Entities\Championship();
//        $ch1->setName("Ligue1");
//        $ch2 = new Entities\Championship();
//        $ch2->setName("UEFA");
//        $em->persist($ch1);
//        $em->persist($ch2);
//        
//        $em->flush();
        
//        $team1 = $em->find("\Application\Model\Entities\Team", 1);
//        $team2 = $em->find("\Application\Model\Entities\Team", 2);
//        $ch1 = $em->find("\Application\Model\Entities\Championship", 1);
//        $ch2 = $em->find("\Application\Model\Entities\Championship", 2);
//        
//        $team2->addChampionship($ch1);
//        $team2->addChampionship($ch2);
//        $em->persist($team2);
//        
//        $em->flush();
        
    }


}

