<?php
    require_once("../config/conexion.php");
    require_once("../models/Profesor.php");
    $profesor = new Profesor();
    //$prof = $profesor->get_profesorDetallexid($_GET['prof_id']);
    require_once("../models/Cv.php");
    $cv = new Cv();

    switch($_GET["opc"]){
        case "guardaryeditar":
            
                if(empty($_POST["prof_id"])){
                    //$ruta = __DIR__."images/profesor/default/anonymous.png";
                    $r=__DIR__."/..";
                    if(isset($_FILES["prof_image"]["tmp_name"])){
                        list($ancho, $alto) = getimagesize($_FILES["prof_image"]["tmp_name"]);
                        $nuevoAncho = 500;
                        $nuevoAlto = 500;
                        $directorio = $r."/images/profesor/".$_POST["prof_apep"]."".$_POST["prof_apem"];
                        //var_dump($directorio);
                        mkdir($directorio, 0777);
                        if($_FILES["prof_image"]["type"] == "image/jpeg"){
                            $aleatorio = mt_rand(100,999);
                            //$ruta = __DIR__."/../views/images/profesor/".$_POST["prof_apep"].$_POST["prof_apem"]."/".$aleatorio.".jpg";
                            $ruta = "/images/profesor/".$_POST["prof_apep"].$_POST["prof_apem"]."/".$aleatorio.".jpg";
                            //$ruta = "images/profesor/".$_POST["prof_apep"]."/".$aleatorio.".jpg";
                            $origen = imagecreatefromjpeg($_FILES["prof_image"]["tmp_name"]);						
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagejpeg($destino, $r.$ruta);
                        }
                        if($_FILES["prof_image"]["type"] == "image/png"){
                            $aleatorio = mt_rand(100,999);
                            $ruta ="/images/profesor/".$_POST["prof_apep"].$_POST["prof_apem"]."/".$aleatorio.".jpg";
                            $origen = imagecreatefrompng($_FILES["prof_image"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagepng($destino, $r.$ruta);
                        }
                    }
                    
                    $datos=$profesor->insert_profesor($ruta,$_POST["prof_dni"],$_POST["prof_nom"],$_POST["prof_apep"],$_POST["prof_apem"],$_POST["prof_correo"],$_POST["prof_correo2"],$_POST["prof_niv"],$_POST["prof_sex"],$_POST["prof_telf"],$_POST["rol_id"],$_POST["esc_id"],date('Y-m-d',strtotime($_POST["prof_fecini"])),date('Y-m-d',strtotime($_POST["prof_fecfin"])),$_POST["prof_cvlac"],$_POST["prof_orcid"],$_POST["prof_google"],$_POST["prof_est"]);
                    if (is_array($datos)==true and count($datos)>0){
                        foreach ($datos as $row){
                            $output["prof_id"] = $row["prof_id"];
                            if (empty($_FILES['files']['name'])){
        
                            }else{
                                $countfiles = count($_FILES['files']['name']);
                                $ruta = "../document/cv/".$output["prof_id"]."/";
                                $files_arr = array();
        
                                if (!file_exists($ruta)) {
                                    mkdir($ruta, 0777, true);
                                }
        
                                for ($index = 0; $index < $countfiles; $index++) {
                                    $doc1 = $_FILES['files']['tmp_name'][$index];
                                    $destino = $ruta.$_FILES['files']['name'][$index];
                                    $cv->insert_cv( $output["prof_id"],$_FILES['files']['name'][$index]);
                                    move_uploaded_file($doc1,$destino);
                                }
                            }
                        }
                    }
                    echo json_encode($datos);
                }else{
                    $r=__DIR__."/..";
                    if(isset($_FILES["prof_image"]["tmp_name"])){
                        list($ancho, $alto) = getimagesize($_FILES["prof_image"]["tmp_name"]);
                        $nuevoAncho = 500;
                        $nuevoAlto = 500;
                        $directorio = $r."/images/profesor/".$_POST["prof_apep"].$_POST["prof_apem"];
                        if(is_dir($directorio) == false){
                            mkdir($directorio, 0777);
                        }
                        
                        
                        if($_FILES["prof_image"]["type"] == "image/jpeg"){
                            $aleatorio = mt_rand(100,999);
                            $ruta = "/images/profesor/".$_POST["prof_apep"].$_POST["prof_apem"]."/".$aleatorio.".jpg";
                            $origen = imagecreatefromjpeg($_FILES["prof_image"]["tmp_name"]);						
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagejpeg($destino, $r.$ruta);
                        }
                        if($_FILES["prof_image"]["type"] == "image/png"){
                            $aleatorio = mt_rand(100,999);
                            $ruta = "/images/profesor/".$_POST["prof_apep"].$_POST["prof_apem"]."/".$aleatorio.".jpg";
                            $origen = imagecreatefrompng($_FILES["prof_image"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagepng($destino, $r.$ruta);
                        }
                        if($_FILES["prof_image"]["type"] == "image/jpg"){
                            $aleatorio = mt_rand(100,999);
                            $ruta = "/images/profesor/".$_POST["prof_apep"].$_POST["prof_apem"]."/".$aleatorio.".jpg";
                            $origen = imagecreatefrompng($_FILES["prof_image"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagepng($destino, $r.$ruta);
                        }
                       
                    }
                    $profesor->update_profesor($_POST["prof_id"], $ruta, $_POST["prof_dni"], $_POST["prof_nom"],$_POST["prof_apep"],$_POST["prof_apem"],$_POST["prof_correo"],$_POST["prof_correo2"],$_POST["prof_niv"],$_POST["prof_sex"],$_POST["prof_telf"],$_POST["rol_id"],$_POST["esc_id"],date('Y-m-d',strtotime($_POST["prof_fecini"])),date('Y-m-d',strtotime($_POST["prof_fecfin"])),$_POST["prof_cvlac"],$_POST["prof_orcid"],$_POST["prof_google"],$_POST["prof_est"]);
                    
                    //$profesor->update_profesor($_POST["prof_id"], $ruta, $_POST["prof_dni"], $_POST["prof_nom"],$_POST["prof_apep"],$_POST["prof_apem"],$_POST["prof_correo"],$_POST["prof_correo2"],$_POST["prof_niv"],$_POST["prof_sex"],$_POST["prof_telf"],$_POST["rol_id"],$_POST["esc_id"],date('Y-m-d',strtotime($_POST["prof_fecini"])),date('Y-m-d',strtotime($_POST["prof_fecfin"])),$_POST["prof_cvlac"],$_POST["prof_orcid"],$_POST["prof_google"],$_POST["prof_est"]);
                    //if (is_array($datos)==true and count($datos)>0){
                        ///foreach ($datos as $row){
                            //$output["prof_id"] = $row["prof_id"];
                            if (empty($_FILES['files']['name'])){
        
                            }else{
                                $countfiles = count($_FILES['files']['name']);
                                $ruta = "../document/cv/".$_POST["prof_id"]."/";
                                //$files_arr = array();
        
                                if (!file_exists($ruta)) {
                                    mkdir($ruta, 0777, true);
                                }
        
                                for ($index = 0; $index < $countfiles; $index++) {
                                    $doc1 = $_FILES['files']['tmp_name'][$index];
                                    $destino = $ruta.$_FILES['files']['name'][$index];
                                    $cv->insert_cv( $_POST["prof_id"],$_FILES['files']['name'][$index]);
                                    move_uploaded_file($doc1,$destino);
                                }
                            }
                        //}
                    //}
                    //echo json_encode($datos);
                
                }
                break;
        case "mostrar":
                $datos = $profesor->profesores_id($_POST["prof_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["prof_id"] = $row["prof_id"];
                        $output["prof_image"] = $row["prof_image"];
                        $output["prof_dni"] = $row["prof_dni"];
                        $output["prof_nom"] = $row["prof_nom"];
                        $output["prof_apep"] = $row["prof_apep"];
                        $output["prof_apem"] = $row["prof_apem"];
                        $output["prof_correo"] = $row["prof_correo"];
                        $output["prof_correo2"] = $row["prof_correo2"];
                        $output["prof_niv"] = $row["prof_niv"];
                        $output["prof_sex"] = $row["prof_sex"];
                        $output["prof_telf"] = $row["prof_telf"];
                        $output["rol_id"] = $row["rol_id"];
                        $output["esc_id"] = $row["esc_id"];
                        $output["prof_fecini"] = $row["prof_fecini"];
                        $output["prof_fecfin"] = $row["prof_fecfin"];
                        if($row["prof_fecfin"] == "1970-01-01"){
                            $output["prof_fecfin"] = "Actualmente";
                        }
                        
                        $output["prof_cvlac"] = $row["prof_cvlac"];
                        $output["prof_orcid"] = $row["prof_orcid"];
                        $output["prof_google"] = $row["prof_google"];
                        $output["prof_est"] = $row["prof_est"];
                       // $output["prof_cv"] = $row["prof_cv"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $profesor->delete_profesor($_POST["prof_id"]);
                break;
        case "listar":
                $datos=$profesor->profesores2();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["prof_dni"];
                    $sub_array[] = $row["prof_nom"] ." ". $row["prof_apep"] ." ". $row["prof_apem"];
                    //$sub_array[] = $row["prof_correo"];
                    if($row["prof_niv"] == 'P'){
                        $sub_array[] = "Pregrado";
                    }elseif ($row["prof_niv"] == 'E'){
                        $sub_array[] = "Especialista";
                    }elseif ($row["prof_niv"] == 'M'){
                        $sub_array[] = "Magister";
                    }elseif ($row["prof_niv"] == 'D'){
                        $sub_array[] = "Doctor";
                    }else{
                        $sub_array[] = "Sin escalafón";
                    }
                    //$sub_array[] = $row["prof_telf"];
                    if($row["rol_id"] == 1){
                        $sub_array[] = "Coordinador";
                    }elseif ($row["rol_id"] == 2){
                        $sub_array[] = "Profesor TC";
                    }elseif ($row["rol_id"] == 3){
                        $sub_array[] = "Profesor MT";
                    }elseif ($row["rol_id"] == 4){
                        $sub_array[] = "Profesor TP";
                    }else{
                        $sub_array[] = "Sin rol";
                    }
                    $sub_array[] = $row["esc_nombre"];
                    if($row["prof_est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='prof_ina(".$row["prof_id"].");' class='btn btn-primary btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='prof_act(".$row["prof_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["prof_id"].');"  id="'.$row["prof_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["prof_id"].');"  id="'.$row["prof_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    $sub_array[] = '<button type="button" onClick="detalle_profesor('.$row["prof_id"].');"  id="'.$row["prof_id"].'" class="btn btn-outline-dark btn-icon"><i class="bx bx-book-content"></i></button>';
                    $data[] = $sub_array;
                }
                /*Formato del datatable, se usa siempre*/
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
                break;
        case "combo":
            $datos=$profesor->profesores();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['prof_id']."'>".$row['prof_nom']." ".$row['prof_apep']." ".$row['prof_apem']."</option>";
                }
                echo $html;
            }
            break;
        case "guardar_desde_excel":
            $profesor->insert_profesor($_POST["prof_image"],$_POST["prof_dni"],$_POST["prof_nom"],$_POST["prof_apep"],$_POST["prof_apem"],$_POST["prof_correo"],$_POST["prof_correo2"],$_POST["prof_niv"],$_POST["prof_sex"],$_POST["prof_telf"],$_POST["rol_id"],$_POST["esc_id"],$_POST["prof_fecini"],$_POST["prof_fecfin"],$_POST["prof_cvlac"],$_POST["prof_orcid"],$_POST["prof_google"],$_POST["prof_est"],$_POST["prof_cv"]);
            break;
        
        case "activo":
            $profesor->update_estadoActivo($_POST["prof_id"]);
            break;
        case "inactivo":
            $profesor->update_estadoInactivo($_POST["prof_id"]);
            break; 
               
     
    }
?>