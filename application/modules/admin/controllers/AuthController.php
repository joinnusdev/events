<?php

class Admin_AuthController extends App_Controller_Action
{

    
    
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
                
                $this->_helper->redirector->gotoUrl('/admin/usuario');
            }
            else {
                $this->_helper->redirector->gotoUrl('/admin/');
            }

            $this->_flashMessenger->addMessage("Intentelo nuevamente datos incorrectos");
        }
    } 
    public function logoutAction()
    {       	
        $this->_helper->layout->disableLayout();
        $auth = Zend_Auth::getInstance();
        
        if ($auth->hasIdentity()) {            
            $data = $auth->getStorage()->read();
           
            $auth->clearIdentity();
            if ($data->tipoUsuario == 1)
                $this->_helper->redirector->gotoUrl('/admin');
            
            $this->_helper->redirector->gotoUrl('/');
            
            
        } else {
            $this->_helper->redirector->gotoUrl('/');
        }

    } 

}

