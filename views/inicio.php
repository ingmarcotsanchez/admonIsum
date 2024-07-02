<?php
define( "BASE_URL", "/ISUM/views/");
define("BASE_PATH","/ISUM");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
require_once("../models/Usuario.php");
require_once("../models/Info.php");
if(isset($_SESSION["usu_id"])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>ISUM | Home</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3 id="lbltotalProfesores"> </h3>

                <p>Total de Profesores</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="lbltotalProyectos"> </h3>

                <p>Total de Proyectos</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 id="lbltotalSemilleros"> </h3>

                <p>Total de Semilleros</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-light">
              <div class="inner">
                <h3 id="lbltotalEstudiantes"> </h3>

                <p>Total de Estudiantes</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>   
          <!-- ./col -->
        </div>
        <div class="row bg-white">
          <div class="col-8">
            <div class="card py-5 px-2">
                <div id="columnchart_material"></div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <p class="text-center">
                <strong>Estado de Estudiantes</strong>
              </p>
              <div class="card-body p-4">
                <div class="progress-group">
                  Total de estudiantes Desertores
                  <span class="float-right"id="lbltotalDesertores"></span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-danger" style="width: 100%"></div>
                  </div>
                </div>

                <!-- /.progress-group -->
                <div class="progress-group">
                  <span class="progress-text">Estudiantes Activos</span>
                  <span class="float-right" id="lbltotalActivos"></span>
                  <!--  $porcentaje = (((lbltotalEstudiantes * lbltotalActivos ) / 100) * 100);-->
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-success" style="width: 100%"></div>
                  </div>
                </div>


                <div class="progress-group">
                  Estudiantes Ausentes
                  <span class="float-right" id="lbltotalAusentes"></span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: 100%"></div>
                  </div>
                </div>

                <div class="progress-group">
                  Estudiantes No Graduados
                  <span class="float-right" id="lbltotalNoGraduados"></span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-info" style="width: 100%"></div>
                  </div>
                </div>

                <div class="progress-group">
                  Total de Egresados
                  <span class="float-right" id="lbltotalEgresados"></span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-secondary" style="width: 100%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row bg-white my-3">
          <div class="col-sm-3 col-6">
            <div class="description-block border-right">
              <h4 class="description-percentage text-primary" id="lbltotalProductosUnitic"> </h4>
              <h5 class="description-header">Unitic</h5>
              <span class="description-text">TOTAL PRODUCTOS</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3 col-6">
            <div class="description-block border-right">
              <h4 class="description-percentage text-primary" id="lbltotalProductosSatsoc"> </h4>
              <h5 class="description-header">Satelites Sociales</h5>
              <span class="description-text">TOTAL PRODUCTOS</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3 col-6">
            <div class="description-block border-right">
              <h4 class="description-percentage text-primary" id="lbltotalProductosTecnoreciclaje"> </h4>
              <h5 class="description-header">TecnoReciclaje y Redes libres</h5>
              <span class="description-text">TOTAL PRODUCTOS</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3 col-6">
            <div class="description-block">
              <h4 class="description-percentage text-primary" id="lbltotalProductosBigdata"> </h4>
              <h5 class="description-header">Analitica de datos y BigData</h5>
              <span class="description-text">TOTAL PRODUCTOS</span>
            </div>
            <!-- /.description-block -->
          </div>
        </div>
      </div>

      
    </section>
  </div>
  
  <?php
    include("modulos/footer.php");
  ?>
</div>
<!-- /.Site warapper -->
<?php
  include("modulos/js.php");
?>
<script type="text/javascript" src="js/inicio.js"></script>
<script type="text/javascript" src="js/inicio/barras.js"></script>
<script type="text/javascript" src="notificacion.js"></script>


  
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
