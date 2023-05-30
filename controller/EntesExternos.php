<?php
class EntesExternos extends Model{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render($param = null){
        $EE = $this->model->getEntesExternos();
        $this->view->list = $EE;
        $this->view->render('entesExternos/lista.php');
    }

    function verEnteExt($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $ente = $this->model->searchEnteExterno($id,$idb);

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['idb'] = $idb;

        //pasa a la view los datos
        $this->view->item = $ente;
        $this->view->mensaje = "";
        $this->view->render('entesExternos/editar.php');

    }

    function editarEnteExt(){
        session_start();
        $IdProyecto     = $_SESSION['IdProyecto '];
        $IdEnteExterno  = $_SESSION['IdEnteExterno'];
        $Tipo           = $_POST['Tipo'];
        $Ente           = $_POST['Ente'];

        $arreglo = [
            'IdProyectos'    => $IdProyectos,
            'IdEnteExterno'  => $IdEnteExterno,
            'Tipo'           => $Tipo,
            'Ente'           => $Ente
        ];
 
        unset_session($_SESSION['IdProyecto'],$_SESSION['IdEnteExterno']);

        if($this->model->updateEnteExterno($arreglo)){    
            $ente = new EnteExterno();      

            $ente->idProyectos     = $IdProyectos;
            $ente->idEnteExterno   = $IdEnteExterno;
            $ente->tipo         = $Tipo;
            $ente->ente         = $Ente;
            
            $this->view->item = $ente;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro Actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('entesExternos/ver.php');

    }

    function borrarEnteExt($param = null){
        $idc = $param[0];
        $idp = $param[1];
      
        if($this->model->deleteEnteExterno($idc,$idp)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarEnteExt(){
        $IdProyecto     = $_POST['IdProyecto '];
        $IdEnteExterno  = $_POST['IdEnteExterno'];
        $Tipo           = $_POST['Tipo'];
        $Ente           = $_POST['Ente'];

        $arreglo = [
            'IdProyectos'    => $IdProyectos,
            'IdEnteExterno'  => $IdEnteExterno,
            'Tipo'           => $Tipo,
            'Ente'           => $Ente
        ];

        if($this->model->addEnteExterno($arreglo)){
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }   

}
?>