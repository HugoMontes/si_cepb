<?php
require_once("LoginController.php");
$controller=new LoginController("../conexion/conexion.php");
if($_GET['action']=='index'){
	$controller->index();
}else if($_POST['action']=='login'){
	$controller->login();
}else if($_GET['action']=='listar'){
	echo 'LISTAR';
}else{
	echo '404';
}