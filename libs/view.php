<?php

class View{
    public $mensaje;
    public $id;
    public $anota;
    public $obj;
    public $areaI;
    public $conv;
    public $crono;
    public $desc;
    public $disc;
    public $enc;
    public $enteE;
    public $finan;
    public $impactoB;
    public $inscribir;
    //public $metasO;
    public $metric;
    public $res;
    public $tema;
    public $usuario;
    public $usuarios;
    public $proyecto;
    public $item;
    public $msj;
    public $list;

    function __construct(){

    }

    function render($nombre){
        require 'view/'.$nombre.'.php';
    }
}

?>