<?php 

class CombinacionController{
	
	private $conexion;
	private $tabla;

	function __construct($cad_conexion){
		require_once($cad_conexion);
		$this->conexion=$con=$conexion;
		$this->tabla='combinacion';
	}

	function getAllActividadesEconomicas(){
		$query = "select DISTINCT actividad from $this->tabla";
		$result = mysqli_query($this->conexion, $query) or die("Problemas en el select:".mysqli_error($this->conexion));
		return $result;
	}

	function getAllNombresIndicadoresByNameActividad($actividad){
		$query = "select DISTINCT B from $this->tabla where actividad='$actividad'";
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

	function getSerieByIndicador($row){
		$serie=array();
		for($i=$row[2];$i<=$row[3];$i++){
			$serie[]=$row[$i]==''?0:$row[$i];
		}
		return $serie;
	}

	function getNombreColumnas(){
		$result=mysqli_query($this->conexion,"SELECT * FROM combinacion") or die("Problemas en el select:".mysqli_error($this->conexion));
		$row=$result->fetch_row();
		$field=$result->fetch_fields();
		$ini=$row[2];
		$fin=$row[3];
		$columnas=array();
		for($i=$ini;$i<=$fin;$i++) {
			$columnas[]=$field[$i]->name;
		}
		return $columnas;
	}
}