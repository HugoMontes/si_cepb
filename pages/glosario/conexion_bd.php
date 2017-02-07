<?php
require_once 'configuracion_bd.php';
// connecting to mysql
$con = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
// selecting database
mysql_select_db(DB_NAME,$con);

?>