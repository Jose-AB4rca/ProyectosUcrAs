<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
<div class="center bg-primary text-center text-white rounded"><?php echo $this->mensaje;?></div>   
<div class="conatiner-fluid min-vh-100 d-flex justify-content-center bg-image" 
    style="background-image: url('../img/white-abstract.jpg');">
    <div class="row col-sm-10 bg-primary mb-5 mt-4 h-50">
        <form action="<?php echo constant('URL'); ?>usuarios/registrarUsuario" method="post" style="text-align: center;">
           <h1 class="mt-3" style="color: white;">Crear una cuenta</h1>
           <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3 mt-3">
                        <label for="cedula" style="color: white;" class="form-label">Cedula:</label>
                        <input type="number" required class="form-control" id="Cedula" name="Cedula">
                    </div>
                    <div class="mb-3">
                        <label for="pwd" style="color: white;" class="form-label mt-2">Nombre:</label>
                        <input type="text" required class="form-control" id="Nombre" name="Nombre">
                    </div>                    
                    <div class="mb-3">
                        <label for="pwd" style="color: white;" class="form-label mt-2">apellidos:</label>
                        <input type="text" required class="form-control" id="Apellidos" name="Apellidos">
                    </div>
                    <div class="mb-3">
                        <label for="rols" style="color: white;" class="form-label mt-2">Rol:</label>
                        <select class="form-control" id="rols" name="Rol" id="Rol">
                            <?php
                                 session_start();
                                 if(isset($_SESSION['cedula'])){
                                     if(isset($_SESSION['Rol']) && $_SESSION['Rol'] == '1'){
                             ?>     
                                    <option value="1">Administrador</option>
                                    <option value="2">Profesor</option>
                             <?php       
                                     }else{
                              ?>
                                    <option value="2">Profesor</option>
                              <?Php          
                                     }
                                 }else{
                              ?>      
                                    <option value="2">Profesor</option>
                            <?php        
                                 }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3 mt-3">
                        <label for="email" style="color: white;" class="form-label">Email:</label>
                        <input type="email" required class="form-control" id="Email" name="Email" placeholder="ejemplo@gmail.com">
                    </div>
                    <div class="mb-3">
                        <label for="pwd" style="color: white;" class="form-label mt-2">Password:</label>
                        <input type="password" required class="form-control" id="Password" name="Password">
                    </div>
                    <div class="mb-3">
                        <label for="pwd" style="color: white;" class="form-label mt-2">Estado</label>
                        <input type="text" required class="form-control" id="Estado" name="Estado">
                    </div>
                    <div class="mb-3">
                        <label for="pwd" style="color: white;" class="form-label mt-2">Fecha registro:</label>
                        <?php date_default_timezone_set('America/Costa_Rica');?>
                        <input type="" required class="form-control" id="FechaRegistro" value="<?php echo(date("Y-m-d H:i:s"));?>" default="<?php echo(date("Y-m-d H:i:s"));?>" name="FechaRegistro" disabled>
                    </div>
                </div>
           </div>
           <div class="d-flex justify-content-end">
           <button style="background-color: white;" type="submit" class="btn mt-4 mb-5">Registrar</button>
           <a style="background-color: white; margin-left: 1rem;" href="<?php echo constant('URL');?>" type="button" class="btn mt-4 mb-5">Volver</a>
           </div>  
        </form> 
    </div>
</div>
</body>
</html>