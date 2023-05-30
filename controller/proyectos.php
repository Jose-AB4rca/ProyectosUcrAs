<?php
class Proyectos extends Controller{
    function __cosntruct(){
        parent::__construct();
    }

    function render(){
        $pry = $this->model->getProyectos();
        $this->view->list = $pry;
        $this->view->render('proyectos/lista.php');
   }

   function agregarProyecto(){
        $IdProyecto                 = $_POST['IdProyecto'];
        $Descripcion                = $_POST['Descripcion'];
        $Encargado                  = $_POST['Encargado'];
        $Observaciones              = $_POST['Observaciones'];
        $Justificacion              = $_POST['Justificacion'];
        $Antecedentes               = $_POST['Antecedentes'];
        $ObjetivoGeneral            = $_POST['ObjetivoGeneral'];
        $SubActividadesSubstantivas = $_POST['SubActividadesSubstantivas'];
        $Metologia                  = $_POST['Metologia'];
        $FechaInicio                = $_POST['FechaInicio'];
        $FechaFin                   = $_POST['FechaFin'];
        $FechaRegistro              = $_POST['FechaRegistro'];
        $Comentarios                = $_POST['Comentarios'];

        $arreglo = [
            'IdProyecto'                 => $IdProyecto,
            'Descripcion'                => $Descripcion,
            'Encargado'                  => $Encargado,
            'Observaciones'              => $Observaciones,
            'Justificacion'              => $Justificacion,
            'Antecedentes'               => $Antecedentes,
            'ObjetivoGeneral'            => $ObjetivoGeneral,
            'SubActividadesSubstantivas' => $SubActividadesSubstantivas,
            'Metologia'                  => $Metologia,
            'FechaInicio'                => $FechaInicio,
            'FechaFin'                   => $FechaFin,
            'FechaRegistro'              => $FechaRegistro,
            'Comentarios'                => $Comentarios
        ];

        $mensaje = "";
       
        if($this->model->addProyecto($arreglo)){
             
            $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Proyecto creado</h1></div>';  
        }else{
            $mensaje = '<div class="center mt-4 p-1 bg-danger text-white rounded"><h1>Proyecto no creado</h1></div>';  
        }

        $this->view->mensaje = $mensaje;
        $this->render();
   }

   function editarProyecto(){
    session_start();
    $IdProyecto                 = $_SESSION['IdProyecto'];
    $Descripcion                = $_POST['Descripcion'];
    $Encargado                  = $_POST['Encargado'];
    $Observaciones              = $_POST['Observaciones'];
    $Justificacion              = $_POST['Justificacion'];
    $Antecedentes               = $_POST['Antecedentes'];
    $ObjetivoGeneral            = $_POST['ObjetivoGeneral'];
    $SubActividadesSubstantivas = $_POST['SubActividadesSubstantivas'];
    $Metologia                  = $_POST['Metologia'];
    $FechaInicio                = $_POST['FechaInicio'];
    $FechaFin                   = $_POST['FechaFin'];
    $FechaRegistro              = $_POST['FechaRegistro'];
    $Comentarios                = $_POST['Comentarios'];

    $arreglo = [
        'IdProyecto'                 => $IdProyecto,
        'Descripcion'                => $Descripcion,
        'Encargado'                  => $Encargado,
        'Observaciones'              => $Observaciones,
        'Justificacion'              => $Justificacion,
        'Antecedentes'               => $Antecedentes,
        'ObjetivoGeneral'            => $ObjetivoGeneral,
        'SubActividadesSubstantivas' => $SubActividadesSubstantivas,
        'Metologia'                  => $Metologia,
        'FechaInicio'                => $FechaInicio,
        'FechaFin'                   => $FechaFin,
        'FechaRegistro'              => $FechaRegistro,
        'Comentarios'                => $Comentarios
    ];
    unset_session($_SESSION['IdProyecto']);

    if($this->modelo->updateProyecto($arreglo)){
       
        $pry = new Proyecto();
        $idProyecto                 = $IdProyecto;
        $descripcion                = $Descripcion;
        $encargado                  = $Encargado;
        $observaciones              = $Observaciones;
        $justificacion              = $Justificacion;
        $antecedentes               = $Antecedentes;
        $objetivoGeneral            = $ObjetivoGeneral;
        $subActividadesSubstantivas = $SubActividadesSubstantivas;
        $metologia                  = $Metologia;
        $fechaInicio                = $FechaInicio;
        $fechaFin                   = $FechaFin;
        $fechaRegistro              = $FechaRegistro;
        $comentarios                = $Comentarios;

        $this->view->item = $pry;
        $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Proyecto actualizado</h1></div>';  
    }else{
        $mensaje = '<div class="center mt-4 p-1 bg-primary text-white rounded"><h1>Proyecto no actualizado</h1></div>';  
    }
    $this->view->render('proyectos/ver.php');

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