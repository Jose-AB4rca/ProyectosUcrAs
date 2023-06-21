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
<div><?php echo $this->mensaje;?></div>   
<div class="conatiner-fluid min-vh-100 d-flex justify-content-center bg-image" 
    style="background-image: url('../../img/white-abstract.jpg');">
    <div class="row col-sm-10 bg-primary mb-5 mt-4 h-50">
        <form action="<?php echo constant('URL');?>unidadesRelacionada/editarUnidadRe" method="post" style="text-align: center;">
           <h1 class="mt-3" style="color: white;">Editar unidades relacionadas</h1>
           <div class="row d-flex justify-content-center">
                <div class="col-sm-10">
                    <div class="mb-3 mt-3">
                        <label for="Titulo" style="color: white;" class="form-label mt-2">ID del proyecto:</label>
                        <input type="number" class="form-control" id="IdProyecto" name="IdProyecto" value="<?php echo $this->item->idProyecto?>" readonly>
                    </div> 
                    <div class="mb-3 mt-3">
                        <label for="Titulo" style="color: white;" class="form-label mt-2">ID unidad relacionada:</label>
                        <input type="number" class="form-control" id="IdUnidadR" name="IdUnidadR" value="<?php echo $this->item->idUnidadR?>" readonly>
                    </div> 
                    <div class="mb-3 mt-3">
                        <label for="Titulo" style="color: white;" class="form-label mt-2">Unidad:</label>
                        <textarea type="text" maxlength="200" class="form-control" id="Unidad" name="Unidad" rows="4" cols="40" required><?php echo $this->item->unidad?></textarea>
                    </div> 
                    <div class="mb-3 mt-3">
                        <label for="Titulo" style="color: white;" class="form-label mt-2">Base:</label>
                        <input type="number" step="1"  class="form-control" id="Base" name="Base" value="<?php echo $this->item->base?>" required>
                    </div> 
                </div>
           </div>
           <div class="d-flex justify-content-end">
           <button style="background-color: white;" type="submit" class="btn mt-4 mb-5">Editar</button>
           <a style="background-color: white; margin-left: 1rem;" href="<?php echo constant('URL').'unidadesRelacionada/listaEspecifica/'.$this->item->idProyecto;?>" type="button" class="btn mt-4 mb-5">Volver</a>
           </div>  
        </form> 
    </div>
</div>
</body>
</html>