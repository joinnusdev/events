<?php

class Extra_Plugin_Acl
        extends Zend_Controller_Plugin_Abstract
{

    private $_noauth = array('module' => 'auth',
        'controller' => 'index',
        'action' => 'login');
    
    private $_exception = array(
        'mvc:auth/index/sinacceso',      
        'mvc:auth/index/logout',
        'mvc:auth/index/login',
        );
    
    private $_noacl = array('module' => 'admin',
        'controller' => 'index',
        'action' => 'index');
    protected $_acl;
    
    protected $_role;
    
    private $_module;
    
    private $_controller;
    
    private $_action;

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {        
        
        $this->_module =  $request->getModuleName();
        $this->_controller =  $request->getControllerName();
        $this->_action =  $request->getActionName();
        
        //$this->setAcl(Zend_Registry::get('Acl'));	
        $auth = Zend_Auth::getInstance();        
        
        if ($auth->hasIdentity()) {

            $user = (object)$auth->getStorage()->read();
            
            $roleName = $user->rol_id;
            if ($roleName == 1) {
                $module = $this->_module;
                if ($module == "retailer") {
                    $request->setModuleName("admin");
                    $request->setControllerName("index");
                    $request->setActionName("index");
                    return;
                } else {
                    $request->setModuleName($module);
                    if($this->_controller=="estadisticas")
                            $this->_controller="index";
                    $request->setControllerName($this->_controller);
                    $request->setActionName($this->_action);
                    return;
                }
            }
            if ($roleName == 2) {
                $module = $this->_module;
                if ($module == "retailer") {
                    $request->setModuleName("admin");
                    $request->setControllerName("index");
                    $request->setActionName("index");
                    return;
                } else {
                    $request->setModuleName($module);
                    if($this->_controller=="estadisticas")
                            $this->_controller="index";
                    $request->setControllerName($this->_controller);
                    $request->setActionName($this->_action);
                    return;
                }
            }
            if ($roleName == 3) {
                if ($this->_module != "admin") {
                    $request->setModuleName($this->_module);
                    $request->setControllerName($this->_controller);
                    $request->setActionName($this->_action);
                } else {
                    $request->setModuleName('retailer');
                    $request->setControllerName('index');
                    $request->setActionName('index');
                }
                return;
            }
            if ($roleName == 4) {
                if ($this->_module != "admin" AND $this->_module != "retailer") {
                    $request->setModuleName($this->_module);
                    $request->setControllerName($this->_controller);
                    $request->setActionName($this->_action);
                } else {
                    $request->setModuleName('default');
                    $request->setControllerName('index');
                    $request->setActionName('index');
                }
                return;
            }
            if ($roleName == 6) {
                $module = $this->_module;
                $controller = $this->_controller;
                if ($module == "admin") {
                    $request->setModuleName("admin");
                    $request->setControllerName("estadisticas");
                    $request->setActionName($this->_action);
                    return;
                } else {
                    $request->setModuleName($this->_module);
                    $request->setControllerName($this->_controller);
                    $request->setActionName($this->_action);
                    return;
                }
            }
        } else {            
            
            if ($this->_module == 'admin') {                
                $request->setModuleName('admin');
                $request->setControllerName('auth');
                $request->setActionName('index');
                return;
            } else {                
                $request->setModuleName('');
                $request->setControllerName('');
                $request->setActionName('');
                return;
            }
            
        }
        
    }

    /*function isValidUrl(Zend_Controller_Request_Abstract $request)
    {
        
        $acl = $this->getAcl();
        //var_dump($acl);exit;
        $url1 = 'mvc:' . $request->getModuleName() . '/*';
        $url2 = 'mvc:' . $request->getModuleName() . '/' . $request->getControllerName() . '/*';
        $url3 = 'mvc:' . $request->getModuleName() . '/'
                . $request->getControllerName() . '/' . $request->getActionName();
        return $acl->has($url1) && $acl->isAllowed($this->getRole(), $url1)
                || $acl->has($url2) && $acl->isAllowed($this->getRole(), $url2)
                || $acl->has($url3) && $acl->isAllowed($this->getRole(), $url3);
    }*/

    function getAcl()
    {
        return $this->_acl;
    }

    function getRole()
    {
        return $this->_role;
    }

    function setRole($role)
    {
        $this->_role = $role;
    }

    function setAcl($acl)
    {
        $this->_acl = $acl;
    }

}
