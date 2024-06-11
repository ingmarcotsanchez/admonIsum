<?php
    require_once("../config/conexion.php");
    require_once("../models/Asignaturas.php");
    $asignatura = new Asignatura();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["asig_id"])){
                    $asignatura->insert_asignatura($_POST["asig_nom"],$_POST["asig_alfa"],$_POST["asig_nrc"],$_POST["asig_cred"],$_POST["asig_horas"],$_POST["seme_id"]);
                }else{
                    $asignatura->update_asignatura($_POST["asig_id"], $_POST["asig_nom"],$_POST["asig_alfa"],$_POST["asig_nrc"],$_POST["asig_cred"],$_POST["asig_horas"],$_POST["seme_id"]);
                }
                break;
        case "mostrar":
                $datos = $asignatura->asignaturas_id($_POST["asig_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["asig_id"] = $row["asig_id"];
                        $output["asig_nom"] = $row["asig_nom"];
                        $output["asig_alfa"] = $row["asig_alfa"];
                        $output["asig_nrc"] = $row["asig_nrc"];
                        $output["asig_cred"] = $row["asig_cred"];
                        $output["asig_horas"] = $row["asig_horas"];
                        $output["seme_id"] = $row["seme_id"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $asignatura->delete_asignatura($_POST["asig_id"]);
                break;
        case "listar":
                $datos=$asignatura->asignaturas2();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["asig_nom"];
                    $sub_array[] = $row["asig_alfa"];
                    $sub_array[] = $row["asig_nrc"];
                    $sub_array[] = $row["asig_cred"];
                    $sub_array[] = $row["asig_horas"];
                    $sub_array[] = $row["seme_nombre"];
                
                    $sub_array[] = '<button type="button" onClick="editar('.$row["asig_id"].');"  id="'.$row["asig_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["asig_id"].');"  id="'.$row["asig_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
            $datos=$asignatura->asignaturas();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['asig_id']."'>".$row['asig_nom']." ".$row['asig_alfa']." ".$row['asig_nrc']."</option>";
                }
                echo $html;
            }
            break;
        case "guardar_desde_excel":
            $asignatura->insert_asignatura($_POST["asig_nom"],$_POST["asig_alfa"],$_POST["asig_nrc"],$_POST["asig_cred"],$_POST["asig_horas"],$_POST["seme_id"]);
            break;

        case "listar_asignaturas":
            $datos=$asignatura->asignaturas_mantenimiento($_POST["est_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                //columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = "<input type='checkbox' name='detallecheck[]' value='". $row["asig_id"] ."'>";
                $sub_array[] = $row["asig_nom"];
                $sub_array[] = $row["asig_alfa"];
                $sub_array[] = $row["asig_nrc"];
                $sub_array[] = $row["asig_cred"];
                $sub_array[] = $row["asig_horas"];
            
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
        
         
     
    }
?>