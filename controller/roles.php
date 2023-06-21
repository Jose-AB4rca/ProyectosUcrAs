<?php
class Roles extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller

    }

    function verRol($param = null){
        //la posicion [0] es un identificador
        $idrol = $param[0];
        $rol = $this->model->searchRol($idrol);

        session_start();
        $_SESSION['idRol'] = $idrol;

        //pasa a la view los datos
        $this->view->item = $rol;
        $this->view->mensaje = "";
        $this->view->render('roles/verRol.php');

    }

    function actualizarRol(){
        session_start();
        $IdRol      = $_SESSION['IdRol'];
        $TipoRol    = $_POST['TipoRol'];

        $arreglo = [
            'IdRol' => $IdRol,
            'TipoRol' => $TipoRol
        ];

        unset($_SESSION['IdRol']);

        if($this->model->updateRol($arreglo)){    
            $rol = new Rol();

            $idRol      = $IdRol;
            $tipoRol   = $TipoRol;
            
            $this->view->item = $rol;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Rol actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Rol no se actualizó</h1></div>';  
        }

        $this->view->render('roles/verRol.php');

    }    

    function eliminarRol($param = null){
        $idrol = $param[0];
 
        if($this->model->deleteRol($idrol)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Rol Eliminado con el ID: '.$idrol.'</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Rol no se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

    }

    function registrarUsuario(){
        $IdRol      = $_POST['IdRol'];
        $TipoRol    = $_POST['TipoRol'];

        $arreglo = [
            'IdRol' => $IdRol,
            'TipoRol' => $TipoRol
        ];
        $mensaje = "";
     
        if($this->model->addRol($arreglo)){
            
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Rol creado</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Rol no creado</h1></div>';  
        }
              
    }

    function editarRol(){
        $IdRol      = $_SESSION['IdRol'];
        $TipoRol    = $_POST['TipoRol'];

        $arreglo = [
            'IdRol' => $IdRol,
            'TipoRol' => $TipoRol
        ];
        if($this->model->updateRol($arreglo)){
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>rol actualizado</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>rol no actualizado</h1></div>';  
        }

    }
}
?>