<?php
class Financiamientos extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller
    }

    function render($param = null){
        $fin = $this->model->getFinanciamientos();
        $this->view->list = $fin;
        $this->view->render('financiamientos/lista.php');
    }
    function listaEspecifica($param = null){
        $conv = $this->model->getfinanciamientosPr($param[0]);
        $this->view->list = $conv;
        $this->view->render('financiamientos/lista');
    }
    function editar($param = null){
        $obs = $this->model->searchFinanciamiento($param[0],$_GET['idc']);
        $this->view->item = $obs;
        $this->view->render('financiamientos/editar');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('financiamientos/agregar');
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

        if($this->model->updateFinanciamiento($arreglo)){    
            $financia = new Financiamiento();      

            $financia->idFinanciamiento = $IdFinanciamiento;
            $financia->idProyecto       = $IdProyecto;
            $financia->tipo             = $Tipo;
            $financia->descripcion      = $Descripcion;
            $financia->costo            = $Costo;
            $financia->tipoCosto        = $TipoCosto;
            $financia->justificaFi      = $JustificaFi;
            
            $mjs = "Actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/financiamientos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No cambiado";  
            header("Location: http://localhost/ProyectosUcrAs/financiamientos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }

    function borrarFinanciamiento($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
        if($this->model->deleteFinanciamiento($idp,$ido)){    
            $mjs = "Actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/financiamientos/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "Actualizado";  
            header("Location: http://localhost/ProyectosUcrAs/financiamientos/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }
    }

    function agregarFinanciamiento(){
        $IdFinanciamiento   =$_POST['IdFinanciamiento'];
        $IdProyecto         =$_POST['IdProyecto'];
        $Tipo               =$_POST['Tipo'];  
        $Descripcion        =$_POST['Descripcion'];
        $Costo              =$_POST['Costo'];
        $TipoCosto          =$_POST['TipoCosto'];
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

        if($this->model->addFinanciamiento($arreglo)){
        
            $mjs = "Agregado";  
            header("Location: http://localhost/ProyectosUcrAs/financiamientos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/financiamientos/listaEspecifica/".$IdProyecto."?ms=$mjs"); 
            exit();  
        }
    }    
}
?>