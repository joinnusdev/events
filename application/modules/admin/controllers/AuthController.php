<?php

class Admin_AuthController extends Zend_Controller_Action
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

