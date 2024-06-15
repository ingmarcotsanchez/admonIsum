<?php
    require_once("../config/conexion.php");
    require_once("../models/Semillero.php");
    $semillero = new Semillero();

    switch($_GET["opc"]){
        
        case "guardaryeditar":
            if(empty($_POST["sem_id"])){
                $semillero->insert_semillero($_POST["sem_nom"],$_POST["sem_anno"],$_POST["prof_id"],$_POST["grup_id"],$_POST["linea_id"],$_POST["sublinea_id"],$_POST["sem_mision"],$_POST["sem_vision"],$_POST["sem_objetivo"]);
            }else{
                $semillero->update_semillero($_POST["sem_id"],$_POST["sem_nom"],$_POST["sem_anno"],$_POST["prof_id"],$_POST["grup_id"],$_POST["linea_id"],$_POST["sublinea_id"],$_POST["sem_mision"],$_POST["sem_vision"],$_POST["sem_objetivo"]);
            }
            break;
        case "mostrar":
            $datos = $semillero->semillero_id($_POST["sem_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["sem_id"] = $row["sem_id"];
                    $output["sem_nom"] = $row["sem_nom"];
                    $output["sem_anno"] = $row["sem_anno"];
                    $output["prof_id"] = $row["prof_id"];
                    $output["grup_id"] = $row["grup_id"];
                    $output["linea_id"] = $row["linea_id"];
                    $output["sublinea_id"] = $row["sublinea_id"];
                    $output["sem_mision"] = $row["sem_mision"];
                    $output["sem_vision"] = $row["sem_vision"];
                    $output["sem_objetivo"] = $row["sem_objetivo"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $semillero->delete_semillero($_POST["sem_id"]);
            break;
        case "listar":
            $datos=$semillero->lideresxsemillero();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                //columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = $row["sem_nom"];
                $sub_array[] = $row["sem_anno"];
                $sub_array[] = $row["prof_nom"] ." ". $row["prof_apep"] ." ". $row["prof_apem"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["sem_id"].');"  id="'.$row["sem_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["sem_id"].');"  id="'.$row["sem_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                $sub_array[] = '<button type="button" onClick="detalle_semillero('.$row["sem_id"].');"  id="'.$row["sem_id"].'" class="btn btn-outline-dark btn-icon"><i class="bx bx-book-content"></i></button>';
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
            $datos=$semillero->semilleros();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['sem_id']."'>".$row['sem_nom']."</option>";
                }
                echo $html;
            }
            break;
        
        
            
     
    }
?>