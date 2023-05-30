<?php
class ObjetivosEspecificos extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render(){
        $obs = $this->model->getObjetivoEsp();
        $this->view->list = $obs;
        $this->view->render('objetivoEsp/lista.php');
    }

    function verObjetivoEsp($paramA = null){
        $obs = $this->model->searchObjetivoEsp($paramA[0],$paramA[1]);
        $this->view->item = $obs;
        $this->view->render('objetivoEsp/ver.php');
    }

    function editarObjetivoEsp(){
        session_start();
        $IdProyecto     = $_SESSION['IdProyecto'];
        $IdObjetivoEsp  = $_SESSION['IdObjetivoEsp'];
        $Objetivo       = $_POST['Objetivo'];


        $arreglo = [
            'IdProyecto'     => $IdProyecto,
            'IdObjetivoEsp'           => $IdObjetivoEsp,
            'Objetivo'       => $Objetivo 
        ];
        unset_session($_SESSION['IdProyecto'],$_SESSION['IdObjetivoEsp']);

        if($this->model->updateObjetivoEsp($arreglo)){
            $pg = new ObjetivoEspecifico();
            $pg->idProyecto         = $IdProyecto;
            $pg->idObjetivoEsp      = $IdObjetivoEsp;
            $pg->$objetivo          = $Objetivo; 

            $this->view->item = $pg;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro actualizado</h1></div>';  
        }else{
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizó</h1></div>';  
        }
        $this->view->render('objetivoEsp/ver.php');
    }

    function eliminarObjetoEsp($paramA = null){
        $id = $paramA[0];
        if($this->model->deleteObjeticoEsp($paramA[0],$paramA[1])){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se logró borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarObjetivoEsp(){
        $IdProyecto     = $_POST['IdProyecto'];
        $IdObjetivoEsp  = $_POST['IdObjetivoEsp'];
        $Objetivo       = $_POST['Objetivo'];


        $arreglo = [
            'IdProyecto'     => $IdProyecto,
            'IdObjetivoEsp'           => $IdObjetivoEsp,
            'Objetivo'       => $Objetivo 
        ];

        if($this->model->addObjetivoEsp($arreglo)){

            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro añadida</h1></div>';  
        }else{
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se agregó</h1></div>';  
        }
        $this->render();


    }

}
?>