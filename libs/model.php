<?php
class Model extends Database{

    function __construct()
    {
        $this->db = new Database();
    }
}
?>