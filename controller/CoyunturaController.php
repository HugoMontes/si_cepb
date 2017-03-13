<?php 

class CoyunturaController{
	
	private $conexion;
	private $indicador_general;
	private $grupo;

	function __construct($cad_conexion){
		require_once($cad_conexion);
		$this->conexion=$con=$conexion;
		$this->indicador_general='indicador_coyuntura';
		$this->grupo='Coyuntura';
	}

	function getAllActividad(){
		$registros=mysqli_query($this->conexion,"select * from actividad_economica where id BETWEEN 1 AND 5 order by descripcion") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;
	}

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

	/*
	function getIndicadorByIdTabla($indicador){		
		//consulta para hidrocarburos 1 y 2 
		switch ($indicador) {
			case 'HIDROCARBUROS':
				//$registros=mysqli_query($this->conexion,"select DISTINCT B  FROM hidrocarburos1 UNION SELECT DISTINCT B  FROM hidrocarburos2 where C = '".$departamental."'");
				$registros=mysqli_query($this->conexion,"select DISTINCT B  FROM hidrocarburos1 UNION SELECT DISTINCT B  FROM hidrocarburos2");
				break;
			case 'INDICE PRECIOS AL CONSUMIDOR':
				$registros=mysqli_query($this->conexion,"select DISTINCT B FROM ipc1 UNION SELECT DISTINCT B  FROM ipc2");
				break;
			default:
				$registros=mysqli_query($this->conexion,"select DISTINCT B from ".$indicador) or die("Problemas en el select:".mysqli_error($this->conexion));
		}
        //fin consulta hidrocarvuros 1 y 2
        return $registros;
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
	*/
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

/*
	//var -> tabla
	function getPeriodos($id, $var, $var1, $var2, $descripcion){
		$_SESSION['descripcion'] =$descripcion;
		$_SESSION['indicador']=$var;
		$_SESSION['descripcion']=$var2;
		$_SESSION['departamental']=$var1;
		//echo 'xxxx:'.$_SESSION['descripcion'].'-'.$_SESSION['indicador'].'-'.$_SESSION['descripcion'].'-'.$_SESSION['departamental'];

		//$registros=mysqli_query($this->conexion,"select id from ".$var." where C = '".$var1."' and B = '".$var2."' and DESCRIPCION ='".$descripcion."' ") or die("Problemas en el select:".mysqli_error($this->conexion));
		//while($reg=mysqli_fetch_array($registros)){
		//	$id=$reg["id"];
		//}
		//$_SESSION['id']=$id;


		// PARA SACAR LAS FECHAS
		// $consulta2 = "select * from ".$_SESSION['indicador']." where id= '".$_SESSION['id']."'";//DESCRIPCION = "Papa" and C="ORURO"  and a="a013"      $consulta2 = "SELECT * FROM agricultura WHERE DESCRIPCION = '".$yy."' and C='".$zz."'  and B ='".$xx."'";
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
*/

	// traedatosnomcol.php
	/*
	function getNombreColumnas($indicador){
		session_start();
		// $query = "select * from ".$_SESSION['indicador']." where id= '".$_SESSION['id']."'";//DESCRIPCION = "Papa" and C="ORURO"  and a="a013"      $query = "SELECT * FROM agricultura WHERE DESCRIPCION = '".$yy."' and C='".$zz."'  and B ='".$xx."'";
		$query = "select * from ".$indicador." where id= '".$_SESSION['id']."'";
		$result = mysqli_query($this->conexion, $query) or die("Problemas en el select:".mysqli_error($this->conexion));;
		$registro=$result->fetch_row();
		$ini=$registro[1];
		$fin=$registro[2];
		// echo $ini.'<br/>'.$fin;
		$info_campo = mysqli_fetch_fields($result); //obtemos los nombres de campos de la consulta
		// Acotando columnas
		$num=0;
		for ($i=$ini;$i<$fin+1;$i++) { 
			$nomcampo[$num]=$info_campo[$i]->name;  //colocamos cada nombre de columna en el array $nomcampo *****
		    $num++;
		}		
		return $nomcampo;
	}
	*/
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
		//session_start();
		//codigo para separar el val 
		/*
		$query = "select * from ".$_SESSION['indicador']." where id = '".$_SESSION['id']."'";//$query = "SELECT * FROM agricultura WHERE DESCRIPCION = '".$yy."' and C='".$zz."'  and B ='".$xx."'";
		$result = mysqli_query($this->conexion, $query);
		return $result;
		*/
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
}