<?php
class ProgramasAdsentos extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
    }

    function render(){
        $prm = $this->model->getProgramaAds();
        $this->view->$list = $prm;
        $this->view->render('programaAdsento/lista.php');
    }

    function listaEspecifica($param = null){
        $conv = $this->model->getProgramaAdsPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('programaAdsento/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchProgramaAds($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('programaAdsento/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('programaAdsento/agregar');
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

            $mjs = "Actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/programasAdsentos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/programasAdsentos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();    
        }
    }

    function eliminarProgramaAds($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
        if($this->model->deleteProgramaAds($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/programasAdsentos/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "no borrado";  
            header("Location: http://localhost/ProyectosUcrAs/programasAdsentos/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }

    }

    function agregarProgramaAds(){
        $IdProgramaAdsento   = $_POST['IdProgramaAdsento'];
        $IdProyecto          = $_POST['IdProyecto'];
        $ProgramaAdsento     = $_POST['ProgramaAdsento']; 


        $arreglo = [
            'IdProgramaAdsento'     => $IdProgramaAdsento,
            'IdProyecto'           => $IdProyecto,
            'ProgramaAdsento'       => $ProgramaAdsento
        ];

        if($this->model->addProgramaAds($arreglo)){
            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/programasAdsentos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();    
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/programasAdsentos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();    
        }

    }


}
?>