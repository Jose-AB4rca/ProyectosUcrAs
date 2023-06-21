<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
<div><?php echo $this->mensaje;?></div>   
<div class="conatiner-fluid min-vh-100 d-flex justify-content-center bg-image" 
    style="background-image: url('../img/white-abstract.jpg');">
    <div class="row col-sm-10 bg-primary mb-5 mt-4 h-50">
        <form action="<?php echo constant('URL');?>proyectos/agregarProyecto" method="post" style="text-align: center;">
           <h1 class="mt-3" style="color: white;">Crea un nuevo proyecto</h1>
           <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3 mt-3">
                        <label for="Titulo" style="color: white;" class="form-label mt-2">Titulo:</label>
                        <input type="text" class="form-control" id="Titulo" name="Titulo">
                    </div> 
                    <div class="mb-3">
                        <label for="Descripcion" style="color: white;">Descripción del proyecto</label>
                        <textarea id="Descripcion" class= "form-control" name="Descripcion" rows="4" cols="40"></textarea> 
                    </div>
                    <div class="mb-3">
                        <label for="pwd" style="color: white;" class="form-label mt-2">Encargado:</label>
                        <input type="text" class="form-control" id="Encargado" name="Encargado">
                    </div>  
                    <div class="mb-3">
                        <label for="Justificacion" style="color: white;">Justificacion</label>
                        <textarea id="Justificacion" class= "form-control" name="Justificacion" rows="4" cols="40"></textarea> 
                    </div>                  
                    <div class="mb-3">
                        <label for="Metodologia" style="color: white;">Metodologia</label>
                        <textarea id="Metodologia" class= "form-control" name="Metodologia" rows="3" cols="40"></textarea> 
                    </div>
                    <div class="mb-3">
                        <label for="FechaInicio" style="color: white;"> fecha de inicio</label>
                        <input type="date" class="form-control" name="FechaInicio" id="FechaInicio">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3 mt-3">
                        <label for="ObjetivoGeneral" style="color: white;" class="form-label mt-2">ObjetivoGeneral:</label>
                        <input type="text" class="form-control" id="ObjetivoGeneral" name="ObjetivoGeneral">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="Antecedentes" style="color: white;">Antecedentes</label>
                        <textarea id="Antecedentes" class= "form-control" name="Antecedentes" rows="4" cols="40"></textarea> 
                    </div>
                    <div class="mb-3">
                        <label for="Observaciones" style="color: white;">Observaciones</label>
                        <textarea id="Observaciones" class= "form-control" name="Observaciones" rows="4" cols="40"></textarea> 
                    </div>
                    <div class="mb-3">
                        <label for="SubActividadesSubstantivas" style="color: white;">Sub-actividades Substantivas</label>
                        <textarea id="SubActividadesSubstantivas" class= "form-control" name="SubActividadesSubstantivas" rows="3" cols="40"></textarea> 
                    </div>
                    <div class="mb-3">
                        <label for="FechaFin" style="color: white;"> fecha de finalización</label>
                        <input type="date" class="form-control" name="FechaFin" id="FechaFin">
                    </div>
                    <div class="mb-3">
                        <label for="Comentarios" style="color: white;"> Comentarios</label>
                        <textarea type="date" class="form-control" name="Comentarios" id="Comentarios" rows="3" cols="40"></textarea>
                    </div>
                </div>
           </div>
           <div class="d-flex justify-content-end">
           <button style="background-color: white;" type="submit" class="btn mt-4 mb-5">Crear proyecto</button>
           <a style="background-color: white; margin-left: 1rem;" href="<?php echo constant('URL');?>" type="button" class="btn mt-4 mb-5">Volver</a>
           </div>  
        </form> 
    </div>
</div>
</body>
</html>