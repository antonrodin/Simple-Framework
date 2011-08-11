<?php
/**
 * Shared Code
 * @author Anton Zekeriev Rodin
 * Based on web tutorial from www.anantgarg.com
 */

/**
 * Modify PHP values. I Guess
 */
function setReporting() {
    if (DEVELOPMENT_ENVIROMENT == true) {
        error_reporting(E_ALL);
        ini_set('display_error', 'On');
    } else {
        error_reporting(E_ALL);
        ini_set('display_error', 'Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
    }
}

/**
 * This is some kind of Distributor for actions, it explodes the url /section/action/data/
 * And send this action to controller
 * @global <String> $url defined inside of index.php
 */
function callHook() {

    global $url;


    //Get the array from the Url (ROOT/controller/action/string/)
    $urlArray = array();
    $urlArray = explode("/", $url);

    $controller = $urlArray[0];
    array_shift($urlArray); //Delete first array element

    $action = $urlArray[0];
    array_shift($urlArray);

    $queryString = $urlArray[0];
    array_shift($urlArray);

    $controllerName = $controller;
    $controller = ucwords($controller);

    $model = rtrim($controller, 's');
    $controller .= 'Controller';
    
    $dispatch = new $controller($model, $controllerName, $action);

    if ((int)method_exists($controller, $action)) {
        call_user_func_array(array($dispatch, $action), array($queryString));
    } else {
        /**
         * ¿Show some kind of error or load not found page;
         */
        echo "Error method!";
    }

}

/**
 * Function that load classes or traing to locate them, if not show error message
 * @param <String> $name Class name
 */
function __autoload($name) {

    $path_1 = ROOT . DS . 'library' . DS . strtolower($name) . '.class.php';
    $path_2 = ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($name) . '.class.php';
    $path_3 = ROOT . DS . 'application' . DS . 'models' . DS . strtolower($name) . '.class.php';

    if (file_exists($path_1)) {
        require_once("$path_1");
    } else if (file_exists($path_2)) {
        require_once("$path_2");
    } else if (file_exists($path_3)) {
        require_once("$path_3");
    } else {
        echo "Unable to Load $name Class";
    }

}

setReporting();
callHook();

?>