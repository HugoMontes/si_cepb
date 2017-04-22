<?php
require_once("../config/config.php");
require_once("CombinacionController.php");
$controller=new CombinacionController("../conexion/conexion.php");
$proceso=$_REQUEST['proceso'];
if($proceso=='buscaIndicador'){
	$actividad=$_REQUEST['actividad'];
	$registros=$controller->getAllNombresIndicadoresByNameActividad($actividad);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['B']."'>".strtoupper($reg['B'])."</option>";
	}
	echo $out;
}elseif($proceso=='buscaMedicionIndicador'){
	$actividad=$_REQUEST['actividad'];
	$indicador=$_REQUEST['indicador'];
	$registros=$controller->getAllMedicionesIndicador($actividad,$indicador);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['D']."'>".$reg['D']."</option>";
	}
	echo $out;
}elseif($proceso=='buscaPeriodicidadGeneral'){
	// begin : Recuperando periodos
	$registros=$controller->getAllPeriodo();
	$periodos=array();
	foreach ($registros as $key => $value) {
		$periodos[]=array('key'=>$key,'value'=>$value);
	}
	// end : Recuperando periodos

	// begin : Recuperando actividades economicas por medicion
	$medicion=$_REQUEST['medicion'];
	$registros=$controller->getActividadesEconomicasByMedicion($medicion);
	$actividades=array();
	while ($reg=mysqli_fetch_array($registros)) {
		$actividades[]=array('actividad'=>$reg['actividad']);
	}
	// end : Recuperando actividades economicas por medicion

	$data=array(
		'periodos'=>$periodos,
		'actividades'=>$actividades,
	);
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($data,JSON_NUMERIC_CHECK);
	exit();	
}

/*
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
*/