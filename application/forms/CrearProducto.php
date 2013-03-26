<?php

class App_Form_CrearProducto extends App_Form
{
    public function init() {
        
        parent::init();
        
        $e = new Zend_Form_Element_Text('idProducto');
        $e->setAttrib('class', 'span8');  
        $this->addElement($e);        
        
        $e = new Zend_Form_Element_Text('codigo');
        $e->setRequired(true);
        $e->setFilters(array("StripTags", "StringTrim"));
        $e->setAttrib('class', 'span4');  
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('nombreProducto');
        $e->setAttrib('class', 'span12');
        $e->setFilters(array("StripTags", "StringTrim"));
        $e->setRequired(true);
        $this->addElement($e);
        
        $servicio = new App_Model_Servicio();        
        $e = new Zend_Form_Element_Select('idservicio');        
        $e->setMultiOptions($servicio->comboServicio());
        $e->setAttrib('class', 'span12');
        $this->addElement($e);
        
        $categoria = new App_Model_Categoria();
        $e = new Zend_Form_Element_Select('categoria');
        $e->setMultiOptions(array('0' => '--- Seleccionar ---')+ $categoria->listarPadres());
        $e->setAttrib('class', 'span12');
        $this->addElement($e);
        
        $proveedor = new App_Model_Proveedor();
        $e = new Zend_Form_Element_Select('proveedor');
        $e->setMultiOptions($proveedor->proveedorCombo());
        $e->setAttrib('class', 'span12');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Select('subcategoria');
        $e->setAttrib('class', 'span12');
        $e->setAttrib('disabled', 'disabled');
        //$e->addMultiOptions(array('0' => '--- Seleccionar ---'));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('fechaInicio');
        $e->setAttrib('class', 'span4');
        $e->setFilters(array("StripTags", "StringTrim"));
        $e->setRequired(true);
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('fechaFin');
        $e->setAttrib('class', 'span4');
        $e->setFilters(array("StripTags", "StringTrim"));
        $e->setRequired(true);
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('precio');
        $e->setRequired(true);
        $v = new Zend_Validate_Float();
        $e->addValidator($v);
        $e->setFilters(array("StripTags", "StringTrim", "HtmlEntities"));
        $e->setAttrib('class', 'span4');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('stock');                        
        $e->setFilters(array("StripTags", "StringTrim", "HtmlEntities"));
        $e->setAttrib('class', 'span4');
        $this->addElement($e);
        
        //corta
        $e = new Zend_Form_Element_Textarea('descripcionCorta');        
        $e->setAttrib('rows', '2');
        $e->setAttrib('class', 'span12');
        $this->addElement($e);
        
        //larga
        $e = new Zend_Form_Element_Textarea('descripcionLarga');
        $e->setAttrib('rows', '10');
        $e->setAttrib('class', 'span16');
        $this->addElement($e);
        
        
        $config = Zend_Registry::get('config');
        $ruta = $config->app->mediaRoot;
        
        $e = new Zend_Form_Element_File('fotoPrincipal');        
        $e->setDestination($ruta);
        $e->setAttrib('class', 'span12');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_File('foto1');        
        $e->setDestination($ruta);
        $e->setAttrib('class', 'span12');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_File('foto2');        
        $e->setDestination($ruta);
        $e->setAttrib('class', 'span12');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_File('foto3');        
        $e->setDestination($ruta);
        $e->setAttrib('class', 'span12');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_File('foto4');        
        $e->setDestination($ruta);
        $e->setAttrib('class', 'span12');
        $this->addElement($e);
        
        
        $e = new Zend_Form_Element_Submit('guardar');
        $e->setLabel('Guardar')->setAttrib('class', 'btn pull-right');
        $this->addElement($e);
        
        $this->addElement('hash', 'csrf');
        
         foreach($this->getElements() as $e) {
            $e->removeDecorator('DtDdWrapper');
            $e->removeDecorator('Label');
            $e->removeDecorator('HtmlTag');
        } 
        
        
        
    }
}