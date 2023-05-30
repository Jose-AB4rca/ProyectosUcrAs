<?php
    require_once('class/proyecto.php');
    class proyectoModel extends Model{
        function __construct(){
            parent::__construct();
        }

        function addProyecto($data){
            try{
                //SQL query
                $sql = $this->db->connect()->prepare('INSERT INTO `proyectos` (`idProyecto`,`descripcion`,`encargado`,`observaciones`,`justificacion`, `antecedentes`,
                `objetivoGeneral`,`subActividadesSubstantivas`,`metodologia`,`fechaInicio`,`fechaFin`,`fechaRegistro`,`comentarios`)
                VALUES (`:IdProyecto`,`:Descripcion`,`:Encargado`,`:Observaciones`,`:Justificacion`, `:Antecedentes`,
                `:ObjetivoGeneral`,`:SubActividadesSubstantivas`,`:Metodologia`,`:FechaInicio`,`:FechaFin`,`:FechaRegistro`,`:Comentarios`)');

                //ejecuta
                $sql->execute($data);
                return true;
            }catch(PDOExeption $e){
                print_r('Error de conexión: ' . $e->getMessage());
                return false;
            }
        }

        function deleteProyecto($id){
            try{
                $sql = $this->db->connect()->prepare('DELETE FROM `proyectos` WHERE `idProyecto` = :IdProyecto');
                $sql->execute(['IdProyecto'=>$id]);
                return true;
            }catch(PDOExepcion $e){
                print_r('Error connection: ' . $e->getMessage());
                return false;
            }
        }

        function updateProyecto($data){

            try{
                $sql = $this-$db->connect()->prepare('UPDATE `proyectos` SET (`idProyecto`=:IdProyecto,`descripcion`=:Descripcion,`encargado`=:Encargado,`observaciones`=:Observaciones,
                `justificacion`=:Justificacion,`antecedentes`=:Antecedentes,`objetivoGeneral`=:ObjetivoGeneral,`subActividadesSubstantivas`=:SubActividadesSubstantivas,
                `metodologia`=:Metodologia,`fechaInicio`=:FechaInicio,`fechaFin`=:FechaFin,`fechaRegistro`=:FechaRegistro,`comentarios`=:Comentarios)
                WHERE idProyecto=:IdProyecto');

                $sql->execute($data);
            }catch(PDOExeption $r){
                print_r('Error connection: ' . $e->getMessage());
                return false;
            }
        }

        function searchProyecto($id){
            try{
                $item = new Proyecto();
                $sql = $this->$db->connect()->prepare('SELECT * FROM `proyectos` WHERE `idProyecto` =:IdProyecto');
                $sql->execute(['IdProyecto'=>$id]);

                while($row = $sql->fetch()){
                    $item->idProyecto = $row["`IdProyecto"];
                    $item->descripcion = $row["descripcion"];
                    $item->encargado = $row["encargado"];
                    $item->observaciones = $row["observaciones"];
                    $item->justificacion = $row["justificacion"];
                    $item->antecedentes = $row['antecedentes'];
                    $item->objetivoGeneral= $row['objetivoGeneral'];
                    $item->$subActividadesSubstantivas = $row["subActividadesSubstantivas"];
                    $item->metodologia= $row['metodologia'];
                    $item->fechaInicio= $row['fechaInicio'];
                    $item->FechaFinal= $row['fechaFinal'];
                    $item->comentarios= $row['comentarios'];
                }
                return $item;
            }catch(PDOExeption $e){
                print_r('Error connection: ' . $e->getMessage());
                return false;
            }

        }

        function getProyectos(){
            $items=[];
            try{
                $sql = $this->db->connect()->prepare('SELECT * FROM `proyectos`');
                
                while($row = $sql->fetch()){
                    $proyecto = new Proyecto();
                    $proyecto->idProyecto = $row["`IdProyecto"];
                    $proyecto->descripcion = $row["descripcion"];
                    $proyecto->encargado = $row["encargado"];
                    $proyecto->observaciones = $row["observaciones"];
                    $proyecto->justificacion = $row["justificacion"];
                    $proyecto->antecedentes = $row['antecedentes'];
                    $proyecto->objetivoGeneral= $row['objetivoGeneral'];
                    $proyecto->$subActividadesSubstantivas = $row["subActividadesSubstantivas"];
                    $proyecto->metodologia= $row['metodologia'];
                    $proyecto->fechaInicio= $row['fechaInicio'];
                    $proyecto->FechaFinal= $row['fechaFinal'];
                    $proyecto->comentarios= $row['comentarios'];

                    array_push($items,$proyecto);
                }
                return $items;
            }catch(PDOExeption $e){
                print_r('Error connection: ' . $e->getMessage());
                return false;
            }
        }
    }
?>