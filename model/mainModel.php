<?php
include_once('proyectosModel.php');
class MainModel extends Model {
    public function __construct(){
        parent::__construct();
    }
    function getProyectos(){
       $p = new ProyectosModel();
       return $p->getProyectos();
    }

}
?>