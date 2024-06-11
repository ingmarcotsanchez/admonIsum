<?php
    require_once("../config/conexion.php");
    require_once("../models/Info.php");
    $info = new Info();

    switch($_GET["opc"]){
        case "mostrar":
            $datos = $info->info();
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    //$output["info_id"] = $row["info_id"];
                    $output["info_nombre"] = $row["info_nombre"];
                    $output["info_snies"] = $row["info_snies"];
                    $output["info_resolucion"] = $row["info_resolucion"];
                    $output["info_creditos"] = $row["info_creditos"];
                    $output["info_semestres"] = $row["info_semestres"];
                    $output["info_metodologia"] = $row["info_metodologia"];
                    $output["info_nivel"] = $row["info_nivel"];
                }
                echo json_encode($output);
            }
            break;
        case "update_perfil":
            //if($_POST["info_id"] != 0){
                //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                $info->update($_POST["info_nombre"],$_POST["info_snies"],$_POST["info_resolucion"],$_POST["info_creditos"],$_POST["info_semestres"],$_POST["info_metodologia"],$_POST["info_nivel"]);
            //}
            break;
    }