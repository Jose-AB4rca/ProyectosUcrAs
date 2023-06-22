<?php
    require_once('class/proyecto.php');
    class ProyectosModel extends Model{
        function __construct(){
            parent::__construct();
        }

        function addProyecto($data){
            try{
                //SQL query
                $sql = $this->db->connect()->prepare('INSERT INTO `proyectos` (`titulo`,`descripcion`,`encargado`,`observaciones`,`justificacion`,
                `objetivoGeneral`,`subActividadesSubstantivas`,`metodologia`,`fechaInicio`,`fechaFin`,`antecedentes`,`comentarios`)
                VALUES (:Titulo,:Descripcion,:Encargado,:Observaciones,:Justificacion,
                :ObjetivoGeneral,:SubActividadesSubstantivas,:Metodologia,:FechaInicio,:FechaFin,:Antecedentes,:Comentarios)');

                //ejecuta
                $sql->execute($data);
                return true;
            }catch(PDOException $e){
                print_r('Error de conexión: ' . $e->getMessage());
                return false;
            }
        }

        function deleteProyecto($id){
            try{
                $sql = $this->db->connect()->prepare('DELETE FROM `proyectos` WHERE `idProyecto` = :IdProyecto');
                $sql->execute(['IdProyecto'=>$id]);
                return true;
            }catch(PDOException $e){
                print_r('Error connection: ' . $e->getMessage());
                return false;
            }
        }

        function updateProyecto($data){

            try{
                $sql = $this->db->connect()->prepare('UPDATE `proyectos` SET `titulo`=:Titulo,`descripcion`=:Descripcion,`encargado`=:Encargado,`observaciones`=:Observaciones,
                `justificacion`=:Justificacion,`objetivoGeneral`=:ObjetivoGeneral,`subActividadesSubstantivas`=:SubActividadesSubstantivas,
                `metodologia`=:Metodologia,`fechaInicio`=:FechaInicio,`fechaFin`=:FechaFin,`antecedentes`=:Antecedentes,`comentarios`=:Comentarios
                WHERE `idProyecto`=:IdProyecto');

                $sql->execute($data);
                return true;
            }catch(PDOException $e){
                print_r('Error connection: ' . $e->getMessage());
                return false;
            }
        }

        function searchProyecto($id){
            try{
                $item = new Proyecto();
                $sql = $this->db->connect()->prepare('SELECT * FROM `proyectos` WHERE `idProyecto` =:IdProyecto');
                $sql->execute(['IdProyecto'=>$id]);

                while($row = $sql->fetch()){
                    $item->idProyecto = $row["idProyecto"];
                    $item->titulo = $row["titulo"];
                    $item->descripcion = $row["descripcion"];
                    $item->observaciones = $row["observaciones"];
                    $item->justificacion = $row["justificacion"];
                    $item->antecedentes = $row['antecedentes'];
                    $item->objetivoGeneral= $row['objetivoGeneral'];
                    $item->subActividadesSubstantivas = $row["subActividadesSubstantivas"];
                    $item->metodologia= $row['metodologia'];
                    $item->fechaInicio= $row['fechaInicio'];
                    $item->fechaFin= $row['fechaFin'];
                    $item->encargado = $row["encargado"];
                    $item->fechaRegistro = $row["fechaRegistro"];
                    $item->comentarios= $row['comentarios'];
                }
                return $item;
            }catch(PDOException $e){
                print_r('Error connection: ' . $e->getMessage());
                return false;
            }

        }

        function getProyectos(){
            $items=[];
            try{
                $sql = $this->db->connect()->prepare('SELECT * FROM `proyectos`');
                $sql->execute();
                while($row = $sql->fetch()){
                    $proyecto = new Proyecto();
                    $proyecto->idProyecto = $row["idProyecto"];
                    $proyecto->titulo = $row["titulo"];
                    $proyecto->descripcion = $row["descripcion"];
                    $proyecto->encargado = $row["encargado"];
                    $proyecto->observaciones = $row["observaciones"];
                    $proyecto->justificacion = $row["justificacion"];
                    $proyecto->antecedentes = $row['antecedentes'];
                    $proyecto->objetivoGeneral= $row['objetivoGeneral'];
                    $proyecto->subActividadesSubstantivas = $row["subActividadesSubstantivas"];
                    $proyecto->metodologia= $row['metodologia'];
                    $proyecto->fechaInicio= $row['fechaInicio'];
                    $proyecto->fechaFin= $row['fechaFin'];
                    $proyecto->comentarios= $row['comentarios'];

                    array_push($items,$proyecto);
                }
                return $items;
            }catch(PDOException $e){
                print_r('Error connection: ' . $e->getMessage());
                return false;
            }
        }

        function getProyectosPr($nombre){
            $items=[];
            try{
                $sql = $this->db->connect()->prepare('SELECT * FROM `proyectos`
                WHERE `encargado`=:nom');
                $sql->execute(['nom'=>$nombre]);
                while($row = $sql->fetch()){
                    $proyecto = new Proyecto();
                    $proyecto->idProyecto = $row["idProyecto"];
                    $proyecto->titulo = $row["titulo"];
                    $proyecto->descripcion = $row["descripcion"];
                    $proyecto->encargado = $row["encargado"];
                    $proyecto->observaciones = $row["observaciones"];
                    $proyecto->justificacion = $row["justificacion"];
                    $proyecto->antecedentes = $row['antecedentes'];
                    $proyecto->objetivoGeneral= $row['objetivoGeneral'];
                    $proyecto->subActividadesSubstantivas = $row["subActividadesSubstantivas"];
                    $proyecto->metodologia= $row['metodologia'];
                    $proyecto->fechaInicio= $row['fechaInicio'];
                    $proyecto->fechaFin= $row['fechaFin'];
                    $proyecto->comentarios= $row['comentarios'];

                    array_push($items,$proyecto);
                }
                return $items;
            }catch(PDOException $e){
                print_r('Error connection: ' . $e->getMessage());
                return false;
            }
        }
    }
?>