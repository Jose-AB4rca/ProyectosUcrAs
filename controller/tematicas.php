<?php
class Tematicas extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
    }
    //metodos para cargar y mover datos a las vistas
    function listaEspecifica($param = null){
        $conv = $this->model->getTematicasPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('tematica/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchTematica($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('tematica/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('tematica/agregar');
    }
    //metodos para transacciones de datos con el modelo
    function editarTematica(){
        $IdTematica     = $_POST['IdTematica'];
        $IdProyecto     = $_POST['IdProyecto'];
        $Descripcion    = $_POST['Descripcion'];

        $arreglo = [
            'IdTematica'        => $IdTematica,
            'IdProyecto'        => $IdProyecto,
            'Descripcion'       => $Descripcion
        ];

        if($this->model->updateTematica($arreglo)){    
            $mjs = "Actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/tematicas/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/tematicas/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }

    function borrarTematica($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
      
        if($this->model->deleteTematica($idp,$ido)){    
            $mjs = "No actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/tematicas/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/tematicas/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }
    }

    function agregarTematica(){
        $IdTematica     = $_POST['IdTematica'];
        $IdProyecto     = $_POST['IdProyecto'];
        $Descripcion    = $_POST['Descripcion'];

        $arreglo = [
            'IdTematica'        => $IdTematica,
            'IdProyecto'        => $IdProyecto,
            'Descripcion'       => $Descripcion
        ];
 

        if($this->model->addTematica($arreglo)){
        
            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/tematicas/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/tematicas/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }

    }   


}
?>