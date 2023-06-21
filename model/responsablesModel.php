<?php
include_once('class/Responsables.php');
class ResponsablesModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addResponsable($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `responsables`(`idResponsable`, `idProyecto`, `responsable`) 
            VALUES (:IdResponsable,:IdProyecto,:Responsable)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateResponsable($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `responsables` SET `responsable`=:Responsable 
            WHERE `idResponsable`=:IdResponsable AND `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteResponsable($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `responsables`
             WHERE `idResponsable`=:IdResponsable AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdResponsable'=>$idc,'IdProyecto'=>$idp));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchResponsable($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `responsables`
            WHERE `idResponsable`=:IdResponsable AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdResponsable'=>$idc,'IdProyecto'=>$idp));
            $res = new Responsable();

            while($row = $sql->fetch()){
                $res->idResponsable     = $row['idResponsable'];
                $res->idProyecto        = $row['idProyecto'];
                $res->responsable       = $row['responsable'];   
             }
            return $res;
        }catch(PDOException $e){
              return [];
        }
    }

    function getResponsables(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `responsables`');            
            while($row = $sql->fetch()){
                $res = new Responsable();
                $res->idResponsable     = $row['idResponsable'];
                $res->idProyecto        = $row['idProyecto'];
                $res->responsable       = $row['responsable'];  
                array_push($items,$res);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
    function getResponsablesPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `responsables`
            WHERE `idProyecto`=:idd');  
            $sql->execute(['idd'=>$id]);          
            while($row = $sql->fetch()){
                $res = new Responsable();
                $res->idResponsable     = $row['idResponsable'];
                $res->idProyecto        = $row['idProyecto'];
                $res->responsable       = $row['responsable'];  
                array_push($items,$res);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
}
?>