<?php
class Disciplinas extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render($param = null){
        $dsp = $this->model->getDisciplinas();
        $this->view->list = $dsp;
        $this->view->render('disciplinas/lista.php');
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
        session_start();
        $IdDisciplina   = $_SESSION['IdDisciplina'];
        $IdProyecto     = $_SESSION['IdProyecto '];
        $Disciplina     = $_POST['Disciplina'];


        $arreglo = [
            'IdDisciplina'    => $IdDisciplina,
            'IdProyecto'      => $IdProyecto,
            'Disciplina'      => $Disciplina
        ];
 
        unset_session($_SESSION['IdProyecto'],$_SESSION['IdDisciplina']);

        if($this->model->updateDisciplina($arreglo)){    
            $dis = new Disciplina();      
            $dis->idDisciplina     = $IdProyecto;
            $dis->idProyecto     = $IdProyecto;
            $dis->disciplina      = $Disciplina;
            
            $this->view->item = $dis;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro Actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('disciplina/ver.php');

    }

    function borrarDisciplina($param = null){
        $idp = $param[0];
        $idc = $param[1];
      
        if($this->model->deleteDisciplina($idp,$idc)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarDisciplina(){
        $IdDisciplina   = $_POST['IdDisciplina'];
        $IdProyecto     = $_POST['IdProyecto '];
        $Disciplina     = $_POST['Disciplina'];


        $arreglo = [
            'IdDisciplina'    => $IdDisciplina,
            'IdProyecto'      => $IdProyecto,
            'Disciplina'      => $Disciplina
        ];

        if($this->model->addDisciplina($arreglo)){
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }   

    
}
?>