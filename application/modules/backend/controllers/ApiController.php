<?php

use Application\Model\Entities;

class Backend_ApiController extends Bookfaker_Controller_Backend_Action
{

    public function init()
    {
        parent::init();
    }

    //Récupérer les matchs en les triants par 
    //ex : teamOne=Chelsea tout les matchs ou chelsea jouera
    //ex : teamTwo=Newcastle obligatoirement associer à TeamOne il donnera tout les matchs chelsea newcastle ou newcastle chelsea
    //ex : id=1050 match avec l'identifiant xx
    //ex : dateDebut=2013-08-16%2015:00:00 match commencant après le 16 aout 2013 à 15h00m00s
    //ex : dateFin=2013-08-16%2015:00:00 match commencant avant le 16 aout 2013 à 15h00m00s
    //les paramètres peuvent être combinés
    // exemple complet url/public/backend/api/match?dateDebut=2013-08-17%2014:59:59&teamOne=Arsenal matchs d'arsenal commencant après le 17 aout 2013
    public function matchAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $team1Request = $this->getRequest()->getParam('teamOne', null);
        $team2Request = $this->getRequest()->getParam('teamTwo', null);
        $idRequest = $this->getRequest()->getParam('id', null);
        $dateDebutRequest = $this->getRequest()->getParam('dateDebut', null);
        $dateFinRequest = $this->getRequest()->getParam('dateFin', null);
        $resultatNull = $this->getRequest()->getParam('resultatNull', null);
        $arrayMatch= array();

        if($this->getRequest()->getPost('idmatch')){
            $idMatch = $this->getRequest()->getPost('idmatch');
            $resultat = $this->getRequest()->getPost('resultat');
            $match = $this->_entityManager->getRepository('Application\Model\Entities\Match')->findOneById($idMatch);
            switch ($resultat) {
                case 'teamOne':
                    $match->setResultat('1');
                    $this->_entityManager->persist($match);
                    $this->_entityManager->flush();
                    break;

                case 'teamTwo':
                    $match->setResultat('2');
                    $this->_entityManager->persist($match);
                    $this->_entityManager->flush();
                    break;

                case 'draw':
                    $match->setResultat('0');
                    $this->_entityManager->persist($match);
                    $this->_entityManager->flush();
                    break;

                default:
                    # code...
                    break;
            }

            echo $resultat;
        }else{
            if(!$team1Request&&!$team2Request&&!$idRequest){
                $Matchs = $this->_entityManager->getRepository('Application\Model\Entities\Match')->findAll();
                foreach ($Matchs as $key => $Match) {
                    $DateMatch = $Match->getDate();
                    $Championnats = $Match->getTeamOne()->getChampionships();
                    $Sport = $Match->getTeamOne()->getSport();

                    array_push($arrayMatch, array($Match->getId(),$Match->getTeamOne()->getName(),$Match->getTeamTwo()->getName(),$DateMatch->format('Y-m-d H:i:s'),$Match->getResultat(),$Championnats[0]->getName(),$Sport->getName()));
                }
            }else if($team1Request&&!$team2Request&&!$idRequest){

                $TeamOne = $this->_entityManager->getRepository('Application\Model\Entities\Team')->findOneByName($team1Request);
                if($TeamOne){
                    $Matchs = $this->_entityManager->getRepository('Application\Model\Entities\Match')->findByTeamOne($TeamOne->getId());
                    foreach ($Matchs as $key => $Match) {
                        $DateMatch = $Match->getDate();
                        array_push($arrayMatch, array($Match->getId(),$Match->getTeamOne()->getName(),$Match->getTeamTwo()->getName(),$DateMatch->format('Y-m-d H:i:s'),$Match->getResultat(),$Championnats[0]->getName(),$Sport->getName()));
                    }
                    $Matchs = $this->_entityManager->getRepository('Application\Model\Entities\Match')->findByTeamTwo($TeamOne->getId());
                    foreach ($Matchs as $key => $Match) {
                        $DateMatch = $Match->getDate();
                        array_push($arrayMatch, array($Match->getId(),$Match->getTeamOne()->getName(),$Match->getTeamTwo()->getName(),$DateMatch->format('Y-m-d H:i:s'),$Match->getResultat(),$Championnats[0]->getName(),$Sport->getName()));
                    }
                }
            }else if($team1Request&&$team2Request&&!$idRequest){

                $TeamOne = $this->_entityManager->getRepository('Application\Model\Entities\Team')->findOneByName($team1Request);
                $TeamTwo = $this->_entityManager->getRepository('Application\Model\Entities\Team')->findOneByName($team2Request);
                if($TeamOne&&$TeamTwo){
                    $Matchs = $this->_entityManager->getRepository('Application\Model\Entities\Match')->findBy(array('teamOne'=>$TeamOne->getId(),'teamTwo'=>$TeamTwo->getId()));
                    foreach ($Matchs as $key => $Match) {
                        $DateMatch = $Match->getDate();
                        array_push($arrayMatch, array($Match->getId(),$Match->getTeamOne()->getName(),$Match->getTeamTwo()->getName(),$DateMatch->format('Y-m-d H:i:s'),$Match->getResultat(),$Championnats[0]->getName(),$Sport->getName()));
                    }

                    $Matchs = $this->_entityManager->getRepository('Application\Model\Entities\Match')->findBy(array('teamTwo'=>$TeamOne->getId(),'teamOne'=>$TeamTwo->getId()));
                    foreach ($Matchs as $key => $Match) {
                        $DateMatch = $Match->getDate();
                        array_push($arrayMatch, array($Match->getId(),$Match->getTeamOne()->getName(),$Match->getTeamTwo()->getName(),$DateMatch->format('Y-m-d H:i:s'),$Match->getResultat(),$Championnats[0]->getName(),$Sport->getName()));
                    }
                }
            }else if($idRequest){
                $Match = $this->_entityManager->getRepository('Application\Model\Entities\match')->findOneBy(array('id' => $idRequest));
                $DateMatch = $Match->getDate();
                array_push($arrayMatch, array($Match->getId(),$Match->getTeamOne()->getName(),$Match->getTeamTwo()->getName(),$DateMatch->format('Y-m-d H:i:s'),$Match->getResultat(),$Championnats[0]->getName(),$Sport->getName()));
            }

            $newArrayMatch = array();

            if($dateDebutRequest)
                $dateDebutRequestTemp = mktime(substr($dateDebutRequest,11,2),substr($dateDebutRequest,14,2),substr($dateDebutRequest,17,2),substr($dateDebutRequest,5,2),substr($dateDebutRequest,8,2),substr($dateDebutRequest,0,4));

            if($dateFinRequest)
                $dateFinRequestTemp = mktime(substr($dateFinRequest,11,2),substr($dateFinRequest,14,2),substr($dateFinRequest,17,2),substr($dateFinRequest,5,2),substr($dateFinRequest,8,2),substr($dateFinRequest,0,4));


            if(!$dateDebutRequest&&!$dateFinRequest){
                $newArrayMatch = $arrayMatch;
            }else if($dateDebutRequest&&$dateFinRequest){

                foreach ($arrayMatch as $key => $match) {
                    $dateMatchCourantTemp = mktime(substr($match[3],11,2),substr($match[3],14,2),substr($match[3],17,2),substr($match[3],5,2),substr($match[3],8,2),substr($match[3],0,4));
                    
                    if($dateMatchCourantTemp>=$dateDebutRequestTemp&&$dateMatchCourantTemp<=$dateFinRequestTemp){
                        array_push($newArrayMatch, $match);
                    }

                }

            }else if(!$dateDebutRequest&&$dateFinRequest){

                foreach ($arrayMatch as $key => $match) {
                    $dateMatchCourantTemp = mktime(substr($match[3],11,2),substr($match[3],14,2),substr($match[3],17,2),substr($match[3],5,2),substr($match[3],8,2),substr($match[3],0,4));
                    
                    if($dateMatchCourantTemp<=$dateFinRequestTemp){
                        array_push($newArrayMatch, $match);
                    }

                }

            }else if($dateDebutRequest&&!$dateFinRequest){
                
                 foreach ($arrayMatch as $key => $match) {
                    $dateMatchCourantTemp = mktime(substr($match[3],11,2),substr($match[3],14,2),substr($match[3],17,2),substr($match[3],5,2),substr($match[3],8,2),substr($match[3],0,4));

                    if($dateMatchCourantTemp>=$dateDebutRequestTemp){
                        array_push($newArrayMatch, $match);
                    }

                }
            }

            $newnewArrayMatch = array();
            if($resultatNull!=null){
                foreach ($newArrayMatch as $key => $match) {
                    if($match[4]==null){
                        array_push($newnewArrayMatch, $match);
                    }
                }
            }else{
                $newnewArrayMatch = $newArrayMatch;
            }

            print_r(json_encode($newnewArrayMatch));
        }
    }

    //Récupérer les bookmakers
    //ex : name=betclic 
    //ex : id=3 
    //les paramètres peuvent être combinés
    // exemple complet url/public/backend/api/bookmaker/?name=betclic
    public function bookmakerAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $nameRequest = $this->getRequest()->getParam('name', null);
        $idRequest = $this->getRequest()->getParam('id', null);
        $arrayBookmaker= array();

        if(!$nameRequest&&!$idRequest){
            $Bookmakers = $this->_entityManager->getRepository('Application\Model\Entities\Bookmaker')->findAll();
            foreach ($Bookmakers as $key => $Bookmaker) {
                array_push($arrayBookmaker, array($Bookmaker->getId(),$Bookmaker->getName()));
            }
        }else if($nameRequest&&!$idRequest){
            $Bookmakers = $this->_entityManager->getRepository('Application\Model\Entities\Bookmaker')->findByName($nameRequest);
            foreach ($Bookmakers as $key => $Bookmaker) {
                array_push($arrayBookmaker, array($Bookmaker->getId(),$Bookmaker->getName()));
            }
        }else if(!$nameRequest&&$idRequest){
            $Bookmakers = $this->_entityManager->getRepository('Application\Model\Entities\Bookmaker')->findById($idRequest);
            foreach ($Bookmakers as $key => $Bookmaker) {
                array_push($arrayBookmaker, array($Bookmaker->getId(),$Bookmaker->getName()));
            }
        }else if($nameRequest&&$idRequest){
            $Bookmaker = $this->_entityManager->getRepository('Application\Model\Entities\Bookmaker')->findOneBy(array('id' => $idRequest,'name' => $nameRequest));
            array_push($arrayBookmaker, array($Bookmaker->getId(),$Bookmaker->getName()));
        }

        print_r(json_encode($arrayBookmaker));

    }

    //Récupérer les sports
    //ex : name=tennis
    //ex : id=5 
    //les paramètres peuvent être combinés
    // exemple complet url/public/backend/api/sport/?name=football
    public function sportAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $nameRequest = $this->getRequest()->getParam('name', null);
        $idRequest = $this->getRequest()->getParam('id', null);
        $arraySport= array();

        if(!$nameRequest&&!$idRequest){
            $Sports = $this->_entityManager->getRepository('Application\Model\Entities\Sport')->findAll();
            foreach ($Sports as $key => $Sport) {
                array_push($arraySport, array($Sport->getId(),$Sport->getName()));
            }
        }else if($nameRequest&&!$idRequest){
            $Sports = $this->_entityManager->getRepository('Application\Model\Entities\Sport')->findByName($nameRequest);
            foreach ($Sports as $key => $Sport) {
                array_push($arraySport, array($Sport->getId(),$Sport->getName()));
            }
        }else if(!$nameRequest&&$idRequest){
            $Sports = $this->_entityManager->getRepository('Application\Model\Entities\Sport')->findById($idRequest);
            foreach ($Sports as $key => $Sport) {
                array_push($arraySport, array($Sport->getId(),$Sport->getName()));
            }
        }else if($nameRequest&&$idRequest){
            $Sport = $this->_entityManager->getRepository('Application\Model\Entities\Sport')->findOneBy(array('id' => $idRequest,'name' => $nameRequest));
            array_push($arraySport, array($Sport->getId(),$Sport->getName()));
        }

        print_r(json_encode($arraySport));

    }

    //Récupérer les cotes
    //ex : match=838 les cotes du match xx
    //ex : id=5 la cote avec l'id x
    //ex : bookmaker=3 les cotes du bookmaker x
    //les paramètres peuvent être combinés
    // exemple complet url/public/backend/api/odds?match=838&bookmaker=3
    public function oddsAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $matchRequest = $this->getRequest()->getParam('match', null);
        $idRequest = $this->getRequest()->getParam('id', null);
        $bookmakerRequest = $this->getRequest()->getParam('bookmaker', null);
        $arrayOdd= array();

        if(!$matchRequest&&!$idRequest){
            $Odds = $this->_entityManager->getRepository('Application\Model\Entities\Odds')->findAll();
            foreach ($Odds as $key => $Odd) {
                array_push($arrayOdd, array($Odd->getId(),$Odd->getMatch()->getId(),$Odd->getOddsTeamOne(),$Odd->getOddsTeamTwo(),$Odd->getOddsDraw(),$Odd->getBookmaker()->getId()));
            }
        }else if($matchRequest&&!$idRequest){
            $Odds = $this->_entityManager->getRepository('Application\Model\Entities\Odds')->findByMatch($matchRequest);
            foreach ($Odds as $key => $Odd) { 
                array_push($arrayOdd, array($Odd->getId(),$Odd->getMatch()->getId(),$Odd->getOddsTeamOne(),$Odd->getOddsTeamTwo(),$Odd->getOddsDraw(),$Odd->getBookmaker()->getId()));
            }
        }else if($idRequest){
            $Odds = $this->_entityManager->getRepository('Application\Model\Entities\Odds')->findById($idRequest);
            foreach ($Odds as $key => $Odd) {
                array_push($arrayOdd, array($Odd->getId(),$Odd->getMatch()->getId(),$Odd->getOddsTeamOne(),$Odd->getOddsTeamTwo(),$Odd->getOddsDraw(),$Odd->getBookmaker()->getId()));
            }
        }

        print_r(json_encode($arrayOdd));

    }

    //Récupérer les compétitions
    //ex : name=Eng.%20Premier%20League
    //ex : id=945
    //les paramètres peuvent être combinés
    // exemple complet url/public/backend/api/championship/?name=Eng.%20Premier%20League&id=945
    public function championshipAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $nameRequest = $this->getRequest()->getParam('name', null);
        $idRequest = $this->getRequest()->getParam('id', null);
        $arrayChampionship= array();

        if(!$nameRequest&&!$idRequest){
            $Championships = $this->_entityManager->getRepository('Application\Model\Entities\Championship')->findAll();
            foreach ($Championships as $key => $Championship) {
                array_push($arrayChampionship, array($Championship->getId(),$Championship->getName()));
            }
        }else if($nameRequest&&!$idRequest){
            $Championships = $this->_entityManager->getRepository('Application\Model\Entities\Championship')->findByName($nameRequest);
            foreach ($Championships as $key => $Championship) {
                array_push($arrayChampionship, array($Championship->getId(),$Championship->getName()));
            }
        }else if(!$nameRequest&&$idRequest){
            $Championships = $this->_entityManager->getRepository('Application\Model\Entities\Championship')->findById($idRequest);
            foreach ($Championships as $key => $Championship) {
                array_push($arrayChampionship, array($Championship->getId(),$Championship->getName()));
            }
        }else if($nameRequest&&$idRequest){
            $Championship = $this->_entityManager->getRepository('Application\Model\Entities\Championship')->findOneBy(array('id' => $idRequest,'name' => $nameRequest));
            array_push($arrayChampionship, array($Championship->getId(),$Championship->getName()));
        }

        print_r(json_encode($arrayChampionship));

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
                        $datematch = $match['start_date'];
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

                                            $championship->addSport($Sports[0]);
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
                                            $dateTemp = date('Y-m-d H:i:s',mktime(substr($datematch,11,2),substr($datematch,14,2),substr($datematch,17,2),substr($datematch,5,2),substr($datematch,8,2),substr($datematch,0,4)));
                                            $datetime = new DateTime($dateTemp);
                                            $match->setDate($datetime);
                                            $match->setIdchampionnat($Championships[0]->getId());
                                            $match->setResultat(null);
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

                                if($bet['code']=='Ten_Mr2'){
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

                                            $championship->addSport($Sports[0]);
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
                                            $dateTemp = date('Y-m-d H:i:s',mktime(substr($datematch,11,2),substr($datematch,14,2),substr($datematch,17,2),substr($datematch,5,2),substr($datematch,8,2),substr($datematch,0,4)));
                                            $datetime = new DateTime($dateTemp);
                                            $match->setDate($datetime);
                                            $match->setIdChampionnat($Championships[0]->getId());
                                            $this->_entityManager->persist($match);
                                            $this->_entityManager->flush();
                                        }

                                        $Match = $this->_entityManager->getRepository('Application\Model\Entities\Match')->findBy(array('teamOne'=>$TeamOne[0],'teamTwo'=>$TeamTwo[0]));

                                        $coteTeam1 = $bet->choice[0]['odd'];
                                        $coteDraw = '0';
                                        $coteTeam2 = $bet->choice[1]['odd'];

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


            
