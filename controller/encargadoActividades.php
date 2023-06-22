<?php
class EncargadoActividades extends Controller{
    function __construct(){
        parent::__construct();      //constructor de libs/controller

    }
    //metodos para psar datos a las vistar y luego cargarlas
    function listaEspecifica($param = null){
        $conv = $this->model->getEncargadosAct($param[0]);
        $this->view->list = $conv;
        $this->view->render('encargadoActividades/lista');
    }
    function agregar($param = null){
        $obs = $param[0];
        $this->view->id = $obs;
        $this->view->render('encargadoActividades/agregar');
    }

    function editarEncargadoAct(){
        $IdEncargado        =$_POST['IdEncargado'];
        $IdInscripcionAc    =$_POST['IdInscripcionAc'];
        $CedulaEncargado    =$_POST['CedulaEncargado'];


        $arreglo = [
            'IdEncargado'     => $IdEncargado,
            'IdInscripcionAc' => $IdInscripcionAc,
            'CedulaEncargado' => $CedulaEncargado
        ];
 
        if($this->model->updateEncargadoAct($arreglo)){    
            $enc = new EncargadoActividad();      

            $enc->idEncargado     = $IdEncargado;
            $enc->idInscripcionAc    = $IdInscripcionAc;
            $enc->cedulaEncargado      = $CedulaEncargado;
            
            $this->view->item = $enc;
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Registro Actualizado</h1></div>';  
        }else{          
            $this->view->mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Registro no se actualizo</h1></div>';  
        }

        $this->view->render('encargadoActividades/lista.php');

    }

    function borrarEncargadoAct($param = null){
        $par = explode(',',$param[0]);
        $sum = count($par);
        $val = $sum -2;
        $valOb = $sum -1;
        $idp = $par[$val];
        $ido = $par[$valOb];
      
        if($this->model->deleteEncargadoAct($idp,$ido)){    
            $mjs = "Borrado";  
            header("Location: http://localhost/ProyectosUcrAs/encargadoActividades/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }else{          
            $mjs = "No Borrado";   
            header("Location: http://localhost/ProyectosUcrAs/encargadoActividades/listaEspecifica/".$idp."?ms=$mjs"); 
            exit();  
        }
    }

    function agregarEncargadoAct(){
        $IdEncargado        =$_POST['IdEncargado'];
        $IdInscripcionAc    =$_POST['IdInscripcionAc'];
        $CedulaEncargado    =$_POST['CedulaEncargado'];


        $arreglo = [
            'IdEncargado'     => $IdEncargado,
            'IdInscripcionAc' => $IdInscripcionAc,
            'CedulaEncargado'      => $CedulaEncargado
        ];

        if($this->model->addEncargadoAct($arreglo)){
            $mjs = "Creado";  
            header("Location: http://localhost/ProyectosUcrAs/encargadoActividades/listaEspecifica/".$IdInscripcionAc."?ms=$mjs"); 
            exit();  
        }else{
            $mjs = "No creado";  
            header("Location: http://localhost/ProyectosUcrAs/encargadoActividades/listaEspecifica/".$IdInscripcionAc."?ms=$mjs"); 
            exit();  
        }
    }   

}
?>