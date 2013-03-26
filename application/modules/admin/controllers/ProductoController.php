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
        
        $form = new App_Form_CrearProducto();
        $this->view->form = $form;         
        $idUsuario = $this->view->authData->idusuario;
        
        if($this->getRequest()->isPost()){            
            $data = $this->getRequest()->getPost();
            
            if ($form->isValid($data)) {
                $modelProducto = new App_Model_Producto();
                
                $subcate =  $form->subcategoria->getValue();
                $fecha = Zend_Date::now()->toString('YYYY-MM-dd HH:mm:ss');
                
                $datos = array(
                    'codigo' => $data['codigo'],
                    'nombreProducto' => $data['nombreProducto'],
                    'idservicio' => $data['idservicio'],
                    'idcategoria' => $subcate,
                    'idproveedor' => $data['proveedor'],
                    'descripcionCorta' => $data['descripcionCorta'],
                    'descripcionLarga' => $data['descripcionLarga'],
                    'fechaRegistro' => $fecha,
                    'fechaInicio' => $data['fechaInicio'],
                    'fechaFin' => $data['fechaFin'],
                    'precio' => $data['precio'],
                    'stock' => $data['stock'],
                    'idUsuarioRegistro' => $idUsuario,
                    'estado' => App_Model_Producto::ESTADO_ACTIVO,                    
                );
                
                
                $id = $modelProducto->actualizarDatos($datos);
                
                //$foto = $form->foto->getFileName();
                /*if (!empty ($foto)) {
                    $config = Zend_Registry::get('config');
                    $ruta = $config->app->mediaRoot;

                    $form->foto->addFilter(
                            'Rename', array(
                        'target' => $ruta . $id . ".jpeg",
                        'overwrite' => true)
                    );
                    $form->foto->receive();
                    $data['idProducto'] = $id;
                    $data['foto'] = $id . ".jpeg";
                    $modelProducto->actualizarDatos($data);                    
                }*/
                
                
                $this->_flashMessenger->addMessage("Guardado con éxito");
                $this->_redirect('/admin/producto');
                
                
                
            } else {
                //var_dump($form->getMessages());exit;
                $form->populate($data);                
            }
        }        
        
    } 
    

}

