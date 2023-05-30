<?php
class InscripciónActividadModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addInscripcionAc($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `inscripcion_actividad`(`idInscripcionAc`, `idProyecto`, `objetivo`, `poblacionBeneficiada`, `cantPoblacion`, `facilitadores`, `duracionHoras`, `cuentaFinanciamientoExt`, `numeroSesion`) 
            VALUES (:IdInscripcionAc,:IdProyecto,:Objetivo,:PoblacionBeneficiada,:CantPoblacion,:Facilitadores,:DuracionHoras,:CuentaFinanciamientoExt,:NumeroSesion)');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateInscripcionAc($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `inscripcion_actividad` SET `idInscripcionAc`=:IdInscripcionAc,`idProyecto`=:IdProyecto,
            `objetivo`=:Objetivo,`poblacionBeneficiada`=:PoblacionBeneficiada,`cantPoblacion`=:CantPoblacion,`facilitadores`=:Facilitadores,
            `duracionHoras`=:DuracionHoras,`cuentaFinanciamientoExt`=:CuentaFinanciamientoExt,`numeroSesion`=:NumeroSesion 
            WHERE `idInscripcionAc`=:IdInscripcionAc AND `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteInscripcionAc($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `inscripcion_actividad` 
            WHERE `idInscripcionAc`=:IdInscripcionAc AND `idProyecto`=:IdProyecto');
            $sql->execute(['IdInscripcionAc'=>$idc],['IdProyecto'=>$idp]);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchInscripcionAc($idp,$id){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `inscripcion_actividad` 
            WHERE `idInscripcionAc`=:IdInscripcionAc AND `idProyecto`=:IdProyecto');
            $sql->execute(['IdInscripcionAc'=>$idc],['IdProyecto'=>$idp]);
            
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
        }catch(PDOExeption $e){
              return [];
        }
    }

    function getInscripciones(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `inscripcion_actividad`');            
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
        }catch(PDOExeption $e){
              return [];
        }
    }
}
?>