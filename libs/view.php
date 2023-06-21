<?php

class View{
    public $mensaje;
    public $id;
    public $usuario;
    public $usuarios;
    public $proyecto;
    public $item;
    public $list;

    function __construct(){

    }

    function render($nombre){
        require 'view/'.$nombre.'.php';
    }
}

?>