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
            <div class="container d-flex">
                <div class="row justify-content-center">
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Objetivo especifico</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'objetivosEspecificos/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar en lista" href="<?php echo constant('URL').'objetivosEspecificos/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Anotaciones</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'anotaciones/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'anotaciones/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Convenios</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'convenios/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'convenios/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                        <h3 class="mt-1">Cronogramas</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'cronogramas/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'cronogramas/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Descriptores</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'descriptores/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'descriptores/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Disciplinas</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'disciplinas/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'disciplinas/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Inscripcion a Actividad</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'inscripcionActividades/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'inscripcionActividades/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Entes externos</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'enteExternos/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'enteExternos/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Financiamiento</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'financiamientos/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'financiamientos/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Impacto-beneficio</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'impactosBeneficios/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'impactosBeneficios/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Metrica de evaluación</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'metricasEvaluacion/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'metricasEvaluacion/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Modalidad</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'modalidades/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'modalidades/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Programas adsentos</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'programasAdsentos/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'programasAdsentos/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Proyectos vinculados</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'proyectosVinculados/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'proyectosVinculados/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Recursos</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'recursos/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'recursos/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Responsables</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'responsables/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'responsables/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Temática</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'tematicas/listaEspecifica/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'tematicas/agregar/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Ubicación geográfica</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'ubicacionesGeo/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'ubicacionesGeo/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-2 bg-light" id="admin-cards">
                        <div class="container mt-3 d-flex flex-column h-100 align-items-center justify-content-center">
                            <h3 class="mt-1">Unidades relacionadas</h3>
                            <div class="d-flex">
                            <a class="btn mt-auto mb-4 fa fa-plus" title="Agregar nuevo" id="init"  href="<?php echo constant('URL').'unidadesRelacionada/agregar/'.$this->item->idProyecto;?>"></a>
                            <a class="btn mt-auto mb-4" id="init" title="Editar" href="<?php echo constant('URL').'unidadesRelacionada/listaEspecifica/'.$this->item->idProyecto;?>"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>  
          </div>
    </div>
</div>
    <script>
            function dataOps(route,txt) {
            if (confirm("Deseas borrar el usuario con cedula: ".concat(txt).concat(" ?"))) {
                location.href = "<?php echo constant('URL');?>".concat(route).concat(txt);
            }
        }
    </script>
<script type="text/javascript">
function actualizar(){location.reload(true);}
setInterval("actualizar()",18000);
</script>
</body>
</html>
