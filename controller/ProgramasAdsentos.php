<?php
class ProgramasAdsentos extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render(){
        $prm = $this->model->getProgramaAds();
        $this->view->$list = $prm;
        $this->view->render('programaAdsento/lista.php');
    }

    function verProgramaAds($paramA = null){
        $pry = $this->model->searchProgramaAds($paramA[0],$paramA[1]);
        $this->view->$item = $pry;
        $this->view->render('programaAdsento/ver.php');
    }

    function editarProgramaAds(){
 
        $IdProgramaAdsento   = $_POST['IdProgramaAdsento'];
        $IdProyecto          = $_POST['IdProyecto'];
        $ProgramaAdsento     = $_POST['ProgramaAdsento']; 


        $arreglo = [
            'IdProgramaAdsento'     => $IdProgramaAdsento,
            'IdProyecto'           => $IdProyecto,
            'ProgramaAdsento'       => $ProgramaAdsento
        ];

        if($this->model->updateProgramaAds($arreglo)){
            $pg = new ProgramaAdsento();
            $pg->idProgramaAdsento    = $IdProgramaAdsento;
            $pg->idProyecto            = $IdProyecto;
            $pg->$programaAdsento      = $ProgramaAdsento; 

            $this->view->item = $pg;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro actualizado</h1></div>';  
        }else{
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizó</h1></div>';  
        }
        $this->view->render('programaAdsento/ver.php');
    }

    function eliminarProgramaAds($paramA = null){
        $id = $paramA[0];
        if($this->model->deleteProgramaAds($paramA[0],$paramA[1])){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se logró borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarProgramaAds(){
        $IdProgramaAdsento   = $_POST['IdProgramaAdsento'];
        $IdProyecto          = $_POST['IdProyecto'];
        $ProgramaAdsento     = $_POST['ProgramaAdsento']; 


        $arreglo = [
            'IdProgramaAdsento'     => $IdProgramaAdsento,
            'IdProyectoo'           => $IdProyecto,
            'ProgramaAdsento'       => $ProgramaAdsento
        ];

        if($this->model->addProyectoAds($arreglo)){

            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro añadida</h1></div>';  
        }else{
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se agregó</h1></div>';  
        }
        $this->render();


    }


}
?>