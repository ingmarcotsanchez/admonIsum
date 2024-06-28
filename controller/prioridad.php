<?php
    require_once("../config/conexion.php");
    require_once("../models/Prioridad.php");
    $prioridad = new Prioridad();

    switch($_GET["opc"]){
        case "guardaryeditar":
            if(empty($_POST["prio_id"])){
                //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                $prioridad->insert_prioridad($_POST["prio_nom"]);
            }else{
                $prioridad->update_prioridad($_POST["prio_id"], $_POST["prio_nom"]);
            }
            break;
    case "mostrar":
            $datos = $prioridad->prioridad_id($_POST["prio_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["prio_id"] = $row["prio_id"];
                    $output["prio_nom"] = $row["prio_nom"];
                }
                echo json_encode($output);
            }
            break;
    case "eliminar":
            $prioridad->delete_prioridad($_POST["prio_id"]);
            break;
    case "listar":
            $datos=$prioridad->prioridad();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                //columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = $row["prio_nom"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["prio_id"].');"  id="'.$row["prio_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["prio_id"].');"  id="'.$row["prio_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                
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
            $datos = $prioridad->get_prioridad();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['prio_id']."'>".$row['prio_nom']."</option>";
                }
                echo $html;
            }
        break;
    }
?>