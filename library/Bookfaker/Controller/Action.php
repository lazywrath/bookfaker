<?php

class Bookfaker_Controller_Action extends Zend_Controller_Action{
    
    protected $_entityManager;
    
    public function init() {
        parent::init();
        
        $this->_entityManager = Zend_Registry::get("entityManager");
    }
}

?>
