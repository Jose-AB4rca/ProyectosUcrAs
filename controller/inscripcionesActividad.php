<?php
class InscripcionActividades extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render(){
        $obs = $this->model->getInscripcionAc();
        $this->view->list = $obs;
        $this->view->render('inscripcionActividad/lista.php');
    }

    function verInscripcionAc($paramA = null){
        $obs = $this->model->searchInscripcionAc($paramA[0],$paramA[1]);
        $this->view->item = $obs;
        $this->view->render('inscripcionActividad/ver.php');
    }

    function editarInscripcionAc(){
        session_start();

        $IdInscripcionAc         = $_SESSION['IdInscripcionAc'];
        $IdProyecto              = $_SESSION['IdProyecto'];
        $Objetivo                = $_POST['Objetivo'];
        $PoblacionBeneficiada    = $_POST['PoblacionBeneficiada'];
        $CantPoblacion           = $_POST['CantPoblacion'];
        $Facilitadores           = $_POST['Facilitadores'];
        $DuracionHoras           = $_POST['DuracionHoras'];
        $CuentaFinanciamientoExt = $_POST['CuentaFinanciamientoExt'];
        $NumeroSesion            = $_POST['NumeroSesion'];
        
        $arreglo = [
            'idInscripcionAc'     => $IdInscripcionAc,
            'IdObjetivoEsp'           => $IdObjetivoEsp,
            'Objetivo'       => $Objetivo,
            'PoblacionBeneficiada'  =>  $PoblacionBeneficiada,
            'CantPoblacion'      =>   $CantPoblacion,
            'Facilitadores'      => $Facilitadores,
            'DuracionHoras'      => $DuracionHoras,
            'CuentaFinanciamientoExt' => $CuentaFinanciamientoExt,
            'NumeroSesion'       =>  $NumeroSesion

        ];
        unset_session($_SESSION['IdInscripcionAc'],$_SESSION['IdProyecto']);

        if($this->model->updateInscripcionAc($arreglo)){
            $pg = new InscripcionActividad();
            $idInscripcionAc         = $IdInscripcionAc;
            $idProyecto              = $IdProyecto;
            $objetivo                = $Objetivo;
            $poblacionBeneficiada    = $PoblacionBeneficiada;
            $cantPoblacion           = $CantPoblacion;
            $facilitadores           = $Facilitadores;
            $duracionHoras           = $DuracionHoras;
            $cuentaFinanciamientoExt = $CuentaFinanciamientoExt;
            $numeroSesion            = $NumeroSesion;

            $this->view->item = $pg;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro actualizado</h1></div>';  
        }else{
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizó</h1></div>';  
        }
        $this->view->render('inscripcionActividad/ver.php');
    }

    function eliminarInscripcionAc($paramA = null){
        $id = $paramA[0];
        if($this->model->deleteInscripcionAc($paramA[0],$paramA[1])){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se logró borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarInscripcionAc(){
        $IdInscripcionAc         = $_SESSION['IdInscripcionAc'];
        $IdProyecto              = $_SESSION['IdProyecto'];
        $Objetivo                = $_POST['Objetivo'];
        $PoblacionBeneficiada    = $_POST['PoblacionBeneficiada'];
        $CantPoblacion           = $_POST['CantPoblacion'];
        $Facilitadores           = $_POST['Facilitadores'];
        $DuracionHoras           = $_POST['DuracionHoras'];
        $CuentaFinanciamientoExt = $_POST['CuentaFinanciamientoExt'];
        $NumeroSesion            = $_POST['NumeroSesion'];
        
        $arreglo = [
            'idInscripcionAc'     => $IdInscripcionAc,
            'IdObjetivoEsp'           => $IdObjetivoEsp,
            'Objetivo'       => $Objetivo,
            'PoblacionBeneficiada'  =>  $PoblacionBeneficiada,
            'CantPoblacion'      =>   $CantPoblacion,
            'Facilitadores'      => $Facilitadores,
            'DuracionHoras'      => $DuracionHoras,
            'CuentaFinanciamientoExt' => $CuentaFinanciamientoExt,
            'NumeroSesion'       =>  $NumeroSesion

        ];

        if($this->model->addInscripcionAc($arreglo)){

            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro añadida</h1></div>';  
        }else{
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se agregó</h1></div>';  
        }
        $this->render();


    }

}
?>