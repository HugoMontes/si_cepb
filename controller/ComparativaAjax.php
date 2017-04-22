<?php
function getControllerByTabla($tabla_indicador){
	if($tabla_indicador=='indicador_historico'){
		require_once("HistoricosController.php");
		$controller=new HistoricosController("../conexion/conexion.php");
	}elseif($tabla_indicador=='indicador_coyuntura'){
		require_once("CoyunturaController.php");
		$controller=new CoyunturaController("../conexion/conexion.php");		
	}elseif($tabla_indicador=='indicador_internacional'){
		require_once("InternacionalController.php");
		$controller=new InternacionalController("../conexion/conexion.php");
	}
	return $controller;
}

require_once("../config/config.php");
$proceso=$_REQUEST['proceso'];
//$indicador=$_REQUEST['indicador'];

if($proceso=='buscaActividadEconomica'){
	$controller=getControllerByTabla($_REQUEST['tabla_indicador']);
	$registros=$controller->getAllActividad();
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['id']."'>".$reg['descripcion']."</option>";
	}
	echo $out;
}else if($proceso=='buscaGrupo'){
	$controller=getControllerByTabla($_REQUEST['tabla_indicador']);
	$id=$_REQUEST['id'];
	$registros=$controller->getAllGrupoByIdActividad($id);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['tabla']."'>".$reg['campos']."</option>";
	}
	echo $out;
}elseif($proceso=='buscaDesagregacion'){
	$controller=getControllerByTabla($_REQUEST['tabla_indicador']);
	$tabla=$_REQUEST['tabla'];
	$registros=$controller->getAllDesagregacionByNameTabla($tabla);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['desagregacion']."'>".$reg['desagregacion']."</option>";
	}
	echo $out;
}elseif($proceso=='buscaMedicion'){
	$controller=getControllerByTabla($_REQUEST['tabla_indicador']);
	$tabla=$_REQUEST['tabla'];
	$desagregacion=$_REQUEST['desagregacion'];
	$registros=$controller->getAllMedicion($tabla,$desagregacion);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['medicion_indicador']."'>".$reg['medicion_indicador']."</option>";
	}
	echo $out;
}elseif($proceso=='buscaCobertura'){
	$controller=getControllerByTabla($_REQUEST['tabla_indicador']);
	$tabla=$_REQUEST['tabla'];
	$desagregacion=$_REQUEST['desagregacion'];
	$medicion=$_REQUEST['medicion'];
	$registros=$controller->getAllCobertura($tabla,$desagregacion,$medicion);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['C']."'>".$reg['C']."</option>";
	}
	echo $out;
}elseif($proceso=='buscaIndicador'){
	$controller=getControllerByTabla($_REQUEST['tabla_indicador']);
	$tabla=$_REQUEST['tabla'];
	$desagregacion=$_REQUEST['desagregacion'];
	$medicion=$_REQUEST['medicion'];
	$cobertura=$_REQUEST['cobertura'];
	$registros=$controller->getAllIndicador($tabla,$desagregacion,$medicion,$cobertura);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['B']."'>".$reg['B']."</option>";
	}
	echo $out;
}elseif($proceso=='buscaDescripcion'){
	$controller=getControllerByTabla($_REQUEST['tabla_indicador']);
	$tabla=$_REQUEST['tabla'];
	$desagregacion=$_REQUEST['desagregacion'];
	$medicion=$_REQUEST['medicion'];
	$cobertura=$_REQUEST['cobertura'];
	$indicador=$_REQUEST['indicador'];
	$registros=$controller->getAllDescripcion($tabla,$desagregacion,$medicion,$cobertura,$indicador);
	
	$fila_indicador=array();
	while ($reg=mysqli_fetch_array($registros)){
		$fila_indicador[]=array('id'=>$reg['id'],'descripcion'=>$reg['descripcion']);
	}
	$ruta_xlsx=$controller->getRutaXlsx($tabla,$indicador);
	$data=array(
		'indicador' => $fila_indicador,
		'ruta_xlsx' => BASE_URL.$ruta_xlsx,
	);
	header('Content-type: application/json; charset=utf-8');
    echo json_encode($data,JSON_NUMERIC_CHECK);
    exit();	
}elseif($proceso=='buscaPeriodicidad'){
	$controller=getControllerByTabla($_REQUEST['tabla_indicador']);
	$tabla=$_REQUEST['tabla'];
	$id=$_REQUEST['id'];
	$registros=$controller->getPeriodos($tabla, $id);
	$out='';
	foreach ($registros as $key => $value) {
		$out.="<option  value='".$key."'>".$value."</option>";
	}
	echo $out;
}elseif($proceso=='imprimirResultados'){
	$controller=getControllerByTabla($_REQUEST['tabla_indicador']);
	$tabla=$_REQUEST['tabla'];
	$id=$_REQUEST['id'];
	$ini=$_REQUEST['ini'];
	$fin=$_REQUEST['fin'];
	
	$gestion=$controller->getNombreColumnas($id,$tabla,$ini,$fin);
	$series=$controller->getSerie($id,$tabla,$ini,$fin);
	
	$reg_indicador=$controller->getIndicadorById($id,$tabla);
	$descripcion=$reg_indicador['DESCRIPCION'];

	$titulo=array('text'=>$reg_indicador['B']);

	$subtitulo=array('text'=>$descripcion);
	$tituloy=array('text'=>$reg_indicador['D']);

	// GENERAR SERIE
	$data1=array();
	$data2=array();
	$data3=array();
	for($i=0;$i<count($gestion);$i++) {
		$data1[]=array($series[$i]);
		$data2[]=array($gestion[$i]);
		$data3[]=array('name' => $gestion[$i], 'y' => $series[$i]);
	}
	$serie[] = array('name' => $descripcion, 'data' => $data1);
	// DEFINIR CATEGORIAS EN X
	$categorias[] = array('categories' => $data2);
	// SERIE TORTA
	$serie_torta[] =array('name' => $descripcion, 'data' => $data3);
	// DEFINIR CHAR
	$char=array(
		'titulo'=>$titulo,
		'subtitulo'=>$subtitulo,
		//'subtitulo'=>$descripcion,
		'serie'=>$serie,
		'categorias'=>$categorias,
		'tituloy'=>$tituloy,
		'serie_torta'=>$serie_torta,
	);
	header('Content-type: application/json; charset=utf-8');
    echo json_encode($char,JSON_NUMERIC_CHECK);
    exit();	
}
