<?php

use Application\Model\Entities;

class Backend_IndexController extends Bookfaker_Controller_Backend_Action
{

    public function init()
    {
        Zend_Session::start();
        parent::init();
    }

    public function indexAction()
    { 
        //Zend_Session::namespaceUnset('auth');
        if(Zend_Session::namespaceIsset('auth')){
            $this->resultatAction();
            //$this->view->MatchRecents = array();
            $this->render('resultat');
        }else{
            $this->_redirect('/backend/index/login/');
        }
    }

    public function giftAction(){
        if(!Zend_Session::namespaceIsset('auth')){
            $this->_redirect('/backend/index/login/');
        }
        $giftForm = new Bookfaker_Form_AddGift();
        $this->view->form = $giftForm;

        if ($giftForm->isValid($_POST)) {
            if($this->getRequest()->getPost('nameGift') && $this->getRequest()->getPost('imageGift')&&$this->getRequest()->getPost('bookiesGift')){

                $gift = new Entities\Gift();
                $gift->setName($this->getRequest()->getPost('nameGift') );
                $gift->setBookies($this->getRequest()->getPost('bookiesGift') );
                $gift->setImage($this->getRequest()->getPost('imageGift') );
                $this->_entityManager->persist($gift);
                $this->_entityManager->flush();

                echo 'ajout Gift';
            }else{
                echo 'erreure d\'envoi';
            }
        }else{
            echo 'formulaire invalide';
        }
    }
    public function loginAction()
    {
       $db = Zend_Db_Table::getDefaultAdapter();

        $loginForm = new Bookfaker_Form_LoginAdmin();
 
        if ($loginForm->isValid($_POST)) {
            $adapter = new Zend_Auth_Adapter_DbTable(
                $db,
                'bf_user',
                'username',
               'password',
                'password'
                );
 
            $adapter->setIdentity($loginForm->getValue('username'));
            $adapter->setCredential($loginForm->getValue('password'));
 
            $auth   = Zend_Auth::getInstance();
            $result = $auth->authenticate($adapter);
 
            if ($result->isValid()) {
                
                // On met le user en session
                $repoUser =  $this->_entityManager->getRepository('Application\Model\Entities\User');
                $user = $repoUser->findOneBy(array('username' => $loginForm->getValue('username')));

                if(isset($user)){
                    if($user->getIsAdmin()==1){
                        $authNamespace = new Zend_Session_Namespace('auth');
                        $authNamespace->user = $user;
                        $this->_redirect('/backend/index');
                    }else{
                        echo 'Vous n etes pas admin';
                    }
                }else{
                    echo 'invalid login mdp';
                }
            }
 
        }else{
            echo 'invalid form';
        }
        
        $this->view->form = $loginForm;
    }

    public function crawlAction(){

    }

    public function resultatAction(){
        $DateAujourdhui =  date('Y-m-d H:i:s',time());
        $MatchRecents = file_get_contents("http://localhost/public/backend/api/match/?resultatNull=1&dateFin=".$DateAujourdhui);
        $this->view->MatchRecents = json_decode($MatchRecents);
    }

    public function commandeAction(){
        if(!Zend_Session::namespaceIsset('auth')){
            $this->_redirect('/backend/index/login/');
        }
        $DateAujourdhui =  date('Y-m-d H:i:s',time());
        $Commandes = file_get_contents("http://localhost/public/backend/api/commande");
        $this->view->Commandes = json_decode($Commandes);
    }

}

