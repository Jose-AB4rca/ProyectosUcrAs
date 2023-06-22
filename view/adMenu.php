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
    if(isset($_GET['url'])){
      $par = explode('/',$_GET['url']);
      $sum = count($par);
    }else{
      $sum = 1;
    }
    if($sum == 1){
      $ruta= "img/4.png";
     }
    if($sum == 2){
      $ruta = "../img/4.png";
    }
    if($sum == 3){
      $ruta = "../../img/4.png";
    }
    if($sum == 4){
      $ruta = "../../../img/4.png";
    }
    if($sum == 5){
      $ruta = "../../../img/4.png";
    }

  ?>
<nav class="navbar navbar-expand-sm" id="menusPry">
  <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo constant('URL');?>">
          <img class="img-fluid" src="<?php echo $ruta; ?>" width="100" height="86" alt="">
      </a>
    <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon navbar-dark"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo constant('URL');?>vistas/proyectos">Tareas administrativas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">Acerca de</a>
        </li>
      </ul>
      <div class="d-flex justify-content-center">
        <!-- Button trigger modal -->
        <button type="button" id="init" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <?php echo ('Bienvenido :'.$_SESSION['NameUser']);?>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos del usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class=text-break>
                <?php echo ('Bienvenido :'.$_SESSION['NameUser']);?>
                <br>
                <?php echo ('Cedula usuario :'.$_SESSION['cedula']);?>
                <br>
                <?php
                  $value = $_SESSION['Rol'] == '1' ? "Administrador" : "Profesor";
                  echo ('Rol asignado :'.$value);?>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a type="button" href="<?php echo constant('URL').'usuarios/editar/'.$_SESSION['cedula']?>" class="btn btn-primary">Editar mi usuario</a>
              </div>
            </div>
          </div>
        </div>
        <a class="btn" id="init"  href="<?php echo constant('URL').'login/desconectar';?>">Cerrar sesión</a>
      </div>
    </div>
  </div>
</nav> 
</body>
</html>