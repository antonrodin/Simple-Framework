<?php
/**
 * Modify php.ini values to show error
 * Set log file for writine errors
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

    //Get action and params from explode(url)
    $action = $urlArray[0];
    array_shift($urlArray);
    $queryString = $urlArray;

    $controllerName = $controller;
    $controller = ucwords($controller);

    $model = rtrim($controller, 's');
    $controller .= 'Controller';
    
    $dispatch = new $controller($model, $controllerName, $action);

    if ((int)method_exists($controller, $action)) {
        call_user_func_array(array($dispatch, $action), $queryString);
    } else {
        /**
         * ¿Show some kind of error or load not found page;
         */
        echo "Error method!";
    }

}

/**
 * Recursive function fot apply streep shashes to a multi-dimensional array, because stripshashes is not recursive
 * @param <array> $value that we wont to stripped off
 * @return <array> $value return backslashed string or array
 */
function stripSlashesDeep($value) {
    if (is_array($value)) {
        array_map('stripSlashesDeep', $value);
    } else {
        stripslashes($value);
    }
}

/**
 * Remove magic quotes from POST, GET and COOKIE variables
 */
function removeMagicQuotes() {
    if (get_magic_quotes_gpc()) {
        $_GET = stripSlashesDeep($_GET);
        $_POST = stripSlashesDeep($_POST);
        $_COOKIE = stripSlashesDeep($_COOKIE);
    }
}

/**
 * Unregister globals if in php.ini file register_globals is set to ON.
 * In PHP6 register_globals is deprecated. This is so stupid function, to avoid this, set the register_globals
 * properly to Off
 */
function unregisterGlobals() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');

        //Unset GLOBALS bucle
        foreach($array as $value) {
            foreach($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }

    }
}

/**
 * Function that load classes or traing to locate them, if not show error message
 * @param <String> $name Class name
 */
function __autoload($name) {

    $path_1 = ROOT . DS . 'lib' . DS . strtolower($name) . '.class.php';
    $path_2 = ROOT . DS . 'app' . DS . 'controllers' . DS . strtolower($name) . '.class.php';
    $path_3 = ROOT . DS . 'app' . DS . 'models' . DS . strtolower($name) . '.class.php';

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

/**
 * Call above defined function
 */
setReporting();
removeMagicQuotes();
unregisterGlobals();
callHook();

?>