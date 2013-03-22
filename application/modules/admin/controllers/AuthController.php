<?php

class Admin_AuthController extends App_Controller_Action
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {       	
        $this->_helper->layout->setLayout('login');
        
        if ($this->_request->isPost()) {            
            
            $data = $this->_getAllParams();
            
            $f = new Zend_Filter_StripTags();
            
            $email = $f->filter($data['email']);
            $clave = $f->filter($data['clave']);
            $usuario = new App_Model_Usuario();
            $valido = $usuario->loguinUsuario($email, $clave, array(App_Model_Usuario::TIPO_ADMIN));
            
            if (Zend_Auth::getInstance()->hasIdentity()) {
                echo "entro";exit;
                $this->_helper->redirector->gotoUrl('/admin/producto');
            }
            else {
                echo "nada";exit;
            }

            $this->_flashMessenger->addMessage("Intentelo nuevamente datos incorrectos");
        }
        
        
    } 

}

