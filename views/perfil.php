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
  <title>Proyecto | Perfil</title>
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
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Datos del programa</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del Programa</label>
                                        <input type="text" class="form-control" name="info_nombre" id="info_nombre" placeholder="Ingrese su nombre">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="ape_paterno">SNIES</label>
                                        <input type="text" class="form-control" name="info_snies" id="info_snies" placeholder="Ingrese su apellido">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="ape_materno">Resolución</label>
                                        <input type="text" class="form-control" name="info_resolucion" id="info_resolucion" placeholder="Ingrese su apellido">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="correo">Número de Créditos</label>
                                        <input type="email" class="form-control" name="info_creditos" id="info_creditos" placeholder="Ingrese su nombre">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="password">Duración del Programa</label>
                                        <input type="text" class="form-control" name="info_semestres" id="info_semestres" placeholder="Ingrese su apellido">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                    <label>Metodología</label>
                                    <select class="form-control select2" name="info_metodologia" id="info_metodologia" data-placeholder="Seleccione">
                                        <option label="Seleccione"></option>
                                        <option value="P">Presencial</option>
                                        <option value="V">Virtual</option>
                                        <option value="D">Distancia</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    <label>Nivel de Programa</label>
                                    <select class="form-control select2" name="info_nivel" id="info_nivel" data-placeholder="Seleccione">
                                        <option label="Seleccione"></option>
                                        <option value="T">Técnico</option>
                                        <option value="N">Tecnologo</option>
                                        <option value="P">Profesional</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-secondary" id="btnactualizar">Actualizar</button>
                            </div>
                        <!-- /.card-body -->
                        </div>
                    <!-- /.row -->
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
    <script type="text/javascript" src="js/perfil.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
