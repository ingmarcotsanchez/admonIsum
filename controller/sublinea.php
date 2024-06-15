<?php
    require_once("../config/conexion.php");
    require_once("../models/Sublinea.php");
    $sublinea = new Sublinea();
    //$prof = $profesor->get_profesorDetallexid($_GET['prof_id']);

    switch($_GET["opc"]){
        case "guardaryeditar":
            
                if(empty($_POST["sublinea_id"])){
                    $sublinea->insert_sublinea($_POST["sublinea_nom"], $_POST["sublinea_est"]);
                    
                }else{
                    $sublinea->update_sublinea($_POST["sublinea_id"], $_POST["sublinea_nom"], $_POST["sublinea_est"]);
                }
                break;
        case "mostrar":
                $datos = $sublinea->sublineas_id($_POST["sublinea_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["sublinea_id"] = $row["sublinea_id"];
                        $output["sublinea_nom"] = $row["sublinea_nom"];
                        $output["sublinea_est"] = $row["sublinea_est"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $sublinea->delete_sublinea($_POST["sublinea_id"]);
                break;
        case "listar":
                $datos=$sublinea->sublineas();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["sublinea_nom"];
                    if($row["sublinea_est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='sublinea_ina(".$row["sublinea_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='sublinea_act(".$row["sublinea_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["sublinea_id"].');"  id="'.$row["sublinea_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["sublinea_id"].');"  id="'.$row["sublinea_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
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
            $datos=$sublinea->sublineas();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['sublinea_id']."'>".$row['sublinea_nom']."</option>";
                }
                echo $html;
            }
            break;
        case "activo":
            $sublinea->update_estadoActivo($_POST["sublinea_id"]);
            break;
        case "inactivo":
            $sublinea->update_estadoInactivo($_POST["sublinea_id"]);
            break; 
               
     
    }
?>