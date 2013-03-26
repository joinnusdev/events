<?php

class Admin_ProveedorController extends App_Controller_Action_Admin
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {      	
        $modelProveedor = new App_Model_Proveedor();
        $listaProveedor = $modelProveedor->listarProveedor();
        $this->view->listaProveedor = $listaProveedor;
    }
    
    public function crearAction()
    {
        $form = new App_Form_CrearProveedor();
        $this->view->form = $form; 
        if($this->getRequest()->isPost()){            
            
            $data = $this->getRequest()->getPost();
            
            if ($form->isValid($data)) {
                $modelProveedor = new App_Model_Proveedor();
                $fechaRegistro = Zend_Date::now()->toString('YYYY-MM-dd HH:mm:ss');
                $data['fechaRegistro'] = $fechaRegistro;
                $data['estado'] = App_Model_Proveedor::ESTADO_ACTIVO;
                $id = $modelProveedor->actualizarDatos($data);
                
                $this->_flashMessenger->addMessage("Proveedor creado con exito");
                $this->_redirect('/admin/proveedor');
                
            } else {
                $form->populate($data);                
            }
        }
    }
    
    public function editarAction()
    {
        $modelProveedor = new App_Model_Proveedor();
        $form = new App_Form_CrearProveedor();
        $id = $this->_getParam('id');
        $proveedor = $modelProveedor->getProveedorPorId($id);
        $form->populate($proveedor);        
        if($this->getRequest()->isPost()){            
            $data = $this->getRequest()->getParams();            
            $data['idproveedor'] = $id;
            if ($form->isValid($data)) {                
                $id = $modelProveedor->actualizarDatos($data);
                $this->_flashMessenger->addMessage("Proveedor editado con éxito");
                $this->_redirect('/admin/proveedor');
                
            } else {
                $form->populate($data);                
            }
        }
        $this->view->form = $form;
    }
    
    public function eliminarAction()
    {
        
        $modelProveedor = new App_Model_Proveedor();
        $id = $this->_getParam('id');
        $data = array(
            'idproveedor' => $id,
            'estado' => App_Model_Proveedor::ESTADO_ELIMINADO
        );        
        
        $modelProveedor->actualizarDatos($data);
        $this->_flashMessenger->addMessage("Proveedor eliminado con exito");
        $this->_redirect('/admin/proveedor');
    }
    
    
     public function activarAction()
    {
        
        $modelProveedor = new App_Model_Proveedor();
        $id = $this->_getParam('id');
        $data = array(
            'idproveedor' => $id,
            'estado' => App_Model_Proveedor::ESTADO_ACTIVO
        );        
        
        $modelProveedor->actualizarDatos($data);
        $this->_flashMessenger->addMessage("Proveedor Activado con exito");
        $this->_redirect('/admin/proveedor');
    }
    

}

