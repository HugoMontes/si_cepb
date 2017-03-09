<?php
require_once("../config/config.php");
require_once("HistoricosController.php");
$controller=new HistoricosController("../conexion/conexion.php");

$proceso=$_REQUEST['proceso'];


if($proceso=='buscaGrupo'){
	$id=$_REQUEST['id'];
	$registros=$controller->getAllGrupoByIdActividad($id);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['tabla']."'>".$reg['campos']."</option>";
	}
	echo $out;
}elseif($proceso=='buscaDesagregacion'){
	$tabla=$_REQUEST['tabla'];
	$registros=$controller->getAllDesagregacionByNameTabla($tabla);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['desagregacion']."'>".$reg['desagregacion']."</option>";
	}
	echo $out;
}elseif($proceso=='buscaMedicion'){
	$tabla=$_REQUEST['tabla'];
	$desagregacion=$_REQUEST['desagregacion'];
	$registros=$controller->getAllMedicion($tabla,$desagregacion);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['medicion_indicador']."'>".$reg['medicion_indicador']."</option>";
	}
	echo $out;
}elseif($proceso=='buscaCobertura'){
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
}elseif($proceso==3){
	$indicador=$_REQUEST['indicador'];
	$departamental=$_REQUEST['departamental'];
	$indicador2=$_REQUEST['indicador2'];
	$registros=$controller->getDescripcionByIndicador($indicador,$departamental,$indicador2);
	$out='';
	while ($reg=mysqli_fetch_array($registros)){
		$out.="<option  value='".$reg['DESCRIPCION']."'>".$reg['DESCRIPCION']."</option>";
	}
	echo $out;
}elseif($proceso==4){
	$indicador=$_REQUEST['indicador'];
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
	$indicador=$_REQUEST['indicador'];
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

