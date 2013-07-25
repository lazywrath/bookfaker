<?php
use Application\Model\Entities;

class BetController extends Bookfaker_Controller_Frontend_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }
    
    public function saveBetsAction(){
        
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        // Il faut être connecté pour parier
        if(!Bookfaker_Control::isLogged()){
            echo json_encode(array("state" => 0, "msg" => "Vous devez être connectés pour valider vos paris."));
            return;
        }
        
        $body = $this->getRequest()->getRawBody();
        $data = Zend_Json::decode($body);
        
        $bets = $data["bets"];
        $stake = $data["stacke"];
        $betType = $data["type"];
        
        if(empty($bets) || empty($stake)|| !isset($betType)){
            echo  json_encode(array("state" => -1, "msg" => "Une erreur est survenue."));
            return;
        }
        // On vérifie si le user a assez de bookies
        if($stake >= $this->_user->getMoneybank()){
            echo  json_encode(array("state" => -2, "msg" => "Vous n'avez pas assez de bookies."));
            return;
        }
        
        $repoMatch = $this->_entityManager->getRepository('Application\Model\Entities\Match');
        $repoCombination = $this->_entityManager->getRepository('Application\Model\Entities\Combination');
        $repoUser = $this->_entityManager->getRepository('Application\Model\Entities\User');
        
        $user = $repoUser->findOneById($this->_user->getId());
        
        $isLastIdSet = false;

        foreach($bets as $bet){

            $match = $repoMatch->findOneById($bet['match']['idMatch']);

            if(1 == $bet['team']){
                $odds = $bet['match']['oddsTeamOne'];
            }
            elseif(2 == $bet['team']){
                $odds = $bet['match']['oddsTeamTwo'];
            }
            else{
                $odds = $bet['match']['oddsDraw'];
            }

            $entityBet = new Entities\Bet($bet);
            $entityBet->setStake($stake)
                ->setOdds($odds)
                ->setMatch($match)
                ->setUser($user)
                ->setStatus(0)
                ->setResultat($bet['team']);

            $this->_entityManager->persist($entityBet);
            $this->_entityManager->flush();

            $result = $repoCombination->findBy(array(), array("id"=>"DESC"), 1);
            
            if(!$isLastIdSet){ 
                
                if(null == $result)
                    $lastIdCombination = 0;
                else
                    $lastIdCombination = $result[0]->getId();
                
                if(1 == $betType) // Pour les paris combinés on garde le mm id de combinaison
                    $isLastIdSet = true;
            }

            $combination = new Entities\Combination(array("bet" => $entityBet, "combination" => $lastIdCombination+1, "checkbet" => 0));

            $this->_entityManager->persist($combination);
            $this->_entityManager->flush();
        }
       
        // On met à jour le user
        $newMoneybank = $user->getMoneybank()-$stake;
        $user->setMoneybank($newMoneybank);
        $this->_entityManager->persist($user);
        $this->_entityManager->flush();
        
        Bookfaker_Control::setUserInfos($user);
        
        echo json_encode(array('state' => 1));
            
        
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

