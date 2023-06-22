<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
            <a class="btn mt-auto mb-4" id="init"  href="<?php echo constant('URL').'proyectos/listaPr/'.$_SESSION['NameUser'];?>">Ir a la lista</a>
        </div>
      </div>
    </div>
  </div>  
</section>
</body>
</html>