<?php
    include_once('class/proyecto.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proyectos</title>
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
        if (isset($_GET['mss'])){
    ?>
        <div class="alert alert-dismissible center bg-primary text-center text-white rounded fade show mt-2">
            <?php echo $_GET['mss'];?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php    
        }
    ?>
    <section class="min-vh-100 h-100 bg-image" style="background-image: url('../img/p14.jpg');">
        <div class="container min-vh-100 h-100 bg-light" id="admin-cards">
            <h1 class="text-center text-break">Proyectos inscritos en el sistema</h1>

        <div class="container mt-3">
            <br></br>
            <input type="text" class="form-control" id="Buscar">
            </div>
                <div class="mt-3 display" id="table_id">
            </div>
        </div>
    </section>    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#Buscar").keyup(function(){
            var input = $(this).val();

            if(input != ""){
                $.ajax({
                    url: "https://localhost/ProyectosUcrAs/proyectos/loadList",
                    method: "POST",
                    data: {input:input},

                    success:function(data){
                        $("#table_id").html(data);
                    }
                });
            }else{
                //$("#result").css("display","none");
                $("#result").html(data);
            }
        });
    });
</script>
<script>
    $('#table_id').DataTable( {
        responsive: true,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
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