<?php
class Recursos extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render($param = null){  //lista de objetos
        $tem = $this->model->getRecursos();
        $this->view->list = $tem;
        $this->view->render('recurso/lista.php');
    }

    function verRecurso($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $enc = $this->model->searchRecurso($id,$idb);

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['idb'] = $idb;

        //pasa a la view los datos
        $this->view->item = $enc;
        $this->view->mensaje = "";
        $this->view->render('recurso/ver.php');

    }

    function editarRecurso(){
        session_start();
        $IdRecurso      = $_SESSION['IdRecurso'];;
        $IdProyecto     = $_SESSION['IdProyecto'];;
        $Recurso        = $_POST['Recurso'];

        $arreglo = [
            'IdRecurso'        => $IdRecurso,
            'IdProyecto'        => $IdProyecto,
            'Recurso'       => $Recurso
        ];
 
        unset_session($_SESSION['IdRecurso'],$_SESSION['IdProyecto']);

        if($this->model->updateRecurso($arreglo)){    
            $rec = new Recurso();      
            $rec->idRecurso     = $IdRecurso;
            $rec->idProyecto    = $IdProyecto;
            $rec->recurso       = $Recurso;
            $this->view->item = $rec;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro Actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->render();

    }

    function borrarRecurso($param = null){
        $idc = $param[0];
        $idp = $param[1];
      
        if($this->model->deleteRecurso($idc,$idp)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado </h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarRecurso(){
        $IdRecurso      = $_POST['IdRecurso'];;
        $IdProyecto     = $_POST['IdProyecto'];;
        $Recurso        = $_POST['Recurso'];

        $arreglo = [
            'IdRecurso'        => $IdRecurso,
            'IdProyecto'        => $IdProyecto,
            'Recurso'       => $Recurso
        ];
 

        if($this->model->addRecurso($arreglo)){
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }   


}
?>