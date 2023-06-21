<?php
class AreasImpacto extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
    }

    function listaEspecifica($param = null){
        $conv = $this->model->getAreaImpactoPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('areaImpactos/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchAreaImpacto($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('areaImpactos/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('areaImpactos/agregar');
    }

    function editarAreaImpacto(){
        $IdArea     = $_POST['IdArea'];
        $IdImpacto  = $_POST['IdImpacto'];
        $Area       = $_POST['Area'];

        $arreglo = [
            'IdArea'     => $IdArea,
            'IdImpacto'  => $IdImpacto,
            'Area'       => $Area
        ];

        if($this->model->updateAreaImpacto($arreglo)){
            $mjs = "Actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/areasImpacto/listaEspecifica/".$IdImpacto."?ms=$mjs"); 
            exit(); 
        }else{
            $mjs = "No actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/areasImpacto/listaEspecifica/".$IdImpacto."?ms=$mjs"); 
            exit();  
        }
    }

    function eliminarAreaimpacto($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
        if($this->model->deleteAreaImpacto($idp,$ido)){    
            $mjs = "Eliminado";  
            header("Location: http://localhost/ProyectosUcrAs/areasImpacto/listaEspecifica/".$idp."?ms=$mjs"); 
            exit(); 
        }else{          
            $mjs = "no borrado";  
            header("Location: http://localhost/ProyectosUcrAs/areasImpacto/listaEspecifica/".$idp."?ms=$mjs"); 
            exit(); 
        }
    }

    function agregarAreaImpacto(){
        $IdArea     = $_POST['IdArea'];
        $IdImpacto  = $_POST['IdImpacto'];
        $Area       = $_POST['Area'];

        $arreglo = [
            'IdArea'     => $IdArea,
            'IdImpacto'  => $IdImpacto,
            'Area'       => $Area
        ];
        if($this->model->addAreaImpacto($arreglo)){
            $mjs = "creado";  
            header("Location: http://localhost/ProyectosUcrAs/areasImpacto/listaEspecifica/".$IdImpacto."?ms=$mjs"); 
            exit(); 
        }else{
            $mjs = "no creado";  
            header("Location: http://localhost/ProyectosUcrAs/areasImpacto/listaEspecifica/".$IdImpacto."?ms=$mjs"); 
            exit(); 
        }
    }
}
?>