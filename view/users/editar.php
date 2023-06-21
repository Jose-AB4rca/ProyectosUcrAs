<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
<?php session_start();?>
<div class="conatiner-fluid min-vh-100 d-flex justify-content-center bg-image" 
    style="background-image: url('../../img/white-abstract.jpg');">
    <div class="row col-sm-10 bg-primary mb-5 mt-4 h-50">
        <form action="<?php echo constant('URL'); ?>usuarios/actualizarUsuario" method="post" style="text-align: center;">
           <h1 class="mt-3" style="color: white;">Editar datos de usuario</h1>
           <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3 mt-3">
                        <label for="cedula" style="color: white;" class="form-label">Cedula:</label>
                        <input type="number" class="form-control" id="Cedula" name="Cedula" value="<?php echo $this->item->cedula;?>" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" style="color: white;" class="form-label mt-2">Nombre:</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?php echo $this->item->nombre;?>" required>
                    </div>                    
                    <div class="mb-3">
                        <label for="pwd" style="color: white;" class="form-label mt-2">apellidos:</label>
                        <input type="text" class="form-control" id="Apellidos" name="Apellidos" value="<?php echo $this->item->apellidos;?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="Rol" style="color: white;" class="form-label mt-2">Rol: <?php echo $this->item->rol == '1' ? ' Administrador' : ' Profesor';?></label>
                        <input type="number" class="form-control" id="Rol" name="Rol" value="<?php echo $this->item->rol;?>" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3 mt-3">
                        <label for="email" style="color: white;" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $this->item->email;?>">
                    </div>
                    <div class="mb-3">
                        <label for="pwd" style="color: white;" class="form-label mt-2">Password:</label>
                        <input type="password" class="form-control" id="Password" name="Password" value="<?php echo $this->item->password;?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" style="color: white;" class="form-label mt-2">Estado</label>
                        <input type="text" class="form-control" id="Estado" name="Estado" value="<?php echo $this->item->estado;?>">
                    </div>
                    <?php
                        if (isset($this->mensaje)){
                    ?>
                        <div class="alert alert-dismissible fade show">
                            <?php echo $this->mensaje;?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php    
                        }
                    ?>   
                </div>
           </div>
           <div class="d-flex justify-content-end">
           <button style="background-color: white;" type="submit" class="btn mt-4 mb-5">Actualizar datos</button>
           <a style="background-color: white; margin-left: 1rem;" href="<?php echo constant('URL');?>" type="button" class="btn mt-4 mb-5">Volver</a>
           </div>  
        </form> 
    </div>
</div>
</body>
</html>