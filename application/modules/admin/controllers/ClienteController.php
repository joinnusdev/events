<?php

class Admin_ClienteController extends App_Controller_Action_Admin
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {   
        $modelUsuario = new App_Model_Usuario();
        $listaUsuario = $modelUsuario->listarUsuario(App_Model_Usuario::TIPO_CLIENTE);
        $this->view->listaUsuario = $listaUsuario;
    }
    
    public function crearAction()
    {
        $form = new App_Form_CrearCliente();        
        $this->view->form = $form; 
        $form->clave->setRequired(FALSE); 
        
        if($this->getRequest()->isPost()){
            
            $data = $this->getRequest()->getPost();
            
            if ($form->isValid($data)) {
                $model = new App_Model_Usuario();
                $fecha = Zend_Date::now()->toString('YYYY-MM-dd HH:mm:ss');
                $data['fechaUltimoAcceso'] = $fecha;
                $data['email'] = $data['correo'];
                $data['fechaRegistro'] = $fecha;
                $data['ultimaIp'] = $model->_getRealIP();
                $data['estado'] = App_Model_Cliente::ESTADO_ACTIVO;
                $data['numeroVisita'] = 1;
                $data['tipoUsuario'] = App_Model_Usuario::TIPO_CLIENTE;
                $id = $model->actualizarDatos($data);
                
                $this->_flashMessenger->addMessage("Cliente guardado con exito");
                $this->_redirect('/admin/cliente');
                
            } else {
                $form->populate($data);
                var_dump($form->getMessages());
            }
        }
    }
    
    public function editarAction()
    {        
        $model = new App_Model_Usuario();
        $id = $this->_getParam('id');
        $user = $model->getUsuarioPorId($id, App_Model_Usuario::TIPO_CLIENTE);
        
        $form = new App_Form_CrearCliente();
        $user['correo'] = $user['email'];
        $form->populate($user);
        $this->view->form = $form; 
        
        $form->clave->setRequired(FALSE); 
        
        if($this->getRequest()->isPost()){
            
            $data = $this->getRequest()->getPost();
            
            if ($form->isValid($data)) {
                
                $fecha = Zend_Date::now()->toString('YYYY-MM-dd HH:mm:ss');
                $data['fechaUltimoAcceso'] = $fecha;
                $data['idusuario'] = $user['idusuario'];
                $data['email'] = $data['correo'];
                $data['ultimaIp'] = $model->_getRealIP();
                $data['tipoUsuario'] = App_Model_Usuario::TIPO_CLIENTE;
                $id = $model->actualizarDatos($data);
                
                $this->_flashMessenger->addMessage("Cliente editado con exito");
                $this->_redirect('/admin/cliente');
                
            } else {
                $form->populate($data);
                var_dump($form->getMessages());
            }
        }
        
    }
    
    public function eliminarAction()
    {
        
    }
    

}

