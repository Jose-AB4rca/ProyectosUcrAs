<?php
class EnteExternos extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
    }

    function render($param = null){
        $EE = $this->model->getEntesExternos();
        $this->view->list = $EE;
        $this->view->render('enteExternos/lista');
    }
    function listaEspecifica($param = null){
        $conv = $this->model->getEntesExternosPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('enteExternos/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchEnteExterno($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('enteExternos/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('enteExternos/agregar');
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
        $IdProyecto     = $_POST['IdProyecto'];
        $IdEnteExterno  = $_POST['IdEnteExterno'];
        $Tipo           = $_POST['Tipo'];
        $Ente           = $_POST['Ente'];

        $arreglo = [
            'IdProyecto'    => $IdProyecto,
            'IdEnteExterno'  => $IdEnteExterno,
            'Tipo'           => $Tipo,
            'Ente'           => $Ente
        ];
 
        if($this->model->updateEnteExterno($arreglo)){    
            $ente = new EnteExterno();      

            $ente->idProyecto     = $IdProyecto;
            $ente->idEnteExterno   = $IdEnteExterno;
            $ente->tipo         = $Tipo;
            $ente->ente         = $Ente;

            $mjs = "Editado";  
            header("Location: http://localhost/ProyectosUcrAs/enteExternos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No editado";  
            header("Location: http://localhost/ProyectosUcrAs/enteExternos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }

    function borrarEnteExt($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
      
        if($this->model->deleteEnteExterno($idp,$ido)){    
            $mjs = "Eliminado";  
            header("Location: http://localhost/ProyectosUcrAs/enteExternos/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No eliminado";  
            header("Location: http://localhost/ProyectosUcrAs/enteExternos/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }
    }

    function agregarEnteExt(){
        $IdProyecto     = $_POST['IdProyecto'];
        $IdEnteExterno  = $_POST['IdEnteExterno'];
        $Tipo           = $_POST['Tipo'];
        $Ente           = $_POST['Ente'];

        $arreglo = [
            'IdProyecto'    => $IdProyecto,
            'IdEnteExterno'  => $IdEnteExterno,
            'Tipo'           => $Tipo,
            'Ente'           => $Ente
        ];

        if($this->model->addEnteExterno($arreglo)){
            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/enteExternos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/enteExternos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }   

}
?>