<?php 

class InternacionalController{
	
	private $conexion;
	private $indicador_general;

	function __construct($cad_conexion){
		require_once($cad_conexion);
		$this->conexion=$con=$conexion;
		$this->indicador_general='indicador_internacional';
	}

	function getAllActividadEconomica(){
		$registros=mysqli_query($this->conexion,"SELECT * FROM $this->indicador_general WHERE estado=1 ORDER BY campos") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;
	}

	function getIndicadorByIdTabla($indicador){
		$registros=mysqli_query($this->conexion,"SELECT DISTINCT B  FROM $indicador WHERE grupo='Internacional'");
		return $registros;
	}

	function getCoberturasByIndicador($indicador){
		$registros=mysqli_query($this->conexion,"SELECT DISTINCT C FROM $indicador WHERE grupo='Internacional'");	
		return $registros;
	}

	function getRutaXlsx($indicador, $indicador2, $cobertura){
		$result=mysqli_query($this->conexion,"SELECT ruta FROM $this->indicador_general WHERE tabla='$indicador' LIMIT 1");
		$row=$result->fetch_assoc();
		$nombre_ruta=$row['ruta'];
		$result=mysqli_query($this->conexion,"SELECT A FROM $indicador WHERE B='$indicador2' AND C='$cobertura' LIMIT 1");
		$row=$result->fetch_assoc();
		$nombre_archivo=$row['A'];
		return $nombre_ruta.'/'.$nombre_archivo.'.xlsx';
	}

	function getDescripcionByIndicador($indicador,$departamental,$indicador2){
		$registros=mysqli_query($this->conexion,"select DISTINCT DESCRIPCION from ".$indicador." where C = '".$departamental."' and B = '".$indicador2."'") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;
	}

	function getIdIndicador($tabla,$var1,$var2,$descripcion){
		session_start();
		$registros=mysqli_query($this->conexion,"select id from ".$tabla." where C = '".$var1."' and B = '".$var2."' and DESCRIPCION ='".$descripcion."' ") or die("Problemas en el select:".mysqli_error($this->conexion));
		while($reg=mysqli_fetch_array($registros)){
			$id=$reg["id"];
		}
		$_SESSION['id']=$id;
		return $id;		
	}

	function getPeriodos($id, $var, $var1, $var2, $descripcion){
		$_SESSION['descripcion'] =$descripcion;
		$_SESSION['indicador']=$var;
		$_SESSION['descripcion']=$var2;
		$_SESSION['departamental']=$var1;

		$consulta2 = "select * from ".$var." where id= '".$id."'";//DESCRIPCION = "Papa" and C="ORURO"  and a="a013"      $consulta2 = "SELECT * FROM agricultura WHERE DESCRIPCION = '".$yy."' and C='".$zz."'  and B ='".$xx."'";
		
		$resultado2 = mysqli_query($this->conexion, $consulta2);
		$info_campo = $resultado2->fetch_fields();

		$info_campo = mysqli_fetch_fields($resultado2); //obteemos los nombres de campos de la consulta
		$num=0;
		foreach ($info_campo as $valor) {
		    $nomcampo[$num]=$valor->name;  //colocamos cada nombre de columna en el array $nomcampo *****
		    $num++;
		}
		$fila=$resultado2->fetch_row();
		$ini=$fila[2];
		$fin=$fila[3];

		$numcolumnas=$fin;

		$i=0;
		$j=0;
		for ($g=$ini;$g<=$fin;$g++){
		  	$m=$ini;//*****
		  	for ($l=$ini;$l<=$numcolumnas;$l++){
				$re22[$m]=$nomcampo[$l];  
			  	$j++;
			  	$m++; 
			}
		  	$i++;
		}
		$_SESSION['inicio']=$ini;
		$_SESSION['final']=$fin;
		return $re22;
	}

	// traedatosnomcol.php
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
		$query = "select * from ".$_SESSION['indicador']." where id = '".$_SESSION['id']."'";//$query = "SELECT * FROM agricultura WHERE DESCRIPCION = '".$yy."' and C='".$zz."'  and B ='".$xx."'";
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

	function getSerieResult($id,$indicador,$ini=null,$fin=null){
		//session_start();
		//codigo para separar el val 
		/*
		$query = "select * from ".$_SESSION['indicador']." where id = '".$_SESSION['id']."'";//$query = "SELECT * FROM agricultura WHERE DESCRIPCION = '".$yy."' and C='".$zz."'  and B ='".$xx."'";
		$result = mysqli_query($this->conexion, $query);
		return $result;
		*/
		$conn = mysql_connect(cServidor,cUsuario,cPass);
    	$db = mysql_select_db(cBd,$conn);
    	$sql = "SELECT * FROM ".$_SESSION['indicador']." WHERE id = '".$_SESSION['id']."'"; 
    	//$sql = "SELECT * FROM indicador_historico";
    	$rec = mysql_query($sql) or die (mysql_error());
    	return $rec;
	}

	function getIndicadorById($id,$indicador){
		$query = "select * from $indicador where id = '$id'";
		$result = mysqli_query($this->conexion, $query);
		$row=$result->fetch_assoc();
		return $row;
	}
}