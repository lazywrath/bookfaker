<?php
use Application\Model\Entities;

class GiftController extends Bookfaker_Controller_Frontend_Action
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }
    
    public function indexAction(){
        
        $repoGift = $this->_entityManager->getRepository('Application\Model\Entities\Gift');
        
        $idGift = $this->_request->getParam("idGift", null);
        
        // Le user essaye de prendre un cadeau
        if(null != $idGift){
            $gift = $repoGift->findBy($idGift);
            
            if(null != $gift){
                // On check si le user a assez de bookies
                if($gift->getBookies() <= $this->_user->getMoneybank()){
                    
                    $commande = new Application\Model\Entities\Commande(array("user" =>$this->_user, "gift"=> $gift, "date" => date("Y-m-d")));
                    
                    $this->_entityManager->persist($commande);
                    $this->_entityManager->flush();
                    
                    $this->view->message = "Votre cadeau est commandé !";
                }else{
                    $this->view->message = "Vous n'avez pas assez de Bookies !";
                }
            }
        }
            
        $gifts = $repoGift->findAll();
        
        $this->view->gifts = $gifts;
        
    }
    
}

