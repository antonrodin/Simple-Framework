<?php

class Model extends Sql {

    protected $_model;

    function __construct() {
        parent::__construct(DB_USER, DB_PASS, DB_NAME, DB_HOST);
    }

}
?>
