<?php

class Admin_AuthController extends App_Controller_Action_Admin
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {       	
        $this->_helper->layout->setLayout('login');
        
        
    } 

}

