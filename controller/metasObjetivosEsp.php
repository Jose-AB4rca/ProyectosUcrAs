<?php
class MetasObjetivosEsp extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render($param = null){
        $dsp = $this->model->getMetasObjetivosEsp();
        $this->view->list = $dsp;
        $this->view->render('metasObjetiosEsp/lista.php');
    }

    function verMetasObjetivosEsp($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $dis = $this->model->searchMetasObjetivosEsp($id,$idb);

        //session_start();
        //$_SESSION['id'] = $id;
        //$_SESSION['idb'] = $idb;

        //pasa a la view los datos
        $this->view->item = $dis;
        $this->view->mensaje = "";
        $this->view->render('metasObjetiosEsp/ver.php');

    }

    function editarMetasObjetivosEsp(){
        session_start();
        $IdMeta         =$_SESSION['IdMeta'];
        $IdObjetivoEsp  =$_SESSION['IdObjetivoEsp'];
        $Meta           =$_POST['Meta'];
        $Indicador      =$_POST['Indicador'];
        
        $arreglo = [
            'IdMeta'          => $IdMeta,
            'IdObjetivoEsp'   => $IdObjetivoEsp,
            'Meta'            => $Meta,
            'Indicador'       => $Indicador
        ];
 
        unset_session($_SESSION['IdMeta'],$_SESSION['IdObjetivoEsp']);

        if($this->model->updateMetasObjetivosEsp($arreglo)){    
            $obj = new MetaObjetivoEsp();      
            $obj->idMeta          = $IdMeta;
            $obj->idObjetivoEsp   = $IdObjetivoEsp;
            $obj->meta            = $Meta;
            $obj->indicador       = $Indicador;
            
            $this->view->item = $obj;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('metasObjetivosEsp/ver.php');

    }

    function borrarMetasObjetivosEsp($param = null){
        $idp = $param[0];
        $idc = $param[1];
      
        if($this->model->deleteMetasObjetivosEsp($idp,$idc)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado con ID: '.$idc.' PROYECTO :'.$idp.'</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarMetasObjetivosEsp(){
       
        $IdMeta         =$_POST['IdMeta'];
        $IdObjetivoEsp  =$_POST['IdObjetivoEsp'];
        $Meta           =$_POST['Meta'];
        $Indicador      =$_POST['Indicador'];
        
        $arreglo = [
            'IdMeta'          => $IdMeta,
            'IdObjetivoEsp'   => $IdObjetivoEsp,
            'Meta'            => $Meta,
            'Indicador'       => $Indicador
        ];

        if($this->model->addMetasObjetivosEsp($arreglo)){
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }   

}
?>