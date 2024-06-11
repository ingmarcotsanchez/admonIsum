<?php
    require_once("../config/conexion.php");
    require_once("../models/Semestre.php");
    $semestre = new Semestre();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["seme_id"])){
                    //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                    $semestre->insert_semestre($_POST["seme_nombre"]);
                }else{
                    $semestre->update_semestre($_POST["seme_id"], $_POST["seme_nombre"]);
                }
                break;
        case "mostrar":
                $datos = $semestre->semestre_id($_POST["seme_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["seme_id"] = $row["seme_id"];
                        $output["seme_nombre"] = $row["seme_nombre"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $semestre->delete_semestre($_POST["seme_id"]);
                break;
        case "listar":
                $datos=$semestre->semestre();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["seme_nombre"];
                    $sub_array[] = '<button type="button" onClick="editar('.$row["seme_id"].');"  id="'.$row["seme_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["seme_id"].');"  id="'.$row["seme_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
            $datos=$semestre->semestre();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['seme_id']."'>".$row['seme_nombre']."</option>";
                }
                echo $html;
            }
            break;
            
     
    }
?>