<?php
include_once('class/unidadRelacionada.php');
class UnidadesRelacionada extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
    }

    //metodos para cargar y mover datos a las vistas
    function listaEspecifica($param = null){
        $conv = $this->model->getUnidadesRePr($param[0]);
        $this->view->list = $conv;
        $this->view->render('unidadRe/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchUnidadRe($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('unidadRe/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('unidadRe/agregar');
    }


    function editarUnidadRe(){

        $IdUnidadR  = $_POST['IdUnidadR'];
        $IdProyecto = $_POST['IdProyecto'];
        $Unidad     = $_POST['Unidad'];
        $Base       = $_POST['Base'];

        $arreglo = [
            'IdUnidadR'       => $IdUnidadR,
            'IdProyecto'    => $IdProyecto,
            'Unidad'       => $Unidad,
            'Base'       => $Base
        ];

        if($this->model->updateUnidadRe($arreglo)){    
            $mjs = "Actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/unidadesRelacionada/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/unidadesRelacionada/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }

    function borrarUnidadRe($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
        if($this->model->deleteUnidadRe($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/unidadesRelacionada/listaEspecifica/".$idp."?ms=$mjs"); 
            exit(); 
        }else{          
            $mjs = "No borrado";  
            header("Location: http://localhost/ProyectosUcrAs/unidadesRelacionada/listaEspecifica/".$idp."?ms=$mjs"); 
            exit(); 
        }
    }

    function agregarUnidadRe(){
        $IdUnidadR  = $_POST['IdUnidadR'];
        $IdProyecto = $_POST['IdProyecto'];
        $Unidad     = $_POST['Unidad'];
        $Base       = $_POST['Base'];

        $arreglo = [
            'IdUnidadR'       => $IdUnidadR,
            'IdProyecto'    => $IdProyecto,
            'Unidad'       => $Unidad,
            'Base'       => $Base
        ];
 
 

        if($this->model->addUnidadRe($arreglo)){
        
            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/unidadesRelacionada/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/unidadesRelacionada/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }   

}
?>