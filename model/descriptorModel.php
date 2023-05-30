<?php
class DescriptorModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addDescriptor($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `descriptores`(`idProyectos`, `idDescriptor`, `descriptor`) 
            VALUES (:IdProyectos,:IdDescriptor,:Descriptor)');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateDescriptor($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `descriptores` SET `idProyectos`=:IdProyectos,
            `idDescriptor`=:IdDescriptor,`descriptor`=:Descriptor 
            WHERE `idProyectos`=:IdProyectos AND `idDescriptor`=:IdDescriptor');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteDescriptor($idp,$idd){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `descriptores` 
            WHERE `idProyectos`=:IdProyectos AND `idDescriptor`=:IdDescriptor');
            $sql->execute(['IdProyecto'=>$idp],['IdDescriptor'=>$idd]);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchCronograma($idp,$id){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `descriptores`
            WHERE `idProyectos`=:IdProyectos AND `idDescriptor`=:IdDescriptor');
            $sql->execute(['IdProyecto'=>$idp],['IdDescriptor'=>$idd]);
            
            $descip = new Descriptor();
            while($row = $sql->fetch()){

                $descrip->$idProyectos  = $row['idProyecto'];
                $descrip->$idDescripto  = $row['idDescriptor'];
                $descrip->$descriptor   = $row['descriptor'];
            }
            return $descrip;
        }catch(PDOExeption $e){
              return [];
        }
    }

    function getDescriptores(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `descriptores`');            
            while($row = $sql->fetch()){
                $crono = new Descriptor();
                $descrip->$idProyectos  = $row['idProyecto'];
                $descrip->$idDescripto  = $row['idDescriptor'];
                $descrip->$descriptor   = $row['descriptor'];
                array_push($items,$crono);
            }
            return $items;
        }catch(PDOExeption $e){
              return [];
        }
    }
}
?>