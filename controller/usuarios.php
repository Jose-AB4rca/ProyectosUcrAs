<?php
class Usuarios extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
        $this->view->usuarios = [];
        $this->view->mensaje = "";
    }

    function render(){
       $userlist = $this->model->listUser();
       $this->view->list = $userList;
       $this->render('users/lista.php');
    }

    function verUser($param = null){
        //la posicion [0] es un identificador
        $idusuario = $param[0];
        $usuarios = $this->model->searchUser($idusuario);

        session_start();
        $_SESSION['idusuario'] = $idusuario;

        //pasa a la view los datos del usuario
        $this->view->item = $usuarios;
        $this->view->mensaje = "";
        $this->view->render('users/ver.php');

    }

    function actualizarUsuario(){
        session_start();
        $Cedula = $_SESSION['Cedula'];        
        $Nombre = $_POST['Nombre'];
        $Apellido       = $_POST['Apellido'];
        $Rol     = $_POST['Rol'];
        $Email         = $_POST['Email'];
        $Password         = $_POST['Password'];
        $Estado       = $_POST['Estado'];
        $FechaRegistro = $_POST['FechaRegistro'];

        $arreglo = [
            'Cedula' => $Cedula,
            'Nombre' => $Nombre,
            'Apellido' => $Apellido,
            'Rol' => $Rol,
            'Email' => $Email,
            'Password' => $Password,
            'Estado' => $Estado,
            'FechaRegistro' => $FechaRegistro
        ];

        unset($_SESSION['Cedula']);

        if($this->model->updateUsuario($arreglo)){    
            $usuario = new Usuario();      

            $usuario->cedula = $Cedula;
            $usuario->nombre = $Nombre;
            $usuario->apellidos = $Nombre;
            $usuario->rol = $Apellidos;
            $usuario->email = $Email;
            $usuario->email = $Password;
            $usuario->estado = $Estado;
            $usuario->fechaRegistro = $FechaRegistro;
            //$usuario->Passwords = $row['Password'];
            
            $this->view->item = $usuario;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Usuario Actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Usuario no se actualizo</h1></div>';  
        }

        $this->view->render('users/lista.php');

    }    

    function eliminarUsuario($param = null){
        $idusuario = $param[0];
        //echo "Se elimina ".$idusuario;
        //version ajax
        if($this->model->deleteUsuario($idusuario)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Usuario Eliminado con el ID: '.$idusuario.'</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Usuario no se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function registrarUsuario(){
        $Cedula     = $_POST['Cedula'];        
        $Nombre     = $_POST['Nombre'];
        $Apellido   = $_POST['Apellido'];
        $Rol        = $_POST['Rol'];
        $Email      = $_POST['Email'];
        $Password   = $_POST['Password'];
        $Estado     = $_POST['Estado'];
        $FechaRegistro = $_POST['FechaRegistro'];

        $arreglo = [
            'Cedula' => $Cedula,
            'Nombre' => $Nombre,
            'Apellido' => $Apellido,
            'Rol' => $Rol,
            'Email' => $Email,
            'Password' => $Password,
            'Estado' => $Estado,
            'FechaRegistro' => $FechaRegistro
        ];
        $mensaje = "";
        //var_dump($arreglo);
        if($this->model->addUsuario($arreglo)){
            // $mensaje = "<br>";  
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Usuario Creado</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Usuario No Creado</h1></div>';  
        }

        $this->view->mensaje = $mensaje;
        $this->render();
              
    }
}
?>