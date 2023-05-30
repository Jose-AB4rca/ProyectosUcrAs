<?php
class Financiamientos extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
        $this->view->list = [];
        $this->view->mensaje = "";
    }

    function render($param = null){
        $fin = $this->model->getFinanciamientos();
        $this->view->list = $fin;
        $this->view->render('financiamientos/lista.php');
    }

    function verFinanciamiento($param = null){
        //param [0] es un identificador
        $idf= $param[0];
        $idf= $param[1];
        $financia = $this->model->searchFinanciamiento($idf);

        session_start();
        $_SESSION['idf'] = $idf;

        //pasa a la view los datos
        $this->view->item = $financia;
        $this->view->mensaje = "";
        $this->view->render('financiamientos/ver.php');

    }

    function editarFinanciamiento(){
        session_start();
        $IdFinanciamiento   =$_SESSION['IdFinanciamiento'];
        $IdProyecto         =$_SESSION['IdProyecto'];
        $Tipo               =$_POST['Tipo'];  
        $Descripcion        =$_POST['Descripcion'];
        $Costo              =$_POST['Costo'];
        $TipoCosto          =$_POST['TipoCosto '];
        $JustificaFi        =$_POST['JustificaFi'];

        $arreglo = [
            'IdFinanciamiento' => $IdFinanciamiento,
            'IdProyecto'       => $IdProyecto,
            'Tipo'             => $Tipo,
            'Descripcion'      => $Descripcion,
            'Costo'            => $Costo,
            'TipoCosto'        => $TipoCosto,
            'JustificaFi'      => $JustificaFi
        ];

        unset_session($_SESSION['IdFinanciamiento'],$_SESSION['IdProyecto']);

        if($this->model->updateFinanciamiento($arreglo)){    
            $financia = new Financiamiento();      

            $financia->idFinanciamiento = $IdFinanciamiento;
            $financia->idProyecto       = $IdProyecto;
            $financia->tipo             = $Tipo;
            $financia->descripcion      = $Descripcion;
            $financia->costo            = $Costo;
            $financia->tipoCosto        = $TipoCosto;
            $financia->justificaFi      = $JustificaFi;
            
            $this->view->item = $financia;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro Actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('financiamientos/ver.php');

    }

    function borrarFinanciamiento($param = null){
      
        if($this->model->deleteFinanciamiento($param[0],$param[1])){    
             $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro eliminado</h1></div>';  
             $mensaje = "Borrado";
        }else{          
             $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>No se logro borrar</h1></div>';  
             $mensaje = "No Borrado";
        }

        echo $mensaje;
        $this->render();
    }

    function agregarFinanciamiento(){
        $IdFinanciamiento   =$_POST['IdFinanciamiento'];
        $IdProyecto         =$_POST['IdProyecto'];
        $Tipo               =$_POST['Tipo'];  
        $Descripcion        =$_POST['Descripcion'];
        $Costo              =$_POST['Costo'];
        $TipoCosto          =$_POST['TipoCosto '];
        $JustificaFi        =$_POST['JustificaFi'];

        $arreglo = [
            'IdFinanciamiento' => $IdFinanciamiento,
            'IdProyecto'       => $IdProyecto,
            'Tipo'             => $Tipo,
            'Descripcion'      => $Descripcion,
            'Costo'            => $Costo,
            'TipoCosto'        => $TipoCosto,
            'JustificaFi'      => $JustificaFi
        ];

        if($this->model->addFinanciamineto($arreglo)){
        
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro creada</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no creado</h1></div>';  
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }    
}
?>