<?php

use Application\Model\Entities;

class UserController extends Bookfaker_Controller_Frontend_Action
{
    public function init() {
        parent::init();
    }

    public function registerAction()
    {
        $form = new Bookfaker_Form_RegisterUser();
        
        if($this->getRequest()->isPost()){
            
            $data = $this->getRequest()->getParams();
            
            if($form->isValid($data)){
                $user = new Application\Model\Entities\User($data);
                
                $this->_entityManager->persist($user);
                $this->_entityManager->flush();
                
                // Log in + redirect
                $this->_redirect('/frontend/user/welcome');
            }else{
                $form->populate($data);
            }
        }
        
        $this->view->form = $form;
    }
    public function loginAction(){
       $db = Zend_Db_Table::getDefaultAdapter();

        $loginForm = new Bookfaker_Form_LoginUser();
 
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
                $repoUser = $this->_entityManager->getRepository('Application\Model\Entities\User');
                $user = $repoUser->findOneBy(array('username' => $loginForm->getValue('username')));
                
                $authNamespace = new Zend_Session_Namespace('auth');
                $authNamespace->user = $user;
                $this->_redirect('/frontend');
                return;
            }
 
        }
        
        $this->view->form = $loginForm;
    }
   
    public function logoutAction(){
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/frontend');
    }

    public function welcomeAction(){
        
    }


}

