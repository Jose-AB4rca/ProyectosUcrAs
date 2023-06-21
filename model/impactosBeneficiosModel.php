<?php
include_once('class/impactoBeneficio.php');
class ImpactosBeneficiosModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addImpactoB($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `impactos_y_beneficios`(`idImpacto`, `idProyecto`, `cantPoblacion`, `poblacion`, `beneficioUcr`, `beneficioPoblacion`) 
            VALUES (:IdImpacto,:IdProyecto,:CantPoblacion,:Poblacion,:BeneficioUcr,:BeneficioPoblacion)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateImpactoB($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `impactos_y_beneficios` SET `cantPoblacion`=:CantPoblacion,`poblacion`=:Poblacion,`beneficioUcr`=:BeneficioUcr,`beneficioPoblacion`=:BeneficioPoblacion 
            WHERE `idImpacto`=:IdImpacto AND `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteImpactoB($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `impactos_y_beneficios` 
            WHERE `idImpacto`=:IdImpacto AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdImpacto'=>$idc,'IdProyecto'=>$idp));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchImpactoB($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `impactos_y_beneficios` 
            WHERE `idImpacto`=:IdImpacto AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdImpacto'=>$idc,'IdProyecto'=>$idp));
            
            $imp = new ImpactoBeneficio();
            while($row = $sql->fetch()){

                $imp->idImpacto            = $row['idImpacto'];
                $imp->idProyecto           = $row['idProyecto'];
                $imp->cantPoblacion        = $row['cantPoblacion'];
                $imp->poblacion            = $row['poblacion'];   
                $imp->beneficioUcr         = $row['beneficioUcr'];
                $imp->beneficioPoblacion   = $row['beneficioPoblacion'];

            }
            return $imp;
        }catch(PDOException $e){
              return [];
        }
    }

    function getImpactosBPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `impactos_y_beneficios`
            WHERE `idProyecto`=:IdProyecto');
            $sql->execute(['IdProyecto'=>$id]);            
            while($row = $sql->fetch()){
                $imp = new ImpactoBeneficio();
                $imp->idImpacto            = $row['idImpacto'];
                $imp->idProyecto           = $row['idProyecto'];
                $imp->cantPoblacion        = $row['cantPoblacion'];
                $imp->poblacion            = $row['poblacion'];   
                $imp->beneficioUcr         = $row['beneficioUcr'];
                $imp->beneficioPoblacion   = $row['beneficioPoblacion'];

                array_push($items,$imp);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
}
?>