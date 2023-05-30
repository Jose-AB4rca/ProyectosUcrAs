<?php
class ObjetivoEspecificoModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addObjetivoEsp($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `objetivo_especifico`(`idProyecto`, `idObjetivoEsp`, `objetivo`) 
            VALUES (:IdProyecto,:IdObjetivoEsp,:Objetivo)');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateObjetivoEsp($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `objetivo_especifico` SET `idProyecto`=:IdProyecto,`idObjetivoEsp`=:IdObjetivoEsp,`objetivo`=:Objetivo 
            WHERE `idProyecto`=:IdProyecto AND `idObjetivoEsp`=:IdObjetivoEsp');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteObjetivoEsp($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `objetivo_especifico`
             WHERE `idProyecto`=:IdProyecto AND `idObjetivoEsp`=:IdObjetivoEsp');
            $sql->execute(['IdProyecto'=>$idp],['idObjetivoEsp'=>$idc]);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchObjetivoEsp($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `objetivo_especifico`
            WHERE `idProyecto`=:IdProyecto AND `idObjetivoEsp`=:IdObjetivoEsp');
            $sql->execute(['IdProyecto'=>$idp],['idObjetivoEsp'=>$idc]);
            $obj = new Modalidad();

            while($row = $sql->fetch()){
                $obj->idProyecto   = $row['idProyecto'];
                $obj->idObjetivo  = $row['idObjetivo'];
                $obj->objetivo  = $row['objetivo'];
            }
            return $mod;
        }catch(PDOExeption $e){
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
                $obj->idObjetivo  = $row['idObjetivo'];
                $obj->objetivo  = $row['objetivo'];
                array_push($items,$obj);
            }
            return $items;
        }catch(PDOExeption $e){
              return [];
        }
    }
}

?>