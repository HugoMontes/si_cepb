<?php
//$conexion=mysqli_connect("localhost","root","","cepbusuarios") or
//die("Problemas con la conexión");

/*
// CONFIGURACION SERVIDOR
define("cServidor", "localhost");
define("cUsuario", "formaem4_cepb");
define("cPass","zse45tgb");
define("cBd","formaem4_cepb");
*/

// CONFIGURACION LOCAL
define("cServidor", "localhost");
define("cUsuario", "root");
define("cPass",null);
define("cBd","formaem4_cepb");

$conexion = mysqli_connect(cServidor, cUsuario, cPass, cBd);
$acentos = $conexion->query("SET NAMES 'utf8'");
/*
$consulta = 'SELECT cuenta,valor FROM datosprueba';
$resultado = mysqli_query($conexion, $consulta);
*/

$numcolumnas=26;
/*mysql_close($conexion);
*/

?>

