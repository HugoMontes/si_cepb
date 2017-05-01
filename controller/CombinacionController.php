<?php 

class CombinacionController{
	
	private $conexion;
	private $tabla;
	private $grupo;

	function __construct($cad_conexion){
		require_once($cad_conexion);
		$this->conexion=$con=$conexion;
		$this->tabla='combinacion';
		$this->grupo='Combinaciones';
	}

	function cuenta_visitas(){
		require_once("VisitasController.php");
		$visitas_controller=new VisitasController($this->conexion);
		$visitas_controller->save_visita($this->grupo);
	}

	function getAllActividadesEconomicas(){
		$this->cuenta_visitas();
		$query = "select DISTINCT actividad from $this->tabla";
		$result = mysqli_query($this->conexion, $query) or die("Problemas en el select:".mysqli_error($this->conexion));
		return $result;
	}

	function getAllNombresIndicadoresByNameActividad($actividad){
		$query = "select DISTINCT B from $this->tabla where actividad='$actividad'";
		$result = mysqli_query($this->conexion, $query) or die("Problemas en el select:".mysqli_error($this->conexion));
		return $result;
	}

	function getAllNombresIndicadoresByNameActividadAndMedicion($actividad,$medicion){
		$query = "select DISTINCT B from $this->tabla where actividad='$actividad' and D='$medicion'";
		$result = mysqli_query($this->conexion, $query) or die("Problemas en el select:".mysqli_error($this->conexion));
		return $result;
	}

	function getAllMedicionesIndicador($actividad,$indicador){
		$query = "select DISTINCT D from $this->tabla where actividad='$actividad' and B='$indicador'";
		$result = mysqli_query($this->conexion, $query) or die("Problemas en el select:".mysqli_error($this->conexion));
		return $result;
	}

	function getAllPeriodo(){
		$query="select * from $this->tabla";
		$result = mysqli_query($this->conexion, $query);
		$fila_data=$result->fetch_assoc();
		$ini=$fila_data['ini'];
		$fin=$fila_data['fin'];
		$fila_head=$result->fetch_fields();
		for($i=$ini;$i<=$fin;$i++){
			$fechas[$i]=$fila_head[$i]->name;
		}
		return $fechas;
	}

	function getActividadesEconomicasByMedicion($medicion){
		$query = "select DISTINCT actividad from $this->tabla where D='$medicion'";
		$result = mysqli_query($this->conexion, $query) or die("Problemas en el select:".mysqli_error($this->conexion));
		return $result;
	}
/*
	function getAllCombinados(){
		$query = "select * from combinacion";
		$result = mysqli_query($this->conexion, $query);
		return $result;
	}
*/
	function getIndicadorById($id){
		$result=mysqli_query($this->conexion,"SELECT * FROM combinacion WHERE id=$id LIMIT 1") or die("Problemas en el select:".mysqli_error($this->conexion));
		$row=$result->fetch_row();
		return $row;
	}

	function getIndicadorByActividadBMedicion($actividad,$indicador,$medicion){
		$result=mysqli_query($this->conexion,"SELECT * FROM combinacion WHERE actividad='$actividad' AND B='$indicador' AND D='$medicion'  LIMIT 1") or die("Problemas en el select:".mysqli_error($this->conexion));
		$row=$result->fetch_row();
		return $row;
	}

	function getSerieByIndicador($row){
		$serie=array();
		for($i=$row[3];$i<=$row[4];$i++){
			$serie[]=$row[$i]==''?0:$row[$i];
		}
		return $serie;
	}

	function getSerieByIndicadorIniFin($row,$ini,$fin){
		$serie=array();
		for($i=$ini;$i<=$fin;$i++){
			$serie[]=$row[$i]==''?0:$row[$i];
		}
		return $serie;
	}

	function getNombreColumnas(){
		$result=mysqli_query($this->conexion,"SELECT * FROM combinacion") or die("Problemas en el select:".mysqli_error($this->conexion));
		$row=$result->fetch_row();
		$field=$result->fetch_fields();
		$ini=$row[3];
		$fin=$row[4];
		$columnas=array();
		for($i=$ini;$i<=$fin;$i++) {
			$columnas[]=$field[$i]->name;
		}
		return $columnas;
	}

	function getNombreColumnasIniFin($ini,$fin){
		$result=mysqli_query($this->conexion,"SELECT * FROM combinacion") or die("Problemas en el select:".mysqli_error($this->conexion));
		$row=$result->fetch_row();
		$field=$result->fetch_fields();
		$columnas=array();
		for($i=$ini;$i<=$fin;$i++) {
			$columnas[]=$field[$i]->name;
		}
		return $columnas;
	}
}