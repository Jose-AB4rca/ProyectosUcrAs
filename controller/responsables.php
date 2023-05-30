<?php
class Responsables extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render($param = null){
        $enc = $this->model->getResponsable();
        $this->view->list = $enc;
        $this->view->render('responsables/lista.php');
    }

    function verResponsable($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $enc = $this->model->searchResponsable($id,$idb);

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['idb'] = $idb;

        //pasa a la view los datos
        $this->view->item = $enc;
        $this->view->mensaje = "";
        $this->view->render('responsables/ver.php');

    }

    function editarResponsable(){
        session_start();
       
        $IdResponsable  = $_SESSION['IdResponsable'];
        $IdProyecto     = $_SESSION['IdProyecto'];
        $Responsable    = $_POST['Responsable'];

        $arreglo = [
            'IdResponsable'     => $IdResponsable,
            'IdProyecto'        => $IdProyecto,
            'Responsable'       => $Responsable
        ];
 
        unset_session($_SESSION['IdResponsable'],$_SESSION['IdProyecto']);

        if($this->model->updateResponsable($arreglo)){    
            $res = new Responsable();      

            $res->idResponsable     = $IdResponsable;
            $res->idProyecto    = $IdProyecto;
            $res->responsable      = $Responsable;
            
            $this->view->item = $res;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro Actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('responsables/lista.php');

    }

    function borrarResponsable($param = null){
        $idc = $param[0];
        $idp = $param[1];
      
        if($this->model->deleteResponsable($idc,$idp)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado </h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarResponsable(){
        $IdResponsable  = $_POST['IdResponsable'];
        $IdProyecto     = $_POST['IdProyecto'];
        $Responsable    = $_POST['Responsable'];

        $arreglo = [
            'IdResponsable'     => $IdResponsable,
            'IdProyecto'        => $IdProyecto,
            'Responsable'       => $Responsable
        ];

        if($this->model->addResponsable($arreglo)){
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }   

}
?>