<?php
class EnteExterno extends Model{
    function __construct(){
        parent::__construct();
    }

    function addEnteExterno($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `entes_externos_re`(`idProyecto`, `idEnteExterno`, `tipo`, `ente`) 
            VALUES (:IdProyecto,:IdEnteExterno,:Tipo,:Entes)');
            $sql->execute($data); 
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function updateEnteExterno($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `entes_externos_re` SET `idProyecto`=:IdProyecto,
            `idEnteExterno`=:IdEnteExterno,`tipo`=:Tipo,`ente`=:Ente 
            WHERE `idProyecto`=:IdProyecto AND `idEnteExterno`=:IdEnteExterno');
            $sql->execute($data);
            return true;
            }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }
    function deleteEnteExterno($idp,$id){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `entes_externos_re` 
            WHERE `idProyecto`=:IdProyecto AND `idEnteExterno`=:IdEnteExterno');
            $sql->execute(['IdProyecto'=>$idp],['IdEnteExterno'=>$id]);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function searchEnteExterno($idp,$id){
        try{
            $ente = new EnteExterno();
            $sql = $this->db->connect()->prepare('SELECT * FROM `entes_externos_re` 
            WHERE `idProyecto`=:IdProyecto AND `idEnteExterno`=:IdEnteExterno');
            $sql->execute(['IdProyecto'=>$idp],['IdEnteExterno'=>$id]);
            while($row = $sql-fetch()){
                $ente->idProyecto       =$row['idProyecto'];
                $ente->idEnteExterno    =$row['idEnteExterno'];
                $ente->tipo             =$row['tipo'];
                $ente->ente             =$row['ente'];
            }
            
            return $ente;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function getEntesExternos(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `entes_externos_re`');
            while($row = sql->fetch()){
                $ente = new EnteExterno();
                $ente->idProyecto       =$row['idProyecto'];
                $ente->idEnteExterno    =$row['idEnteExterno'];
                $ente->tipo             =$row['tipo'];
                $ente->ente             =$row['ente'];

                array_push($items, $ente);
            }
            return $items;
        }catch(PDOExeption $e){
           return [];
        }
    }


}

?>