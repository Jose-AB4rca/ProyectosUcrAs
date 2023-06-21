<?php
class Convenios extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
        $this->view->mensaje = "";
        $this->view->list =[];
    }
    //metoodos para vistas
    function render(){
        $conv = $this->model->getConvenios();
        $this->view->list = $conv;
        $this->view->render('convenios/lista');
    }
    function verConvenio($paramA = null){
        $conv = $this->model->searchConvenio($paramA[0],$paramA[1]);
        $this->view->item = $conv;
        $this->view->render('convenios/ver');
    }
    function listaEspecifica($param = null){
        $conv = $this->model->getConveniosPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('convenios/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchConvenio($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('convenios/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('convenios/agregar');
    }

    //metodos para transacciones de datos 
    function agregarConvenio(){
        $IdConvenio  = $_POST['IdConvenio'];
        $IdProyecto  = $_POST['IdProyecto'];
        $Convenios   = $_POST['Convenios'];

        $arreglo = [
            'IdConvenio'=>$IdConvenio,
            'IdProyecto'=>$IdProyecto,
            'Convenios'=>$Convenios
        ];
        $mensaje = "";
        if($this->model->addConvenio($arreglo)){
            $mjs = "Agregado";  
            header("Location: http://localhost/ProyectosUcrAs/convenios/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No añadido";  
            header("Location: http://localhost/ProyectosUcrAs/convenios/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }

    function editarConvenio(){
        $IdConvenio  = $_POST['IdConvenio'];
        $IdProyecto  = $_POST['IdProyecto'];
        $Convenios   = $_POST['Convenios'];

        $arreglo = [
            'IdConvenio'=>$IdConvenio,
            'IdProyecto'=>$IdProyecto,
            'Convenios'=>$Convenios
        ];
       
        if($this->model->updateConvenio($arreglo)){
            $conv = new Convenio();
            $conv->idConvenio = $IdConvenio;
            $conv->idProyecto = $IdProyecto;
            $conv->convenios = $Convenios;

            $mjs = "Editado";  
            header("Location: http://localhost/ProyectosUcrAs/convenios/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No editado";  
            header("Location: http://localhost/ProyectosUcrAs/convenios/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }    
    }

    function eliminarConvenio($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
        if($this->model->deleteConvenio($idp,$ido)){
            $mjs = "Eliminado";  
            var_dump($par);
            header("Location: http://localhost/ProyectosUcrAs/convenios/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No eliminado";  
            header("Location: http://localhost/ProyectosUcrAs/convenios/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();    
        }
    }

 


}
?>