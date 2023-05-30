<?php
require_once('class/rol.php');
class RolModel extends Model{
    function __construct(){
        parent::__construct();
    }

    function getRoles(){
        $roles = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `rol`');

            while($row = $sql->fetch()){
                $rol = new Rol();
                $rol->idRol = $row['idRol'];
                $rol->tipoRol = $row['tipoRol'];

                array_push($roles,$rol);
            }
            return $roles; 
        }catch(PDOExeption $e){
            return [];
        }
    }

    function addRol($data){
        try{
            $sql = $this->db->connect()-prepare('INSERT INTO `rol` VALUES (`idRol`,`tipoRol`) VALUES (`:IdRol`,`:TipoRol`)');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateRol($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `rol` SET (`idRol`=:IdRol,`tipoRol`=:TipoRol)
            WHERE `idRol`=:IdRol');
            $sql->execute($data);
            return true;

        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function searchRol($id){
        try{
            $rol = new Rol();
            $sql = $this->db->connect()->prepare('SELECT * FROM `rol` WHERE `idRol`=:IdRol');
            $sql->execute(['IdRol'=>$id]);
            while($row = $sql->fetch()){
                $rol->idRol = $row['idRol'];
                $rol->tipoRol = $row['tipoRol'];
            }
            return $rol;

        }catch(PDOExeption $e){
            return [];
        }
    }

    function deleteRol($id){
        try{
            $sql = $this->db->connect()->prepare('DELETE * FROM `rol` WHERE `idRol`=:IdRol');
            $query->execute(['idRol'=>$id]);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

}
?>