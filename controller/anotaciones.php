<?php
class Anotaciones extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
    }

    //lista de objetos
    function render(){
        $anotaciones = $this->model->getAnotaciones();
        $this->view->list = $anotaciones;
        $this->view->render('anotaciones/lista');
    }
    function listaEspecifica($param = null){
        $anotaciones = $this->model->getAnotacionesProyecto($param[0]);
        $this->view->list = $anotaciones;
        $this->view->render('anotaciones/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchAnotacion($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('anotaciones/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('anotaciones/agregar');
    }






    function editarAnotacion(){
        $IdAnotacion   = $_POST['IdAnotacion'];
        $IdProyecto    = $_POST['IdProyecto'];
        $Documento     = $_POST['Documento'];
        $Anotacion     = $_POST['Anotacion'];
        $CedulaUsuario = $_POST['CedulaUsuario'];

        $arreglo = [
            'IdAnotacion' => $IdAnotacion,
            'IdProyecto' => $IdProyecto,
            'Documento' => $Documento,
            'Anotacion' => $Anotacion,
            'CedulaUsuario' => $CedulaUsuario
        ];

        if($this->model->updateAnotacion($arreglo)){    
            $ant = new Anotacion();      

            $ant->idAnotacion   = $IdAnotacion;
            $ant->idProyecto    = $IdProyecto;
            $ant->documento     = $Documento;
            $ant->anotacion     = $Anotacion;
            $ant->cedulaUsuario = $$CedulaUsuario;
            
            $mjs = "Editado";  
            header("Location: http://localhost/ProyectosUcrAs/anotaciones/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
        }else{          
            $mjs = "No editado";  
            header("Location: http://localhost/ProyectosUcrAs/anotaciones/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
        }
        //$this->view->render('anotaciones/ver.php');
    }

    function borrarAnotacion($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
        //var_dump($par);
      
        if($this->model->deleteAnotacion($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/anotaciones/listaEspecifica/".$idp."?ms=$mjs"); 
            var_dump($par);
        }else{          
            $mjs = "No borrado";  
            header("Location: http://localhost/ProyectosUcrAs/anotaciones/listaEspecifica/".$idp."?ms=$mjs"); 
        }
    }

    function agregarAnotacion(){
        $IdAnotacion   = $_POST['IdAnotacion'];
        $IdProyecto    = $_POST['IdProyecto'];
        $Fecha         = $_POST['Fecha'];
        $Documento     = $_POST['Documento'];
        $Anotacion     = $_POST['Anotacion'];
        $CedulaUsuario = $_POST['CedulaUsuario'];

        $arreglo = [
            'IdAnotacion' => $IdAnotacion,
            'IdProyecto' => $IdProyecto,
            'Fecha'     => $Fecha,
            'Documento' => $Documento,
            'Anotacion' => $Anotacion,
            'CedulaUsuario' => $CedulaUsuario
        ];

        if($this->model->addAnotacion($arreglo)){
            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/anotaciones/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/anotaciones/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
        }
    }    


}
?>
