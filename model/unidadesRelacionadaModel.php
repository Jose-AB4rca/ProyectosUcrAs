<?php
include_once('class/unidadRelacionada.php');
class UnidadesRelacionadaModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addUnidadRe($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `unidades_relacionadas`(`idUnidadR`, `idProyecto`, `unidad`, `base`) 
            VALUES (:IdUnidadR,:IdProyecto,:Unidad,:Base)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateUnidadRe($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `unidades_relacionadas` SET `unidad`=:Unidad,`base`=:Base 
            WHERE `idUnidadR`=:IdUnidadR AND `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteUnidadRe($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `unidades_relacionadas`
             WHERE `idUnidadR`=:IdUnidadR AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdProyecto'=>$idp,'IdUnidadR'=>$idc));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchUnidadRe($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `unidades_relacionadas`
            WHERE `idUnidadR`=:IdUnidadR AND `idProyecto`=:IdProyecto');
           $sql->execute(array('IdProyecto'=>$idp,'IdUnidadR'=>$idc));
            $Unidad = new UnidadRelacionada();

            while($row = $sql->fetch()){
                $Unidad->idUnidadR  = $row['idUnidadR'];
                $Unidad->idProyecto = $row['idProyecto'];
                $Unidad->unidad     = $row['unidad'];
                $Unidad->base       = $row['base'];
             }
            return $Unidad;
        }catch(PDOException $e){
              return [];
        }
    }

    function getUnidadesRe(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `unidades_relacionadas`');            
            while($row = $sql->fetch()){
                $Unidad = new UnidadRelacionada();
                $Unidad->idUnidadR  = $row['idUnidadR'];
                $Unidad->idProyecto = $row['idProyecto'];
                $Unidad->unidad     = $row['unidad'];
                $Unidad->base       = $row['base'];
                array_push($items,$Unidad);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
    function getUnidadesRePr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `unidades_relacionadas`
            WHERE `idProyecto`=:idd');
            $sql->execute(['idd'=>$id]);            
            while($row = $sql->fetch()){
                $Unidad = new UnidadRelacionada();
                $Unidad->idUnidadR  = $row['idUnidadR'];
                $Unidad->idProyecto = $row['idProyecto'];
                $Unidad->unidad     = $row['unidad'];
                $Unidad->base       = $row['base'];
                array_push($items,$Unidad);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }

}
?>