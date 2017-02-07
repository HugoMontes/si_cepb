<?php 

class CombinacionController{
	
	private $conexion;

	function __construct($cad_conexion){
		require_once($cad_conexion);
		$this->conexion=$con=$conexion;
	}

	function getAllCombinados(){
		$query = "select * from combinacion";
		$result = mysqli_query($this->conexion, $query);
		return $result;
	}

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