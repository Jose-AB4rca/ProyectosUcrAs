<?php
class ProyectosVinculados extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
    }

    function render(){
        $Area = $this->model->getProyectosVin();
        $this->view->list = $Area;
        $this->view->render('proyectoVinculado/lista.php');
    }

    function listaEspecifica($param = null){
        $conv = $this->model->getProyectosVinPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('proyectoVinculado/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchProyectoVin($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('proyectoVinculado/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('proyectoVinculado/agregar');
    }

    function verProyectoVin($paramA = null){
        $pry = $this->model->searchProyectoVin($paramA[0],$paramA[1]);
        $this->view->item = $pry;
        $this->view->render('proyectoVinculado/ver');
    }

    function editarProyectoVin(){
        $IdProyectoVinculado   = $_POST['IdProyectoVinculado'];
        $IdProyecto            = $_POST['IdProyecto'];
        $ProyectoVinculado     = $_POST['ProyectoVinculado']; 


        $arreglo = [
            'IdProyectoVinculado'     => $IdProyectoVinculado,
            'IdProyecto'  => $IdProyecto,
            'ProyectoVinculado'       => $ProyectoVinculado
        ];

        if($this->model->updateProyectoVin($arreglo)){
            $pgv = new ProyectoVinculado();
            $pgv->idProyectoVinculado   = $IdProyectoVinculado;
            $pgv->idProyecto            = $IdProyecto;
            $pgv->proyectoVinculado     = $ProyectoVinculado ; 

            $mjs = "Actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/proyectosVinculados/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/proyectosVinculados/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();   
        }
    }

    function eliminarProyectoVin($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
        if($this->model->deleteProyectoVin($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/proyectosVinculados/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No borrado";  
            header("Location: http://localhost/ProyectosUcrAs/proyectosVinculados/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }

        echo $mensaje;
        $this->render();
    }

    function agregarProyectoVin(){
        $IdProyectoVinculado   = $_POST['IdProyectoVinculado'];  
        $IdProyecto            = $_POST['IdProyecto']; 
        $ProyectoVinculado     = $_POST['ProyectoVinculado'];  

        $arreglo = [
            'IdProyectoVinculado'    => $IdProyectoVinculado,
            'IdProyecto'             => $IdProyecto,
            'ProyectoVinculado'      => $ProyectoVinculado
        ];

        if($this->model->addProyectoVin($arreglo)){

            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/proyectosVinculados/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/proyectosVinculados/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }


}
?>