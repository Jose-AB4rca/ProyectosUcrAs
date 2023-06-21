<?php
include_once('class/AreaImpacto.php');
class areasImpactoModel extends Model{
    function __construct(){
        parent::__construct();
    }

    function addAreaImpacto($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `area_impacto` (`idArea`, `idImpacto`, `area`) 
            VALUES (:IdArea,:IdImpacto,:Area)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteAreaImpacto($impacto,$id){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `area_impacto` 
            WHERE `idArea`=:IdArea AND `idImpacto`=:IdImpacto');
            $sql->execute(array('IdArea'=>$id,'IdImpacto'=>$impacto));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function updateAreaImpacto($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `area_impacto` SET `area`=:Area 
            WHERE `idArea`=:IdArea AND `idImpacto`=:IdImpacto');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function searchAreaImpacto($id,$impacto){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `area_impacto` 
            WHERE `idArea`=:IdArea AND `idImpacto`=:IdImpacto');
            $sql->execute(array('IdArea'=>$id,'IdImpacto'=>$impacto));

            $area = new AreaImpacto();
            while($row = $sql->fetch()){
                $area->idArea    = $row['idArea'];
                $area->idImpacto = $row['idImpacto'];
                $area->area      = $row['area'];
            }
            return $area;
        }catch(PDOException $e){
              return [];
        }
    }   
    
    function getAreaImpacto(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `area_impacto`');            
            while($row = $sql->fetch()){
                $area = new AreaImpacto();

                $area->idArea    = $row['idArea'];
                $area->idImpacto = $row['idImpacto'];
                $area->area      = $row['area'];

                array_push($items,$area);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }

    function getAreaImpactoPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `area_impacto`
            WHERE `idImpacto`=:idd');       
            $sql->execute(['idd'=>$id]);     
            while($row = $sql->fetch()){
                $area = new AreaImpacto();

                $area->idArea    = $row['idArea'];
                $area->idImpacto = $row['idImpacto'];
                $area->area      = $row['area'];

                array_push($items,$area);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
}
?>