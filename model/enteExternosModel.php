<?php
include_once('class/enteExterno.php');
class EnteExternosModel extends Model{
    function __construct(){
        parent::__construct();
    }

    function addEnteExterno($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `entes_externos_re`(`idProyecto`, `idEnteExterno`, `tipo`, `ente`) 
            VALUES (:IdProyecto,:IdEnteExterno,:Tipo,:Ente)');
            $sql->execute($data); 
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function updateEnteExterno($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `entes_externos_re` SET `tipo`=:Tipo,`ente`=:Ente 
            WHERE `idProyecto`=:IdProyecto AND `idEnteExterno`=:IdEnteExterno');
            $sql->execute($data);
            return true;
            }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }
    function deleteEnteExterno($idp,$id){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `entes_externos_re` 
            WHERE `idProyecto`=:IdProyecto AND `idEnteExterno`=:IdEnteExterno');
            $sql->execute(array('IdProyecto'=>$idp,'IdEnteExterno'=>$id));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function searchEnteExterno($idp,$id){
        try{
            $ente = new EnteExterno();
            $sql = $this->db->connect()->prepare('SELECT * FROM `entes_externos_re` 
            WHERE `idProyecto`=:IdProyecto AND `idEnteExterno`=:IdEnteExterno');
            $sql->execute(array('IdProyecto'=>$idp,'IdEnteExterno'=>$id));
            while($row = $sql->fetch()){
                $ente->idProyecto       =$row['idProyecto'];
                $ente->idEnteExterno    =$row['idEnteExterno'];
                $ente->tipo             =$row['tipo'];
                $ente->ente             =$row['ente'];
            }
            
            return $ente;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function getEntesExternos(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `entes_externos_re`');
            while($row = $sql->fetch()){
                $ente = new EnteExterno();
                $ente->idProyecto       =$row['idProyecto'];
                $ente->idEnteExterno    =$row['idEnteExterno'];
                $ente->tipo             =$row['tipo'];
                $ente->ente             =$row['ente'];

                array_push($items, $ente);
            }
            return $items;
        }catch(PDOException $e){
           return [];
        }
    }
    function getEntesExternosPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `entes_externos_re`
            WHERE `idProyecto` =:IdProyecto');
            $sql->execute(['IdProyecto'=>$id]);
            while($row = $sql->fetch()){
                $ente = new EnteExterno();
                $ente->idProyecto       =$row['idProyecto'];
                $ente->idEnteExterno    =$row['idEnteExterno'];
                $ente->tipo             =$row['tipo'];
                $ente->ente             =$row['ente'];

                array_push($items, $ente);
            }
            return $items;
        }catch(PDOException $e){
           return [];
        }
    }
}
?>