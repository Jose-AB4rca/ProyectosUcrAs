<?php
include_once('class/recurso.php');
class RecursosModel extends Model{

    function __construct(){
        parent::__construct();
    }
    function addRecurso($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `recursos`(`idRecurso`, `idProyecto`, `recurso`) 
            VALUES (:IdRecurso,:IdProyecto,:Recurso)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateRecurso($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `recursos` SET `recurso`=:Recurso 
            WHERE `idRecurso`=:IdRecurso AND `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteRecurso($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `recursos` 
            WHERE `idRecurso`=:IdRecurso AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdRecurso'=>$idc,'IdProyecto'=>$idp));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchRecurso($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `recursos` 
            WHERE `idRecurso`=:IdRecurso AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdRecurso'=>$idc,'IdProyecto'=>$idp));
            $re = new Recurso();

            while($row = $sql->fetch()){
                $re->idRecurso         = $row['idRecurso']; 
                $re->idProyecto        = $row['idProyecto'];        
                $re->recurso           = $row['recurso']; 
             }
            return $re;
        }catch(PDOException $e){
              return [];
        }
    }

    
    function getRecursosPr($i){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `recursos`
            WHERE `idProyecto`=:id');   
            $sql->execute(['id'=>$i]);         
            while($row = $sql->fetch()){
                $re = new Recurso();
                $re->idRecurso         = $row['idRecurso']; 
                $re->idProyecto        = $row['idProyecto'];        
                $re->recurso           = $row['recurso']; 
                array_push($items,$re);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }


    function getRecursos(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `recursos`');            
            while($row = $sql->fetch()){
                $re = new Recurso();
                $re->idRecurso         = $row['dRecurso']; 
                $re->idProyecto        = $row['idProyecto'];        
                $re->recurso           = $row['recurso']; 
                array_push($items,$re);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
}

?>