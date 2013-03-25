<?php

class App_Form_CrearCliente extends App_Form
{
    public function init() {
        
        parent::init();
        
        $e = new Zend_Form_Element_Text('idusuario');
        $e->setAttrib('class', 'span8');  
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('nombre');        
        $e->setFilters(array("StripTags", "StringTrim"));
        $e->setRequired(true);
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('apellido');
        $e->setRequired(true);
        $e->setFilters(array("StripTags", "StringTrim"));        
        $this->addElement($e);
        
        $this->addElement(new Zend_Form_Element_Select('sexo'));
        $this->getElement('sexo')->addMultiOption('', 'Seleccione Sexo');
        $this->getElement('sexo')->addMultiOption('Masculino', 'Masculino');
        $this->getElement('sexo')->addMultiOption('Femenino', 'Femenino');
        $this->getElement('sexo')->setAttrib('class', 'span13');
        $this->getElement('sexo')->setRequired();
        $this->getElement('sexo')->removeDecorator('htmlTag');
        $this->getElement('sexo')->removeDecorator('Errors');
        
        $e = new Zend_Form_Element_Text('fechaNacimiento');
        $e->setAttrib('class', 'span12');
        $e->setRequired(true);
        $e->setFilters(array("StripTags", "StringTrim"));
        $this->addElement($e);        
        
        
        $this->addElement(new Zend_Form_Element_Select('tipoDocumento'));
        $this->getElement('tipoDocumento')->addMultiOption('', 'Seleccione Documento');
        $this->getElement('tipoDocumento')->addMultiOption('DNI', 'DNI');
        $this->getElement('tipoDocumento')->addMultiOption('RUC', 'RUC');
        $this->getElement('tipoDocumento')->addMultiOption('PASAPORTE', 'PASAPORTE');
        $this->getElement('tipoDocumento')->setAttrib('class', 'span8');
        $this->getElement('tipoDocumento')->removeDecorator('htmlTag');
        $this->getElement('tipoDocumento')->removeDecorator('Errors');        
        
        $e = new Zend_Form_Element_Text('nroDocumento');
        $e->setAttrib('class', 'span8');
        $e->setFilters(array("StripTags", "StringTrim"));
        $this->addElement($e);
        
        
        $this->addElement(new Zend_Form_Element_Select('idDepartamento'));
        $this->getElement('idDepartamento')->addMultiOption('', 'Seleccione Departamento');
        $this->getElement('idDepartamento')->setAttrib('class', 'span8');
        
        $this->addElement(new Zend_Form_Element_Select('idProvincia'));
        $this->getElement('idProvincia')->addMultiOption('', 'Seleccione Provincia');
        $this->getElement('idProvincia')->setAttrib('class', 'span8');
        
        $this->addElement(new Zend_Form_Element_Select('idDistrito'));
        $this->getElement('idDistrito')->addMultiOption('', 'Seleccione Distrito');
        $this->getElement('idDistrito')->setAttrib('class', 'span8');
        
        
        $e = new Zend_Form_Element_Text('correo');
        $e->setAttrib('class', 'span8');
        $e->setFilters(array("StripTags", "StringTrim"));
        $v = new Zend_Validate_EmailAddress();
        $e->addValidator($v);
        $e->setRequired(true);
        $e->addFilter(new Zend_Filter_HtmlEntities());
        $this->addElement($e);
        
        
        $e = new Zend_Form_Element_Password('clave');
        $e->setLabel('Password');
        $e->setRequired();
        $v = new Zend_Validate_StringLength(array('min'=>5,'max'=>30));
        $e->addValidator($v);
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('direccion');
        //$e->setAttrib('class', 'span8');
        $e->setFilters(array("StripTags", "StringTrim"));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('telefono');
        $e->setAttrib('class', 'span8');
        $e->setFilters(array("StripTags", "StringTrim"));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('celular');
        $e->setAttrib('class', 'span8');
        $e->setFilters(array("StripTags", "StringTrim"));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Submit('guardar');
        $e->setLabel('Guardar')->setAttrib('class', 'btn pull-right');
        $this->addElement($e);
        
        $this->addElement('hash', 'csrf', array(
                    'ignore' => true,
                ));
        
         foreach($this->getElements() as $e) {
            $e->clearDecorators();
            $e->addDecorator("ViewHelper");
         }
    }
}