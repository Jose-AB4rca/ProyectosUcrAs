<?php
class Anotaciones extends Controller{
    function __construct(){
        parent::__construct(); //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    //lista de objetos
    function render($param = null){
        $anotaciones = $this->model->getAnotaciones();
        $this->view->list = $anotaciones;
        $this->view->render('anotaciones/lista.php');
    }
    //ver un objeto especifico
    function verAnotacion($param = null){
        //la posicion [0] es un identificador
        $idAn= $param[0];
        $idAnB= $param[1];
        $annotacion = $this->model->searchAnotacion($idAnt,$idAntB);

        //session_start();
        //$_SESSION['idAn'] = $idAn;

        //pasa a la view los datos
        $this->view->item = $annotacion;
        $this->view->mensaje = "";
        $this->view->render('anotaciones/ver.php');

    }

    function editarAnotacion(){
        session_start();
        $IdAnotacion   = $_SESSION['IdAnotacion'];
        $IdProyecto    = $_SESSION['IdProyecto'];
        $Documento     = $_POST['Documento'];
        $Anotacion     = $_POST['Anotacion'];
        $CedulaUsuario = $_POST['CedulaUsuario'];

        $arreglo = [
            'IdAnotacion' => $IdAnotacion,
            'IdProyecto' => $IdProyecto,
            'Documento' => $Documento,
            'Anotacion' => $Anotacion,
            'CedulaUsuario' => $CedulaUsuario
        ];

        unset_session($_SESSION['idAnotacion'],$_SESSION['idProyecto']);

        if($this->model->updateAnotacion($arreglo)){    
            $ant = new Anotacion();      

            $ant->idAnotacion   = $IdAnotacion;
            $ant->idProyecto    = $IdProyecto;
            $ant->documento     = $Documento;
            $ant->anotacion     = $Anotacion;
            $ant->cedulaUsuario = $$CedulaUsuario;
            
            $this->view->item = $ant;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Anotación actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Anotación no actualizada</h1></div>';  
        }

        $this->view->render('anotaciones/ver.php');

    }

    function borrarAnotacion($param = null){
        $idAnt = $param[0];
        $idAntB = $param[1];
      
        if($this->model->deleteAnotacion($idAnt,$idAntB)){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Anotación eliminada con ID: '.$idAntB.'</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Anotación no se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarAnotacion(){
        $IdAnotacion   = $_SESSION['IdAnotacion'];
        $IdProyecto    = $_SESSION['IdProyecto'];
        $Documento     = $_POST['Documento'];
        $Anotacion     = $_POST['Anotacion'];
        $CedulaUsuario = $_POST['CedulaUsuario'];

        $arreglo = [
            'IdAnotacion' => $IdAnotacion,
            'IdProyecto' => $IdProyecto,
            'Documento' => $Documento,
            'Anotacion' => $Anotacion,
            'CedulaUsuario' => $CedulaUsuario
        ];

        if($this->model->addAnotacion($arreglo)){
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Anotación creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Anotación no Creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }    


}
?>
