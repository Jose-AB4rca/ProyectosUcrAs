<?php
class Descriptores extends Model{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render(){
        $descrip = $this->model->getDescriptores();
        $this->view->list = $descrip;
        $this->view->render('descriptores/lista.php');
    }

    function verDescriptor($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $descrip = $this->model->searchDescriptor($id,$idb);

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['idb'] = $idb;

        //pasa a la view los datos
        $this->view->item = $descrip;
        $this->view->mensaje = "";
        $this->view->render('descriptores/ver.php');

    }

    function editarDescriptor(){
        session_start();
        $IdProyectos = $_SESSION['IdProyectos'];
        $IdDescriptor = $_SESSION['IdDescriptor'];
        $Descriptor  = $_POST['Descriptor'];


        $arreglo = [
            'IdProyectos'     => $IdProyectos,
            'IdDescriptor'    => $IdDescriptor,
            'Descriptor'      => $Descriptor
        ];
 
        unset_session($_SESSION['IdProyecto'],$_SESSION['IdDescriptor']);

        if($this->model->updateDescriptor($arreglo)){    
            $descrip = new Descriptor();      

            $descrip->idProyectos     = $IdProyectos;
            $descrip->idDescriptor    = $IdDescriptor;
            $descrip->descriptor      = $Descriptor;
            
            $this->view->item = $descrip;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro Actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('descriptor/ver.php');

    }

    function borrarDescriptor($param = null){
        $idp = $param[0];
        $idc = $param[1];
      
        if($this->model->deleteCronograma($idc,$idp)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarDescriptor(){
        $IdProyectos = $_POST['IdProyectos'];
        $IdDescriptor = $_POST['IdDescriptor'];
        $Descriptor  = $_POST['Descriptor'];


        $arreglo = [
            'IdProyectos'     => $IdProyectos,
            'IdDescriptor'    => $IdDescriptor,
            'Descriptor'      => $Descriptor
        ];

        if($this->model->addDescriptor($arreglo)){
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }   

}

?>