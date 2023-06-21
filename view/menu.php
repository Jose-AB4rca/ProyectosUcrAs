<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<nav class="navbar navbar-expand-sm" id="menusPry">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo constant('URL');?>">byteSoftware</a>
    <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon navbar-dark"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">Secciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">Acerca de</a>
        </li>
      </ul>
      <form class="d-flex justify-content-center">
        <a class="btn" id="init"  href="<?php echo constant('URL');?>login">Iniciar sesión</a>
        <a class="btn" id="init"  href="<?php echo constant('URL');?>usuarios/registro">Crear cuenta</a>
      </form>
    </div>
  </div>
</nav> 
</body>
</html>