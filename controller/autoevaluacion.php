<?php
    require_once("../config/conexion.php");
    require_once("../models/autoevaluacion.php");
    $autoevaluacion = new Autoevaluacion();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["aut_id"])){
                    $autoevaluacion->insert_autoevaluacion($_POST["fac_id"],$_POST["aut_ponderacion"],$_POST["aut_califica"],$_POST["aut_cumple"],$_POST["aut_anno"]);
                }else{
                    $autoevaluacion->update_autoevaluacion($_POST["aut_id"], $_POST["fac_id"],$_POST["aut_ponderacion"],$_POST["aut_califica"],$_POST["aut_cumple"],$_POST["aut_anno"]);
                }
                break;
        case "mostrar":
                $datos = $autoevaluacion->autoevaluaciones_id($_POST["aut_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["aut_id"] = $row["aut_id"];
                        $output["fac_id"] = $row["fac_id"];
                        $output["aut_ponderacion"] = $row["aut_ponderacion"];
                        $output["aut_califica"] = $row["aut_califica"];
                        $output["aut_cumple"] = $row["aut_cumple"];
                        $output["aut_anno"] = $row["aut_anno"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $autoevaluacion->delete_autoevaluacion($_POST["aut_id"]);
                break;
        case "listar":
                $datos=$autoevaluacion->autoevaluaciones2();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["fac_cod"]." - ".$row["fac_nombre"];
                    $sub_array[] = $row["aut_ponderacion"];
                    $sub_array[] = $row["aut_califica"];
                   
                    if($row["aut_cumple"] == 'P'){
                        $sub_array[] = "<p style='color:#28a745'>Se cumple plenamente</p>"; //aut_califica 90 - 100
                    }elseif ($row["aut_cumple"] == 'G'){
                        $sub_array[] = "<p style='color:#20c997'>Se cumple en alto grado</p>";  //aut_califica 80 - 89
                    }elseif ($row["aut_cumple"] == 'A'){
                        $sub_array[] = "<p style='color:#ffc107'>Se cumple aceptablemente</p>"; //aut_califica 70 - 79
                    }elseif ($row["aut_cumple"] == 'I'){
                        $sub_array[] = "<p style='color:#fd7e14'>Se cumple insatisfactoriamente</p>"; //aut_califica 60 - 69
                    }else{
                        $sub_array[] = "<p style='color:#dc3545'>No se cumple</p>"; //aut_califica <=59
                    }
                    
                    $sub_array[] = $row["aut_anno"];
                    
                    $sub_array[] = '<button type="button" onClick="editar('.$row["aut_id"].');"  id="'.$row["aut_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["aut_id"].');"  id="'.$row["aut_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
        
        case "guardar_desde_excel":
            $autoevaluacion->insert_autoevaluacion($_POST["aut_factor"],$_POST["aut_ponderacion"],$_POST["aut_califica"],$_POST["aut_cumple"],$_POST["aut_anno"]);
            break;
        
            
     
    }
?>