<?php
class Controller{
    public $view;
    public $model;
    // Esta clase carga el modelo 
    // Y transmite la referencia de libs/View via __construc
    public function __construct()
    {
        $this->view = new View();
    }

    function loadModel($objeto){
        $ruta = 'model/'.$objeto.'Model.php';
        // ruta del objetoModelo solicitado

        if(file_exists($ruta)){
            require $ruta;  //traer script

            $modelName = $objeto.'Model';  //construye el nombre el modelo

            $this->model = new $modelName();
        }   


    }
}

?>