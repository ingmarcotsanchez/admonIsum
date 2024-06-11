<?php
    require_once("../config/conexion.php");
    require_once("../models/Factor.php");
    $factor = new Factor();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["fac_id"])){
                    //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                    $factor->insert_factor($_POST["fac_cod"],$_POST["fac_nombre"]);
                }else{
                    $factor->update_factor($_POST["fac_id"], $_POST["fac_cod"], $_POST["fac_nombre"]);
                }
                break;
        case "mostrar":
                $datos = $factor->factor_id($_POST["fac_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["fac_id"] = $row["fac_id"];
                        $output["fac_cod"] = $row["fac_cod"];
                        $output["fac_nombre"] = $row["fac_nombre"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $factor->delete_factor($_POST["fac_id"]);
                break;
        case "listar":
                $datos=$factor->factor();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["fac_cod"];
                    $sub_array[] = $row["fac_nombre"];
                    $sub_array[] = '<button type="button" onClick="editar('.$row["fac_id"].');"  id="'.$row["fac_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["fac_id"].');"  id="'.$row["fac_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
            $datos=$factor->factor();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['fac_id']."'>".$row['fac_cod']." - ".$row['fac_nombre']."</option>";
                }
                echo $html;
            }
            break;
            
     
    }
?>