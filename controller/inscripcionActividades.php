<?php
class InscripcionActividades extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render(){
        $obs = $this->model->getInscripcionesAc();
        $this->view->list = $obs;
        $this->view->render('inscripcionActividad/lista');
    }
    function listaEspecifica($param = null){
        $conv = $this->model->getInscripcionesAcPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('inscripcionActividad/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchInscripcionAc($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('inscripcionActividad/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('inscripcionActividad/agregar');
    }
    function verInscripcionAc($paramA = null){
        $obs = $this->model->searchInscripcionAc($paramA[0],$paramA[1]);
        $this->view->item = $obs;
        $this->view->render('inscripcionActividad/ver');
    }

    function editarInscripcionAc(){
        $IdInscripcionAc         = $_POST['IdInscripcionAc'];
        $IdProyecto              = $_POST['IdProyecto'];
        $Objetivo                = $_POST['Objetivo'];
        $PoblacionBeneficiada    = $_POST['PoblacionBeneficiada'];
        $CantPoblacion           = $_POST['CantPoblacion'];
        $Facilitadores           = $_POST['Facilitadores'];
        $DuracionHoras           = $_POST['DuracionHoras'];
        $CuentaFinanciamientoExt = $_POST['CuentaFinanciamientoExt'];
        $NumeroSesion            = $_POST['NumeroSesion'];
        
        $arreglo = [
            'idInscripcionAc'     => $IdInscripcionAc,
            'IdProyecto'           => $IdProyecto,
            'Objetivo'       => $Objetivo,
            'PoblacionBeneficiada'  =>  $PoblacionBeneficiada,
            'CantPoblacion'      =>   $CantPoblacion,
            'Facilitadores'      => $Facilitadores,
            'DuracionHoras'      => $DuracionHoras,
            'CuentaFinanciamientoExt' => $CuentaFinanciamientoExt,
            'NumeroSesion'       =>  $NumeroSesion

        ];

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

            $mjs = "Editado";  
            header("Location: http://localhost/ProyectosUcrAs/inscripcionActividades/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No editado";  
            header("Location: http://localhost/ProyectosUcrAs/inscripcionActividades/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }

    function eliminarInscripcionAc($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
        if($this->model->deleteInscripcionAc($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/inscripcionActividades/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/inscripcionActividades/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }
    }

    function agregarInscripcionAc(){
        $IdInscripcionAc         = $_POST['IdInscripcionAc'];
        $IdProyecto              = $_POST['IdProyecto'];
        $Objetivo                = $_POST['Objetivo'];
        $PoblacionBeneficiada    = $_POST['PoblacionBeneficiada'];
        $CantPoblacion           = $_POST['CantPoblacion'];
        $Facilitadores           = $_POST['Facilitadores'];
        $DuracionHoras           = $_POST['DuracionHoras'];
        $CuentaFinanciamientoExt = $_POST['CuentaFinanciamientoExt'];
        $NumeroSesion            = $_POST['NumeroSesion'];
        
        $arreglo = [
            'idInscripcionAc'     => $IdInscripcionAc,
            'IdProyecto'           => $IdProyecto,
            'Objetivo'       => $Objetivo,
            'PoblacionBeneficiada'  =>  $PoblacionBeneficiada,
            'CantPoblacion'      =>   $CantPoblacion,
            'Facilitadores'      => $Facilitadores,
            'DuracionHoras'      => $DuracionHoras,
            'CuentaFinanciamientoExt' => $CuentaFinanciamientoExt,
            'NumeroSesion'       =>  $NumeroSesion

        ];

        if($this->model->addInscripcionAc($arreglo)){

            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/inscripcionActividades/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/inscripcionActividades/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }

    }
}
?>