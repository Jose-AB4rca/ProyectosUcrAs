<?php
class ProgramaAdsentoModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addProgramaAds($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `programas_adsentos`(`idProgramaAdsento`, `idProyecto`, `programaAdsento`) 
            VALUES (:IdProgramaAdsento,:IdProyecto,:ProgramaAdsento)');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateProgramaAds($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `programas_adsentos` SET `idProgramaAdsento`=:IdProgramaAdsento,`idProyecto`=:IdProyecto,`programaAdsento`=:ProgramaAdsento 
            WHERE `idProgramaAdsento`=:IdProgramaAdsento AND`idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteProgramaAds($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `programas_adsentos`
             WHERE `idProgramaAdsento`=:IdProgramaAdsento AND`idProyecto`=:IdProyecto');
            $sql->execute(['idProgramaAdsento'=>$idc],['IdProyecto'=>$idp]);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchProgramaAds($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `programas_adsentos`
            WHERE `idProgramaAdsento`=:IdProgramaAdsento AND`idProyecto`=:IdProyecto');
            $sql->execute(['idProgramaAdsento'=>$idc],['IdProyecto'=>$idp]);
            $pgr = new ProgramaAdsento();

            while($row = $sql->fetch()){
                $pgr->idProgramaAdsento = $row['idProgramaAdsento']; 
                $pgr->idProyecto        = $row['idProyecto'];        
                $pgr->programaAdsento   = $row['programaAdsento']; 
             }
            return $pgr;
        }catch(PDOExeption $e){
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
        }catch(PDOExeption $e){
              return [];
        }
    }
}
?>