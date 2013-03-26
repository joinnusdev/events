<?php

class Admin_ProductoController extends App_Controller_Action_Admin
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {
        $model = new App_Model_Producto();
        $this->view->producto = $model->listaProductos();
    } 
    
    public function crearAction()
    {       	
        //datepicker
        /*$this->view->headLink()->appendStylesheet(
            $this->getConfig()->app->mediaUrl . '/css/datepicker-bootstrap/datepicker.css'
        );*/        
        
        
        $form = new App_Form_CrearProducto();
        $this->view->form = $form; 
        if($this->getRequest()->isPost()){            
            $data = $this->getRequest()->getPost();
            
            if ($form->isValid($data)) {
                $modelCliente = new App_Model_Cliente();
                $fecha = Zend_Date::now()->toString('YYYY-MM-dd HH:mm:ss');
                $data['fechaUltimaVisita'] = $fecha;
                $data['estado'] = App_Model_Cliente::ESTADO_ACTIVO;
                $data['totalVisitas'] = 1;
                $data['idTipoUsuario'] = App_Model_User::TIPO_CLIENTE;
                $id = $modelCliente->actualizarDatos($data);
                
                $this->_flashMessenger->addMessage("Cliente guardado con exito");
                $this->_redirect('/cliente');
                
            } else {
                $form->populate($data);                
            }
        }        
        
    } 
    

}

