<?
class MetricasEvaluacion extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render($param = null){
        $dsp = $this->model->getMetricaEvaluacion();
        $this->view->list = $dsp;
        $this->view->render('metricaEvaluacion/lista.php');
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
        session_start();

        $IdMetrica              = $_SESSION['IdMetrica'];
        $IdProyecto             = $_SESSION['IdProyecto'];
        $EvaluacionProyecto    = $_POST['EvaluacionProyecto'];
        $EvaluacionImpacto      = $_POST['EvaluacionImpacto'];
        $EvaluacionParticipante = $_POST['EvaluacionParticipante'];
        
        $arreglo = [
            'IdMetrica'           => $IdMetrica,
            'IdProyecto'          => $IdProyecto,
            'EvaluacionProyecto' => $EvaluacionProyecto,
            'EvaluacionImpacto'   => $EvaluacionImpacto,
            'EvaluacionParticipante'  => $EvaluacionParticipante
        ];
 
        unset_session($_SESSION['IdMetrica'],$_SESSION['IdProyecto']);

        if($this->model->updateMetricaEvaluacion($arreglo)){    
            $eva = new MetricaEvaluacion();      
            $eva->idMetrica           = $IdMetrica;
            $eva->idProyecto          = $IdProyecto;
            $eva->evaluacionProyecto      = $EvaluacionProyecto;
            $eva->evaluacionImpacto       = $EvaluacionImpacto;
            $eva->evaluacionParticipante  = $EvaluacionParticipante;
            
            $this->view->item = $eva;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('metricaEvaluacion/ver.php');

    }

    function borrarMetricaEva($param = null){
        $idp = $param[0];
        $idc = $param[1];
      
        if($this->model->deleteMetricaEvaluacion($idp,$idc)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado con ID: '.$idc.' PROYECTO :'.$idp.'</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
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
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }   

}
?>