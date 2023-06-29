<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver</title>
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
                        include_once('model/metasObjetivosEspModel.php');
                        include_once('class/metasObjetivosEspec.php');
                        $objId = [];
                        foreach($this->obj as $row){
                            $ob = new ObjetivoEspecifico();
                            $ob = $row;
                        ?>
                        <tr>
                            <p><?php echo $ob->objetivo;?></p>
                            <br>
                            <p><?php
                                $ref = new MetasObjetivosEspModel();
                                $meta = $ref->getMetasObjetivosEspPr($ob->idObjetivoEsp);
                                $metas = new MetaObjetivoEsp;
                                foreach($meta as $row){
                                    $metas->meta = $row->meta;
                                    if(isset($metas->meta)){
                                        echo 'Meta:  '.$metas->meta;
                                        ?>
                                        <br>
                                       <?php 
                                    }
                                }
                                ?>
                            </p>
                        </tr>

                        <?php      
                            }
                        ?>
                        <br>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 mt-2">
                    <article class="text-break"> 
                        <h2 class="mt-2">Anotaciones</h2>   
                        <br> 
                        <?php
                        include_once('class/anotacion.php');
                        foreach($this->anota as $row){
                            $an = new Anotacion();
                            $an = $row;

                        ?>
                        <tr>
                            <p><?php echo 'Documento: '.$an->documento."  --  "." Anotación: ".$an->anotacion;?></p>
                            <br>
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
                <div class="col-sm-4 mt-2">
                    <article class="text-break"> 
                        <h2 class="mt-2">Financiamiento</h2>   
                        <br> 
                        <?php
                        include_once('class/financiamiento.php');
                        foreach($this->finan as $row){
                            $fin = new Financiamiento();
                            $fin = $row;

                        ?>
                        <tr>
                            <p><?php echo 'Tipo: '.$fin->tipo."  --  "." Descripción: ".$fin->descripcion;?></p>
                            <br>
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
                        <h2 class="mt-2">Impactos</h2>   
                        <?php
                        include_once('class/impactoBeneficio.php');
                        foreach($this->impactoB as $row){
                            $ob = new ImpactoBeneficio();
                            $ob = $row;
                        ?>
                        <tr>
                            <p><?php echo 'Población: '.$ob->poblacion. " --  "." Cantidad: ".$ob->cantPoblacion."   --  "." beneficio:  ".$ob->beneficioPoblacion;?></p>
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