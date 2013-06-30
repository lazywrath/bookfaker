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
    
    public function welcomeAction(){
        
    }


}

