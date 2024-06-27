<?php
    require_once("../config/conexion.php");
    require_once("../models/Prioridad.php");
    $prioridad = new Prioridad();

    switch($_GET["opc"]){
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