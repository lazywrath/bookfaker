<?php

class Bookfaker_Form_RegisterUser extends Zend_Form{
    
    public function __construct($options = null){
        
        parent::__construct($options);
        
       $firstname = new Zend_Form_Element_Text('firstname'); 
       $firstname->setLabel($this->translate("Prénom"));
       $firstname->setRequired(TRUE);
       
       $lastname = new Zend_Form_Element_Text('lastname'); 
       $lastname->setLabel($this->translate("Nom"));
       $lastname->setRequired(TRUE);
        
       $username = new Zend_Form_Element_Text('username'); 
       $username->setLabel($this->translate("Pseudo"));
       $username->setRequired(true);
        
       $address = new Zend_Form_Element_Text('address'); 
       $address->setLabel($this->translate("Adresse"));
       $address->setRequired(true);
       
       $zip = new Zend_Form_Element_Text('zip'); 
       $zip->setLabel($this->translate("Code Postal"));
       $zip->setRequired(true);
       
       $submit = new Zend_Form_Element_Submit('submit');
       $submit->setLabel('Valider');
       
       $this->addElements(array($username,$submit));
    }
    
}

?>
