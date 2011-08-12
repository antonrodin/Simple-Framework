<?php

class Template {

    protected $_variables = array();
    protected $_controller;
    protected $_action;

    function __construct($controller, $action) {
        $this->_controller = $controller;
        $this->_action = $action;
    }

    function __destruct() {}

    function set($name, $value) {
        $this->_variables[$name] = $value;
    }

    /**
     * This function called then Controller class is destroyed
     */
    function render() {

        //This function extract all variables from Array. Yo can use them like $title, $description
        extract($this->_variables);

        //Class that control all some html function, like links, script, css...etc
        $html = new Html();

        //Declare path
        $path_1 = ROOT . DS . 'app' . DS . 'views' . DS . strtolower($this->_controller) . DS;
        $path_2 = ROOT . DS . 'app' . DS . 'views' . DS;

        //Include header.php
        if (file_exists($path_1 . "header.php")) {
            include($path_1 . "header.php");
        } else {
            include($path_2 . "header.php");
        }

        //Include selected file
        if (file_exists($path_2 . $this->_action . ".php")) {
            include($path_2 . $this->_action . ".php");
        } else {
            include($path_1 . $this->_action . ".php");
        }

        //Include footer.php
        if (file_exists($path_1 . "footer.php")) {
            include($path_1 . "footer.php");
        } else {
            include($path_2 . "footer.php");
        }

    }


}
?>
