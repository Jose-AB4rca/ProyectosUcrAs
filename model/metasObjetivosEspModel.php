<?php
include_once('class/metasObjetivosEspec.php');
class MetasObjetivosEspModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addMetasObjetivosEsp($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `metas_objetivos_esp`(`idMeta`, `idObjetivoEsp`, `meta`, `indicador`) 
            VALUES (:IdMeta,:IdObjetivoEsp,:Meta,:Indicador)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function updateMetasObjetivosEsp($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `metas_objetivos_esp` SET `meta`=:Meta,`indicador`=:Indicador WHERE `idMeta`=:IdMeta AND `idObjetivoEsp`=:IdObjetivoEsp');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteMetasObjetivosEsp($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `metas_objetivos_esp` 
            WHERE `idMeta`=:IdMeta AND `idObjetivoEsp`=:IdObjetivoEsp');
            $sql->execute(array('IdMeta'=>$idc,'IdObjetivoEsp'=>$idp));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchMetasObjetivosEsp($idp,$id){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `metas_objetivos_esp` 
            WHERE `idMeta`=:IdMeta AND `idObjetivoEsp`=:IdObjetivoEsp');
            $sql->execute(array('IdMeta'=>$id,'IdObjetivoEsp'=>$idp));
            
            $obj = new MetaObjetivoEsp();
            while($row = $sql->fetch()){

                $obj->idMeta          = $row['idMeta'];
                $obj->idObjetivoEsp   = $row['idObjetivoEsp'];
                $obj->meta            = $row['meta'];
                $obj->indicador       = $row['indicador'];

            }
            return $obj;
        }catch(PDOException $e){
              return [];
        }
    }

    function getMetasObjetivosEsp(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `metas_objetivos_esp`');            
            while($row = $sql->fetch()){
                $obj = new MetaObjetivoEsp();
                $obj->idMeta          = $row['idMeta'];
                $obj->idObjetivoEsp   = $row['idObjetivoEsp'];
                $obj->meta            = $row['meta'];
                $obj->indicador       = $row['indicador'];
                array_push($items,$obj);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
    function getMetasObjetivosEspPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `metas_objetivos_esp`
            WHERE `idObjetivoEsp`=:Id');
            $sql->execute(['Id'=>$id]);            
            while($row = $sql->fetch()){
                $obj = new MetaObjetivoEsp();
                $obj->idMeta          = $row['idMeta'];
                $obj->idObjetivoEsp   = $row['idObjetivoEsp'];
                $obj->meta            = $row['meta'];
                $obj->indicador       = $row['indicador'];
                array_push($items,$obj);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
}
?>