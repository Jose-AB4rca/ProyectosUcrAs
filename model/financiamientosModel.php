<?php
include_once('class/financiamiento.php');
class FinanciamientosModel extends Model{
    function __construct(){
        parent::__construct();
    }

    function addFinanciamiento($data){
        try{
            $sql = $this->db->connect()->prepare('INSERT INTO `financiamiento` (`idFinanciamiento`, `idProyecto`, `tipo`, `descripcion`, `costo`, `tipoCosto`, `justificaFi`) 
            VALUES (:IdFinanciamiento,:IdProyecto,:Tipo,:Descripcion,:Costo,:TipoCosto,:JustificaFi)');
            $sql->execute($data); 
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function updateFinanciamiento($data){
        try{
            $sql = $this->db->connect()->prepare('UPDATE `financiamiento` SET `tipo`=:Tipo,`descripcion`=:Descripcion,`costo`=:Costo,`tipoCosto`=:TipoCosto,`justificaFi`=:JustificaFi
            WHERE `idFinanciamiento`=:IdFinanciamiento AND `idProyecto`=:IdProyecto');
            $sql->execute($data);
            return true;
            }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }
    function deleteFinanciamiento($idp,$id){
        try{
            $sql = $this->db->connect()->prepare('DELETE FROM `financiamiento`
            WHERE `idFinanciamiento`=:IdFinanciamiento AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdFinanciamiento'=>$id,'IdProyecto'=>$idp));
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function searchFinanciamiento($idp,$id){
        try{
            $financia = new Financiamiento();
            $sql = $this->db->connect()->prepare('SELECT * FROM `financiamiento` 
            WHERE `idFinanciamiento`=:IdFinanciamiento AND `idProyecto`=:IdProyecto');
            $sql->execute(array('IdFinanciamiento'=>$id,'IdProyecto'=>$idp));
            while($row = $sql->fetch()){
                $financia->idFinanciamiento     =$row['idFinanciamiento'];
                $financia->idProyecto           =$row['idProyecto'];
                $financia->tipo                 =$row['tipo'];
                $financia->descripcion          =$row['descripcion'];
                $financia->costo                =$row['costo'];
                $financia->tipoCosto            =$row['tipoCosto'];
                $financia->justificaFi          =$row['justificaFi'];
            }
            
            return $financia;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
              return false;
        }
    }
    function getFinanciamientos(){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `financiamiento`');
            while($row = $sql->fetch()){
                $financia = new Financiamiento();
                $financia->idFinanciamiento     =$row['idFinanciamiento'];
                $financia->idProyecto           =$row['idProyecto'];
                $financia->tipo                 =$row['tipo'];
                $financia->descripcion          =$row['descripcion'];
                $financia->costo                =$row['costo'];
                $financia->tipoCosto            =$row['tipoCosto'];
                $financia->justificaFi          =$row['justificaFi'];

                array_push($items, $financia);
            }
            return $items;
        }catch(PDOException $e){
           return [];
        }
    }
    function getFinanciamientosPr($id){
        $items = [];
        try{
            $sql = $this->db->connect()->prepare('SELECT * FROM `financiamiento`
            WHERE `idProyecto` =:IdProyecto');
            $sql->execute(['IdProyecto'=>$id]);
            while($row = $sql->fetch()){
                $financia = new Financiamiento();
                $financia->idFinanciamiento     =$row['idFinanciamiento'];
                $financia->idProyecto           =$row['idProyecto'];
                $financia->tipo                 =$row['tipo'];
                $financia->descripcion          =$row['descripcion'];
                $financia->costo                =$row['costo'];
                $financia->tipoCosto            =$row['tipoCosto'];
                $financia->justificaFi          =$row['justificaFi'];

                array_push($items, $financia);
            }
            return $items;
        }catch(PDOException $e){
           return [];
        }
    }

}

?>