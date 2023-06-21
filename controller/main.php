<?php

class Main extends Controller{

    function __construct(){
        parent::__construct();        
    }

    function render(){  
        $pry = $this->model->getProyectos();
        $this->view->list = $pry;
        $this->view->render('main/index');       
    }
}

?>