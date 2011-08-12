<?php

/**
 * Index File
 * @author Anton Zekeriev Rodin
 * Based on web tutorial from www.anantgarg.com
 */

/**
 * Define Directory separator, in linux is "/" and base path, in my case is /var/www/frw
 */
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

/**
 * With .htaccess we defined a rule, that give us a directio like this ROOT/option1/option2/option2
 * The URL in this case is /option1/option2/option3/
 */
if (isset($_GET['url'])) {
    $url = $_GET['url'];
} else {
    $url = "items/viewall/";
}

/**
 * Include bootstrap from library, this ile includes the rest of files
 */
require_once(ROOT . DS . 'cfg'. DS . 'cfg.php');
require_once(ROOT . DS . 'lib' . DS . 'ini.php');