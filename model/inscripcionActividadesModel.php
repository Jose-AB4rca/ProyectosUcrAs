<?php
require_once('class/inscripcionActividad.php');
class InscripcionActividadesModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addInscripcionAc($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `inscripcion_actividad`(`idInscripcionAc`, `idProyecto`, `objetivo`, `poblacionBeneficiada`, `cantPoblacion`, `facilitadores`, `duracionHoras`, `cuentaFinanciamientoExt`, `numeroSesion`) 
            VALUES (:idInscripcionAc,:IdProyecto,:Objetivo,:PoblacionBeneficiada,:CantPoblacion,:Facilitadores,:DuracionHoras,:CuentaFinanciamientoExt,:NumeroSesion)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateInscripcionAc($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `inscripcion_actividad` SET
            `objetivo`=:Objetivo,`poblacionBeneficiada`=:PoblacionBeneficiada,`cantPoblacion`=:CantPoblacion,`facilitadores`=:Facilitadores,
            `duracionHoras`=:DuracionHoras,`cuentaFinanciamientoExt`=:CuentaFinanciamientoExt,`numeroSesion`=:NumeroSesion 
            WHERE `idInscripcionAc`=:idInscripcionAc AND `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteInscripcionAc($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `inscripcion_actividad` 
            WHERE `idInscripcionAc`=:IdInscripcionAc AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdInscripcionAc'=>$idc,'IdProyecto'=>$idp));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchInscripcionAc($idp,$id){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `inscripcion_actividad` 
            WHERE `idInscripcionAc`=:IdInscripcionAc AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdInscripcionAc'=>$id,'IdProyecto'=>$idp));
            
            $ins = new InscripcionActividad();
            while($row = $sql->fetch()){

                $ins->idInscripcionAc           = $row['idInscripcionAc'];
                $ins->idProyecto                = $row['idProyecto'];
                $ins->objetivo                  = $row['objetivo'];
                $ins->poblacionBeneficiada      = $row['poblacionBeneficiada'];
                $ins->cantPoblacion             = $row['cantPoblacion'];
                $ins->facilitadores             = $row['facilitadores'];
                $ins->duracionHoras             = $row['duracionHoras'];
                $ins->cuentaFinanciamientoExt   = $row['cuentaFinanciamientoExt'];
                $ins->numeroSesion              = $row['numeroSesion'];

            }
            return $ins;
        }catch(PDOException $e){
              return [];
        }
    }

    function getInscripcionesAcPr($idp){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `inscripcion_actividad`
            WHERE `idProyecto`=:IdProyecto');
            $sql->execute(['IdProyecto'=>$idp]);
                     
            while($row = $sql->fetch()){
                $ins = new InscripcionActividad();
                $ins->idInscripcionAc           = $row['idInscripcionAc'];
                $ins->idProyecto                = $row['idProyecto'];
                $ins->objetivo                  = $row['objetivo'];
                $ins->poblacionBeneficiada      = $row['poblacionBeneficiada'];
                $ins->cantPoblacion             = $row['cantPoblacion'];
                $ins->facilitadores             = $row['facilitadores'];
                $ins->duracionHoras             = $row['duracionHoras'];
                $ins->cuentaFinanciamientoExt   = $row['cuentaFinanciamientoExt'];
                $ins->numeroSesion              = $row['numeroSesion'];
                array_push($items,$ins);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }
}
?>