<?php
class MetasObjetivosEsp extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
    }

    function listaEspecifica($param = null){
        $conv = $this->model->getMetasObjetivosEspPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('metasObjetivosEsp/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchMetasObjetivosEsp($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('metasObjetivosEsp/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('metasObjetivosEsp/agregar');
    }

    function editarMetasObjetivosEsp(){
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

        if($this->model->updateMetasObjetivosEsp($arreglo)){    
            $obj = new MetaObjetivoEsp();      
            $obj->idMeta          = $IdMeta;
            $obj->idObjetivoEsp   = $IdObjetivoEsp;
            $obj->meta            = $Meta;
            $obj->indicador       = $Indicador;
            
            $mjs = "Actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/metasObjetivosEsp/listaEspecifica/".$IdObjetivoEsp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/metasObjetivosEsp/listaEspecifica/".$IdObjetivoEsp."?ms=$mjs"); 
            exit();  
        }
    }

    function borrarMetasObjetivosEsp($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
      
        if($this->model->deleteMetasObjetivosEsp($idp,$ido)){    
             $mjs = "Borrado";  
             header("Location: http://localhost/ProyectosUcrAs/metasObjetivosEsp/listaEspecifica/".$idp."?ms=$mjs"); 
             exit();  
        }else{          
            $mjs = "No borrado";  
            header("Location: http://localhost/ProyectosUcrAs/metasObjetivosEsp/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }

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
            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/metasObjetivosEsp/listaEspecifica/".$IdObjetivoEsp."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/metasObjetivosEsp/listaEspecifica/".$IdObjetivoEsp."?ms=$mjs"); 
            exit();  
        }
    }   

}
?>