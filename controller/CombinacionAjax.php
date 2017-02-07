<?php
require_once("../config/config.php");
require_once("CombinacionController.php");
$controller=new CombinacionController("../conexion/conexion.php");

$id_indicadores=$_REQUEST['cbxIndicador'];
$indicadores=array();
foreach ($id_indicadores as $indicador) {
	$row=$controller->getIndicadorById($indicador);
	$serie=$controller->getSerieByIndicador($row);
	$indicadores[]=array('name'=>$row[5],'data'=>$serie);
}
$gestiones=array('categories' => $controller->getNombreColumnas());
$titulo=array('text'=>'Grafica Lineal Combinada');
$char=array(
	'titulo'=>$titulo,
	'serie'=>$indicadores,
	'categorias'=>$gestiones,
);
header('Content-type: application/json; charset=utf-8');
echo json_encode($char,JSON_NUMERIC_CHECK);
exit();	
