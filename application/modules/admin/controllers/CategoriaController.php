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
    
    
    public function updateestadoAction()
    {
        $model = new App_Model_Categoria();
        $id = $this->_getParam('id');
        $tipo = $this->_getParam('tipo', '0');
        $est = $this->_getParam('est');        
        
        $model->updateEstado($id, $est, $tipo);
        $this->_flashMessenger->addMessage("Se actualizo el estado del item");
        $this->_redirect('/admin/categoria');
    }
    
    public function agregarSubcategoriaAction()
    {
        $model = new App_Model_Categoria();
        $form = new App_Form_CrearCategoria();
        $id = $this->_getParam('id');
        
        $categoria = $model->getCategoriaPorId($id);        
        $this->view->padre = $categoria;
        
        if($this->getRequest()->isPost()){
            
            $data = $this->getRequest()->getParams();
            
            $datos = array(
                'categoriaPadre' => $id,
                'descripcion' => $data['descripcion'],
                'estado' => App_Model_Categoria::ESTADO_ACTIVO,
            );
            
            
            if ($form->isValid($data)) {                 
                $id = $model->actualizarDatos($datos);
                $this->_flashMessenger->addMessage("Sub Categoría Agregada Correctamente");
                
                $this->_redirect('/admin/categoria');
                
            } else {
                $form->populate($data);                
            }
        }
        $this->view->form = $form;        
        
    }

}

