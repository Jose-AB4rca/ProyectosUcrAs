<?php
class UnidadRelacionadaModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addUnidadRe($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `unidades_relacionadas`(`idUnidadR`, `idProyecto`, `unidad`, `base`) 
            VALUES (:IdUnidadR,:IdProyecto,:Unidad,:Base)');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateUnidadRe($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `unidades_relacionadas` SET `idUnidadR`=:IdUnidadR,`idProyecto`=:IdProyecto,`unidad`=:Unidad,`base`=:Base 
            WHERE idUnidadR`=:IdUnidadR` AND idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteUnidadRe($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `unidades_relacionadas`
             WHERE idUnidadR`=:IdUnidadR` AND idProyecto`=:IdProyecto');
            $sql->execute(['IdProyecto'=>$idp],['IdUnidadR'=>$idc]);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchUnidadRe($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `unidades_relacionadas`
            WHERE idUnidadR`=:IdUnidadR` AND idProyecto`=:IdProyecto');
           $sql->execute(['IdProyecto'=>$idp],['IdUnidadR'=>$idc]);
            $Unidad = new UnidadRelacionada();

            while($row = $sql->fetch()){
                $Unidad->idUnidadR  = $row['idUnidadR'];
                $Unidad->idProyecto = $row['idProyecto'];
                $Unidad->unidad     = $row['unidad'];
                $Unidad->base       = $row['base'];
             }
            return $Unidad;
        }catch(PDOExeption $e){
              return [];
        }
    }

    function getUnidadesRe(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `uunidades_relacionadas`');            
            while($row = $sql->fetch()){
                $Unidad = new UnidadRelacionda();
                $Unidad->idUnidadR  = $row['idUnidadR'];
                $Unidad->idProyecto = $row['idProyecto'];
                $Unidad->unidad     = $row['unidad'];
                $Unidad->base       = $row['base'];
                array_push($items,$Unidad);
            }
            return $items;
        }catch(PDOExeption $e){
              return [];
        }
    }

}
?>