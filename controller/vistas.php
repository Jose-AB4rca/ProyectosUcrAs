<?php

class Vistas extends Controller{

    function __construct(){
        parent::__construct();        
    }

    function render(){     
        $this->view->render('vistas/index');       
    }
     function proyectos(){
        $this->view->render('vistas/pryOptions');
     }
     

}

?>