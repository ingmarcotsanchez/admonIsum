<?php
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");
    $usuario = new Usuario();

    switch($_GET["opc"]){
        case "guardaryeditar":
            if(empty($_POST["usu_id"])){
               // $PasswordHash = password_hash($_POST["usu_pass"], PASSWORD_BCRYPT);
                $usuario->insert_usuario($_POST["usu_nom"],$_POST["usu_apep"],$_POST["usu_apem"],$_POST["usu_correo"],$P_POST["usu_pass"],$_POST["usu_rol"]);
            }else{
                //$PasswordHash = password_hash($_POST["usu_pass"], PASSWORD_BCRYPT);
                $usuario->update_usuario($_POST["usu_id"],$_POST["usu_nom"],$_POST["usu_apep"],$_POST["usu_apem"],$P_POST["usu_pass"],$_POST["usu_rol"]);
            }
            break;
        case "crear":
            $usuario->insert_usuario($_POST["usu_nom"],$_POST["usu_apep"],$_POST["usu_apem"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_rol"]);
            break;
        case "mostrar":
            $datos = $usuario->usuario_id($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_apep"] = $row["usu_apep"];
                    $output["usu_apem"] = $row["usu_apem"];
                    $output["usu_correo"] = $row["usu_correo"];
                    $output["usu_pass"] = $row["usu_pass"];
                    $output["usu_rol"] = $row["usu_rol"];
                    $output["est"] = $row["est"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $usuario->delete_usuario($_POST["usu_id"]);
            break;
        case "listar":
            $datos=$usuario->listar();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                //columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = $row["usu_nom"];
                $sub_array[] = $row["usu_apep"];
                $sub_array[] = $row["usu_apem"];
                $sub_array[] = $row["usu_correo"];
                $sub_array[] = $row["usu_rol"];
                $sub_array[] = $row["fech_crea"];
                $sub_array[] = $row["fech_mod"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                
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
       
        case "editPerfil":
            $usuario->update_perfil($_POST["usu_id"],$_POST["usu_pass"]);
            break;

        case "total_Profesores":
            $datos=$usuario->total_profesores();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_Proyectos":
            $datos=$usuario->total_proyectos();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_Semilleros":
            $datos=$usuario->total_semilleros();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
       
        case "total_Productos_unitic":
            $datos=$usuario->total_productos_unitic();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;

    

        case "total_Productos_satsoc":
            $datos=$usuario->total_productos_satsoc();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_Productos_tecnoreciclaje":
            $datos=$usuario->total_productos_tecnoreciclaje();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_Productos_bigdata":
            $datos=$usuario->total_productos_bigdata();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_estudiantes":
            $datos=$usuario->total_estudiantes();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_activos":
            $datos=$usuario->total_activos();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_ausentes":
            $datos=$usuario->total_ausentes();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_desertores":
            $datos=$usuario->total_desertores();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_egresados":
            $datos=$usuario->total_egresados();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_NoGraduados":
            $datos=$usuario->total_NoGraduados();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;

       
    }
?>