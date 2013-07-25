<?php

class Bookfaker_Form_LoginUser extends Zend_Form{
    
    public function __construct($options = null){
        
        parent::__construct($options);
        
        $this->setAction($this->getView()->url(array('module' => 'frontend','controller' => 'user','action' => 'login')));
        
        $this->setMethod('post');
 
        $this->addElement(
            'text', 'username', array(
                'label' => 'Login:',
                'required' => true,
                'filters'    => array('StringTrim'),
                'placeholder' => 'Pseudo  (requis)'
            ));
        
 
        $this->addElement('password', 'password', array(
            'label' => 'Mot de passe:',
            'required' => true,
            'placeholder' => 'Mot de passe  (requis)'
            ));
 
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Login',
            ));
        
        foreach($this->getElements() as $element)
        {
            $element->removeDecorator('Label');
        }
 
    }
}

