<?php
/**
 * Config File
 * @author Anton Zekeriev Rodin
 * Based on web tutorial from www.anantgarg.com
 */

/**
 * Set Development Enviroment to true, or false
 * true:    Show all errors in the browser window
 * false:   Write all errors in the log file, located in tmp\log\error.log
 */
define('DEVELOPMENT_ENVIROMENT', true);

/**
 * MySQL configuration:
 */
define('DB_NAME', 'frw');
define('DB_USER', 'root');
define('DB_PASS', '1234');
define('DB_HOST', 'localhost');

/**
 * Your application path
 */
define('BASE_PATH', 'http://localhost/frw/');

?>