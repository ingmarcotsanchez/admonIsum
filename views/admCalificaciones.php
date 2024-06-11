<?php
define( "BASE_URL", "/ISUM/views/");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>ISUM | Calificaciones X Estudiante </title>
</head>
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Header -->
        <?php
            include("modulos/header.php");
        ?>
        <!-- /.Header -->

        <!-- Menú -->
        <?php
            include("modulos/menu.php");
        ?>
        <!-- /.Menú -->

        <div class="content-wrapper">
            <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2"></div>
            </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Admón Calificaciones</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Estudiantes: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" style="width:100%" name="est_id" id="est_id" data-placeholder="Seleccione">
                                            <option label="Seleccione"></option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-control-label">&nbsp;</label>
                                    <button class="btn btn-outline-primary form-control" onclick="agregar()"><i class="fa fa-plus-square mg-r-10"></i> Agregar Asignaturas</button>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Estado: <span class="tx-danger">*</span></label>
                                        <div class="progress-group">
                                            <span class="progress-text">Porcentaje aprobado en la carrera</span>
                                            <span class="float-right"><b><span id="creditosAprobados">0</span></b>/159</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" id="barraProgreso" style="width: 0%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="detalle_data" class="table display responsive wrap">
                                <thead>
                                    <tr>
                                        <th>Estudiante</th>
                                        <th>Asignatura</th>
                                        <th>Calificación</th>
                                        <th>Estado</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
  
        <?php
            include("modulos/footer.php");
        ?>
    </div>
    <!-- /.Site wrapper -->
    <?php require_once("admmantenimiento.php"); ?>
    <?php require_once("admCalificacionesModal.php"); ?>
    <?php include("modulos/js.php"); ?>
    <script type="text/javascript" src="js/admCalificaciones.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
