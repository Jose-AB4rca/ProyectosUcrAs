<?php
class Encargado_Actividades extends Model{
    function __construct(){
        parent::__cosntruct();
    }

    function addEncargadoAct($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `encargado_actividades`(`idEncargado`, `idInscripcionAc`, `cedulaEncargado`) 
            VALUES (:IdEncargado,:IdInscripcionAc,:CedulaEncargado)');
            $sql->execute($data); 
            return true;
        }catch(PDOExeption $e){
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
            
            }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }
    function deleteEncargadoAct($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `encargado_actividades` 
             WHERE `idEncargado`=:IdEncargado AND `idInscripcionAc`=:IdInscripcionAc');
            $sql->execute(['IdEncargado'=>$idE],['IdInscripcionAc'=>$idP]);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }
    function searchEncargadoAct($idP,$idE){
        try{
            $ant = new EncargadoActividad();
            $sql = $this->db->connect()->prepare('SELECT * FROM `encargado_actividades` 
            WHERE `idEncargado`=:IdEncargado AND `idInscripcionAc`=:IdInscripcionAc');
            $sql->execute(['IdEncargado'=>$idE],['IdInscripcionAc'=>$idP]);
            while($row = $sql-fetch()){
                $enc->$idEncargado        = $row['idEncargado'];
                $enc->$idInscripcionAc    = $row['idInscripcionAc'];
                $enc->$cedulaEnc          = $row['cedulaEnc'];
            }
            
            return $enc;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function getEncargadosAct(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `encargado_actividades`');
            while($row = sql->fetch()){
                $enc = new EncargadoActividad();
                $enc->$idEncargado        = $row['idEncargado'];
                $enc->$idInscripcionAc    = $row['idInscripcionAc'];
                $enc->$cedulaEnc          = $row['cedulaEnc'];

                array_push($items, $enc);
            }
            return $items;
        }catch(PDOExeption $e){
           return [];
        }
    }

}
?>