<?php
class UbicacionesGeo extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render($param = null){
        $tem = $this->model->getUbicacionGeo();
        $this->view->list = $tem;
        $this->view->render('ubicacionGeo/lista.php');
    }

    function verUbicacionGeo($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $enc = $this->model->searchUbicacionGeo($id,$idb);

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['idb'] = $idb;

        //pasa a la view los datos
        $this->view->item = $enc;
        $this->view->mensaje = "";
        $this->view->render('ubicacionGeo/ver.php');

    }

    function editarUbicacionGeo(){
        session_start();
        $IdUbicacionGeo  = $_SESSION['IdUbicacionGeo'];
        $IdProyecto      = $_SESSION['IdProyecto'];
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
 
        unset_session($_SESSION['IdUbicacionGeo'],$_SESSION['IdProyecto']);

        if($this->model->updateUbicacionGeo($arreglo)){    
            $ubicacion = new UbicacionGeografica();      

            $ubicacion->idUbicacionGeo = $IdUbicacionGeo;
            $ubicacion->idProyecto = $IdProyecto;
            $ubicacion->region     = $Region;
            $ubicacion->provincia  =  $Provincia;
            $ubicacion->canton   = $Canton;
            $ubicacion->distrito  = $Distrito;
            $ubicacion->descripcion  = $Descripcion;
            
            $this->view->item = $ubicacion;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro Actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('ubicacionGeo/lista.php');

    }

    function borrarUbicacionGeo($param = null){
        $idc = $param[0];
        $idp = $param[1];
      
        if($this->model->deleteTematica($idc,$idp)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado </h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
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
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }   

}
?>