<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
<div class="center bg-primary text-center text-white rounded"><?php echo $this->mensaje;?></div>   
<div class="conatiner-fluid min-vh-100 d-flex justify-content-center bg-image" 
    style="background-image: url('../img/white-abstract.jpg');">
    <div class="row col-sm-10 bg-primary mb-5 mt-4 h-50">
        <form action="<?php echo constant('URL').'metricasEvaluacion/agregarMetricaEva';?>" method="post" style="text-align: center;">
           <h1 class="mt-3" style="color: white;">Agregar metrica de evaluación</h1>
           <div class="row justify-content-center"> 
                <div class="col-sm-6">
                    <div class="mb-3 mt-3">
                        <label for="cedula" style="color: white;" class="form-label">ID proyecto:</label>
                        <input type="number" class="form-control" id="IdProyecto" name="IdProyecto" value="<?php echo $this->id;?>" readonly>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" id="IdMetrica" name="IdMetrica" readonly hidden>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" style="color: white;" class="form-label mt-2">Evaluación proyecto:</label>
                        <textarea class= "form-control" id="EvaluacionProyeecto" name="EvaluacionProyeecto" rows="4" cols="40" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" style="color: white;" class="form-label mt-2">Evaluacion impacto:</label>
                        <textarea class= "form-control" id="EvaluacionImpacto" name="EvaluacionImpacto" rows="4" cols="40" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" style="color: white;" class="form-label mt-2">Evaluacion participantes:</label>
                        <textarea class= "form-control" id="EvaluacionParticipante" name="EvaluacionParticipante" rows="4" cols="40" required></textarea>
                    </div>
                </div>
           </div>
           <div class="d-flex justify-content-end">
           <button style="background-color: white;" type="submit" class="btn mt-4 mb-5">Crear</button>
           <a style="background-color: white; margin-left: 1rem;" href="<?php echo constant('URL').'metricasEvaluacion/listaEspecifica/'.$idPoryecto;?>" type="button" class="btn mt-4 mb-5">Volver</a>
           </div>  
        </form> 
    </div>
</div>
</body>
</html>