<?php

class App {

    function __construct(){

       $url = isset($_GET['url']) ? $_GET['url']: null;
               // trae link, si está vacio entonces es null
       $url = rtrim((string) $url, '/');

       $url = explode('/', $url);
        //separador del link

        if(empty($url[0])){
            $archivoController = 'controller/main.php';
            require_once $archivoController;
            $controller = new Main();
            $controller->loadModel('main');
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
                 
                    $controller->{$url[1]}($param);
                }else{
                    $controller->{$url[1]}();
                }
            }else{
                $controller->render();
            }

        }
        else{
            require_once 'controller/errores.php';
            $controller = new Errores();
        }

    }

}


?>