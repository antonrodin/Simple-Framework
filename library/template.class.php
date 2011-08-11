<?php
/**
 * Description of Template Class
 *
 * @author Framework based on Anant Garg tutorial www.anantgarg.com
 * @author Modified by Anton Zekeriev Rodin www.azrodin.com
 */
class Template {
    protected $_variables = array();
    protected $_controller;
    protected $_action;

    function __construct($controller, $action) {
        $this->_controller = $controller;
        $this->_action = $action;
    }

    function set($name, $value) {
        $this->_variables[$name] = $value;
    }

    /**
     * This function called then Controller class is destroyed
     */
    function render() {

        //This function extract all variables from Array. Yo can use them like $title, $description
        extract($this->_variables);

        //$this->_variables['title'] = "My aplication";
        //echo count($this->_variables);

        //echo "|" . $this->_controller . "|";
        //echo $this->_variables['title'];

        //Declare path
        $path_1 = ROOT . DS . 'application' . DS . 'views' . DS . strtolower($this->_controller) . DS;
        $path_2 = ROOT . DS . 'application' . DS . 'views' . DS;

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
