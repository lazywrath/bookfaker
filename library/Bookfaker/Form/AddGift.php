<?php

class Bookfaker_Form_AddGift extends Zend_Form{
    
    public function __construct($options = null){
        
        parent::__construct($options);
        $this->setMethod('post');
 
        $this->addElement(
            'text', 'nameGift', array(
                'label' => 'Nom du cadeau:',
                'required' => true,
                'filters'    => array('StringTrim'),
            ));
 
        $this->addElement('text', 'bookiesGift', array(
            'label' => 'Prix en bookies:',
            'required' => true,
            'filters' => array('Int')
            ));
 
        $this->addElement('text', 'imageGift', array(
            'label' => 'Image du cadeau:',
            'required' => true,
            ));
 
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Add gift',
            ));
 
    }
}

