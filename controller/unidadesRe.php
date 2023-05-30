<?php
class UnidadesRe extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render($param = null){
        $unid = $this->model->getUnidadRe();
        $this->view->list = $unid;
        $this->view->render('unidadRe/lista.php');
    }

    function verUnidadRe($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $enc = $this->model->searchUnidadRe($id,$idb);

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['idb'] = $idb;

        //pasa a la view los datos
        $this->view->item = $enc;
        $this->view->mensaje = "";
        $this->view->render('unidadRe/ver.php');

    }

    function editarUnidadRe(){
        session_start();

        $idUnidadR  = $_SESSION['IdUnidadR'];
        $idProyecto = $_SESSION['IdProyecto'];
        $unidad     = $_POST['Unidad'];
        $base       = $_POST['Base'];

        $arreglo = [
            'IdUnidadR'       => $IdUnidadR,
            'IdProyecto'    => $IdProyecto,
            'Unidad'       => $Unidad,
            'Base'       => $Base
        ];
 
        unset_session($_SESSION['IdUnidadR'],$_SESSION['IdProyecto']);

        if($this->model->updateTematica($arreglo)){    
            $unidRe = new UnidadRelaionada();      

            $unidRe->idUnidadR       = $IdUnidadR;
            $unidRe->idProyecto    = $IdProyecto;
            $unidRe->unidad       = $Unidad;
            $unidRe->base       = $Base;
            
            $this->view->item = $unidRe;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro Actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('unidadRe/lista.php');

    }

    function borrarUnidadRe($param = null){
        $idc = $param[0];
        $idp = $param[1];
      
        if($this->model->deleteUnidadRe($idc,$idp)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado </h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarUnidadRe(){
        $idUnidadR  = $_POST['IdUnidadR'];
        $idProyecto = $_POST['IdProyecto'];
        $unidad     = $_POST['Unidad'];
        $base       = $_POST['Base'];

        $arreglo = [
            'IdUnidadR'       => $IdUnidadR,
            'IdProyecto'    => $IdProyecto,
            'Unidad'       => $Unidad,
            'Base'       => $Base
        ];
 
 

        if($this->model->addUnidadRe($arreglo)){
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }   

}
?>