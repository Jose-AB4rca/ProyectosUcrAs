<?php
class Model extends Database{

    public $db;

    function __construct()
    {
        $this->db = new Database();
    }
}
?>