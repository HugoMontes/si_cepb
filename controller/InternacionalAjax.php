<?php
require_once("../config/config.php");
require_once("InternacionalController.php");
$controller=new InternacionalController("../conexion/conexion.php");

$proceso=$_REQUEST['proceso'];

if($proceso=='buscaPaises'){
	$tabla=$_REQUEST['tabla'];
	$registros=$controller->getAllPaises($tabla);	

	$paises=array();
	while ($reg=mysqli_fetch_array($registros)){
		$paises[]=$reg['pais'];
	}
	$indicador=$controller->getByTableIndicador($tabla);
	$data=array(
		'paises' => $paises,
		'ruta_xls' => BASE_URL.$indicador['ruta'].'/'.$indicador['archivo'],
	);
	header('Content-type: application/json; charset=utf-8');
    echo json_encode($data,JSON_NUMERIC_CHECK);
    exit();
	//echo $out;
}elseif($proceso=='buscaDescripcion'){
	$tabla=$_REQUEST['tabla'];
	$registros=$controller->getAllClasificacionByNameTabla($tabla);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['clasificacion']."'>".$reg['clasificacion']."</option>";
	}
	echo $out;
}elseif($proceso=='buscaPeriodicidad'){
	$tabla=$_REQUEST['tabla'];
	$registros=$controller->getPeriodos($tabla);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['anio']."'>".$reg['anio']."</option>";
	}
	echo $out;
}elseif($proceso=='imprimirResultados'){
	$tabla=$_REQUEST['tabla'];
	$descripcion=$_REQUEST['descripcion'];
	$pais1=$_REQUEST['pais1'];
	$pais2=$_REQUEST['pais2'];
	$periodo=$_REQUEST['periodo'];
	
	$reg1=$controller->getIndicePais($tabla, $descripcion, $pais1, $periodo);
	$reg2=$controller->getIndicePais($tabla, $descripcion, $pais2, $periodo);
	
	$data=array(
		'title'=>$reg1['clasificacion'],
		'subtitle'=>$periodo,
		'descripcion'=>$descripcion,
		'pais1'=>array('nombre'=>$pais1,'monto'=>$reg1['monto']),
		'pais2'=>array('nombre'=>$pais2,'monto'=>$reg2['monto']),
	);
	header('Content-type: application/json; charset=utf-8');
    echo json_encode($data,JSON_NUMERIC_CHECK);
    exit();
}

