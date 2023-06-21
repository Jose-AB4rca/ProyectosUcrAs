<?php
class Responsables extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
    }

    function listaEspecifica($param = null){
        $conv = $this->model->getResponsablesPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('responsables/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchResponsable($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('responsables/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('responsables/agregar');
    }

    function editarResponsable(){
        $IdResponsable  = $_POST['IdResponsable'];
        $IdProyecto     = $_POST['IdProyecto'];
        $Responsable    = $_POST['Responsable'];

        $arreglo = [
            'IdResponsable'     => $IdResponsable,
            'IdProyecto'        => $IdProyecto,
            'Responsable'       => $Responsable
        ];

        if($this->model->updateResponsable($arreglo)){    
            $res = new Responsable();      

            $res->idResponsable     = $IdResponsable;
            $res->idProyecto    = $IdProyecto;
            $res->responsable      = $Responsable;
            
            $mjs = "actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/responsables/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "no actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/responsables/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }

    function borrarResponsable($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
      
        if($this->model->deleteResponsable($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/responsables/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "no borrado";  
            header("Location: http://localhost/ProyectosUcrAs/responsables/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }

    }

    function agregarResponsable(){
        $IdResponsable  = $_POST['IdResponsable'];
        $IdProyecto     = $_POST['IdProyecto'];
        $Responsable    = $_POST['Responsable'];

        $arreglo = [
            'IdResponsable'     => $IdResponsable,
            'IdProyecto'        => $IdProyecto,
            'Responsable'       => $Responsable
        ];

        if($this->model->addResponsable($arreglo)){
        
            $mjs = "creado";  
            header("Location: http://localhost/ProyectosUcrAs/responsables/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "no creado";  
            header("Location: http://localhost/ProyectosUcrAs/responsables/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }   

}
?>