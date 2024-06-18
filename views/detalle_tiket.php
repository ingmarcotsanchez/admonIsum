<?php
define( "BASE_URL", "/ISUM/views/");
define("BASE_PATH","/ISUM");
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalle Ticket: ID- <strong id="id_ticket"></strong> </h3>  <span class="float-right ml-2" id="Estado"></span><span class="btn btn-light btn-sm float-right" id="Fecha_creacion"></span>

                        </div>
                       
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                
                                    <div class="form-group">
                                        <label>Categoría</label>
                                        <input type="text" class="form-control" id="cat_nom" name="cat_nom" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tick_titulo">Título</label>
                                        <input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <textarea id="tick_descrip_usu" name="tick_descrip_usu"readonly>
                                    
                                    </textarea>
                                </div>
                            </div>
                        </div>
               
                    </div>  
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" id="Detalle_ticket">
                           
                        </div>
                    </div>
                </div>
            </section>
            <section class="content" id="panel_detalle">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Enviar una respuesta</h3>
                        </div>
                        <form method="post" id="ticket_form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <textarea id="dtick_descrip" name="dtick_descrip">
                                        
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" id="btnEnviarTicket" class="btn btn-info float-right">Enviar</button>
                                <button type="button" id="btnCerrarTicket" class="btn btn-danger float-left">Cerrar Ticket</button>
                            </div>
                        </form>
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
    <script type="text/javascript" src="js/admDtllTicket.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
