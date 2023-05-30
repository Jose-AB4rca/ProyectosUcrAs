<?php
class EncargadoAct extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render($param = null){
        $enc = $this->model->getEncargadosAct();
        $this->view->list = $enc;
        $this->view->render('encargadoActividades/lista.php');
    }

    function verEncargadoAct($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $enc = $this->model->searchEncargadoAct($id,$idb);

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['idb'] = $idb;

        //pasa a la view los datos
        $this->view->item = $enc;
        $this->view->mensaje = "";
        $this->view->render('encargadoActividades/ver.php');

    }

    function editarEncargadoAct(){
        session_start();
        $IdEncargado        =$_SESSION['IdEncargado'];
        $IdInscripcionAc    =$_SESSION['IdInscripcionAc'];
        $CedulaEncargado    =$_POST['CedulaEncargado'];


        $arreglo = [
            'IdEncargado'     => $IdEncargado,
            'IdInscripcionAc' => $IdInscripcionAc,
            'CedulaEncargado' => $CedulaEncargado
        ];
 
        unset_session($_SESSION['IdProyecto'],$_SESSION['IdEncargado']);

        if($this->model->updateEncargadoAct($arreglo)){    
            $enc = new EncargadoActividad();      

            $enc->idEncargado     = $IdEncargado;
            $enc->idInscripcionAc    = $IdInscripcionAc;
            $enc->CedulaEncargado      = $CedulaEncargado;
            
            $this->view->item = $enc;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro Actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('encargadoActividades/lista.php');

    }

    function borrarEncargadoAct($param = null){
        $idc = $param[0];
        $idp = $param[1];
      
        if($this->model->deleteCronograma($idc,$idp)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado con ID: '.$idc.' PROYECTO :'.$idp.'</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarEncargadoAct(){
        $IdEncargado        =$_POST['IdEncargado'];
        $IdInscripcionAc    =$_POST['IdInscripcionAc'];
        $CedulaEncargado    =$_POST['CedulaEncargado'];


        $arreglo = [
            'IdEncargado'     => $IdEncargado,
            'IdInscripcionAc' => $IdInscripcionAc,
            'CedulaEncargado'      => $CedulaEncargado
        ];

        if($this->model->addEncargadoAct($arreglo)){
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }   

}
?>