<?php
class AreaImpactos extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render(){
        $Area = $this->model->getAreaImpacto();
        $this->view->list = $Area;
        $this->view->render('areaImpactos/lista.php');
    }

    function verAreaImpacto($paramA = null){
        $Area = $this->model->searchAreaImpacto($paramA[0],$paramA[1]);
        $this->view->item = $Area;
        $this->view->render('verAreaImpacto/ver.php');
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
            $area = new AreaImpacto();
            $area->idArea = $IdArea; 
            $area->idImpacto = $IdImpacto; 
            $area->area = $Area; 

            $this->view->item = $area;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Area de impacto actualizado</h1></div>';  
        }else{
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Area de impacto no se actualizó</h1></div>';  
        }
        $this->view->render('areaImpactos/editar.php');
    }

    function eliminarAreaimpacto($paramA = null){
        $id = $paramA[0];
        if($this->model->deleteAreaImpacto($paramA[0],$paramA[1])){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>area impacto eliminado</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>area impacto no se logró borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
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

            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Area de impacto añadida</h1></div>';  
        }else{
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Area de impacto no se agregó</h1></div>';  
        }
        $this->view->render('areaImpactos/ver.php');


    }


}
?>