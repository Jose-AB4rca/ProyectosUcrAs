<?php
class Convenios extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
        $this->view->mensaje = "";
        $this->view->list =[];
    }

    function render(){
        $conv = $this->model->getConvenios();
        $this->view->list = $conv;
        $this->view->render('convenios/lista.php');
    }
    function verConvenio($paramA = null){
        $conv = $this->model->searchConvenio($paramA[0],$paramA[1]);
        $this->view->item = $conv;
        $this->view->render('convenios/ver.php');
    }

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
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Convenio creado</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Convenio no Creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();   
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
            $conv->$convenios = $Convenios;

            $this->view->item = $conv;

            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Convenio actualizado</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Convenio no actualizado</h1></div>';  
        }    
        $this->render();
    }

    function eliminarConvenio($paramA = null){
        if($this->model->deleteConvenio($paramA[0],$paramA[1])){
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Convenio eliminado</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>No borrado</h1></div>';  
        }
    }

 


}
?>