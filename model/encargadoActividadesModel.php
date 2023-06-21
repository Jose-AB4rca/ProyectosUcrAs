<?php
require_once('class/encargadoActividad.php');
class EncargadoActividadesModel extends Model{
    function __construct(){
        parent::__construct();
    }

    function addEncargadoAct($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `encargado_actividades`(`idEncargado`, `idInscripcionAc`, `cedulaEncargado`) 
            VALUES (:IdEncargado,:IdInscripcionAc,:CedulaEncargado)');
            $sql->execute($data); 
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function updateEncargadoAct($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `encargado_actividades` SET `idEncargado`=:IdEncargado,`idInscripcionAc`=:IdInscripcionAc,
            `cedulaEncargado`=:CedulaEncargado WHERE `idEncargado`=:IdEncargado AND`idInscripcionAc`=:IdInscripcionAc');
            $sql->execute($data);
            return true;
            
            }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }
    function deleteEncargadoAct($idP,$idE){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `encargado_actividades` 
             WHERE `idEncargado`=:IdEncargado AND `idInscripcionAc`=:IdInscripcionAc');
            $sql->execute(array('IdEncargado'=>$idE,'IdInscripcionAc'=>$idP));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }
    function searchEncargadoAct($idP,$idE){
        try{
            $enc = new EncargadoActividad();
            $sql = $this->db->connect()->prepare('SELECT * FROM `encargado_actividades` 
            WHERE `idEncargado`=:IdEncargado AND `idInscripcionAc`=:IdInscripcionAc');
            $sql->execute(array('IdEncargado'=>$idE,'IdInscripcionAc'=>$idP));
            while($row = $sql->fetch()){
                $enc->idEncargado        = $row['idEncargado'];
                $enc->idInscripcionAc    = $row['idInscripcionAc'];
                $enc->cedulaEncargado    = $row['cedulaEncargado'];
            }
            
            return $enc;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function getEncargadosAct($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `encargado_actividades`
            WHERE `idInscripcionAc`=:ids');
            $sql->execute(['ids'=>$id]);
            while($row = $sql->fetch()){
                $enc = new EncargadoActividad();
                $enc->idEncargado        = $row['idEncargado'];
                $enc->idInscripcionAc    = $row['idInscripcionAc'];
                $enc->cedulaEncargado    = $row['cedulaEncargado'];

                array_push($items, $enc);
            }
            return $items;
        }catch(PDOException $e){
           return [];
        }
    }

}
?>