<?php

class Admin_ClienteController extends App_Controller_Action_Admin
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {      	
        $modelUsuario = new App_Model_Cliente();
        $listaCliente = $modelUsuario->listarCliente();
        $this->view->listaCliente = $listaCliente;
    }
    
    public function crearAction()
    {
        
    }
    
    public function editarAction()
    {
        
    }
    
    public function eliminarAction()
    {
        
    }
    

}

