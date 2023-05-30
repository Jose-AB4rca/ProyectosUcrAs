<?php
class Modalidades extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render($param = null){
        $dsp = $this->model->getModalidades();
        $this->view->item = $dsp;
        $this->view->render('modalidad/lista.php');
    }

    function verModalidad($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $dis = $this->model->searchModalidad($id,$idb);

        //pasa a la view los datos
        $this->view->item = $dis;
        $this->view->mensaje = "";
        $this->view->render('modalidad/ver.php');

    }

    function editarModalidad(){
        session_start();

        $IdModalidad  = $_SESSION['IdModalidad'];
        $IdProyecto   = $_SESSION['IdProyecto'];
        $Descripcion  = $_POST['Descripcion'];

        $arreglo = [
            'IdModalidad'       => $IdModalidad,
            'IdProyecto'        => $IdProyecto,
            'Descripcion'       => $Descripcion
        ];
 
        unset_session($_SESSION['IdModalidad'],$_SESSION['IdProyecto']);

        if($this->model->updateModalidad($arreglo)){    
            $mod = new Modalidad();      
            $mod->idModalidad = $IdModalidad;
            $mod->idProyecto = $IdProyecto;
            $mod->descripcion = $Descripcion;
            
            $this->view->item = $mod;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('modalidad/ver.php');

    }

    function borrarModalidad($param = null){
        $idp = $param[0];
        $idc = $param[1];
      
        if($this->model->deleteModalidad($idp,$idc)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado con ID: '.$idc.' PROYECTO :'.$idp.'</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarModalidad(){
       
        $IdModalidad  = $_POST['IdModalidad'];
        $IdProyecto   = $_POST['IdProyecto'];
        $Descripcion  = $_POST['Descripcion'];

        $arreglo = [
            'IdModalidad'       => $IdModalidad,
            'IdProyecto'        => $IdProyecto,
            'Descripcion'       => $Descripcion
        ];
        if($this->model->addModalidad($arreglo)){
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }   
}
?>