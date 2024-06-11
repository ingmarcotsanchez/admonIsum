<?php
        require_once("../config/conexion.php");
        require_once("../models/Calificaciones.php");
        $calificacion = new calificacion();

        switch($_GET["opc"]){
            case "guardaryeditar":
                if(empty($_POST["asigxest_id"])){
                    //$calificacion->insert_calificacion($_POST["asig_id"],$_POST["est_id"],$_POST["asigxest_nota"],$_POST["asigxest_est"]);
                }else{
                    if($_POST["asigxest_nota"] >= 3){
                        $asigxest_est=1;
                        $calificacion->update_estudiante_asignatura($_POST["asigxest_id"],$_POST["asigxest_nota"],$asigxest_est);
                    }else{
                        $asigxest_est=0;
                        $calificacion->update_estudiante_asignatura($_POST["asigxest_id"],$_POST["asigxest_nota"],$asigxest_est);
                    }
                }
                break;
            //case "guardaryeditar":
            case "editar_estudiante_asignatura":
                /*TODO: Array de usuario separado por comas */
                $datos = explode(',', $_POST['asigxest_id']);
                /*TODO: Registrar tantos usuarios vengan de la vista */
                $data = Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $idx=$calificacion->update_estudiante_asignatura($asigxest_id, $asigxest_nota, $asigxest_est);
                    $sub_array[] = $idx;
                    $data[] = $sub_array;
                }
    
                echo json_encode($data);
                break;


            
            case "mostrar":
                $datos = $calificacion->calificaciones_id($_POST["asigxest_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["asigxest_id"] = $row["asigxest_id"];
                        $output["asig_id"] = $row["asig_id"];
                        $output["est_id"] = $row["est_id"];
                        $output["asigxest_nota"] = $row["asigxest_nota"];
                        $output["asigxest_est"] = $row["asigxest_est"];
                    }
                    echo json_encode($output);
                }
                break;
            
            case "listar":
                $datos=$calificacion->calificaciones($_POST["est_id"]);
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["est_nom"] ." ". $row["est_apep"] ." ". $row["est_apem"];
                    $sub_array[] = $row["asig_nom"] ." - ". $row["asig_alfa"] ." - ". $row["asig_nrc"];
                    $sub_array[] = $row["asigxest_nota"];
                    if($row["asigxest_est"] == 1){
                        $sub_array[] = "<strong style='color:green'>Aprobada</strong>";
                    }else{
                        $sub_array[] = "<strong style='color:red'>Reprobada</strong>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["asigxest_id"].');"  id="'.$row["asigxest_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["asigxest_id"].');"  id="'.$row["asigxest_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
                    $data[] = $sub_array;
                }
          
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
                break;
            case "eliminar_estudiante_asignatura":
                $calificacion->delete_estudiante_asignatura($_POST["asigxest_id"]);
                break;
            /*TODO: Insetar detalle de curso usuario */
            
            case "obtener_creditos":
                if (isset($_POST["est_id"])) {
                    $estudiante = $_POST["est_id"];
                    $creditos = $calificacion->total_creditos($asigxest_id);
                
                    
                    echo json_encode($response);
                } else {
                    
                
                    echo json_encode($response);
                }
                break;
            case "obtener_creditos_aprobados":
                if (isset($_POST["est_id"])) {
                    $est_id = $_POST["est_id"];
                    $creditos = $calificacion->obtenerCreditosAprobados($est_id);
                    echo json_encode($creditos);
                } else {
                    throw new Exception("No se proporcionó el ID del estudiante");
                }
                break;
                
        }
        
?> 