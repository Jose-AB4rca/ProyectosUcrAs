<?php
include_once('class/programaAdsento.php');
class ProgramasAdsentosModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addProgramaAds($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `programas_adsentos` (`idProgramaAdsento`, `idProyecto`, `programaAdsento`) 
            VALUES (:IdProgramaAdsento,:IdProyecto,:ProgramaAdsento)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateProgramaAds($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `programas_adsentos` SET `programaAdsento`=:ProgramaAdsento 
            WHERE `idProgramaAdsento`=:IdProgramaAdsento AND `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteProgramaAds($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `programas_adsentos`
             WHERE `idProgramaAdsento`=:IdProgramaAdsento AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdProgramaAdsento'=>$idc,'IdProyecto'=>$idp));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchProgramaAds($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `programas_adsentos`
            WHERE `idProgramaAdsento`=:IdProgramaAdsento AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdProgramaAdsento'=>$idc,'IdProyecto'=>$idp));
            $pgr = new ProgramaAdsento();

            while($row = $sql->fetch()){
                $pgr->idProgramaAdsento = $row['idProgramaAdsento']; 
                $pgr->idProyecto        = $row['idProyecto'];        
                $pgr->programaAdsento   = $row['programaAdsento']; 
             }
            return $pgr;
        }catch(PDOException $e){
              return [];
        }
    }

    function getProgramaAdsPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `programas_adsentos`
            WHERE `idProyecto`=:idp');
            $sql->execute(['idp'=>$id]);            
            while($row = $sql->fetch()){
                $pgr = new ProgramaAdsento();
                $pgr->idProgramaAdsento = $row['idProgramaAdsento']; 
                $pgr->idProyecto        = $row['idProyecto'];        
                $pgr->programaAdsento   = $row['programaAdsento']; 
                array_push($items,$pgr);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }

    function getProgramasAds(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `programas_adsentos`');            
            while($row = $sql->fetch()){
                $pgr = new ProgramaAdsento();
                $pgr->idProgramaAdsento = $row['idProgramaAdsento']; 
                $pgr->idProyecto        = $row['idProyecto'];        
                $pgr->programaAdsento   = $row['programaAdsento']; 
                array_push($items,$pgr);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
}
?>