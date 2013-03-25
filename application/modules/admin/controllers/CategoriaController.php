<?php

class Admin_CategoriaController extends App_Controller_Action_Admin
{
    
    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {      	
        $modelCate = new App_Model_Categoria();
        $this->view->lista = $modelCate->listarCategorias();
        //var_dump($this->view->lista);exit;
         
    }
    
    public function crearAction()
    {
        $form = new App_Form_CrearCategoria();
        $this->view->form = $form; 
        if($this->getRequest()->isPost()){
            
            $data = $this->getRequest()->getPost();
            
            if ($form->isValid($data)) {
                $model = new App_Model_Categoria();
                $data['estado'] = App_Model_Categoria::ESTADO_ACTIVO;
                $model->actualizarDatos($data);
                
                $this->_flashMessenger->addMessage("Se agrego correctamente la Categoría");
                $this->_redirect('/admin/categoria');
                
            } else {
                $form->populate($data);                
            }
        }
    }
    
    public function editarAction()
    {
        $model = new App_Model_Categoria();
        $form = new App_Form_CrearCategoria();
        $id = $this->_getParam('id');
        $tipo = $this->_getParam('tipo', '');
        
        $this->view->tipo = $tipo;
        
        $categoria = $model->getCategoriaPorId($id);
        $form->populate($categoria);        
        
        if($this->getRequest()->isPost()){
            
            $data = $this->getRequest()->getParams();
            
            $data['idcategoria'] = $id;
            
            if ($form->isValid($data)) {                
                $id = $model->actualizarDatos($data);
                
                if ($tipo == '2')
                    $this->_flashMessenger->addMessage("Sub - Categoría editada con éxito");
                else 
                    $this->_flashMessenger->addMessage("Categoría editado con éxito");
                
                $this->_redirect('/admin/categoria');
                
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

