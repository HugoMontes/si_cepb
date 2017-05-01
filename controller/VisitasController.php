<?php 
class VisitasController{
	
	private $conexion;

	function __construct($conexion){
		$this->conexion=$conexion;
	}

	function save_visita($nombre_seccion){
		$fecha_actual=date("Y-m-d H:i:s");
		$registros=mysqli_query($this->conexion,"INSERT INTO adm_visitas (seccion, fecha_visita) VALUES ('$nombre_seccion', '$fecha_actual');") or die("Problemas en el select:".mysqli_error($this->conexion));
		return true;
	}
}
