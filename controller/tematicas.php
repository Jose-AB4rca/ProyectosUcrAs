<?php
class Tematicas extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render($param = null){
        $tem = $this->model->getTematicas();
        $this->view->list = $tem;
        $this->view->render('tematica/lista.php');
    }

    function verTematica($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $enc = $this->model->searchTematica($id,$idb);

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['idb'] = $idb;

        //pasa a la view los datos
        $this->view->item = $enc;
        $this->view->mensaje = "";
        $this->view->render('tematica/ver.php');

    }

    function editarTematica(){
        session_start();
        $IdTematica     = $_SESSION['IdTematica'];
        $IdProyecto     = $_SESSION['IdProyecto'];
        $Descripcion    = $_POST['Descripcion'];

        $arreglo = [
            'IdTematica'        => $IdTematica,
            'IdProyecto'        => $IdProyecto,
            'Descripcion'       => $Descripcion
        ];
 
        unset_session($_SESSION['IdTematica'],$_SESSION['IdProyecto']);

        if($this->model->updateTematica($arreglo)){    
            $tem = new Tematica();      

            $tem->idTematica    = $IdTematica;
            $tem->idProyecto    = $IdProyecto;
            $tem->descripcion      = $Descripcion;
            
            $this->view->item = $tem;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro Actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('tematica/lista.php');

    }

    function borrarTematica($param = null){
        $idc = $param[0];
        $idp = $param[1];
      
        if($this->model->deleteTematica($idc,$idp)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado </h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarTematica(){
        $IdTematica     = $_POST['IdTematica'];
        $IdProyecto     = $_POST['IdProyecto'];
        $Descripcion    = $_POST['Descripcion'];

        $arreglo = [
            'IdTematica'        => $IdTematica,
            'IdProyecto'        => $IdProyecto,
            'Descripcion'       => $Descripcion
        ];
 

        if($this->model->addTematica($arreglo)){
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }   


}
?>