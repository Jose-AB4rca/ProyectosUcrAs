<?php
class Disciplinas extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }
    //metodos para cargar y pasar los datos a las vistas.
    function render($param = null){
        $dsp = $this->model->getDisciplinas();
        $this->view->list = $dsp;
        $this->view->render('disciplinas/lista.php');
    }
    function listaEspecifica($param = null){
        $conv = $this->model->getDisciplinasPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('disciplinas/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchDisciplina($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('disciplinas/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('disciplinas/agregar');
    }

    function verDisciplina($param = null){
        //param [0] es un identificador
        $id= $param[0];
        $idb= $param[1];
        $dis = $this->model->searchDisciplina($id,$idb);

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['idb'] = $idb;

        //pasa a la view los datos
        $this->view->item = $dis;
        $this->view->mensaje = "";
        $this->view->render('disciplinas/ver.php');

    }

    function editarDisciplina(){
        $IdDisciplina   = $_POST['IdDisciplina'];
        $IdProyecto     = $_POST['IdProyecto'];
        $Disciplina     = $_POST['Disciplina'];


        $arreglo = [
            'IdDisciplina'    => $IdDisciplina,
            'IdProyecto'      => $IdProyecto,
            'Disciplina'      => $Disciplina
        ];
 
        if($this->model->updateDisciplina($arreglo)){    
            $dis = new Disciplina();      
            $dis->idDisciplina     = $IdProyecto;
            $dis->idProyecto     = $IdProyecto;
            $dis->disciplina      = $Disciplina;
            
            $mjs = "Editado";  
            header("Location: http://localhost/ProyectosUcrAs/disciplinas/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No editado";  
            header("Location: http://localhost/ProyectosUcrAs/disciplinas/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }

    function borrarDisciplina($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
      
      
        if($this->model->deleteDisciplina($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/disciplinas/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No borrado";  
            header("Location: http://localhost/ProyectosUcrAs/disciplinas/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }
    }

    function agregarDisciplina(){
        $IdDisciplina   = $_POST['IdDisciplina'];
        $IdProyecto     = $_POST['IdProyecto'];
        $Disciplina     = $_POST['Disciplina'];


        $arreglo = [
            'IdDisciplina'    => $IdDisciplina,
            'IdProyecto'      => $IdProyecto,
            'Disciplina'      => $Disciplina
        ];

        if($this->model->addDisciplina($arreglo)){
            $mjs = "Agregado";  
            header("Location: http://localhost/ProyectosUcrAs/disciplinas/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No añadido";  
            header("Location: http://localhost/ProyectosUcrAs/disciplinas/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }

    }   

    
}
?>