<?php
class Usuarios extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
    }

    //metodos para cargar las vistas
    function render(){
       $userlist = $this->model->listUser();
       $this->view->list = $userlist;
       $this->view->render('users/lista');
    }
    function registro(){
        $this->view->render('users/agregar');
    }
    function editar($param = null){
        $Us = $this->model->searchUser($param[0]);
        $this->view->item = $Us;
        $this->view->render('users/editar');
    }
    function lista(){
        $this->view->list = $this->model->listUser();
        $this->view->render('users/lista');
    }
    //fin de metodos para cargar las vistas

    //metodos para transacciones de datos con la BD
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
    //1 usuario
    function actualizarUsuario(){
        $Cedula = $_POST['Cedula'];        
        $Nombre = $_POST['Nombre'];
        $Apellido       = $_POST['Apellidos'];
        $Rol     = $_POST['Rol'];
        $Email         = $_POST['Email'];
        $Password         = $_POST['Password'];
        $Estado       = $_POST['Estado'];

        $arreglo = [
            'Cedula' => $Cedula,
            'Nombre' => $Nombre,
            'Apellido' => $Apellido,
            'Rol' => $Rol,
            'Email' => $Email,
            'Password' => $Password,
            'Estado' => $Estado
        ];
        if($this->model->updateUser($arreglo)){    
            $usuario = new Usuario();      

            $usuario->cedula = $Cedula;
            $usuario->nombre = $Nombre;
            $usuario->apellidos = $Apellido;
            $usuario->rol = $Rol;
            $usuario->email = $Email;
            $usuario->password = $Password;
            $usuario->estado = $Estado;

            
            
            $this->view->item = $usuario;

            $this->view->mensaje = '<div class="center bg-primary text-white rounded"><p>Usuario Actualizado, inicia sesión para refescar tus datos</p></div>';  
        }else{          
            $this->view->mensaje = '<div class="center bg-danger text-white rounded"><p>Usuario no se actualizó</p></div>';  
        }

        $this->view->render('users/editar');
        

    }  

    function eliminarUsuario($param = null){
        $idusuario = $param[0];
  
        if($this->model->deleteUser($idusuario)){    
             $mensaje = "Borrado";
        }else{          
             $mensaje = "No borrado";
        }
        $this->view->mensaje = $mensaje;
        header("Location: http://localhost/ProyectosUcrAs/usuarios/lista");
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
            header("Location: http://localhost/ProyectosUcrAs?ms=$mjs");
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