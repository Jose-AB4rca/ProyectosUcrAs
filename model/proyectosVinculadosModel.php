<?php
include_once('class/proyectoVinculado.php');
class ProyectosVinculadosModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addProyectoVin($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `proyectos_vinculados` (`idProyectoVinculado`, `idProyecto`, `proyectoVinculado`) 
            VALUES (:IdProyectoVinculado, :IdProyecto ,:ProyectoVinculado)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateProyectoVin($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `proyectos_vinculados` SET `proyectoVinculado`=:ProyectoVinculado 
            WHERE `idProyectoVinculado`=:IdProyectoVinculado AND `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteProyectoVin($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `proyectos_vinculados`
             WHERE `idProyectoVinculado`=:IdProyectoVinculado AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdProyectoVinculado'=>$idc,'IdProyecto'=>$idp));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchProyectoVin($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `proyectos_vinculados`
            WHERE `idProyectoVinculado`=:IdProyectoVinculado AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdProyectoVinculado'=>$idc,'IdProyecto'=>$idp));
            $pgv = new ProyectoVinculado();

            while($row = $sql->fetch()){
                $pgv->idProyectoVinculado   = $row['idProyectoVinculado'];
                $pgv->idProyecto            = $row['idProyecto'];
                $pgv->proyectoVinculado     = $row['proyectoVinculado']; 
             }
            return $pgv;
        }catch(PDOException $e){
              return [];
        }
    }

    function getProyectosVin(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `proyectos_vinculados`');            
            while($row = $sql->fetch()){
                $pgv = new ProyectoVinculado();
                $pgv->idProyectoVinculado   = $row['idProyectoVinculado'];
                $pgv->idProyecto            = $row['idProyecto'];
                $pgv->proyectoVinculado     = $row['proyectoVinculado']; 
                array_push($items,$pgv);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }

    function getProyectosVinPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `proyectos_vinculados`
            WHERE `idProyecto`=:idp');     
            $sql->execute(['idp'=>$id]);       
            while($row = $sql->fetch()){
                $pgv = new ProyectoVinculado();
                $pgv->idProyectoVinculado   = $row['idProyectoVinculado'];
                $pgv->idProyecto            = $row['idProyecto'];
                $pgv->proyectoVinculado     = $row['proyectoVinculado']; 
                array_push($items,$pgv);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }

}
?>