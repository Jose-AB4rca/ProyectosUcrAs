<?php
class ObjetivosEspecificos extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }
    // metodos para dar a view datos y cargar vistas
    function render(){
        $obs = $this->model->getObjetivosEsp();
        $this->view->list = $obs;
        $this->view->render('objetivoEsp/lista');
    }
    function listaGeneral(){
        $obs = $this->model->getObjetivosEsp();
        $this->view->list = $obs;
        $this->view->render('objetivoEsp/lista');
    }
    function listaEspecifica($param = null){
        $obs = $this->model->getPryObjetivosEsp($param[0]);
        $this->view->list = $obs;
        $this->view->render('objetivoEsp/lista');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('objetivoEsp/agregar');
    }
    function edit($param = null){
        $obs = $this->model->searchObjetivoEsp($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('objetivoEsp/editar');
    }

    function verObjetivoEsp($paramA = null){
        $obs = $this->model->searchObjetivoEsp($paramA[0],$paramA[1]);
        $this->view->item = $obs;
        $this->view->render('objetivoEsp/ver');
    }
    //metodos pare transacciones de datos
    function editarObjetivoEsp(){
        $IdProyecto     = $_POST['IdProyecto'];
        $IdObjetivoEsp  = $_POST['IdObjetivoEsp'];
        $Objetivo       = $_POST['Objetivo'];

        $arreglo = [
            'IdProyecto'     => $IdProyecto,
            'IdObjetivoEsp'           => $IdObjetivoEsp,
            'Objetivo'       => $Objetivo 
        ];

        if($this->model->updateObjetivoEsp($arreglo)){
            $pg = new ObjetivoEspecifico();
            $pg->idProyecto         = $IdProyecto;
            $pg->idObjetivoEsp      = $IdObjetivoEsp;
            $pg->objetivo          = $Objetivo; 

            $mjs = "Actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/objetivosEspecificos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
        }else{
            $mjs = "No actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/objetivosEspecificos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
        }
    }

    function eliminarObjetivoEsp($paramA = null){
        $par = explode(',',$paramA[0]);
        
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
        //var_dump($id);
        if($this->model->deleteObjetivoEsp($idp,$ido)){    
            $mjs = "Objetivo borrado";  
            header("Location: http://localhost/ProyectosUcrAs/objetivosEspecificos/listaEspecifica/".$idp."?ms=$mjs"); 
        }else{          
            $mjs = "No borrado";  
            header("Location: http://localhost/ProyectosUcrAs/objetivosEspecificos/listaEspecifica/".$idp."?ms=$mjs"); 
        }
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
            $mjs = "Objetivo creado";  
            header("Location: http://localhost/ProyectosUcrAs/objetivosEspecificos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
        }else{
            $mjs = "Objetivo no creado";  
            header("Location: http://localhost/ProyectosUcrAs/objetivosEspecificos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
        }
        
    }

}
?>