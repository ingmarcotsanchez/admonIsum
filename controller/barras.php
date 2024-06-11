<?php
require_once("../config/conexion.php");
require_once("../models/Barras.php");

$Barra = new Barra();

switch ($_GET["opc"]) {
    case "actualizarBarras":
        $inicio = "2017";  
        $fin = date('Y');   

        $datos = $Barra->obtenerEstudiantesPorRangoDeAños($inicio, $fin); 

        $datosJson = json_encode($datos);

        echo $datosJson;
        break;
}
?>

