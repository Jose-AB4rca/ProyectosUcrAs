<?php
require_once('class/descriptor.php');

class descriptoresModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addDescriptor($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `descriptores`(`idProyectos`, `idDescriptor`, `descriptor`) 
            VALUES (:IdProyecto,:IdDescriptor,:Descriptor)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateDescriptor($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `descriptores` SET `descriptor`=:Descriptor 
            WHERE `idProyectos`=:IdProyectos AND `idDescriptor`=:IdDescriptor');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteDescriptor($idp,$idd){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `descriptores` 
            WHERE `idProyectos`=:IdProyectos AND `idDescriptor`=:IdDescriptor');
            $sql->execute(array('IdProyecto'=>$idp,'IdDescriptor'=>$idd));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchDescriptor($idp,$id){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `descriptores`
            WHERE `idProyectos`=:IdProyectos AND `idDescriptor`=:IdDescriptor');
            $sql->execute(array('IdProyectos'=>$idp,'IdDescriptor'=>$id));
            
            $descrip = new Descriptor();
            while($row = $sql->fetch()){

                $descrip->idProyectos  = $row['idProyectos'];
                $descrip->idDescriptor  = $row['idDescriptor'];
                $descrip->descriptor   = $row['descriptor'];
            }
            return $descrip;
        }catch(PDOException $e){
              return [];
        }
    }
    function getDescriptoresPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `descriptores`
            WHERE `idProyectos`=:IdProyecto');   
            $sql->execute(['IdProyecto'=>$id]);         
            while($row = $sql->fetch()){
                $descrip = new Descriptor();
                $descrip->idProyectos  = $row['idProyectos'];
                $descrip->idDescriptor  = $row['idDescriptor'];
                $descrip->descriptor   = $row['descriptor'];
                array_push($items,$descrip);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }

    function getDescriptores(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `descriptores`');            
            while($row = $sql->fetch()){
                $descrip = new Descriptor();
                $descrip->idProyectos  = $row['idProyecto'];
                $descrip->idDescripto  = $row['idDescriptor'];
                $descrip->descriptor   = $row['descriptor'];
                array_push($items,$descrip);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
}
?>