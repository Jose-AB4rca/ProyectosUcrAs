<?php
  session_start();
  require_once('view/adMenu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
  <section class="min-vh-100 h-100 bg-image" style="background-image: url('img/p14.jpg');">
  <div class="container d-flex">
  <div class="row justify-content-center">
      <div class="col-sm-5 m-2 bg-light" id="admin-cards">
        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
        <h3 class="mt-1">Proyectos</h3>
        <img src="img/books.png" alt="nf" style="max-width: 80px !important; max-height: 80px !important;"> 
          <p>En este apartado puedes acceder a las distintas opciones de proyectos, revisar sus datos y avance en general</p>
          <p class="text-wrap">Administrar proyectos registrados</p>
            <a class="btn mt-auto mb-4" id="init"  href="<?php echo constant('URL').'proyectos/lista';?>">Ir a proyectos</a>
        </div>
      </div>
      <div class="col-sm-5 m-2 bg-light" id="admin-cards">
        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
        <h3 class="mt-1">Usuarios</h3>
        <img src="img/user.svg" alt="nf" style="max-width: 80px !important; max-height: 80px !important;">
          <p>En este apartado puedes monitorear a los distintos usuarios asi como ver sus roles, agregarlos y borrarlos.</p> 
          <p class="text-wrap">Administrar usuarios del sistema</p>
            <a class="btn mt-auto mb-4" id="init"  href="<?php echo constant('URL').'usuarios/lista';?>">Ir a usuarios</a>
        </div>
      </div>
    </div>
  </div>  
</section>
</body>
</html>