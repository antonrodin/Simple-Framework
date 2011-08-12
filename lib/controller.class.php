<?php

/**
 * Base controller class, which will be used as the base class for all our controllers
 *
 * @author antonrodin
 */
class Controller {

    protected $_model;
    protected $_controller;
    protected $_action;
    protected $_template;

    function __construct($model, $controller, $action) {

        $this->_model = $model;
        $this->_controller = $controller;
        $this->_action = $action;
        
        ($model) ? $this->_model =& new $model : $this->_model = 0;
        $this->_template =& new Template($controller, $action);

    }

    function set($name, $value) {
        $this->_template->set($name, $value);
    }

    function  __destruct() {
        $this->_template->render();
    }
    
}
?>
