<?php

class Bookfaker_Form_EditUser extends Zend_Form{
    
    public function __construct($options = null){
        
        parent::__construct($options);
        
        $this->setAction($this->getView()->url(array('module' => 'frontend','controller' => 'user','action' => 'edit')));
        
       $firstname = new Zend_Form_Element_Text('firstname'); 
       $firstname->setLabel("Prénom");
       $firstname->setRequired(false);
       
       $lastname = new Zend_Form_Element_Text('lastname'); 
       $lastname->setLabel("Nom");
       $lastname->setRequired(false);
        
       $address = new Zend_Form_Element_Text('address'); 
       $address->setLabel("Adresse");
       $address->setRequired(false);
       
       $zip = new Zend_Form_Element_Text('zip'); 
       $zip->setLabel("Code Postal");
       $zip->setRequired(false);
       
       $city = new Zend_Form_Element_Text('city'); 
       $city->setLabel("Ville");
       $city->setRequired(false);

       $submit = new Zend_Form_Element_Submit('submit');
       $submit->setLabel('Valider');
       
       $this->addElements(
               array(
                   $firstname,
                   $lastname,
                   $address,
                   $city,
                   $zip,
                   $submit
                   )
               );
    }
    
}

?>
