<?php
    require_once("../config/conexion.php");
    require_once("../models/Grupo.php");
    $grupo = new Grupo();
    //$prof = $profesor->get_profesorDetallexid($_GET['prof_id']);

    switch($_GET["opc"]){
        case "guardaryeditar":
            
                if(empty($_POST["grup_id"])){
                    $grupo->insert_grupo($_POST["grup_nom"], $_POST["grup_est"]);
                    
                }else{
                    $grupo->update_grupo($_POST["grup_id"], $_POST["grup_nom"], $_POST["grup_est"]);
                }
                break;
        case "mostrar":
                $datos = $grupo->grupos_id($_POST["grup_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["grup_id"] = $row["grup_id"];
                        $output["grup_nom"] = $row["grup_nom"];
                        $output["grup_est"] = $row["grup_est"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $grupo->delete_grupo($_POST["grup_id"]);
                break;
        case "listar":
                $datos=$grupo->grupos();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["grup_nom"];
                    if($row["grup_est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='grup_ina(".$row["grup_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='grup_act(".$row["grup_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["grup_id"].');"  id="'.$row["grup_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["grup_id"].');"  id="'.$row["grup_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
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
            $datos=$grupo->grupos();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['grup_id']."'>".$row['grup_nom']."</option>";
                }
                echo $html;
            }
            break;
        case "activo":
            $grupo->update_estadoActivo($_POST["grup_id"]);
            break;
        case "inactivo":
            $grupo->update_estadoInactivo($_POST["grup_id"]);
            break; 
               
     
    }
?>