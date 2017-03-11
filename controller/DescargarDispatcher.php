<?php
require_once( '../plugins/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

$tabla=$_REQUEST['tabla'];
$id=$_REQUEST['id'];
$ini=$_REQUEST['ini'];
$fin=$_REQUEST['fin'];
$controlador=$_REQUEST['controlador'];

if($controlador=='historico'){
	require_once("HistoricosController.php");
	$controller=new HistoricosController("../conexion/conexion.php");
}elseif($controlador=='coyuntura'){
	require_once("CoyunturaController.php");
	$controller=new CoyunturaController("../conexion/conexion.php");
}elseif($controlador=='internacionales'){
	require_once("InternacionalController.php");
	$controller=new InternacionalController("../conexion/conexion.php");
}

if($_GET['action']=='pdf'){
	//$id=$controller->getIdIndicador($indicador,$departamental,$indicador2,$descripcion);
	$gestion=$controller->getNombreColumnas($id,$tabla,$ini,$fin);
	$series=$controller->getSerie($id,$tabla,$ini,$fin);

	$table='';
	for($i=0;$i<count($gestion);$i++) {
		$table.='<tr>';
		$table.='<td>'.$gestion[$i].'</td>';
		$table.='<td>'.$series[$i].'</td>';
		$table.='</tr>';
	}

	$indicador=$controller->getIndicadorById($id,$tabla);
  	$dompdf= new DOMPDF();
  	$html='
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>'.$indicador['B'].'</title>
	<!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	</head>
	<body>
	<h3 style="text-align: center;">'.$indicador['B'].'</h3>
	<hr>
	<h3 style="text-align: center;">'.$indicador['DESCRIPCION'].'</h3>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>GESTIÓN</th>
				<th>'.$indicador['D'].'</th>
			</tr>
		</thead>
		<tbody>'.$table.'</tbody>
	</table>
	</body>
	</html>';
  	$dompdf->load_html($html);
  	ini_set("memory_limit","128M");
  	$dompdf->render();
  	$dompdf->stream("cepb_pdf");
	echo 'PDF...';
}elseif ($_GET['action']=='excel') {
	//$id=$controller->getIdIndicador($indicador,$departamental,$indicador2,$descripcion);
	$gestion=$controller->getNombreColumnas($id,$tabla,$ini,$fin);
	$series=$controller->getSerie($id,$tabla,$ini,$fin);
	$indicador=$controller->getIndicadorById($id,$tabla);
    require_once("../lib/PHPExcel/PHPExcel.php");
    //require_once('../lib/PHPExcel/PHPExcel/IOFactory.php');
    $objPHPExcel = new PHPExcel();
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'GESTION');
	$objPHPExcel->getActiveSheet()->SetCellValue('B1', $indicador['D']);
	$rowCount = 2;
	for($i=0;$i<count($gestion);$i++) {
	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $gestion[$i]);
	    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $series[$i]);
	    $rowCount++;
	}
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	// header('Content-type: application/vnd.ms-excel; charset=UTF-8');
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header("Content-Disposition: attachment; filename=reports.xlsx");
    // header("Pragma: no-cache");
    // header("Expires: 0");
	ob_clean();
	$objWriter->save('php://output');
	//$objWriter->save('some_excel_file.xlsx');
}