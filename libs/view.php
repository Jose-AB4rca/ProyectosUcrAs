<?php

class View{
    public $mensaje;
    public $usuario;
    public $usuarios;
    public $proyecto;
    public $anotaciones;
    public $anotacion;
    public $item;
    public $list;

    function __construct(){

    }

    function render($nombre){
        require 'view/'.$nombre.'.php';
    }
}

?>