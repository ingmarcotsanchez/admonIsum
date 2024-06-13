
<?php
//require_once("../../config/conexion.php");
$alfanumerico    = $_REQUEST['asig_alfa'];
$usuario  = "root";
$password = "";
$servidor = "localhost";
$basededatos = "isum";
$con = mysqli_connect($servidor, $usuario, $password,$basededatos) or die("No se ha podido conectar al Servidor");

//Verificando si existe algun cliente en bd ya con dicha cedula asignada
//Preparamos un arreglo que es el que contendrá toda la información
$jsonData = array();
$selectQuery   = ("SELECT asig_alfa FROM asignatura WHERE asig_alfa='".$alfanumerico."' ");
$query         = mysqli_query($con, $selectQuery);
$totalCliente  = mysqli_num_rows($query);

  //Validamos que la consulta haya retornado información
  if( $totalCliente <= 0 ){
    $jsonData['success'] = 0;
    $jsonData['message'] = 'No existe Asignatura ' .$alfanumerico;
    $jsonData['message'] = '';
} else{
    //Si hay datos entonces retornas algo
    $jsonData['success'] = 1;
    $jsonData['message'] = '<p style="color:red;">Ya existe la Asignatura <strong>(' .$alfanumerico.')<strong></p>';
  }

//Mostrando mi respuesta en formato Json
header('Content-type: application/json; charset=utf-8');
echo json_encode( $jsonData );
?>