<?php

class App_Form_CrearUsuario extends App_Form
{
    public function init() {
        parent::init();
        
        $e = new Zend_Form_Element_Text('idusuario');
        $e->setAttrib('class', 'span8');  
        $this->addElement($e);
        
        // name
        $e = new Zend_Form_Element_Text('nombre');
        $e->setLabel('Nombre');
        $e->setRequired();
        $v = new Zend_Validate_StringLength(array('min'=>1,'max'=>45));
        $e->addValidator($v);
        $this->addElement($e);

        // lastname
        $e = new Zend_Form_Element_Text('apellido');
        $e->setLabel('Apellidos');
        $v = new Zend_Validate_StringLength(array('min'=>1,'max'=>45));
        $e->addValidator($v);
        $this->addElement($e);
        
        // usuario
         $e = new Zend_Form_Element_Text('email');
        $e->setAttrib('class', 'span8');
        $e->setFilters(array("StripTags", "StringTrim"));
        $v = new Zend_Validate_EmailAddress();
        $e->addValidator($v);
        $e->setRequired(true);
        $e->addFilter(new Zend_Filter_HtmlEntities());
        $this->addElement($e);
        
        // pwd
        $e = new Zend_Form_Element_Password('clave');
        $e->setLabel('Password');
        $e->setRequired();
        $v = new Zend_Validate_StringLength(array('min'=>5,'max'=>30));
        $e->addValidator($v);
        $this->addElement($e);
        
        // submit
        $e = new Zend_Form_Element_Submit('guardar');
        $e->setLabel('Guardar');
        $e->setAttrib('class', 'btn primary');
        $this->addElement($e);
        
        $this->addElement('hash', 'csrf');
        
         foreach($this->getElements() as $e) {
            $e->removeDecorator('DtDdWrapper');
            $e->removeDecorator('Label');
            $e->removeDecorator('HtmlTag');
        } 
    }
}

?>
