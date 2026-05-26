<?php

include_once 'core/Database.php';

class Model {

    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }
}
?>