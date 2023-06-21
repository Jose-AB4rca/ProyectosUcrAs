<?php
require_once ('class/objetivoEspecifico.php');
class ObjetivosEspecificosModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addObjetivoEsp($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `objetivo_especifico`(`idProyecto`, `idObjetivoEsp`, `objetivo`) 
            VALUES (:IdProyecto,:IdObjetivoEsp,:Objetivo)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateObjetivoEsp($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `objetivo_especifico` SET `objetivo`=:Objetivo 
            WHERE `idProyecto`=:IdProyecto AND `idObjetivoEsp`=:IdObjetivoEsp');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteObjetivoEsp($idp,$idc){
        try{
            //$data = [
              //  "IdProyecto" => $idp,
                //"IdObjetivoEsp" => $idc
            //];
            $sql = $this->db->connect()->prepare('DELETE FROM `objetivo_especifico`
             WHERE `idProyecto`=:IdProyecto AND `idObjetivoEsp`=:IdObjetivoEsp');
            $sql->execute(array('IdProyecto'=>$idp,'IdObjetivoEsp'=>$idc));

            //alternativa
            //  $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchObjetivoEsp($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `objetivo_especifico`
            WHERE `idProyecto`=:IdProyecto AND `idObjetivoEsp`=:IdObjetivoEsp');
            $sql->execute(array('IdProyecto'=>$idp,'IdObjetivoEsp'=>$idc));
            $obj = new ObjetivoEspecifico();

            while($row = $sql->fetch()){
                $obj->idProyecto   = $row['idProyecto'];
                $obj->idObjetivoEsp  = $row['idObjetivoEsp'];
                $obj->objetivo  = $row['objetivo'];
            }
            return $obj;
        }catch(PDOException $e){
              return [];
        }
    }

    function getObjetivosEsp(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `objetivo_especifico`');            
            while($row = $sql->fetch()){
                $obj = new ObjetivoEspecifico();
                $obj->idProyecto   = $row['idProyecto'];
                $obj->idObjetivoEsp  = $row['idObjetivoEsp'];
                $obj->objetivo  = $row['objetivo'];
                array_push($items,$obj);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
    function getPryObjetivosEsp($param = null){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `objetivo_especifico` WHERE `idProyecto`=:IdProyecto');            
            $sql->execute(['IdProyecto'=>$param[0]]);
            $obj = new ObjetivoEspecifico();
            while($row = $sql->fetch()){
                $obj = new ObjetivoEspecifico();
                $obj->idProyecto   = $row['idProyecto'];
                $obj->idObjetivoEsp  = $row['idObjetivoEsp'];
                $obj->objetivo  = $row['objetivo'];
                array_push($items,$obj);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
}

?>