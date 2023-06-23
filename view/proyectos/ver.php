<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
<?php
    session_start();
    if(isset($_SESSION['cedula'])){
        if(isset($_SESSION['Rol']) && $_SESSION['Rol'] == '1'){
            require_once('view/adMenu.php');

        }else{
            require_once('view/profesMenu.php');
        }
    }else{
        require_once('view/menu.php');
    }
?>
<div class="container-fluid min-vh-100 bg-secondary">
    <div class="container bg-light min-vh-100">
            <div class="row">
                <div class="col-sm-4 mt-2">
                    <article class="text-break">
                    <h2 class="mt-2">Información</h2>   
                    <br> 
                    <p>Encargado del proyecto:  <?php echo $this->item->encargado;?></p>
                    <p>Identificador (ID):  <?php echo $this->item->idProyecto;?></p>
                    <p>Inicio:  <?php echo $this->item->fechaInicio;?></p>
                    <p>Limite:  <?php echo $this->item->fechaFin;?></p>
                    </article>
                    </div>
                <div class="col-sm-8 mt-2">
                    <article class="text-break">
                    <h1><?php echo $this->item->titulo;?></h1>   
                    <br>
                    <p>Descripción</p>
                    <p><?php echo $this->item->descripcion;?></p>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mt-2">
                    <article class="text-break">
                        <h2 class="mt-2">Responsables</h2>   
                        <br> 
                        <?php
                        foreach($this->res as $row){
                            $ob = new Responsable();
                            $ob = $row;
                        ?>
                        <tr>
                            <p><?php echo $ob->responsable;?></p>
                        </tr>
                        <?php      
                            }
                        ?>
                        <br>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mt-2">
                    <article class="text-break">
                        <h2 class="mt-2">Justificación</h2>   
                        <br> 
                        <p><?php echo $this->item->justificacion;?></p>
                        <br>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mt-2">
                    <article class="text-break">
                        <h2 class="mt-2">Objetivo general</h2>   
                        <br> 
                        <p><?php echo $this->item->objetivoGeneral;?></p>
                        <br>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mt-2">
                    <article class="text-break">
                        <h2 class="mt-2">Objetivos especificos</h2>   
                        <br> 
                        <?php
                        foreach($this->obj as $row){
                            $ob = new ObjetivoEspecifico();
                            $ob = $row;
                        ?>
                        <tr>
                            <p><?php echo $ob->objetivo;?></p>
                        </tr>
                        <?php      
                            }
                        ?>
                        <br>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mt-2">
                    <article class="text-break"> 
                        <h2 class="mt-2">Metas de objetivos especificicos</h2>   
                        <?php
                        foreach($this->metasO as $row){
                            $ob = new MetaObjetivoEsp();
                            $ob = $row;
                        ?>
                        <tr>
                            <p><?php echo $ob->meta;?></p>
                        </tr>
                        <?php      
                            }
                        ?>
                    </article>
                </div>
            </div>    
            <div class="row">
                <div class="col-sm-12 mt-2">
                    <article class="text-break">
                        <h2 class="mt-2">Antecedentes</h2>   
                        <br> 
                        <p><?php echo $this->item->antecedentes;?></p>
                        <br>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mt-2">
                    <article class="text-break">
                        <h2 class="mt-2">Metodología</h2>   
                        <br> 
                        <p><?php echo $this->item->metodologia;?></p>
                        <br>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mt-2">
                    <article class="text-break">
                        <h2 class="mt-2">Sub-actividades sustantivas</h2>   
                        <br> 
                        <p><?php echo $this->item->subActividadesSubstantivas;?></p>
                        <br>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 mt-2">
                    <article class="text-break"> 
                        <h2 class="mt-2">Observaciones</h2>   
                        <br> 
                        <p><?php echo $this->item->observaciones;?></p>
                        <br>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mt-2">
                    <article class="text-break"> 
                        <h2 class="mt-2">Comentarios</h2>   
                        <br> 
                        <p><?php echo $this->item->comentarios;?></p>
                        <br>
                    </article>
                </div>
            </div>     
            <div class="row">
                <div class="col-sm-12 mt-2">
                    <article class="text-break"> 
                        <h2 class="mt-2">Area de impacto</h2>   
                        <?php
                        foreach($this->areaI as $row){
                            $ob = new AreaImpacto();
                            $ob = $row;
                        ?>
                        <tr>
                            <p><?php echo $ob->area;?></p>
                        </tr>
                        <?php      
                            }
                        ?>
                    </article>
                </div>
            </div>    
            <div class="row">
                <div class="col-sm-12 mt-2">
                    <article class="text-break"> 
                        <h2 class="mt-2">Anotaciones</h2>   
                        <?php
                        foreach($this->anota as $row){
                            $ob = new Anotacion();
                            $ob = $row;
                        ?>
                        <tr>
                            <p><?php echo $ob->anotacion;?></p>
                        </tr>
                        <?php      
                            }
                        ?>
                    </article>
                </div>
            </div>    
     </div>
</div>
</body>
</html>