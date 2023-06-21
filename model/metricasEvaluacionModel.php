<?php
include_once('class/metricaEvaluacion.php');
class MetricasEvaluacionModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addMetricaEvaluacion($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `metrica_evaluacion`(`idMetrica`, `idProyecto`, `evaluacionProyeecto`, `evaluacionImpacto`, `evaluacionParticipante`) 
            VALUES (:IdMetrica,:IdProyecto,:EvaluacionProyeecto,:EvaluacionImpacto,:EvaluacionParticipante)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateMetricaEvaluacion($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `metrica_evaluacion` SET `evaluacionProyeecto`=:EvaluacionProyeecto,
            `evaluacionImpacto`=:EvaluacionImpacto,`evaluacionParticipante`=:EvaluacionParticipante 
            WHERE `idMetrica`=:IdMetrica AND`idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteMetricaEvaluacion($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `metrica_evaluacion` 
            WHERE `idMetrica`=:IdMetrica AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdMetrica'=>$idc,'IdProyecto'=>$idp));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchMetricaEvaluacion($idp,$id){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `metrica_evaluacion` 
            WHERE `idMetrica`=:IdMetrica AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdMetrica'=>$id,'IdProyecto'=>$idp));
            
            $met = new MetricaEvaluacion();
            while($row = $sql->fetch()){

                $met->idMetrica               = $row['idMetrica'];
                $met->idProyecto              = $row['idProyecto'];
                $met->evaluacionProyecto     = $row['evaluacionProyeecto'];
                $met->evaluacionImpacto       = $row['evaluacionImpacto'];
                $met->evaluacionParticipante  = $row['evaluacionParticipante'];
            }
            return $met;
        }catch(PDOException $e){
              return [];
        }
    }
    function getMetricaEvaluacionPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `metrica_evaluacion`
            WHERE `idProyecto`=:IdProyecto');   
            $sql->execute(['IdProyecto'=>$id]);         
            while($row = $sql->fetch()){
                $met = new MetricaEvaluacion();
                $met->idMetrica               = $row['idMetrica'];
                $met->idProyecto              = $row['idProyecto'];
                $met->evaluacionProyecto     = $row['evaluacionProyeecto'];
                $met->evaluacionImpacto       = $row['evaluacionImpacto'];
                $met->evaluacionParticipante  = $row['evaluacionParticipante'];

                array_push($items,$met);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }

    function getMetricaEvaluacion(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `metrica_evaluacion`');            
            while($row = $sql->fetch()){
                $met = new MetricaEvaluacion();
                $met->idMetrica               = $row['idMetrica'];
                $met->idProyecto              = $row['idProyecto'];
                $met->evaluacionProyecto     = $row['evaluacionProyeecto'];
                $met->evaluacionImpacto       = $row['evaluacionImpacto'];
                $met->evaluacionParticipante  = $row['evaluacionParticipante'];

                array_push($items,$met);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
}
?>