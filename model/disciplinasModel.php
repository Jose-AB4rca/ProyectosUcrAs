<?php
    include_once('class/disciplina.php');
    class DisciplinasModel extends Model{
        function __construct(){
            parent::__construct();
        }
        function addDisciplina($data){
            try{
                $sql = $this->db->connect()->prepare('INSERT INTO `disciplinas`(`idDisciplina`, `idProyecto`, `disciplina`) 
                VALUES (:IdDisciplina,:IdProyecto,:Disciplina)');
                $sql->execute($data);
                return true;
            }catch(PDOException $e){
                print_r('Error connection: ' . $e->getMessage());
                  return false;
            }
        }
        function updateDisciplina($data){
            try{
                $sql = $this->db->connect()->prepare('UPDATE `disciplinas` SET
                `disciplina`=:Disciplina WHERE `idDisciplina` =:IdDisciplina AND `idProyecto`=:IdProyecto');
                $sql->execute($data);
                return true;
            }catch(PDOException $e){
                print_r('Error connection: ' . $e->getMessage());
                return false;
            }
        }
        function deleteDisciplina($idp,$idc){
            try{
                $sql = $this->db->connect()->prepare('DELETE FROM `disciplinas` 
                WHERE `idDisciplina` =:IdDisciplina AND `idProyecto`=:IdProyecto');
                $sql->execute(array('IdProyecto'=>$idp,'IdDisciplina'=>$idc));
                return true;
            }catch(PDOException $e){
                print_r('Error connection: ' . $e->getMessage());
                return false;
            }
        }
        function searchDisciplina($idp,$id){
            try{
                $sql = $this->db->connect()->prepare('SELECT * FROM `disciplinas`
                WHERE `idProyecto`=:IdProyecto AND `idDisciplina`=:IdDisciplina');
                $sql->execute(array('IdProyecto'=>$idp,'IdDisciplina'=>$id));
                
                $dis = new Disciplina();
                while($row = $sql->fetch()){
    
                    $dis->idDisciplina     = $row['idDisciplina'];
                    $dis->idProyecto       = $row['idProyecto'];
                    $dis->disciplina       = $row['disciplina'];
    
                }
                return $dis;
            }catch(PDOException $e){
                  return [];
            }
        }
        function getDisciplinas(){
            $items = [];
            try{
                $sql = $this->db->connect()->prepare('SELECT * FROM `disciplinas`');            
                while($row = $sql->fetch()){
                    $dis = new Disciplina();
                    $dis->idDisciplina     = $row['idDisciplina'];
                    $dis->idProyecto       = $row['idProyecto '];
                    $dis->disciplina       = $row['disciplina'];
                    array_push($items,$dis);
                }
                return $items;
            }catch(PDOException $e){
                  return [];
            }
        }
        function getDisciplinasPr($id){
            $items = [];
            try{
                $sql = $this->db->connect()->prepare('SELECT * FROM `disciplinas`
                WHERE `idProyecto`=:IdProyecto');
                $sql->execute(['IdProyecto'=>$id]);            
                while($row = $sql->fetch()){
                    $dis = new Disciplina();
                    $dis->idDisciplina     = $row['idDisciplina'];
                    $dis->idProyecto       = $row['idProyecto'];
                    $dis->disciplina       = $row['disciplina'];
                    array_push($items,$dis);
                }
                return $items;
            }catch(PDOException $e){
                  return [];
            }
        }
    }

?>