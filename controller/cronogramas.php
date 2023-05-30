<?php
class Corogramas extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render($param = null){
        $crono = $this->model->getCronogramas();
        $this->view->list = $crono;
        $this->view->render('cronogramas/lista.php');
    }

    function verCronograma($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $crono = $this->model->searchCronograma($id,$idb);

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['idb'] = $idb;

        //pasa a la view los datos
        $this->view->item = $crono;
        $this->view->mensaje = "";
        $this->view->render('cronogramas/ver.php');

    }

    function editarCronograma(){
        session_start();
        $IdCronograma   = $_SESSION['IdCronograma']; 
        $IdProyecto     = $_SESSION['IdProyecto']; 
        $Tipo           = $_POST['Tipo']; 
        $Actividad      = $_POST['Actividad']; 
        $FechaInicio    = $_POST['FechaInicio']; 
        $FechaFin       = $_POST['FechaFin']; 
        $Descripcion    = $_POST['Descripcion']; 


        $arreglo = [
            'IdCronograma'    => $IdCronograma,
            'IdProyecto'      => $IdProyecto,
            'Tipo'            => $Tipo,
            'Actividad'       => $Actividad,
            'FechaInicio'     => $FechaInicio,
            'FechaFin'        => $FechaFin,
            'Descripcion'     => $Descripcion
        ];
 
        unset_session($_SESSION['IdCronograma'],$_SESSION['IdProyecto']);

        if($this->model->updateCronograma($arreglo)){    
            $crono = new Cronograma();      

            $crono->idCronogram    = $IdCronograma;
            $crono->idProyecto     = $IdProyecto;
            $crono->tipo           = $Tipo;
            $crono->actividad      = $Actividad;
            $crono->fechaInicio    = $FechaInicio;
            $crono->fechaFin       = $FechaFin;
            $crono->descripcion    = $Descripcion;
            
            $this->view->item = $crono;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('cronogramas/ver.php');

    }

    function borrarCronograma($param = null){
        $idp = $param[0];
        $idc = $param[1];
      
        if($this->model->deleteCronograma($idp,$idc)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarCronograma(){
        $IdCronograma   = $_POST['IdCronograma']; 
        $IdProyecto     = $_POST['IdProyecto']; 
        $Tipo           = $_POST['Tipo']; 
        $Actividad      = $_POST['Actividad']; 
        $FechaInicio    = $_POST['FechaInicio']; 
        $FechaFin       = $_POST['FechaFin']; 
        $Descripcion    = $_POST['Descripcion']; 


        $arreglo = [
            'IdCronograma'    => $IdCronograma,
            'IdProyecto'      => $IdProyecto,
            'Tipo'            => $Tipo,
            'Actividad'       => $Actividad,
            'FechaInicio'     => $FechaInicio,
            'FechaFin'        => $FechaFin,
            'Descripcion'     => $Descripcion
        ];

        if($this->model->addCronograma($arreglo)){
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }   

}
?>