<?php
class Cronogramas extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }
    //metodos para vistas 
    function render($param = null){
        $crono = $this->model->getCronogramas();
        $this->view->list = $crono;
        $this->view->render('cronogramas/lista');
    }
    function listaEspecifica($param = null){
        $conv = $this->model->getCronogramasPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('cronogramas/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchCronograma($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('cronogramas/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('cronogramas/agregar');
    }

    function verCronograma($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $crono = $this->model->searchCronograma($id,$idb);

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['idb'] = $idb;

        //pasa a la view los datos
        $this->view->item = $crono;
        $this->view->mensaje = "";
        $this->view->render('cronogramas/ver.php');

    }

    function editarCronograma(){
        $IdCronograma   = $_POST['IdCronograma']; 
        $IdProyecto     = $_POST['IdProyecto']; 
        $Tipo           = $_POST['Tipo']; 
        $Actividad      = $_POST['Actividad']; 
        $FechaInicio    = $_POST['FechaInicio']; 
        $FechaFin       = $_POST['FechaFin']; 
        $Descripcion    = $_POST['Descripcion']; 


        $arreglo = [
            'IdCronograma'    => $IdCronograma,
            'IdProyecto'      => $IdProyecto,
            'Tipo'            => $Tipo,
            'Actividad'       => $Actividad,
            'FechaInicio'     => $FechaInicio,
            'FechaFin'        => $FechaFin,
            'Descripcion'     => $Descripcion
        ];
 
        if($this->model->updateCronograma($arreglo)){    
            
            $mjs = "Editado";  
            header("Location: http://localhost/ProyectosUcrAs/cronogramas/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No editado";  
            header("Location: http://localhost/ProyectosUcrAs/cronogramas/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }

    function borrarCronograma($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
      
        if($this->model->deleteCronograma($idp,$ido)){    
            $mjs = "Eliminado";  
            header("Location: http://localhost/ProyectosUcrAs/cronogramas/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No eliminado";  
            header("Location: http://localhost/ProyectosUcrAs/cronogramas/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }
    }

    function agregarCronograma(){
        $IdCronograma   = $_POST['IdCronograma']; 
        $IdProyecto     = $_POST['IdProyecto']; 
        $Tipo           = $_POST['Tipo']; 
        $Actividad      = $_POST['Actividad']; 
        $FechaInicio    = $_POST['FechaInicio']; 
        $FechaFin       = $_POST['FechaFin']; 
        $Descripcion    = $_POST['Descripcion']; 


        $arreglo = [
            'IdCronograma'    => $IdCronograma,
            'IdProyecto'      => $IdProyecto,
            'Tipo'            => $Tipo,
            'Actividad'       => $Actividad,
            'FechaInicio'     => $FechaInicio,
            'FechaFin'        => $FechaFin,
            'Descripcion'     => $Descripcion
        ];

        if($this->model->addCronograma($arreglo)){
            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/cronogramas/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/cronogramas/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }   

}
?>