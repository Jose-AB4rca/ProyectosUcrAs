<?php
class areaImpactoModel extends Model{
    function __construct(){
        parent::__construct();
    }

    function addAreaImpacto($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `area_impacto`(`idArea`, `idImpacto`, `area`) 
            VALUES (`:IdArea`,`:IdImpacto`,`:Area`)');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteAreaImpacto($id,$impacto){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `area_impacto` 
            WHERE `idArea`=:IdArea AND `idImpacto`=:IdImpacto');
            $sql->execute(['IdArea'=>$id],['IdImpacto'=>$impacto]);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateAreaImpacto($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `area_impacto` SET `idArea`=:IdArea,`idImpacto`=:IdImpacto,`area`=:Area 
            WHERE `idArea`=:IdArea AND `idImpacto`=:IdImpacto');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function searchAreaImpacto($id,$impacto){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `area_impacto` 
            WHERE `idArea`=:IdArea AND `idImpacto`=:IdImpacto');
            $sql->execute(['IdArea'=>$id],['IdImpacto'=>$impacto]);

            $area = new AreaImpacto();
            while($row = $sql->fetch()){
                $area->idArea    = $row['idArea'];
                $area->idImpacto = $row['idImpacto'];
                $area->area      = $row['area'];
            }
            return $area;
        }catch(PDOExeption $e){
              return [];
        }
    }   
    
    function getAreaImpacto(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare();            
            while($row = sql->fetch()){
                $area = new AreaImpacto();

                $area->idArea    = $row['idArea'];
                $area->idImpacto = $row['idImpacto'];
                $area->area      = $row['area'];

                array_push($items,$area);
            }
            return $items;
        }catch(PDOExeption $e){
              return [];
        }
    }
}
?>