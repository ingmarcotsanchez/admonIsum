<?php
    require_once("../config/conexion.php");
    require_once("../models/Linea.php");
    $linea = new Linea();
    //$prof = $profesor->get_profesorDetallexid($_GET['prof_id']);

    switch($_GET["opc"]){
        case "guardaryeditar":
            
                if(empty($_POST["linea_id"])){
                    $linea->insert_linea($_POST["linea_nom"], $_POST["linea_est"]);
                    
                }else{
                    $linea->update_linea($_POST["linea_id"], $_POST["linea_nom"], $_POST["linea_est"]);
                }
                break;
        case "mostrar":
                $datos = $linea->lineas_id($_POST["linea_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["linea_id"] = $row["linea_id"];
                        $output["linea_nom"] = $row["linea_nom"];
                        $output["linea_est"] = $row["linea_est"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $linea->delete_linea($_POST["linea_id"]);
                break;
        case "listar":
                $datos=$linea->lineas();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["linea_nom"];
                    if($row["linea_est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='linea_ina(".$row["linea_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='linea_act(".$row["linea_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["linea_id"].');"  id="'.$row["linea_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["linea_id"].');"  id="'.$row["linea_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
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
            $datos=$linea->lineas();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['linea_id']."'>".$row['linea_nom']."</option>";
                }
                echo $html;
            }
            break;
        case "activo":
            $linea->update_estadoActivo($_POST["linea_id"]);
            break;
        case "inactivo":
            $linea->update_estadoInactivo($_POST["linea_id"]);
            break; 
               
     
    }
?>