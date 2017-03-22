<?php
//require_once 'configuracion_bd.php';
require_once '../../conexion/conexion.php';
// connecting to mysql
$con = mysql_connect(cServidor, cUsuario, cPass);
// selecting database
mysql_select_db(cBd,$con);
?>