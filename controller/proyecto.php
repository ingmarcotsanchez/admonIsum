<?php
    require_once("../config/conexion.php");
    require_once("../models/Proyecto.php");
    $proyecto = new Proyecto();

    switch($_GET["opc"]){
        
        case "guardaryeditar":
            if(empty($_POST["pro_id"])){
                $proyecto->insert_proyecto($_POST["pro_nom"],$_POST["grup_id"],$_POST["linea_id"],$_POST["pro_anno"],$_POST["prof_id"],$_POST["pro_pre"],$_POST["pro_prog1"],$_POST["pro_prog2"],$_POST["pro_prog3"]);
            }else{
                $proyecto->update_proyecto($_POST["pro_id"],$_POST["pro_nom"],$_POST["grup_id"],$_POST["linea_id"],$_POST["pro_anno"],$_POST["prof_id"],$_POST["pro_pre"],$_POST["pro_prog1"],$_POST["pro_prog2"],$_POST["pro_prog3"]);
            }
            break;
        case "mostrar":
            $datos = $proyecto->proyecto_id($_POST["pro_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["pro_id"] = $row["pro_id"];
                    $output["pro_nom"] = $row["pro_nom"];
                    $output["grup_id"] = $row["grup_id"];
                    $output["linea_id"] = $row["linea_id"];
                    $output["pro_anno"] = $row["pro_anno"];
                    $output["prof_id"] = $row["prof_id"];
                    $output["pro_pre"] = $row["pro_pre"];
                    $output["pro_prog1"] = $row["pro_prog1"];
                    $output["pro_prog2"] = $row["pro_prog2"];
                    $output["pro_prog3"] = $row["pro_prog3"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $proyecto->delete_proyecto($_POST["pro_id"]);
            break;
        case "listar":
            $datos = $proyecto->proyectos();
            $data = array();
            foreach ($datos as $row) {
                $sub_array = array();
                // columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = $row["pro_nom"];
                $sub_array[] = $row["pro_anno"];
                $sub_array[] = $row["grup_nom"];
                $sub_array[] = $row["linea_nom"];
                $sub_array[] = $row["prof_nom"] ." ". $row["prof_apep"] ." ". $row["prof_apem"];
                $sub_array[] = "$".$row["pro_pre"];
                $sub_array[] = $row["pro_prog1"] ." ". $row["pro_prog2"] ." ". $row["pro_prog3"];
                $sub_array[] = '<button type="button" onClick="editar(' .$row["pro_id"]. ');"  id="' .$row["pro_id"] . '" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar(' .$row["pro_id"]. ');"  id="' .$row["pro_id"] . '" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                
                $data[] = $sub_array;
            }
            
            // Formatea los datos en el formato requerido por DataTable
            $results = array(
                "draw" => 1,
                "recordsTotal" => count($data),
                "recordsFiltered" => count($data),
                "data" => $data
            );
        
            echo json_encode($results);
            break;
    }
?>