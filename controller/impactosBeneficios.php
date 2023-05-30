<?php
class Impacto_Beneficios extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render(){
        $imp = $this->model->getImpactoB();
        $this->view->list = $imp;
        $this->view->render('impactosBeneficios/lista.php');
    }

    function verImpactoB($paramA = null){
        $imp = $this->model->searchImpactoB($paramA[0],$paramA[1]);
        $this->view->item = $imp;
        $this->view->render('impactosBeneficios/ver.php');
    }

    function editarImpactoB(){
        session_start();
        $IdImpacto            = $_SESSION['IdImpacto'];
        $IdProyecto           = $_SESSION['IdProyecto'];
        $CantPoblacion        = $_POST['CantPoblacion'];
        $Poblacion            = $_POST['Poblacion'];   
        $BeneficioUcr         = $_POST['BeneficioUcr'];
        $BeneficioPoblacion   = $_POST['BeneficioPoblacion'];

        $arreglo = [
            '$IdImpacto'            => $IdImpacto,
            'IdProyecto'            => $IdProyecto,
            'CantPoblacion'         => $CantPoblacion,
            'Poblacion'             => $Poblacion,
            'BeneficioUcr'          => $BeneficioUcr,
            'BeneficioPoblacion'    => $BeneficioPoblacion
        ];
        unset_session($_SESSION['IdImpacto'],$_SESSION['IdProyecto']);

        if($this->model->updateImpactoB($arreglo)){
            $imp = new ImpactoBeneficio();
                $imp->$idImpacto            = $IdImpacto;
                $imp->$idProyecto           = $IdProyecto;
                $imp->$cantPoblacion        = $CantPoblacion;
                $imp->$poblacion            = $Poblacion;   
                $imp->$beneficioUcr         = $BeneficioUcr;
                $imp->$beneficioPoblacion   = $BeneficioPoblacion; 

            $this->view->item = $imp;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro actualizado</h1></div>';  
        }else{
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>El registro no se actualizó</h1></div>';  
        }
        $this->view->render('impactosBeneficios/ver.php');
    }

    function eliminarImpactoB($paramA = null){
        if($this->model->deleteImpactoB($paramA[0],$paramA[1])){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>El registro no se logró borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarImpactoB(){
        $IdImpacto            = $_POST['IdImpacto'];
        $IdProyecto           = $_POST['IdProyecto'];
        $CantPoblacion        = $_POST['CantPoblacion'];
        $Poblacion            = $_POST['Poblacion'];   
        $BeneficioUcr         = $_POST['BeneficioUcr'];
        $BeneficioPoblacion   = $_POST['BeneficioPoblacion'];

        $arreglo = [
            '$IdImpacto'            => $IdImpacto,
            'IdProyecto'            => $IdProyecto,
            'CantPoblacion'         => $CantPoblacion,
            'Poblacion'             => $Poblacion,
            'BeneficioUcr'          => $BeneficioUcr,
            'BeneficioPoblacion'    => $BeneficioPoblacion
        ];
        if($this->model->addImpactoB($arreglo)){

            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro agregado</h1></div>';  
        }else{
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se agregó</h1></div>';  
        }
        $this->render();


    }

}
?>