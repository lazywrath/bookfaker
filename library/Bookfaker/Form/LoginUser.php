<?php

class Bookfaker_Form_LoginUser extends Zend_Form{
    
    public function __construct($options = null){
        
        parent::__construct($options);
        $this->setMethod('post');
 
        $this->addElement(
            'text', 'username', array(
                'label' => 'Login:',
                'required' => true,
                'filters'    => array('StringTrim'),
            ));
 
        $this->addElement('password', 'password', array(
            'label' => 'Mot de passe:',
            'required' => true,
            ));
 
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Login',
            ));
 
    }
}

