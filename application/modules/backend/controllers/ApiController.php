<?php

use Application\Model\Entities;

class Backend_ApiController extends Bookfaker_Controller_Backend_Action
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        set_time_limit(600);
            $this->_helper->layout()->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);

            $url = 'http://xml.cdn.betclic.com/odds_en.xml'; 
            //$url='exploration.xml'; 

            $Bookmaker = $this->_entityManager->getRepository('Application\Model\Entities\Bookmaker')->findByName('betclic');
            if(empty($Bookmaker)){
                echo 'add Bookmaker </br>';
                $bookmaker = new Entities\Bookmaker();
                $bookmaker->setName('betclic');
                $this->_entityManager->persist($bookmaker);
                $this->_entityManager->flush();
            }
            $Bookmaker = $this->_entityManager->getRepository('Application\Model\Entities\Bookmaker')->findByName('betclic');
                                        
            $rss_file = file_get_contents($url); 

            $xml = new SimpleXMLElement($rss_file); 
            foreach ($xml as $key => $sport) {
                $namesport = $sport['name'];
                foreach ($sport as $key => $event) {
                    $nameevent = $event['name'];
                    foreach ($event as $key => $match) {
                        $namematch = $match['name'];
                        foreach ($match as $key => $bets) {
                            foreach ($bets as $key => $bet) {
                                if($bet['code']=='Ftb_Mr3'){
                                     $Sports = $this->_entityManager->getRepository('Application\Model\Entities\Sport')->findByName($namesport);
                                        if(empty($Sports)){
                                            echo 'add sport </br>';
                                            $sport = new Entities\Sport();
                                            $sport->setName($namesport);
                                            $this->_entityManager->persist($sport);
                                            $this->_entityManager->flush();
                                        }
                                        $Sports = $this->_entityManager->getRepository('Application\Model\Entities\Sport')->findByName($namesport);

                                        $Championships = $this->_entityManager->getRepository('Application\Model\Entities\Championship')->findByName($nameevent);
                                        if(empty($Championships)){
                                            echo 'add championship </br>';
                                            $championship = new Entities\Championship();
                                            $championship->setName($nameevent);
                                            $this->_entityManager->persist($championship);
                                            $this->_entityManager->flush();
                                        }
                                        $Championships = $this->_entityManager->getRepository('Application\Model\Entities\Championship')->findByName($nameevent);

                                        $teams = explode(' - ', $namematch);   

                                        $CheckTeams = $this->_entityManager->getRepository('Application\Model\Entities\Team')->findBy(array('name'=>$teams[0],'sport'=>$Sports[0]->getId()));
                                        if(empty($CheckTeams)){
                                            echo 'add Team </br>';
                                            $team = new Entities\Team();
                                            $team->setName($teams[0]);
                                            $team->setSport($Sports[0]);
                                            $this->_entityManager->persist($team);
                                            $this->_entityManager->flush();

                                            $team->addChampionship($Championships[0]);
                                        }
                                        $TeamOne = $this->_entityManager->getRepository('Application\Model\Entities\Team')->findBy(array('name'=>$teams[0],'sport'=>$Sports[0]->getId()));

                                        $CheckTeams = $this->_entityManager->getRepository('Application\Model\Entities\Team')->findBy(array('name'=>$teams[1],'sport'=>$Sports[0]->getId()));
                                        if(empty($CheckTeams)){
                                            echo 'add Team </br>';
                                            $team = new Entities\Team();
                                            $team->setName($teams[1]);
                                            $team->setSport($Sports[0]);
                                            $this->_entityManager->persist($team);
                                            $this->_entityManager->flush();

                                            $team->addChampionship($Championships[0]);
                                        }
                                        $TeamTwo = $this->_entityManager->getRepository('Application\Model\Entities\Team')->findBy(array('name'=>$teams[1],'sport'=>$Sports[0]->getId()));

                                        $CheckMatch = $this->_entityManager->getRepository('Application\Model\Entities\Match')->findBy(array('teamOne'=>$TeamOne[0],'teamTwo'=>$TeamTwo[0]));
                                        if(empty($CheckMatch)){
                                            echo 'add Match </br>';
                                            $match = new Entities\Match();
                                            $match->setTeamOne($TeamOne[0]);
                                            $match->setTeamTwo($TeamTwo[0]);
                                            $this->_entityManager->persist($match);
                                            $this->_entityManager->flush();
                                        }
                                        $Match = $this->_entityManager->getRepository('Application\Model\Entities\Match')->findBy(array('teamOne'=>$TeamOne[0],'teamTwo'=>$TeamTwo[0]));

                                        $coteTeam1 = $bet->choice[0]['odd'];
                                        $coteDraw = $bet->choice[1]['odd'];
                                        $coteTeam2 = $bet->choice[2]['odd'];

                                        $CheckCote = $this->_entityManager->getRepository('Application\Model\Entities\Odds')->findBy(array('match'=>$Match[0]));
                                        if(empty($CheckCote)){
                                            echo 'add Cote </br>';
                                            $odds = new Entities\Odds();
                                            $odds->setOddsTeamOne($coteTeam1);
                                            $odds->setOddsTeamTwo($coteTeam2);
                                            $odds->setOddsDraw($coteDraw);
                                            $odds->setIdBookmaker($Bookmaker[0]);
                                            $odds->setMatch($Match[0]);
                                            $this->_entityManager->persist($odds);
                                            $this->_entityManager->flush();
                                        }
                                }
                            }
                        }
                    }
                }
            }

    }


}


            
