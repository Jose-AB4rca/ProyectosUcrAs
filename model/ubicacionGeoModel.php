<?php
class UbicacionGeoModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function addUbicacionGeo($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `ubicacion_geografica`(`idUbicacionGeo`, `idProyecto`, `region`, `provincia`, `canton`, `distrito`, `descripcion`) 
            VALUES (:IdUbicacionGeo,:IdProyecto,:Region,:Provincia,:Canton,:Distrito,:Descripcion)');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }

    function updateUbicacionGeo($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `ubicacion_geografica` SET `idUbicacionGeo`=:IdUbicacionGeo,`idProyecto`=:IdProyecto,`region`=:Region,`provincia`=:Provincia,`canton`=:Canton,`distrito`=:Distrito,`descripcion`=:Descripcion 
            WHERE `idUbicacionGeo`=:IdUbicacionGeo AND `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function deleteUbicacionGeo($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `ubicacion_geografica`
             WHERE `idUbicacionGeo`=:IdUbicacionGeo AND `idProyecto`=:IdProyecto');
            $sql->execute(['IdProyecto'=>$idp],['IdUbicacionGeo'=>$idc]);
            return true;
        }catch(PDOExeption $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }

    function searchUbicacionGeo($idp,$idc){
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `ubicacion_geografica`
            WHERE `idUbicacionGeo`=:IdUbicacionGeo AND `idProyecto`=:IdProyecto');
           $sql->execute(['IdProyecto'=>$idp],['IdUbicacionGeo'=>$idc]);
            $ubicacion = new UbicacionGeografica();

            while($row = $sql->fetch()){
                $ubicacion->idUbicacionGeo  = $row['idUbicacionGeo'];
                $ubicacion->idProyecto      = $row['idProyecto'];
                $ubicacion->region          = $row['region'];
                $ubicacion->provincia       = $row['provincia'];
                $ubicacion->canton          = $row['canton'];
                $ubicacion->distrito        = $row['distrito'];
                $ubicacion->descripcion     = $row['descripcion'];
             }
            return $ubicacion;
        }catch(PDOExeption $e){
              return [];
        }
    }

    function getTematicas(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `ubicacion_geografica`');            
            while($row = $sql->fetch()){
                $ubicacion = new UbicacionGeografica();
                $ubicacion->idUbicacionGeo  = $row['idUbicacionGeo'];
                $ubicacion->idProyecto      = $row['idProyecto'];
                $ubicacion->region          = $row['region'];
                $ubicacion->provincia       = $row['provincia'];
                $ubicacion->canton          = $row['canton'];
                $ubicacion->distrito        = $row['distrito'];
                $ubicacion->descripcion     = $row['descripcion'];
                array_push($items,$ubicacion);
            }
            return $items;
        }catch(PDOExeption $e){
              return [];
        }
    }

}
?>