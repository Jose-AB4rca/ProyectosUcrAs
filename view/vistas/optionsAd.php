<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
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
  <div class="container d-flex">
  <div class="row justify-content-center">
      <div class="col-sm-5 m-2 bg-light" id="admin-cards">
        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
        <h3 class="mt-1">Agregar</h3>
        <img src="../img/plus.png" alt="nf" style="max-width: 80px !important; max-height: 80px !important;"> 
        <p>En este apartado puedes registrar nuevos proyectos de acción social</p>
          <p class="text-wrap">Formulario para proyectos nuevos</p>
            <a class="btn mt-auto mb-4" id="init"  href="<?php echo constant('URL');?>proyectos/registro">Nuevo registro</a>
        </div>
      </div>
      <div class="col-sm-5 m-2 bg-light" id="admin-cards">
        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
        <h3 class="mt-1">Lista</h3>
        <img src="../img/list2.jpg" alt="nf" style="max-width: 80px !important; max-height: 80px !important;">
          <p>En este apartado puedes monitorear a los distintos proyectos y ver más información de cada uno.</p> 
          <p class="text-wrap">Ver lista de proyectos en el sistema</p>
            <a class="btn mt-auto mb-4" id="init"  href="<?php echo constant('URL');?>proyectos/lista">Ir a la lista</a>
        </div>
      </div>
      <div class="col-sm-5 m-2 bg-light" id="admin-cards">
        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
        <h3 class="mt-1">Centro usuarios</h3>
        <img src="../img/user.svg" alt="nf" style="max-width: 80px !important; max-height: 80px !important;">
          <p>En este apartado puedes monitorear a los distintos proyectos y ver más información de cada uno.</p> 
          <p class="text-wrap">Ver lista de proyectos en el sistema</p>
            <a class="btn mt-auto mb-4" id="init"  href="<?php echo constant('URL');?>usuarios/lista">Ir a la lista</a>
        </div>
      </div>
    </div>
  </div>  
</section>
</body>
</html>