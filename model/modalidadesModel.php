<?php
class ModalidadesModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addModalidad($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `modalidades`(`idModalidad`, `idProyecto`, `descripcion`) 
            VALUES (:IdModalidad,:IdProyecto,:Descripcion)');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateModalidad($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `modalidades` SET `descripcion`=:Descripcion
             WHERE `idModalidad`=:IdModalidad AND `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteModalidad($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `modalidades`
             WHERE `idModalidad`=:IdModalidad AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdModalidad'=>$idc,'IdProyecto'=>$idp));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchModalidad($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `modalidades`
            WHERE `idModalidad`=:IdModalidad AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdModalidad'=>$idc,'IdProyecto'=>$idp));
            $mod = new Modalidad();

            while($row = $sql->fetch()){
                $mod->idModalidad  = $row['idModalidad'];
                $mod->idProyecto   = $row['idProyecto'];
                $mod->descripcion  = $row['descripcion'];
            }
            return $mod;
        }catch(PDOException $e){
              return [];
        }
    }

    function getModalidadesPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `modalidades`
            WHERE `idProyecto`=:idp');
            $sql->bindParam('idp',$id,PDO::PARAM_INT);
            $sql->execute();            
            while($row = $sql->fetch()){
                $mod = new Modalidad();
                $mod->idModalidad  = $row['idModalidad'];
                $mod->idProyecto   = $row['idProyecto'];
                $mod->descripcion  = $row['descripcion'];
                array_push($items,$mod);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }

    function getModalidades(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `modalidades`');            
            while($row = $sql->fetch()){
                $mod = new Modalidad();
                $mod->idModalidad  = $row['idModalidad'];
                $mod->idProyecto   = $row['idProyecto'];
                $mod->descripcion  = $row['descripcion'];
                array_push($items,$mod);
            }
            return $items;
        }catch(PDOException $e){
              return [];
        }
    }

}
?>