<?php

use Application\Model\Entities;

class UserController extends Bookfaker_Controller_Frontend_Action
{
    public function init() {
        parent::init();
    }

    public function registerAction()
    {
        $this->view->form = new Bookfaker_Form_RegisterUser();
    }


}

