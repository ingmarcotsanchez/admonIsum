<?php
define( "BASE_URL", "/ISUM/views/");
define("BASE_PATH","/ISUM");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
require_once("../models/Profesor.php");
    $profesor = new Profesor();
    $prof = $profesor->get_profesorDetallexid($_GET['prof_id']);
require_once("../models/Producto_profesor.php");
    $profesor2 = new Producto_profesor();
    $totponext = $profesor2->total_ponencias_ext($_GET['prof_id']);
    if(is_array($totponext)==true and count($totponext)>0){
        foreach($totponext as $row)
        {
            $output_ponencias_ext["total"] = $row["total"];
        }
        //echo json_encode($output_ponencias_ext);
    }
    $totponint = $profesor2->total_ponencias_int($_GET['prof_id']);
    if(is_array($totponint)==true and count($totponint)>0){
        foreach($totponint as $row)
        {
            $output_ponencias_int["total"] = $row["total"];
        }
        //echo json_encode($output_ponencias_int);
    }
    $totartdiv = $profesor2->total_articulos_div($_GET['prof_id']);
    if(is_array($totartdiv)==true and count($totartdiv)>0){
        foreach($totartdiv as $row)
        {
            $output_articulo_div["total"] = $row["total"];
        }
        //echo json_encode($output_articulo_div);
    }
    $totartcien = $profesor2->total_articulos_cien($_GET['prof_id']);
    if(is_array($totartcien)==true and count($totartcien)>0){
        foreach($totartcien as $row)
        {
            $output_articulo_cien["total"] = $row["total"];
        }
        //echo json_encode($output_articulo_cien);
    }
    $totartscopus = $profesor2->total_articulos_scopus($_GET['prof_id']);
    if(is_array($totartscopus)==true and count($totartscopus)>0){
        foreach($totartscopus as $row)
        {
            $output_articulo_scopus["total"] = $row["total"];
        }
        //echo json_encode($output_articulo_scopus);
    }
    $totsoft = $profesor2->total_software($_GET['prof_id']);
    if(is_array($totsoft)==true and count($totsoft)>0){
        foreach($totsoft as $row)
        {
            $output_software["total"] = $row["total"];
        }
        //echo json_encode($output_software);
    }
    $totcapitulo = $profesor2->total_capitulos($_GET['prof_id']);
    if(is_array($totcapitulo)==true and count($totcapitulo)>0){
        foreach($totcapitulo as $row)
        {
            $output_capitulos["total"] = $row["total"];
        }
        //echo json_encode($output_capitulos);
    }
    $totlibro = $profesor2->total_libros($_GET['prof_id']);
    if(is_array($totlibro)==true and count($totlibro)>0){
        foreach($totlibro as $row)
        {
            $output_libros["total"] = $row["total"];
        }
        //echo json_encode($output_libros);
    }
                                        
                                
require_once("../models/Evaluacion.php");
    $evaluacion = new Evaluacion();
    $eva = $evaluacion->notasxprofesor($_GET['prof_id']);
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
            <?php for($i=0;$i<sizeof($prof);$i++): ?>
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="br-mainpanel br-profile-page">
                        <div class="card shadow-base bd-0 rounded-0 widget-4">
                            <div class="card-header ht-75"></div>
                            <div class="card-body">
                                <div class="card-profile-img">
                                    <img src='<?php echo (isset($prof[$i]["prof_image"])) ? BASE_PATH.$prof[$i]["prof_image"] : $ruta ;?>' alt="foto de perfil">
                                    
                                </div>
                                <h4 class="tx-normal tx-roboto tx-white"><?php echo $prof[$i]["prof_nom"] ." ". $prof[$i]["prof_apep"] ." ". $prof[$i]["prof_apem"]; ?></h4>
                                <?php
                                    if($prof[$i]["prof_niv"] == 'P'){ ?>
                                    <p class="mg-b-25"> Profesional </p>
                                <?php
                                    }elseif ($prof[$i]["prof_niv"] == 'E'){?>
                                        <p class="mg-b-25"> Especialista </p>
                                <?php
                                    }elseif ($prof[$i]["prof_niv"] == 'M'){?>
                                        <p class="mg-b-25"> Magister </p>
                                <?php
                                    }elseif ($prof[$i]["prof_niv"] == 'D'){?>
                                        <p class="mg-b-25"> Doctor </p>
                                <?php
                                    }else{?>
                                        <p class="mg-b-25"> Sin estudios </p>
                                <?php
                                    }
                                ?> 
                            </div>
                        </div>
                    </div>

                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-light">
                                        <div class="card-header">
                                            <h3 class="card-title">Información General</h3>
                                        </div>
                                        <div class="card-body">
                                            <strong>ID</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_dni"];?></p>
                                            <strong>CORREO ADMINISTRATIVO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_correo"];?></p>
                                            <strong>CORREO ACADÉMICO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_correo2"];?></p>
                                            <strong>ESCALAFÓN</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["esc_nombre"];?></p>
                                            <strong>CARGO</strong>
                                            <?php
                                                if($prof[$i]["rol_id"] == 1){ ?>
                                                <p class="mg-b-25"> Coordinador </p>
                                            <?php
                                                }elseif ($prof[$i]["rol_id"] == 2){?>
                                                    <p class="mg-b-25"> Profesor Tiempo Completo </p>
                                            <?php
                                                }elseif ($prof[$i]["rol_id"] == 3){?>
                                                    <p class="mg-b-25"> Profesor Medio Tiempo </p>
                                            <?php
                                                }elseif ($prof[$i]["rol_id"] == 4){?>
                                                    <p class="mg-b-25"> Profesor Catedratico </p>
                                            <?php
                                                }else{?>
                                                    <p class="mg-b-25"> Sin escalafón </p>
                                            <?php
                                                }
                                            ?>
                                            <strong>TELÉFONO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_telf"];?></p>
                                            <strong>FECHA DE INGRESO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_fecini"];?></p>
                                            <strong>FECHA DE RETIRO</strong>
                                            <?php if($prof[$i]["prof_fecfin"] == "1970-01-01"): ?>
                                                <p class="text-muted">Actualmente</p>
                                            <?php else: ?>
                                                <p class="text-muted"><?php echo $prof[$i]["prof_fecfin"];?></p>
                                            <?php endif; ?>
                                            <hr>
                                            <strong>CVLAC</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_cvlac"];?></p>
                                            <strong>ORCID</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_orcid"];?></p>
                                            <strong>GOOGLE SCHOLAR</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prof_google"];?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Resultados de Evaluaciones de los Estudiantes</h3>
                                        </div><!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="row">   
                                            <?php for($j=0;$j<sizeof($eva);$j++): ?>
                                                <div class="col-12 col-sm-6 col-md-4">
                                                    <div class="info-box">
                                                        <?php if($eva[$j]["eva_est"] == 0): ?>
                                                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>
                                                        <?php elseif($eva[$j]["eva_est"] == 1): ?>
                                                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-minus"></i></span>
                                                        <?php elseif($eva[$j]["eva_est"] == 2): ?>
                                                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
                                                        <?php elseif($eva[$j]["eva_est"] ==3): ?>
                                                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-thumbs-up"></i></span>
                                                        <?php endif; ?>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text"><?php echo $eva[$j]["eva_fecha"];?></span>
                                                            <span class="info-box-number"><?php echo $eva[$j]["eva_nota"];?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card">
                                        <div class="row p-2">   
                                                                          
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-light">
                                                    <div class="inner">
                                                        <h3><?php echo $output_articulo_div["total"];?></h3>
                                                        <p>Articulos Divulgativos</p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-light">
                                                    <div class="inner">
                                                        <h3><?php echo $output_articulo_cien["total"];?></h3>
                                                        <p>Articulos Cientificos</p>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-light">
                                                    <div class="inner">
                                                        <h3><?php echo $output_articulo_scopus["total"];?></h3>
                                                        <p>Articulos Scopus</p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-light">
                                                    <div class="inner">
                                                        <h3><?php echo $output_software["total"];?></h3>
                                                        <p>Software</p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-light">
                                                    <div class="inner">
                                                        <h3><?php echo $output_ponencias_int["total"];?></h3>
                                                        <p>Ponencias Internas</p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-light">
                                                    <div class="inner">
                                                        <h3><?php echo $output_ponencias_ext["total"];?></h3>
                                                        <p>Ponencias Externas</p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-light">
                                                    <div class="inner">
                                                        <h3><?php echo $output_capitulos["total"];?></h3>
                                                        <p>Capitulo de libro</p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-light">
                                                    <div class="inner">
                                                        <h3><?php echo $output_libros["total"];?></h3>
                                                        <p>Libros</p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                        
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
    <script type="text/javascript" src="js/perfil.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
