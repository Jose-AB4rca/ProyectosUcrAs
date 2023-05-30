<?php
    class DisciplinaModel extends Model{
        function __construct(){
            parent::__construct();
        }
        function addDisciplina($data){
            try{
                $sql = $this->db->connect()->prepare('INSERT INTO `disciplinas`(`idDisciplina`, `idProyecto`, `disciplina`) 
                VALUES (:IdDisciplina,:IdProyecto,:Disciplina)');
                $sql->execute($data);
                return true;
            }catch(PDOExeption $e){
                print_r('Error connection: ' . $e->getMessage());
                  return false;
            }
        }
    
        function updateDisciplina($data){
            try{
                $sql = $this->db->connect()->prepare('UPDATE `disciplinas` SET `idDisciplina`=:IdDisciplina,`idProyecto`=:IdProyecto,
                `disciplina`=:Disciplina WHERE `idDisciplina` =:IdDisciplina AND `idProyecto`=:IdProyecto');
                $sql->execute($data);
                return true;
            }catch(PDOExeption $e){
                print_r('Error connection: ' . $e->getMessage());
                return false;
            }
        }
    
        function deleteDisciplina($idp,$idc){
            try{
                $sql = $this->db->connect()->prepare('DELETE FROM `disciplinas` 
                WHERE `idDisciplina` =:IdDisciplina AND `idProyectos`=:IdProyectos');
                $sql->execute(['IdProyecto'=>$idp],['IdDisciplina'=>$id]);
                return true;
            }catch(PDOExeption $e){
                print_r('Error connection: ' . $e->getMessage());
                return false;
            }
        }
    
        function searchDisciplina($idp,$id){
            try{
                $sql = $this->db->connect()->prepare('SELECT * FROM `descriptores`
                WHERE `idProyectos`=:IdProyectos AND `idDisciplina`=:IdDisciplina');
                $sql->execute(['IdProyecto'=>$idp],['IdDisciplina'=>$id]);
                
                $dis = new Disciplina();
                while($row = $sql->fetch()){
    
                    $dis->$idDisciplina     = $row['idDisciplina'];
                    $dis->$idProyecto       = $row['idProyecto '];
                    $dis->$disciplina       = $row['disciplina'];
    
                }
                return $dis;
            }catch(PDOExeption $e){
                  return [];
            }
        }
    
        function getDisciplinas(){
            $items = [];
            try{
                $sql = $this->db->connect()->prepare('SELECT * FROM `disciplinas`');            
                while($row = $sql->fetch()){
                    $dis = new Disciplina();
                    $dis->$idDisciplina     = $row['idDisciplina'];
                    $dis->$idProyecto       = $row['idProyecto '];
                    $dis->$disciplina       = $row['disciplina'];
                    array_push($items,$dis);
                }
                return $items;
            }catch(PDOExeption $e){
                  return [];
            }
        }
    }

?>