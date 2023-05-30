<?php
class convenioModel extends Model{
    function __construct(){
        parent::__construct();
    }

    function addConvenio($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `convenios`(`idConvenio`, `idProyecto`, `convenios`) 
            VALUES (`:IdConvenio`,`:IdProyecto`,`:Convenios`)');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateConvenio($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `convenios` SET `idConvenio`=:IdConvenio,`idProyecto`=:IdProyecto,`convenios`=:Convenios 
            WHERE `idProyecto`=:IdProyecto AND `idConvenio`=:IdConvenio');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteConvenio($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `convenios` 
            WHERE `idProyecto`=:IdProyecto AND `idConvenio`=:IdConvenio');
            $sql->execute(['IdConvenio'=>$idc],['IdProyecto'=>$idp]);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchConvenio($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `convenios` 
            WHERE `idProyecto`=:IdProyecto AND `idConvenio`=:IdConvenio');
            $sql->execute(['IdConvenio'=>$idc],['IdProyecto'=>$idp]);
            
            $convenio = new Convenio();
            while($row = $sql->fetch()){
                $convenio->idConvenio  = $row['idConvenio'];
                $convenio->idProyecto  = $row['idProyecto'];
                $convenio->convenios   = $row['convenios'];
            }
        }catch(PDOExeption $e){
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
        }catch(PDOExeption $e){
              return [];
        }
    }
}

?>