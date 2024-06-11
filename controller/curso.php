<?php
    require_once("../config/conexion.php");
    require_once("../models/Curso.php");
    $curso = new Curso();

    switch($_GET["opc"]){
        case "guardaryeditar":
            if(empty($_POST["cur_id"])){
                //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                $curso->insert_curso($_POST["id_categoria"], $_POST["nombre"], $_POST["descripcion"], $_POST["fecha_ini"], $_POST["fecha_fin"], $_POST["profesor"]);
            }else{
                $curso->update_curso($_POST["cur_id"], $_POST["id_categoria"], $_POST["nombre"], $_POST["descripcion"], $_POST["fecha_ini"], $_POST["fecha_fin"], $_POST["profesor"]);
            }
            break;
        case "mostrar":
            $datos = $curso->curso_id($_POST["cur_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["cur_id"] = $row["cur_id"];
                    $output["id_categoria"] = $row["id_categoria"];
                    $output["curso"] = $row["curso"];
                    $output["descripcion"] = $row["descripcion"];
                    $output["fecha_ini"] = $row["fecha_ini"];
                    $output["fecha_fin"] = $row["fecha_fin"];
                    $output["profesor"] = $row["profesor"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $curso->delete_curso($_POST["cur_id"]);
            break;
        case "listar":
            $datos=$curso->curso();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                //columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = $row["nombre"];
                $sub_array[] = $row["curso"];
                $sub_array[] = $row["fecha_ini"];
                $sub_array[] = $row["fecha_fin"];
                $sub_array[] = $row["nombrei"]." ".$row["ape_paternoi"]." ".$row["ape_maternoi"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["cur_id"].');"  id="'.$row["cur_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["cur_id"].');"  id="'.$row["cur_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                
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

