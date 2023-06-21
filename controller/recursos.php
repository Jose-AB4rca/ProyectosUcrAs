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
        $this->view->render('recurso/lista');
    }

    function listaEspecifica($param = null){
        $conv = $this->model->getRecursosPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('recurso/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchRecurso($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('recurso/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('recurso/agregar');
    }

    function editarRecurso(){
        $IdRecurso      = $_POST['IdRecurso'];;
        $IdProyecto     = $_POST['IdProyecto'];;
        $Recurso        = $_POST['Recurso'];

        $arreglo = [
            'IdRecurso'        => $IdRecurso,
            'IdProyecto'        => $IdProyecto,
            'Recurso'       => $Recurso
        ];
 
        if($this->model->updateRecurso($arreglo)){    
            $rec = new Recurso();      
            $rec->idRecurso     = $IdRecurso;
            $rec->idProyecto    = $IdProyecto;
            $rec->recurso       = $Recurso;
            $this->view->item = $rec;
            
            $mjs = "Actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/recursos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/recursos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }

    }

    function borrarRecurso($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
      
        if($this->model->deleteRecurso($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/recursos/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No borrado";  
            header("Location: http://localhost/ProyectosUcrAs/recursos/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }
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
        
            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/recursos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/recursos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }   


}
?>