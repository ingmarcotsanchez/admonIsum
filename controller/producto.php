<?php
    require_once("../config/conexion.php");
    require_once("../models/Producto.php");
    $producto = new Producto();

    switch($_GET["opc"]){
        
        case "guardaryeditar":
            if(empty($_POST["prod_id"])){
                $producto->insert_producto($_POST["prod_nom"],$_POST["prod_tipo"],$_POST["prod_anno"],$_POST["sem_id"]);
            }else{
                $producto->update_producto($_POST["prod_id"],$_POST["prod_nom"],$_POST["prod_tipo"],$_POST["prod_anno"],$_POST["sem_id"]);
            }
            break;
        case "mostrar":
            $datos = $producto->producto_id($_POST["prod_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["prod_id"] = $row["prod_id"];
                    $output["prod_nom"] = $row["prod_nom"];
                    $output["prod_tipo"] = $row["prod_tipo"];
                    $output["prod_anno"] = $row["prod_anno"];
                    $output["sem_id"] = $row["sem_id"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $producto->delete_producto($_POST["prod_id"]);
            break;
        case "listar":
            $datos = $producto->productos();
            $data = array();
            foreach ($datos as $row) {
                $sub_array = array();
                // columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = $row["prod_nom"];
                if($row["prod_tipo"] == 'AD'){
                    $sub_array[] = "Artículo Divulgativo";
                }elseif ($row["prod_tipo"] == 'AS'){
                    $sub_array[] = "Artículo Scopus";
                }elseif ($row["prod_tipo"] == 'DS'){
                    $sub_array[] = "Desarrollo de Software";
                }elseif ($row["prod_tipo"] == 'PI'){
                    $sub_array[] = "Ponencia Interna";
                }elseif ($row["prod_tipo"] == 'PE'){
                    $sub_array[] = "Ponencia Externa";
                }elseif ($row["prod_tipo"] == 'CL'){
                    $sub_array[] = "Capitulo de libro";
                }elseif ($row["prod_tipo"] == 'OT'){
                    $sub_array[] = "Otros";
                }else{
                    $sub_array[] = "Sin Categoría";
                }
                $sub_array[] = $row["prod_anno"];
                $sub_array[] = $row["sem_nom"];
                $sub_array[] = '<button type="button" onClick="editar(' .$row["prod_id"]. ');"  id="' .$row["prod_id"] . '" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar(' .$row["prod_id"]. ');"  id="' .$row["prod_id"] . '" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                
                $data[] = $sub_array;
            }
            
            // Formatea los datos en el formato requerido por DataTable
            $results = array(
                "draw" => 1,
                "recordsTotal" => count($data),
                "recordsFiltered" => count($data),
                "data" => $data
            );
        
            echo json_encode($results);
            break;
            
        
            
     
    }
?>