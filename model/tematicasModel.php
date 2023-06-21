<?php
include_once('class/tematica.php');
class TematicasModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addTematica($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `tematica`(`idTematica`, `idProyecto`, `descripcion`) 
            VALUES (:IdTematica,:IdProyecto,:Descripcion)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateTematica($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `tematica` SET `descripcion`=:Descripcion 
            WHERE `idTematica`=:IdTematica AND `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteTematica($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `tematica`
             WHERE `idTematica`=:IdTematica AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdTematica'=>$idc,'IdProyecto'=>$idp));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchTematica($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `tematica`
            WHERE `idTematica`=:IdTematica AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdTematica'=>$idc,'IdProyecto'=>$idp));
            $tem = new Tematica();

            while($row = $sql->fetch()){
                $tem->idTematica        = $row['idTematica']; 
                $tem->idProyecto        = $row['idProyecto'];        
                $tem->descripcion       = $row['descripcion']; 
             }
            return $tem;
        }catch(PDOException $e){
              return [];
        }
    }

    function getTematicasPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `tematica`
            WHERE `idProyecto`=:idd');  
            $sql->execute(['idd'=>$id]);          
            while($row = $sql->fetch()){
                $tem = new Tematica();
                $tem->idTematica        = $row['idTematica']; 
                $tem->idProyecto        = $row['idProyecto'];        
                $tem->descripcion       = $row['descripcion']; 
                array_push($items,$tem);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }

    function getTematicas(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `tematica`');            
            while($row = $sql->fetch()){
                $tem = new Tematica();
                $tem->idTematica        = $row['idTematica']; 
                $tem->idProyecto        = $row['idProyecto'];        
                $tem->descripcion       = $row['descripcion']; 
                array_push($items,$tem);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
}
?>