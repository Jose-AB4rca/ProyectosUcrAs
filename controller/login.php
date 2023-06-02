<?php
class Login extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        $this->view->render('login/index');    
    }

    function autenticar(){
        $arreglo = [
            'Email'=>$_POST['Email'],
            'Password'=>$_POST['Password']
        ];

        $user = $this->model->AuthUser($arreglo);
        if(isset($user->cedula)){
             session_start();
             $_SESSION['cedula'] = $user->cedula;
             $_SESSION['NameUser'] = $user->nombre;
             $_SESSION['acceso'] = true;
             header("Location: http://localhost/ProyectosUcrAs/");
             exit();
             //$this->view->render('main/index');
          }else{
             $_SESSION['acceso'] = false;
             session_destroy();
             header("Location: http://localhost/ProyectosUcrAs/login");
             exit();
             //$this->view->render('login/index');
          }         


    }
    function desconectar(){
        session_start();
        $_SESSION['acceso'] = false;
        $_SESSION['cedula'] = null;
        $_SESSION['NameUser'] = null;
        session_destroy();
        header("Location: http://localhost/ProyectosUcrAs/");

    }

}
?>