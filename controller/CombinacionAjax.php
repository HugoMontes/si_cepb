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
}elseif($proceso=='buscaIndicadorByMedicion'){
	$actividad=$_REQUEST['actividad'];
	$medicion=$_REQUEST['medicion'];
	$registros=$controller->getAllNombresIndicadoresByNameActividadAndMedicion($actividad,$medicion);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['B']."'>".strtoupper($reg['B'])."</option>";
	}
	echo $out;
}elseif($proceso=='generarTabla'){
	$actividad1=$_REQUEST['actividad1'];
	$indicador1=$_REQUEST['indicador1'];
	$medicion=$_REQUEST['medicion'];
	$ini=$_REQUEST['ini'];
	$fin=$_REQUEST['fin'];
	$actividad2=strval($_REQUEST['actividad2']);
	$indicador2=strval($_REQUEST['indicador2']);
	

	$indicadores=array();
	//$row=$controller->getIndicadorById($indicador1);
	$row1=$controller->getIndicadorByActividadBMedicion($actividad1,$indicador1,$medicion);
	$serie1=$controller->getSerieByIndicador($row1);
	$indicadores[0]=array('name'=>$row1[6],'data'=>$serie1);

	//$row=$controller->getIndicadorById($indicador2);
	$row2=$controller->getIndicadorByActividadBMedicion($actividad2,$indicador2,$medicion);
	$serie2=$controller->getSerieByIndicador($row2);
	$indicadores[1]=array('name'=>$row2[6],'data'=>$serie2);
	
	/*
	$id_indicadores=$_REQUEST['cbxIndicador'];
	$indicadores=array();
	foreach ($id_indicadores as $indicador) {
		$row=$controller->getIndicadorById($indicador);
		$serie=$controller->getSerieByIndicador($row);
		$indicadores[]=array('name'=>$row[5],'data'=>$serie);
	}
	*/

	
	$gestiones=array('categories' => $controller->getNombreColumnas());
	$titulo=array('text'=>'Grafica Lineal Combinada');
	$char=array(
		'titulo'=>$titulo,
		'serie'=>$indicadores,
		'categorias'=>$gestiones,
	);
	

	/*
	$char=array(
		'medicion'=>$medicion,
		'actividad1'=>$actividad1,
		'indicador1'=>$indicador1,
		//'ini'=>$ini,
		//'fin'=>$fin,
		'actividad2'=>$actividad2,
		'indicador2'=>$indicador2,
		'row1'=>$row1,
		'row2'=>$row2,

	);
	*/
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($char,JSON_NUMERIC_CHECK);
	exit();	
	
}


