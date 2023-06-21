<?php
class MetricasEvaluacion extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
    }

    function render($param = null){
        $dsp = $this->model->getMetricaEvaluacion();
        $this->view->list = $dsp;
        $this->view->render('metricaEvaluacion/lista');
    }

    function listaEspecifica($param = null){
        $conv = $this->model->getMetricaEvaluacionPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('metricasEvaluacion/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchMetricaEvaluacion($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('metricasEvaluacion/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('metricasEvaluacion/agregar');
    }

    function verMetricaEva($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $dis = $this->model->searchMetricaEvaluacion($id,$idb);

        //pasa a la view los datos
        $this->view->item = $dis;
        $this->view->mensaje = "";
        $this->view->render('metricaEvaluacion/ver.php');

    }

    function editarMetricaEva(){

        $IdMetrica              = $_POST['IdMetrica'];
        $IdProyecto             = $_POST['IdProyecto'];
        $EvaluacionProyecto    = $_POST['EvaluacionProyecto'];
        $EvaluacionImpacto      = $_POST['EvaluacionImpacto'];
        $EvaluacionParticipante = $_POST['EvaluacionParticipante'];
        
        $arreglo = [
            'IdMetrica'           => $IdMetrica,
            'IdProyecto'          => $IdProyecto,
            'EvaluacionProyeecto' => $EvaluacionProyecto,
            'EvaluacionImpacto'   => $EvaluacionImpacto,
            'EvaluacionParticipante'  => $EvaluacionParticipante
        ];
        if($this->model->updateMetricaEvaluacion($arreglo)){    
            $eva = new MetricaEvaluacion();      
            $eva->idMetrica           = $IdMetrica;
            $eva->idProyecto          = $IdProyecto;
            $eva->evaluacionProyecto      = $EvaluacionProyecto;
            $eva->evaluacionImpacto       = $EvaluacionImpacto;
            $eva->evaluacionParticipante  = $EvaluacionParticipante;
            
            $mjs = "Actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/metricasEvaluacion/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No cambiado";  
            header("Location: http://localhost/ProyectosUcrAs/metricasEvaluacion/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();    
        }

        $this->view->render('metricaEvaluacion/ver.php');

    }

    function borrarMetricaEva($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
      
        if($this->model->deleteMetricaEvaluacion($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/metricasEvaluacion/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();    
        }else{          
            $mjs = "No borrado";  
            header("Location: http://localhost/ProyectosUcrAs/metricasEvaluacion/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();    
        }
    }

    function agregarMetricaEva(){
       
        $IdMetrica              = $_POST['IdMetrica'];
        $IdProyecto             = $_POST['IdProyecto'];
        $EvaluacionProyeecto    = $_POST['EvaluacionProyeecto'];
        $EvaluacionImpacto      = $_POST['EvaluacionImpacto'];
        $EvaluacionParticipante = $_POST['EvaluacionParticipante'];
        
        $arreglo = [
            'IdMetrica'           => $IdMetrica,
            'IdProyecto'          => $IdProyecto,
            'EvaluacionProyeecto' => $EvaluacionProyeecto,
            'EvaluacionImpacto'   => $EvaluacionImpacto,
            'EvaluacionParticipante'  => $EvaluacionParticipante
        ];

        if($this->model->addMetricaEvaluacion($arreglo)){
            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/metricasEvaluacion/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();    
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/metricasEvaluacion/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();    
        }
    }   

}
?>