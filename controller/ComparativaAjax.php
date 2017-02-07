<?php
function getControllerByTabla($tabla){
	if($tabla=='indicador_historico'){
		require_once("HistoricosController.php");
		$controller=new HistoricosController("../conexion/conexion.php");
	}elseif($tabla=='indicador_coyuntura'){
		require_once("CoyunturaController.php");
		$controller=new CoyunturaController("../conexion/conexion.php");		
	}elseif($tabla=='indicador_internacional'){
		require_once("InternacionalController.php");
		$controller=new InternacionalController("../conexion/conexion.php");
	}
	return $controller;
}

require_once("../config/config.php");
$proceso=$_REQUEST['proceso'];
$indicador=$_REQUEST['indicador'];

if($proceso==0){
	$controller=getControllerByTabla($_REQUEST['tabla']);
	$registros=$controller->getAllActividadEconomica();
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.='<option  value="'.$reg['tabla'].'">'.$reg['campos'].'</option>';
	}
	echo $out;
}elseif($proceso==1){
	$controller=getControllerByTabla($_REQUEST['tabla']);
	$registros=$controller->getIndicadorByIdTabla($indicador);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['B']."'>".$reg['B']."</option>";
	}
	echo $out;
}elseif($proceso==2){
	$controller=getControllerByTabla($_REQUEST['tabla']);
	$indicador2=$_REQUEST['indicador2'];
	$registros=$controller->getCoberturasByIndicador($indicador,$indicador2);
	$cobertura=array();
	while ($reg=mysqli_fetch_array($registros)){
		$cobertura[]=$reg['C'];
	}
	$ruta_xlsx=$controller->getRutaXlsx($indicador, $indicador2, $cobertura[0]);
	$data=array(
		'cobertura' => $cobertura,
		'ruta_xlsx' => BASE_URL.$ruta_xlsx,
	);
	header('Content-type: application/json; charset=utf-8');
    echo json_encode($data,JSON_NUMERIC_CHECK);
    exit();	
}elseif($proceso==3){
	$controller=getControllerByTabla($_REQUEST['tabla']);
	$departamental=$_REQUEST['departamental'];
	$indicador2=$_REQUEST['indicador2'];
	$registros=$controller->getDescripcionByIndicador($indicador,$departamental,$indicador2);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['DESCRIPCION']."'>".$reg['DESCRIPCION']."</option>";
	}
	echo $out;
}elseif($proceso==4){
	$controller=getControllerByTabla($_REQUEST['tabla']);
	$descripcion=$_REQUEST['descripcion'];
	$departamental=$_REQUEST['departamental'];
	$indicador2=$_REQUEST['indicador2'];
	$id=$controller->getIdIndicador($indicador,$departamental,$indicador2,$descripcion);
	$registros=$controller->getPeriodos($id,$indicador,$departamental,$indicador2,$descripcion);
	$out='';
	foreach ($registros as $key => $value) {
		$out.="<option  value='".$key."'>".$value."</option>";
	}
	echo $out;
}elseif($proceso==5){
	$controller=getControllerByTabla($_REQUEST['tabla']);
	$ini=$_REQUEST['ini'];
	$fin=$_REQUEST['fin'];
	$descripcion=$_REQUEST['descripcion'];
	$departamental=$_REQUEST['departamental'];
	$indicador2=$_REQUEST['indicador2'];

	$id=$controller->getIdIndicador($indicador,$departamental,$indicador2,$descripcion);
	
	$gestion=$controller->getNombreColumnas($id,$indicador,$ini,$fin);
	$series=$controller->getSerie($id,$indicador,$ini,$fin);
	
	$reg_indicador=$controller->getIndicadorById($id,$indicador);
	$descripcion=$reg_indicador['DESCRIPCION'];
	$cobertura=$reg_indicador['C'];
	$titulo=array('text'=>$reg_indicador['B']);
	$subtitulo=array('text'=>$cobertura);
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
		'serie'=>$serie,
		'categorias'=>$categorias,
		'tituloy'=>$tituloy,
		'serie_torta'=>$serie_torta,
	);
	header('Content-type: application/json; charset=utf-8');
    echo json_encode($char,JSON_NUMERIC_CHECK);
    exit();	
}

