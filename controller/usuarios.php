<?php
class Usuarios extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
    }

    function render(){
       $userlist = $this->model->listUser();
       $this->view->list = $userlist;
       $this->view->render('main/index');
    }
    //carga la vista del registro
    function registro(){
        $this->view->render('users/agregar');
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
        $Apellidos   = $_POST['Apellidos'];
        $Rol        = $_POST['Rol'];
        $Email      = $_POST['Email'];
        $Password   = $_POST['Password'];
        $Estado     = $_POST['Estado'];
        //fecha registro auto generada en la BD

        $arreglo = [
            'Cedula' => $Cedula,
            'Nombre' => $Nombre,
            'Apellidos' => $Apellidos,
            'Rol' => $Rol,
            'Email' => $Email,
            'Password' => $Password,
            'Estado' => $Estado,
        ];
        if($this->model->addUser($arreglo)){
            $mjs = "Usuario Creado";  
            $this->view->mensaje = $mjs;
            header("Location: http://localhost/ProyectosUcrAs/");
        }else{
            $mjs = "Usuario No Creado";
            $this->view->mensaje = $mjs;
            $this->registro();
            //header("Location: http://localhost/ProyectosUcrAs/usuarios/registro");  
        }
        exit();
              
    }
}
?>