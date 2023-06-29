<?php
require_once('class/anotacion.php');
class anotacionesModel extends Model{
    function __construct(){
        parent::__construct();
    }

    function addAnotacion($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `anotaciones` (`idAnotacion`,`idProyecto`,`fecha`,`documento`,`anotacion`,`cedulaUsuario`) 
            VALUES (:IdAnotacion,:IdProyecto,:Fecha,:Documento,:Anotacion,:CedulaUsuario)');
            $sql->execute($data); 
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function updateAnotacion($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `anotaciones` SET `documento`=:Documento,
            `anotacion`=:Anotacion,`cedulaUsuario`=:CedulaUsuario WHERE `idAnotacion`=:IdAnotacion and `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
            
            }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }
    function deleteAnotacion($id,$anotacion){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `anotaciones` 
            WHERE idAnotacion=:IdAnotacion and idProyecto=:IdProyecto');
            $sql->execute(array('IdAnotacion'=>$anotacion,'IdProyecto'=>$id));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function searchAnotacion($id,$anotacion){
        try{
            $ant = new Anotacion();
            $sql = $this->db->connect()->prepare('SELECT * FROM `anotaciones` 
            WHERE idAnotacion=:IdAnotacion and idProyecto=:IdProyecto');
            $sql->execute(array('IdAnotacion'=>$anotacion,'IdProyecto'=>$id));

            while($row = $sql->fetch()){
                $ant->idAnotacion   = $row['idAnotacion'];
                $ant->idProyecto    = $row['idProyecto'];
                $ant->documento     = $row['documento'];
                $ant->anotacion     = $row['anotacion'];
                $ant->cedulaUsuario = $row['cedulaUsuario'];
            }
            
            return $ant;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function getAnotaciones(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `anotaciones`');
            while($row = $sql->fetch()){
                $ant = new Anotacion();
                $ant->idAnotacion   = $row['idAnotacion'];
                $ant->idProyecto    = $row['idProyecto'];
                $ant->documento     = $row['documento'];
                $ant->anotacion     = $row['anotacion'];
                $ant->cedulaUsuario = $row['cedulaUsuario'];

                array_push($items, $ant);
            }
            return $items;
        }catch(PDOException $e){
           return [];
        }
    }

    function getAnotacionesProyecto($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `anotaciones`WHERE `idProyecto` = :Id');
            $sql->execute(['Id'=>$id]);
            while($row = $sql->fetch()){
                $ant = new Anotacion();
                $ant->idAnotacion   = $row['idAnotacion'];
                $ant->idProyecto    = $row['idProyecto'];
                $ant->documento     = $row['documento'];
                $ant->anotacion     = $row['anotacion'];
                $ant->cedulaUsuario = $row['cedulaUsuario'];

                array_push($items, $ant);
            }
            return $items;
        }catch(PDOException $e){
           return [];
        }
    }

}
?>