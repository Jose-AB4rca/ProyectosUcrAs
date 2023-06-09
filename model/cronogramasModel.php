<?php
include_once('class/cronograma.php');
class CronogramasModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addCronograma($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `cronograma`(`idCronograma`, `idProyecto`, `tipo`, `actividad`, `fechaInicio`, `fechaFin`, `descripcion`) 
            VALUES (:IdCronograma,:IdProyecto,:Tipo,:Actividad,:FechaInicio,:FechaFin,:Descripcion)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateCronograma($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `cronograma` SET `tipo`=:Tipo,
            `actividad`=:Actividad,`fechaInicio`=:FechaInicio,`fechaFin`=:FechaFin,`descripcion`=:Descripcion 
            WHERE `idCronograma`=:IdCronograma AND `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteCronograma($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `cronograma`
            WHERE `idCronograma`=:IdCronograma AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdCronograma'=>$idc,'IdProyecto'=>$idp));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchCronograma($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `cronograma`
            WHERE `idCronograma`=:IdCronograma AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdCronograma'=>$idc,'IdProyecto'=>$idp));
            
            $crono = new Cronograma();
            while($row = $sql->fetch()){
                $crono->idCronograma   = $row['idCronograma']; 
                $crono->idProyecto     = $row['idProyecto']; 
                $crono->tipo           = $row['tipo']; 
                $crono->actividad      = $row['actividad']; 
                $crono->fechaInicio    = $row['fechaInicio']; 
                $crono->fechaFin       = $row['fechaFin']; 
                $crono->descripcion    = $row['descripcion']; 
            }
            return $crono;
        }catch(PDOException $e){
              return [];
        }
    }

    function getCronogramas(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `cronograma`');            
            while($row = $sql->fetch()){
                $crono = new Cronograma();
                $crono->idCronograma   = $row['idCronograma']; 
                $crono->idProyecto     = $row['idProyecto']; 
                $crono->tipo           = $row['tipo']; 
                $crono->actividad      = $row['actividad']; 
                $crono->fechaInicio    = $row['fechaInicio']; 
                $crono->fechaFin       = $row['fechaFin']; 
                $crono->descripcion    = $row['descripcion']; 
                array_push($items,$crono);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
    function getCronogramasPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `cronograma`
            WHERE `idProyecto`=:IdProyecto'); 
            $sql->execute(['IdProyecto' => $id]);          
            while($row = $sql->fetch()){
                $crono = new Cronograma();
                $crono->idCronograma   = $row['idCronograma']; 
                $crono->idProyecto     = $row['idProyecto']; 
                $crono->tipo           = $row['tipo']; 
                $crono->actividad      = $row['actividad']; 
                $crono->fechaInicio    = $row['fechaInicio']; 
                $crono->fechaFin       = $row['fechaFin']; 
                $crono->descripcion    = $row['descripcion']; 
                array_push($items,$crono);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
}
?>