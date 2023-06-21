<?php
class Proyectos extends Controller{
    function __cosntruct(){
        parent::__construct();
    }
    //--------------- metodos para redirigir a vistas  --------------------
    function render(){
        $pry = $this->model->getProyectos();
        $this->view->list = $pry;
        $this->view->render('proyectos/lista');
   }
   function registro(){
        $this->view->render('proyectos/agregar');
   }
   function loadList(){
        include('view/proyectos/loadList.php');
   }
    function lista(){
        $pry = $this->model->getProyectos();
        $this->view->list = $pry;
        $this->view->render('proyectos/lista');
    }
    function editar($param = null){
        $pry = $this->model->searchProyecto($param[0]);
        $this->view->item = $pry;
        $this->view->mensaje = "";
        $this->view->render('proyectos/editar');
    }
    function opciones($param = null){
        $pry = $this->model->searchProyecto($param[0]);
        $this->view->item = $pry;
        $this->view->mensaje = "";
        $this->view->render('proyectos/pryOptions');
    }
    function ver($param = null){
        $pry = $this->model->searchProyecto($param[0]);
        $this->view->item = $pry;
        $this->view->mensaje = "";
        $this->view->render('proyectos/ver');
    }
    //----------------- fin de metodos para vistas  -----------------------

    //----------------- metodos para transacciones de datos ---------------
   function agregarProyecto(){
        $Titulo                     = $_POST['Titulo'];
        $Descripcion                = $_POST['Descripcion'];
        $Encargado                  = $_POST['Encargado'];
        $Observaciones              = $_POST['Observaciones'];
        $Justificacion              = $_POST['Justificacion'];
        $Antecedentes               = $_POST['Antecedentes'];
        $ObjetivoGeneral            = $_POST['ObjetivoGeneral'];
        $SubActividadesSubstantivas = $_POST['SubActividadesSubstantivas'];
        $Metodologia                = $_POST['Metodologia'];
        $FechaInicio                = $_POST['FechaInicio'];
        $FechaFin                   = $_POST['FechaFin'];
        $Comentarios                = $_POST['Comentarios'];

        $arreglo = [
            'Titulo'                     => $Titulo,
            'Descripcion'                => $Descripcion,
            'Encargado'                  => $Encargado,
            'Observaciones'              => $Observaciones,
            'Justificacion'              => $Justificacion,
            'ObjetivoGeneral'            => $ObjetivoGeneral,
            'SubActividadesSubstantivas' => $SubActividadesSubstantivas,
            'Metodologia'                => $Metodologia,
            'FechaInicio'                => $FechaInicio,
            'FechaFin'                   => $FechaFin,
            'Antecedentes'               => $Antecedentes,
            'Comentarios'                => $Comentarios
        ];

        $mensaje = "";
       
        if($this->model->addProyecto($arreglo)){
             
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Proyecto creado</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Proyecto no creado</h1></div>';  
        }

        $this->view->mensaje = $mensaje;
        header("Location: http://localhost/ProyectosUcrAs/proyectos/lista");
   }

   function editarProyecto(){
    $IdProyecto                 = $_POST['IdProyecto'];
    $Titulo                     = $_POST['Titulo'];
    $Descripcion                = $_POST['Descripcion'];
    $Encargado                  = $_POST['Encargado'];
    $Observaciones              = $_POST['Observaciones'];
    $Justificacion              = $_POST['Justificacion'];
    $Antecedentes               = $_POST['Antecedentes'];
    $ObjetivoGeneral            = $_POST['ObjetivoGeneral'];
    $SubActividadesSubstantivas = $_POST['SubActividadesSubstantivas'];
    $Metodologia                = $_POST['Metodologia'];
    $FechaInicio                = $_POST['FechaInicio'];
    $FechaFin                   = $_POST['FechaFin'];
    $Comentarios                = $_POST['Comentarios'];

    $arreglo = [
        'IdProyecto'                => $IdProyecto,
        'Titulo'                    => $Titulo,
        'Descripcion'                => $Descripcion,
        'Encargado'                  => $Encargado,
        'Observaciones'              => $Observaciones,
        'Justificacion'              => $Justificacion,
        'ObjetivoGeneral'            => $ObjetivoGeneral,
        'SubActividadesSubstantivas' => $SubActividadesSubstantivas,
        'Metodologia'                => $Metodologia,
        'FechaInicio'                => $FechaInicio,
        'FechaFin'                   => $FechaFin,
        'Antecedentes'               => $Antecedentes,
        'Comentarios'                => $Comentarios
    ];

    if($this->model->updateProyecto($arreglo)){
       
        $pry = new Proyecto();
        $idProyecto                 = $IdProyecto;
        $titulo                     = $Titulo;
        $descripcion                = $Descripcion;
        $encargado                  = $Encargado;
        $observaciones              = $Observaciones;
        $justificacion              = $Justificacion;
        $antecedentes               = $Antecedentes;
        $objetivoGeneral            = $ObjetivoGeneral;
        $subActividadesSubstantivas = $SubActividadesSubstantivas;
        $metodologia                = $Metodologia;
        $fechaInicio                = $FechaInicio;
        $fechaFin                   = $FechaFin;
        $comentarios                = $Comentarios;

        $this->view->item = $pry;
        $mensaje = "Proyecto actualizado";  
    }else{
        $mensaje = "Proyecto no actualizado";  
    }
    header("Location: http://localhost/ProyectosUcrAs/proyectos/lista?mss=$mensaje");

   }

   function verProyecto($param = null){
        $pry = $this->model->searchProyecto($param[0]);
        $this->view->item = $pry;
        $this->view->mensaje = "";
        $this->view->render('proyectos/ver.php');

   }
   function eliminarProyecto($param = null){
        if($this->model->deleteProyecto($param[0])){
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Proyecto eliminado</h1></div>';  
            
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Proyecto no eliminado</h1></div>';  
        }
        $this->render();
   }

}
?>