<?php
class ProyectosVinculados extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
        $this->view->proyectosV = [];
        $this->view->mensaje = "";
    }

    function render(){
        $Area = $this->model->getProyectosVin();
        $this->view->list = $Area;
        $this->view->render('proyectoVinculado/lista.php');
    }

    function verProyectoVin($paramA = null){
        $pry = $this->model->searchProyectoVin($paramA[0],$paramA[1]);
        $this->view->item = $pry;
        $this->view->render('proyectoVinculado/ver.php');
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

            $this->view->item = $pgv;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro actualizado</h1></div>';  
        }else{
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizó</h1></div>';  
        }
        $this->view->render('proyectoVinculado/ver.php');
    }

    function eliminarProyectoVin($paramA = null){
        $id = $paramA[0];
        if($this->model->deleteProyectoVin($paramA[0],$paramA[1])){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se logró borrar</h1></div>';  
             $mensaje = "No Borrado";
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

            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro añadida</h1></div>';  
        }else{
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se agregó</h1></div>';  
        }
        $this->view->render('proyectoVinculado/lista.php');


    }


}
?>