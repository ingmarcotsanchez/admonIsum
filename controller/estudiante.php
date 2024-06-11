<?php
    require_once("../config/conexion.php");
    require_once("../models/Estudiante.php");
    $estudiante = new Estudiante();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["est_id"])){
                    $estudiante->insert_estudiante($_POST["est_dni"],$_POST["est_tipo"],$_POST["est_cedula"],$_POST["est_nom"],$_POST["est_apep"],$_POST["est_apem"],$_POST["est_fecnac"],$_POST["est_correo"],$_POST["est_sex"],$_POST["est_telf"],$_POST["est_seme"],$_POST["est_egre"]);
                }else{
                    $estudiante->update_estudiante($_POST["est_id"],$_POST["est_dni"],$_POST["est_tipo"],$_POST["est_cedula"],$_POST["est_nom"],$_POST["est_apep"],$_POST["est_apem"],$_POST["est_fecnac"],$_POST["est_correo"],$_POST["est_sex"],$_POST["est_telf"],$_POST["est_seme"],$_POST["est_egre"],$_POST["est_grado"]);
                }
                break;
        case "mostrar":
                $datos = $estudiante->estudiantes_id($_POST["est_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["est_id"] = $row["est_id"];
                        $output["est_dni"] = $row["est_dni"];
                        $output["est_tipo"] = $row["est_tipo"];
                        $output["est_cedula"] = $row["est_cedula"];
                        $output["est_nom"] = $row["est_nom"];
                        $output["est_apep"] = $row["est_apep"];
                        $output["est_apem"] = $row["est_apem"];
                        $output["est_fecnac"] = $row["est_fecnac"];
                        $output["est_correo"] = $row["est_correo"];
                        $output["est_sex"] = $row["est_sex"];
                        $output["est_telf"] = $row["est_telf"];
                        $output["est_seme"] = $row["est_seme"];
                        $output["est_egre"] = $row["est_egre"];
                        $output["est_grado"] = $row["est_grado"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $estudiante->delete_estudiante($_POST["est_id"]);
                break;
        case "listar":
                $datos=$estudiante->estudiantes();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["est_dni"];
                    $sub_array[] = $row["est_tipo"] ." ". $row["est_cedula"];
                    $sub_array[] = $row["est_nom"] ." ". $row["est_apep"] ." ". $row["est_apem"];
                    $sub_array[] = $row["est_fecnac"];
                    $sub_array[] = $row["est_correo"];
                    if($row["est_sex"] == 'M'){
                        $sub_array[] = "Masculino";
                    }else{
                        $sub_array[] = "Femenino";
                    }
                    $sub_array[] = $row["est_telf"];
                    
                    $sub_array[] = $row["est_seme"];
                    if($row["est_egre"] == 1){
                        $sub_array[] = "<p style='color:#28a745'>Activo</p>";
                    }else if($row["est_egre"] == 2){
                        $sub_array[] = "<p style='color:#ffc107'>Ausente</p>";
                    }else if($row["est_egre"] == 3){
                        $sub_array[] = "<p style='color:#007bff'>Egresado</p>";
                    }else if($row["est_egre"] == 4){
                        $sub_array[] = "<p style='color:#20c997'>Egresado No Graduado</p>";
                    }else{
                        $sub_array[] = "<p style='color:#dc3545'>Desertor</p>";
                    }
                
                    $sub_array[] = '<button type="button" onClick="editar('.$row["est_id"].');"  id="'.$row["est_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["est_id"].');"  id="'.$row["est_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
            $datos=$estudiante->estudiantes();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['est_id']."'>".$row['est_dni']." - ".$row['est_nom']." ".$row['est_apep']." ".$row['est_apem']."</option>";
                }
                echo $html;
            }
            break;
        case "guardar_desde_excel":
            $estudiante->insert_estudiante($_POST["est_dni"],$_POST["est_tipo"],$_POST["est_cedula"],$_POST["est_nom"],$_POST["est_apep"],$_POST["est_apem"],$_POST["est_fecnac"],$_POST["est_correo"],$_POST["est_sex"],$_POST["est_telf"],$_POST["est_seme"],$_POST["est_egre"],$_POST["est_grado"]);
            break;
        case "insert_estudiante_asignatura":
            $datos = explode(',',$_POST['asig_id']);
            foreach($datos as $row){
                $estudiante->insert_estudiante_asignatura($_POST["est_id"],$row,"0.0",0,1);
            }
            break;
        
            
     
    }
?>