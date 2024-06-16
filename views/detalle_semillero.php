<?php
define( "BASE_URL", "/ISUM/views/");
define("BASE_PATH","/ISUM");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
require_once("../models/Semillero.php");
    $semillero = new Semillero();
    $semi = $semillero->get_semilleroDetallexid($_GET['sem_id']);
    $totpon = $semillero->total_ponencias_semillero($_GET['sem_id']);
    if(is_array($totpon)==true and count($totpon)>0){
        foreach($totpon as $row)
        {
            $output_ponencias["total"] = $row["total"];
        }
        //echo json_encode($output_ponencias);
    }
    $totart = $semillero->total_articulos_semillero($_GET['sem_id']);
    if(is_array($totart)==true and count($totart)>0){
        foreach($totart as $row)
        {
            $output_articulos["total"] = $row["total"];
        }
        //echo json_encode($output_articulos);
    }
    $totdes = $semillero->total_desarrollos_semillero($_GET['sem_id']);
    if(is_array($totdes)==true and count($totdes)>0){
        foreach($totdes as $row)
        {
            $output_desarrollos["total"] = $row["total"];
        }
        //echo json_encode($output_desarrollos);
    }
        

                                        
                                
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
            <?php for($i=0;$i<sizeof($semi);$i++): ?>
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="br-mainpanel br-profile-page">
                        <div class="card shadow-base bd-0 rounded-0 widget-4">
                            <div class="card-header ht-2"></div>
                            <div class="card-body">
                                <h1 class="tx-normal">SEMILLERO <?php echo $semi[$i]["sem_nom"]; ?></h1>
                                <h4 class="mb-15"> <?php echo $semi[$i]["sem_cod"]; ?> </h4>
                                <p class="mg-b-25"> <?php echo $semi[$i]["sem_anno"]; ?> </p>
                            </div>
                        </div>
                    </div>

                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fas fa-edit"></i></span>

                                        <div class="info-box-content">
                                            <h5 class="info-box-text">Cantidad de Ponencias</h5>
                                            <span class="info-box-number h4">
                                            <?php echo $output_ponencias["total"];?>
                                            </span>
                                        </div>
                                    <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
          
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-danger"><i class="fas fa-copy"></i></span>

                                        <div class="info-box-content">
                                            <h5 class="info-box-text">Cantidad de Artículos</h5>
                                            <span class="info-box-number h4"><?php echo $output_articulos["total"];?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box mb-3">
                                    <span class="info-box-icon bg-success"><i class="fas fa-code"></i></span>

                                    <div class="info-box-content">
                                        <h5 class="info-box-text">Cantidad de Desarrollos</h5>
                                        <span class="info-box-number h4"><?php echo $output_desarrollos["total"];?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                              
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card card-light">
                                        <div class="card-header">
                                            <h3 class="card-title">Información General</h3>
                                        </div>
                                        <div class="card-body">
                                            <strong>Misión</strong>
                                            <p class="text-muted">
                                                <?php echo $semi[$i]["sem_mision"];?>
                                            </p>
                                            <strong>Visión</strong>
                                            <p class="text-muted">
                                                <?php echo $semi[$i]["sem_vision"];?>
                                            </p>
                                            <strong>Objetivo General</strong>
                                            <p class="text-muted"><?php echo $semi[$i]["sem_objetivo"];?></p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Información Complementaria</h3>
                                        </div><!-- /.card-header -->
                                        <div class="card-body">
                                            <strong>Líder</strong>
                                            <p class="text-muted">
                                                <?php echo $semi[$i]["prof_nom"]. " " .$semi[$i]["prof_apep"]. " " .$semi[$i]["prof_apem"];?>
                                            </p>
                                            <strong>Grupo</strong>
                                            <p class="text-muted">
                                                <?php echo $semi[$i]["grup_nom"];?>
                                            </p>
                                            <strong>Línea</strong>
                                            <p class="text-muted">
                                                <?php echo $semi[$i]["linea_nom"];?></p>
                                            <strong>Sub Línea</strong>
                                            <p class="text-muted">
                                                <?php echo $semi[$i]["sublinea_nom"];?></p>
                                            <hr>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="card">
                                        <div class="row p-2">                                 
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-light">
                                                    <div class="inner">
                                                        <h3>150</h3>
                                                        <p>Articulos Divulgativos</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class='bx bx-file'></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-secondary">
                                                    <div class="inner">
                                                        <h3>53</h3>
                                                        <p>Articulos Cientificos</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class='bx bx-detail'></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-success">
                                                    <div class="inner">
                                                        <h3>44</h3>
                                                        <p>Articulos Scopus</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class='bx bx-spreadsheet'></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-dark">
                                                    <div class="inner">
                                                        <h3>65</h3>
                                                        <p>Desarrollos de Software</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class='bx bx-code-alt'></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-primary">
                                                    <div class="inner">
                                                        <h3>150</h3>
                                                        <p>Ponencias Internas</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class='bx bx-user-voice'></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-info">
                                                    <div class="inner">
                                                        <h3>53</h3>
                                                        <p>Ponencias Externas</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class='bx bxs-user-detail'></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-warning">
                                                    <div class="inner">
                                                        <h3>44</h3>
                                                        <p>Capitulo de libro</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class='bx bx-book-content'></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-danger">
                                                    <div class="inner">
                                                        <h3>65</h3>
                                                        <p>Libros</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class='bx bx-book-open'></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                        -->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
            <?php endfor; ?>
        </div>
        <?php
            include("modulos/footer.php");
        ?>
    </div>
    <!-- /.Site warapper -->
    <?php
    include("modulos/js.php");
    ?>
    <script type="text/javascript" src="js/admSemillero.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
