<?php

class Admin_ServicioController extends App_Controller_Action_Admin
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {      	
        $modelServicio = new App_Model_Servicio();
        $listaServicio = $modelServicio->listarServicio();
        $this->view->listaServicio = $listaServicio;
    }
    
    public function crearAction()
    {
        $form = new App_Form_CrearServicio();
        $this->view->form = $form; 
        if($this->getRequest()->isPost()){            
            
            $data = $this->getRequest()->getPost();
            
            if ($form->isValid($data)) {
                $modelServicio = new App_Model_Servicio();
                $data['estado'] = App_Model_Servicio::ESTADO_ACTIVO;
                $id = $modelServicio->actualizarDatos($data);
                
                $this->_flashMessenger->addMessage("Servicio creado con exito");
                $this->_redirect('/admin/servicio');
                
            } else {
                $form->populate($data);                
            }
        }
    }
    
    public function editarAction()
    {
        $modelServicio = new App_Model_Servicio();
        $form = new App_Form_CrearServicio();
        $id = $this->_getParam('id');
        $servicio = $modelServicio->getServicioPorId($id);
        $form->populate($servicio);        
        if($this->getRequest()->isPost()){            
            $data = $this->getRequest()->getParams();            
            $data['idservicio'] = $id;
            if ($form->isValid($data)) {                
                $id = $modelServicio->actualizarDatos($data);
                $this->_flashMessenger->addMessage("Servicio editado con éxito");
                $this->_redirect('/admin/servicio');
                
            } else {
                $form->populate($data);                
            }
        }
        $this->view->form = $form;
    }
    
    public function eliminarAction()
    {
        $modelServicio = new App_Model_Servicio();
        $id = $this->_getParam('id');
        $data = array(
            'idservicio' => $id,
            'estado' => App_Model_Servicio::ESTADO_ELIMINADO
        );        
        
        $modelServicio->actualizarDatos($data);
        $this->_flashMessenger->addMessage("Servicio eliminado con exito");
        $this->_redirect('/admin/servicio');
    }
    

}

