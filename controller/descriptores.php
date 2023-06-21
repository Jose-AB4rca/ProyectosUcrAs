<?php
class Descriptores extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
    }

    function render(){
        $descrip = $this->model->getDescriptores();
        $this->view->list = $descrip;
        $this->view->render('descriptores/lista.php');
    }
    function listaEspecifica($param = null){
        $conv = $this->model->getDescriptoresPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('descriptores/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchDescriptor($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('descriptores/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('descriptores/agregar');
    }

    function verDescriptor($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $descrip = $this->model->searchDescriptor($id,$idb);

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['idb'] = $idb;

        //pasa a la view los datos
        $this->view->item = $descrip;
        $this->view->mensaje = "";
        $this->view->render('descriptores/ver.php');

    }

    function editarDescriptor(){
        $IdProyectos = $_POST['IdProyecto'];
        $IdDescriptor = $_POST['IdDescriptor'];
        $Descriptor  = $_POST['Descriptor'];


        $arreglo = [
            'IdProyectos'     => $IdProyectos,
            'IdDescriptor'    => $IdDescriptor,
            'Descriptor'      => $Descriptor
        ];

        if($this->model->updateDescriptor($arreglo)){    
            $descrip = new Descriptor();      

            $descrip->idProyectos     = $IdProyectos;
            $descrip->idDescriptor    = $IdDescriptor;
            $descrip->descriptor      = $Descriptor;
            
            $mjs = "Editado";  
            header("Location: http://localhost/ProyectosUcrAs/descriptores/listaEspecifica/".$IdProyectos."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No editado";  
            header("Location: http://localhost/ProyectosUcrAs/descriptores/listaEspecifica/".$IdProyectos."?ms=$mjs"); 
            exit();  
        }

    }

    function borrarDescriptor($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
      
        if($this->model->deleteCronograma($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/descriptores/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No borrado";  
            header("Location: http://localhost/ProyectosUcrAs/descriptores/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }
    }

    function agregarDescriptor(){
        $IdProyectos = $_POST['IdProyecto'];
        $IdDescriptor = $_POST['IdDescriptor'];
        $Descriptor  = $_POST['Descriptor'];


        $arreglo = [
            'IdProyecto'     => $IdProyectos,
            'IdDescriptor'    => $IdDescriptor,
            'Descriptor'      => $Descriptor
        ];

        if($this->model->addDescriptor($arreglo)){
            $mjs = "Agregado";  
            header("Location: http://localhost/ProyectosUcrAs/descriptores/listaEspecifica/".$IdProyectos."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No agregado";  
            header("Location: http://localhost/ProyectosUcrAs/descriptores/listaEspecifica/".$IdProyectos."?ms=$mjs"); 
            exit();  
        }
    }   

}

?>