<?php

class Bookfaker_Form_RegisterUser extends Zend_Form{
    
    public function __construct($options = null){
        
        parent::__construct($options);
        
       $username = new Zend_Form_Element_Text('username'); 
       $username->setLabel("Pseudo");
       $username->setRequired(true);
       $username->addValidator(new Zend_Validate_Db_NoRecordExists('bf_user', 'username'))
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        
       $password = new Zend_Form_Element_Password('password'); 
       $password->setLabel("Mot de passe");
       $password->setRequired(true);
       
       $email = new Zend_Form_Element_Text('email'); 
       $email->setLabel("Email");
       $email->setRequired(true);
       $email->addValidator(new Zend_Validate_Db_NoRecordExists('bf_user', 'email'))
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('EmailAddress')
                ->addValidator('NotEmpty');

        
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
                   $username,
                   $password,
                   $email,
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
