<?php

class App {

    function __construct(){

       $url = isset($_GET['url']) ? $_GET['url']: null;
               // if ( vacio) verdadero usa geturl,  sino es null
       $url = rtrim((string) $url, '/');

       $url = explode('/', $url);

        // paginas/admin/create/
        // 0 admin/ 1 create/

        if(empty($url[0])){
            $archivoController = 'controller/login.php';
            require_once $archivoController;
            $controller = new Login();
            $controller->loadModel('login');
            $controller->render();
            return false;
        }

        $archivoController = 'controller/'.$url[0].'.php';


        if(file_exists($archivoController)){
            require_once $archivoController;
              
            $controller = new $url[0];   
            $controller->loadModel($url[0]);
            // paginas/admin/create/
    
            $nparam = sizeof($url);     

            if($nparam > 1){
                if($nparam > 2){
                    $param = [];
                    for($i = 2; $i < $nparam; $i++){
                        array_push($param, $url[$i]);
                    }
                    // paginas/admin/create/
                    // 0 admin/ 1 create/                    
                    $controller->{$url[1]}($param);
                }else{
                    $controller->{$url[1]}();
                }
            }else{
                $controller->render();
            }

        }
        else{
            require_once 'controller/error.php';
            $controller = new Errores();
        }

    }

}


?>