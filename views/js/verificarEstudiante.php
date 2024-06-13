
<?php
//require_once("../../config/conexion.php");
$est_dni    = $_REQUEST['est_dni'];
$usuario  = "root";
$password = "";
$servidor = "localhost";
$basededatos = "isum";
$con = mysqli_connect($servidor, $usuario, $password,$basededatos) or die("No se ha podido conectar al Servidor");

//Verificando si existe algun cliente en bd ya con dicha cedula asignada
//Preparamos un arreglo que es el que contendrá toda la información
$jsonData = array();
$selectQuery   = ("SELECT est_dni FROM estudiante WHERE est_dni='".$est_dni."' ");
$query         = mysqli_query($con, $selectQuery);
$totalCliente  = mysqli_num_rows($query);

  //Validamos que la consulta haya retornado información
  if( $totalCliente <= 0 ){
    $jsonData['success'] = 0;
    $jsonData['message'] = 'No existe Cédula ' .$est_dni;
    $jsonData['message'] = '';
} else{
    //Si hay datos entonces retornas algo
    $jsonData['success'] = 1;
    $jsonData['message'] = '<p style="color:red;">Ya existe el ID <strong>(' .$est_dni.')<strong></p>';
  }

//Mostrando mi respuesta en formato Json
header('Content-type: application/json; charset=utf-8');
echo json_encode( $jsonData );
?>