<?php
class ImpactosBeneficios extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
    }

    function render(){
        $imp = $this->model->getImpactoB();
        $this->view->list = $imp;
        $this->view->render('impactosBeneficios/lista');
    }
    function listaEspecifica($param = null){
        $conv = $this->model->getImpactosBPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('impactosBeneficios/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchImpactoB($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('impactosBeneficios/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('impactosBeneficios/agregar');
    }

    function verImpactoB($paramA = null){
        $imp = $this->model->searchImpactoB($paramA[0],$paramA[1]);
        $this->view->item = $imp;
        $this->view->render('impactosBeneficios/ver');
    }

    function editarImpactoB(){
        $IdImpacto            = $_POST['IdImpacto'];
        $IdProyecto           = $_POST['IdProyecto'];
        $CantPoblacion        = $_POST['CantPoblacion'];
        $Poblacion            = $_POST['Poblacion'];   
        $BeneficioUcr         = $_POST['BeneficioUcr'];
        $BeneficioPoblacion   = $_POST['BeneficioPoblacion'];

        $arreglo = [
            'IdImpacto'            => $IdImpacto,
            'IdProyecto'            => $IdProyecto,
            'CantPoblacion'         => $CantPoblacion,
            'Poblacion'             => $Poblacion,
            'BeneficioUcr'          => $BeneficioUcr,
            'BeneficioPoblacion'    => $BeneficioPoblacion
        ];

        if($this->model->updateImpactoB($arreglo)){
            $imp = new ImpactoBeneficio();
                $imp->idImpacto            = $IdImpacto;
                $imp->idProyecto           = $IdProyecto;
                $imp->cantPoblacion        = $CantPoblacion;
                $imp->poblacion            = $Poblacion;   
                $imp->beneficioUcr         = $BeneficioUcr;
                $imp->beneficioPoblacion   = $BeneficioPoblacion; 

                $mjs = "Actualizado";  
                header("Location: http://localhost/ProyectosUcrAs/impactosBeneficios/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
                exit();  
        }else{
                $mjs = "No actualizado";  
                header("Location: http://localhost/ProyectosUcrAs/impactosBeneficios/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
                exit();  
        }
    }

    function eliminarImpactoB($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
        if($this->model->deleteImpactoB($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/impactosBeneficios/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No borrado";  
            header("Location: http://localhost/ProyectosUcrAs/impactosBeneficios/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }
    }

    function agregarImpactoB(){
        $IdImpacto            = $_POST['IdImpacto'];
        $IdProyecto           = $_POST['IdProyecto'];
        $CantPoblacion        = $_POST['CantPoblacion'];
        $Poblacion            = $_POST['Poblacion'];   
        $BeneficioUcr         = $_POST['BeneficioUcr'];
        $BeneficioPoblacion   = $_POST['BeneficioPoblacion'];

        $arreglo = [
            'IdImpacto'            => $IdImpacto,
            'IdProyecto'            => $IdProyecto,
            'CantPoblacion'         => $CantPoblacion,
            'Poblacion'             => $Poblacion,
            'BeneficioUcr'          => $BeneficioUcr,
            'BeneficioPoblacion'    => $BeneficioPoblacion
        ];
        if($this->model->addImpactoB($arreglo)){

            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/impactosBeneficios/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/impactosBeneficios/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }

}
?>