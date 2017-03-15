<?php 

class InternacionalController{
	
	private $conexion;
	private $indicador_general;
	private $grupo;

	function __construct($cad_conexion){
		require_once($cad_conexion);
		$this->conexion=$con=$conexion;
		$this->indicador_general='indicador_internacional';
		// $this->grupo='Internacional';
	}

	function getAllFuente(){
		$registros=mysqli_query($this->conexion,"select * from $this->indicador_general where estado=1 order by campos") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;
	}

	function getByIdIndicador($id){
		$result=mysqli_query($this->conexion,"select * from $this->indicador_general where id=$id") or die("Problemas en el select:".mysqli_error($this->conexion));
		$row=$result->fetch_assoc();
		return $row;	
	}

	function getByTableIndicador($tabla){
		$result=mysqli_query($this->conexion,"select * from $this->indicador_general where tabla='$tabla'") or die("Problemas en el select:".mysqli_error($this->conexion));
		$row=$result->fetch_assoc();
		return $row;	
	}

	function getAllPaises($tabla){
		$registros=mysqli_query($this->conexion,"select DISTINCT pais from $tabla order by pais") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;	
	}

	function getAllClasificacionByNameTabla($tabla){
		$registros=mysqli_query($this->conexion,"select DISTINCT clasificacion from $tabla order by nro") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;	
	}

	function getPeriodos($tabla){
		$registros=mysqli_query($this->conexion,"select DISTINCT anio from $tabla order by anio") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;
	}

	function getIndicePais($tabla, $descripcion, $pais, $periodo){
		$result=mysqli_query($this->conexion,"SELECT * FROM $tabla WHERE pais='$pais' AND clasificacion='$descripcion' AND anio='$periodo'") or die("Problemas en el select:".mysqli_error($this->conexion));
		$row=$result->fetch_assoc();
		return $row;
	}

/*
	function getAllGrupoByIdActividad($id){
		$registros=mysqli_query($this->conexion,"select * from $this->indicador_general where id_actividad_economica=$id and estado=1 order by campos") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;
	}

	function getAllDesagregacionByNameTabla($tabla){
		$registros=mysqli_query($this->conexion,"select DISTINCT desagregacion from $tabla where grupo='$this->grupo' order by desagregacion") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;
	}

	function getAllMedicion($tabla,$desagregacion){
		$registros=mysqli_query($this->conexion,"select DISTINCT medicion_indicador from $tabla where grupo='$this->grupo' AND desagregacion='$desagregacion' order by medicion_indicador") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;
	}

	function getAllCobertura($tabla,$desagregacion,$medicion){
		$registros=mysqli_query($this->conexion,"select DISTINCT C from $tabla where grupo='$this->grupo' AND desagregacion='$desagregacion' AND medicion_indicador='$medicion' order by C") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;
	}

	function getAllIndicador($tabla,$desagregacion,$medicion,$cobertura){
		$registros=mysqli_query($this->conexion,"select DISTINCT B from $tabla where grupo='$this->grupo' AND desagregacion='$desagregacion' AND medicion_indicador='$medicion' AND C='$cobertura'") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;
	}

	function getAllDescripcion($tabla,$desagregacion,$medicion,$cobertura,$indicador){
		$registros=mysqli_query($this->conexion,"select DISTINCT descripcion, id from $tabla where grupo='$this->grupo' AND desagregacion='$desagregacion' AND medicion_indicador='$medicion' AND C='$cobertura' AND B='$indicador'") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;
	}

	function getRutaXlsx($tabla, $indicador){
		// Se obtiene el directorio donde se encuentra el excel
		$result=mysqli_query($this->conexion,"SELECT ruta FROM $this->indicador_general WHERE tabla='$tabla' LIMIT 1");
		$row=$result->fetch_assoc();
		$nombre_ruta=$row['ruta'];
		// Se obtiene el nombre del archivo
		$result=mysqli_query($this->conexion,"SELECT A FROM $tabla WHERE B='$indicador' LIMIT 1");
		$row=$result->fetch_assoc();
		$nombre_archivo=$row['A'];
		return $nombre_ruta.'/'.$nombre_archivo.'.xlsx';
	}

	function getPeriodos($tabla, $id){
		$sql="select * from $tabla where id=$id";
		$query = mysqli_query($this->conexion, $sql);
		$fila_data=$query->fetch_assoc();
		$ini=$fila_data['ini'];
		$fin=$fila_data['fin'];
		$fila_head=$query->fetch_fields();
		for($i=$ini;$i<=$fin;$i++){
			$fechas[$i]=$fila_head[$i]->name;
		}
		return $fechas;
	}


	// OK MODIFICADO HATA AQUI
	function getNombreColumnas($id,$indicador,$ini=null,$fin=null){
		//session_start();
		// $query = "select * from ".$_SESSION['indicador']." where id= '".$_SESSION['id']."'";//DESCRIPCION = "Papa" and C="ORURO"  and a="a013"      $query = "SELECT * FROM agricultura WHERE DESCRIPCION = '".$yy."' and C='".$zz."'  and B ='".$xx."'";
		$query = "select * from ".$indicador." where id= '".$id."'";
		$result = mysqli_query($this->conexion, $query) or die("Problemas en el select:".mysqli_error($this->conexion));
		if($ini==null or $fin==null){
			$registro=$result->fetch_row();
			$ini=$registro[1];
			$fin=$registro[2];
		}
		// echo $ini.'<br/>'.$fin;
		$info_campo = mysqli_fetch_fields($result); //obtemos los nombres de campos de la consulta
		// Acotando columnas
		$num=0;
		for ($i=$ini;$i<=$fin;$i++) { 
			$nomcampo[$num]=$info_campo[$i]->name;  //colocamos cada nombre de columna en el array $nomcampo *****
		    $num++;
		}		
		return $nomcampo;
	}
	
	// traedatosseriebd.php
	function getSerie($id,$indicador,$ini=null,$fin=null){
		//session_start();
		//codigo para separar el val 
		$query = "select * from ".$indicador." where id = '".$id."'";//$query = "SELECT * FROM agricultura WHERE DESCRIPCION = '".$yy."' and C='".$zz."'  and B ='".$xx."'";
		$result = mysqli_query($this->conexion, $query);
		$fila=$result->fetch_row();
		if($ini==null or $fin==null){
			$ini=$fila[1];
			$fin=$fila[2];
		}
		// echo $ini.'<br/>'.$fin;
		$num=0;
		for ($i=$ini;$i<=$fin;$i++){ 
			$serie[$num]=$fila[$i]==''?0:$fila[$i];
			$num++;
		}		
		return $serie;
	}

	function getSerieResult($id,$tabla,$ini=null,$fin=null){
		$conn = mysql_connect(cServidor,cUsuario,cPass);
    	$db = mysql_select_db(cBd,$conn);
    	$sql = "SELECT * FROM ".$tabla." WHERE id = '".$id."'"; 
    	//$sql = "SELECT * FROM $this->indicador_general";
    	$rec = mysql_query($sql) or die (mysql_error());
    	return $rec;
	}	

	function getIndicadorById($id,$tabla){
		$query = "select * from $tabla where id = $id";
		$result = mysqli_query($this->conexion, $query);
		$row=$result->fetch_assoc();
		return $row;
	}
*/
}