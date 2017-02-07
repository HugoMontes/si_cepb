<?php
require_once("../../controller/HistoricosController.php");
$controller=new HistoricosController("../../conexion/conexion.php");
/*
$result=$controller->getCoberturaByIndicador('coptributaria', 'COPARTICIPACIÓN TRIBUTARIA, SEGÚN UNIVERSIDAD');
echo "salida: ";
print_r(mysqli_fetch_array($result));
*/
$gestion=$controller->getNombreColumnas('coptributaria',9,35);
echo 'Gestion: <br/>';
// print_r($gestion);
foreach ($gestion as $valor) {
	echo $valor.', ';
}

echo '<br/><br/><br/>';
$series=$controller->getSerie('coptributaria',9,35);
echo 'Serie: <br/>';
//print_r($series);
foreach ($series as $valor) {
	echo $valor.', ';
}

echo '<br/><br/><br/>';
$descripcion=$controller->getDescripcionByTabla('coptributaria');
echo 'Descripcion Tabla: <br/>';
print_r($descripcion);
echo '<br/><br/><br/>';
$cobertura=$controller->getCoberturaByTabla('coptributaria');
echo 'Cobertura: <br/>';
print_r($cobertura);
echo '<br/><br/><br/>';
