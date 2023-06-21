<?php
require_once('class/modalidad.php');
class Modalidades extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
    }

    function render($param = null){
        $dsp = $this->model->getModalidades();
        $this->view->item = $dsp;
        $this->view->render('modalidad/lista');
    }
    function listaEspecifica($param = null){
        $conv = $this->model->getModalidadesPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('modalidad/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchModalidad($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('modalidad/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('modalidad/agregar');
    }

    function verModalidad($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $dis = $this->model->searchModalidad($id,$idb);

        //pasa a la view los datos
        $this->view->item = $dis;
        $this->view->mensaje = "";
        $this->view->render('modalidad/ver.php');

    }

    function editarModalidad(){

        $IdModalidad  = $_POST['IdModalidad'];
        $IdProyecto   = $_POST['IdProyecto'];
        $Descripcion  = $_POST['Descripcion'];

        $arreglo = [
            'IdModalidad'       => $IdModalidad,
            'IdProyecto'        => $IdProyecto,
            'Descripcion'       => $Descripcion
        ];

        if($this->model->updateModalidad($arreglo)){    
            $mod = new Modalidad();      
            $mod->idModalidad = $IdModalidad;
            $mod->idProyecto = $IdProyecto;
            $mod->descripcion = $Descripcion;
            
            $mjs = "Actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/modalidades/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();   
        }else{          
            $mjs = "No actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/modalidades/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }

    function borrarModalidad($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
      
        if($this->model->deleteModalidad($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/modalidades/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No borrado";  
            header("Location: http://localhost/ProyectosUcrAs/meodalidades/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }
    }

    function agregarModalidad(){
       
        $IdModalidad  = $_POST['IdModalidad'];
        $IdProyecto   = $_POST['IdProyecto'];
        $Descripcion  = $_POST['Descripcion'];

        $arreglo = [
            'IdModalidad'       => $IdModalidad,
            'IdProyecto'        => $IdProyecto,
            'Descripcion'       => $Descripcion
        ];
        if($this->model->addModalidad($arreglo)){
        
            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/modalidades/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/modalidades/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();    
        }
    }   
}
?>