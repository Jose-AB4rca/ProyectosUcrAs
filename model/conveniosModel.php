<?php
require_once('class/convenio.php');
class conveniosModel extends Model{
    function __construct(){
        parent::__construct();
    }

    function addConvenio($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `convenios`(`idConvenio`, `idProyecto`, `convenios`) 
            VALUES (:IdConvenio,:IdProyecto,:Convenios)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateConvenio($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `convenios` SET `convenios`=:Convenios 
            WHERE `idProyecto`=:IdProyecto AND `idConvenio`=:IdConvenio');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteConvenio($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `convenios` 
            WHERE `idProyecto`=:IdProyecto AND `idConvenio`=:IdConvenio');
            $sql->execute(array('IdConvenio'=>$idc,'IdProyecto'=>$idp));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchConvenio($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `convenios` 
            WHERE `idProyecto`=:IdProyecto AND `idConvenio`=:IdConvenio');
            $sql->execute(array('IdConvenio'=>$idc,'IdProyecto'=>$idp));
            
            $convenio = new Convenio();
            while($row = $sql->fetch()){
                $convenio->idConvenio  = $row['idConvenio'];
                $convenio->idProyecto  = $row['idProyecto'];
                $convenio->convenios   = $row['convenios'];
            }
            return $convenio;
        }catch(PDOException $e){
              return [];
        }
    }

    function getConvenios(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `convenios`');            
            while($row = $sql->fetch()){
                $convenio = new Convenio();
                $convenio->idConvenio  = $row['idConvenio'];
                $convenio->idProyecto  = $row['idProyecto'];
                $convenio->convenios   = $row['convenios'];

                array_push($items,$convenio);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
    function getConveniosPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `convenios`
            WHERE `idProyecto`=:IdProyecto');   
            $sql->execute(['IdProyecto'=>$id]);         
            while($row = $sql->fetch()){
                $convenio = new Convenio();
                $convenio->idConvenio  = $row['idConvenio'];
                $convenio->idProyecto  = $row['idProyecto'];
                $convenio->convenios   = $row['convenios'];

                array_push($items,$convenio);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
}

?>