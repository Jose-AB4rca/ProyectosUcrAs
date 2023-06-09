<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
</head>
<body>
    <?php
    session_start();
    //según el estado de la sesión nos carga un menu o el otro
    //isset pregunta si la var esta declarada y no vacia
    if(isset($_SESSION['cedula'])){
        if(isset($_SESSION['Rol']) && $_SESSION['Rol'] == '1'){
            require_once('view/adMenu.php');
        }else{
            require_once('view/profesMenu.php');
        }
    }else{
        require_once('view/menu.php');
    }
    ?>
    
    <?php
        //mensaje para comunicar un cambio o acción
        if (isset($_GET['ms'])){
    ?>
        <div class="alert alert-dismissible center bg-primary text-center text-white rounded fade show mt-2">
            <?php echo $_GET['ms'];?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php    
        }
    ?>
    <section class="min-vh-100 h-100 bg-image" style="background-image: url('img/p14.jpg');">
        <div class="container min-vh-100 h-100 bg-light" id="admin-cards">
            <br>
            <h1 class="text-center text-break pt-4">Usuarios registrados en el sistema</h1>
            
            <a class="btn ms-1" id="init"  href="<?php echo constant('URL');?>vistas/proyectos">Volver</a>
           
            <div class="mt-3 table-responsive text-center">          
            <table class="table display dt-responsive nowrap" id="table_id">
                <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Rol</th>
                    <th>Email</th>
                    <th>Fecha de registro</th>
                    <th>Opción</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($this->list as $row){
                            $us = new Usuario();
                            $us = $row;
                    ?>
                    <tr>
                        <td><?php echo $us->cedula;?></td>
                        <td><?php echo $us->nombre;?></td>
                        <td><?php echo $us->apellidos;?></td>
                        <td><?php echo $us->rol;?></td>
                        <td><?php echo $us->email;?></td>
                        <td><?php echo $us->fechaRegistro;?></td>
                        <td>  
                            <a name="editar" id="editar" class="btn btn-warning m-1" href="<?php echo constant('URL').'usuarios/editar/'.$us->cedula; ?>" role="button">editar</a>
                            <a name="del" id="del" onclick="deleteUser('<?php echo $us->cedula;?>')" class="btn btn-danger m-1"  role="button">eliminar</a>
                        </td>
                    </tr>
                <?php      
                    }
                ?>
               </tbody>
            </table>
        </div>
        </div>
    </section>
        <script>
              function deleteUser(txt) {
                if (confirm("Deseas borrar el usuario con cedula: ".concat(txt).concat(" ?"))) {
                    location.href = "<?php echo constant('URL').'usuarios/eliminarUsuario/';?>".concat(txt);
                }
            }
        </script>
        </script>
        <script>
            $('#table_id').DataTable( {
                responsive: true,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Sin resultados - busca por ID o titulo",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "No se han encontrado registros",
                    "infoFiltered": "( de _MAX_ en total )",
                    "search": "Buscar : ",
                    "paginate":{
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                    }
                } );
        </script>
</body>
</html>