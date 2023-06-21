<?php
    include_once('class/proyecto.php');
    $con = mysqli_connect("localhost","root","","ucr_proyectos");
    if(!$con){
        echo "Conexión fallida" . mysqli_connect_error();
    }

    if(isset($_POST["input"])){
        $input = $_POST["input"];
        $query = "SELECT * FROM `proyectos` WHERE titulo LIKE '%{$input}%' LIMIT 8";

        $result = mysqli_query($con,$query);
   
        if(mysqli_num_rows($result) > 0){?>
            <div class="table-responsive text-center">          
            <table class="table display" id=table_id>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Encargado</th>
                    <th>Objetivo general</th>
                    <th>Descripción</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                        //$result->fetch()
                        $pry = new Proyecto();
                        $pry->idProyecto = $row['idProyecto'];
                        $pry->titulo = $row['titulo'];
                        $pry->encargado = $row['encargado'];
                        $pry->objetivoGeneral = $row['objetivoGeneral']; 
                        $pry->descripcion = $row['descripcion'];
                ?>
                    <tr>
                        <td><?php echo $pry->idProyecto;?></td>
                        <td><?php echo $pry->titulo;?></td>
                        <td><?php echo $pry->encargado;?></td>
                        <td><?php echo $pry->objetivoGeneral;?></td>
                        <td class="text-break"><?php echo $pry->descripcion;?></td>
                        <td>
                        <a name="eliminar" id="eliminar" class="btn btn-info m-1" href="<?php echo constant('URL').'proyectos/verProyecto/'.$pry->idProyecto; ?>" role="button">Ver</a>    
                        <a name="editar" id="editar" class="btn btn-warning m-1" href="<?php echo constant('URL').'proyectos/editar/'.$pry->idProyecto; ?>" role="button">Actualizar</a>
                        <a name="editar" id="editar" class="btn btn-success m-1" href="<?php echo constant('URL').'proyectos/opciones/'.$pry->idProyecto; ?>" role="button">Agregar datos</a></td>
                        
                    </tr>
                <?php      
                    }
                ?>
            </tbody>
        </table>
        </div>
        <?php
        }else{
            echo "<h6 class='text-center text-danger mt-3'>Sin resultados</h6>";
        }

    }
?>