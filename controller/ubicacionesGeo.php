<?php
class UbicacionesGeo extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
    }

    //metodos para cargar y mover datos a las vistas
    function listaEspecifica($param = null){
        $conv = $this->model->getUbicacionesGeoPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('ubicacionGeo/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchUbicacionGeo($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('ubicacionGeo/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('ubicacionGeo/agregar');
    }

    function editarUbicacionGeo(){
        $IdUbicacionGeo  = $_POST['IdUbicacionGeo'];
        $IdProyecto      = $_POST['IdProyecto'];
        $Region          = $_POST['Region'];
        $Provincia       = $_POST['Provincia'];
        $Canton          = $_POST['Canton'];
        $Distrito        = $_POST['Distrito'];
        $Descripcion     = $_POST['Descripcion'];


        $arreglo = [
            'IdUbicacionGeo'    => $IdUbicacionGeo,
            'IdProyecto'        => $IdProyecto,
            'Region'            => $Region,
            'Provincia'         => $Provincia,
            'Canton'            => $Canton,
            'Distrito'          => $Distrito,
            'Descripcion'       => $Descripcion
        ];


        if($this->model->updateUbicacionGeo($arreglo)){    
            $mjs = "actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/ubicacionesGeo/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/ubicacionesGeo/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }

    }

    function borrarUbicacionGeo($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
      
        if($this->model->deleteUbicacionGeo($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/ubicacionesGeo/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No borrado";  
            header("Location: http://localhost/ProyectosUcrAs/ubicacionesGeo/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }
    }

    function agregarUbicacionGeo(){

        $IdUbicacionGeo  = $_POST['IdUbicacionGeo'];
        $IdProyecto      = $_POST['IdProyecto'];
        $Region          = $_POST['Region'];
        $Provincia       = $_POST['Provincia'];
        $Canton          = $_POST['Canton'];
        $Distrito        = $_POST['Distrito'];
        $Descripcion     = $_POST['Descripcion'];


        $arreglo = [
            'IdUbicacionGeo'    => $IdUbicacionGeo,
            'IdProyecto'        => $IdProyecto,
            'Region'            => $Region,
            'Provincia'         => $Provincia,
            'Canton'            => $Canton,
            'Distrito'          => $Distrito,
            'Descripcion'       => $Descripcion
        ];
 

        if($this->model->addUbicacionGeo($arreglo)){
        
            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/ubicacionesGeo/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "no creado";  
            header("Location: http://localhost/ProyectosUcrAs/ubicacionesGeo/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
        
    }   

}
?>