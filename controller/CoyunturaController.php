<?php 
class CoyunturaController{
	
	private $conexion;
	private $indicador_general;

	function __construct($cad_conexion){
		require_once($cad_conexion);
		$this->conexion=$con=$conexion;
		$this->indicador_general='indicador_coyuntura';
	}

	function getAllActividadEconomica(){
		$registros=mysqli_query($this->conexion,"SELECT * FROM $this->indicador_general WHERE estado=1 ORDER BY campos") or die("Problemas en el select:".mysqli_error($this->conexion));
		return $registros;
	}

	function getIndicadorByIdTabla($indicador){
		$registros=mysqli_query($this->conexion,"SELECT DISTINCT B  FROM $indicador WHERE grupo='Coyuntura'");
		return $registros;
	}

	function getCoberturasByIndicador($indicador){
		/*
		if($indicador=='cnacionales2'){
			$codigo=array('CN083','CN084','CN085','CN086','CN087');
		}elseif($indicador=='hidrocarburos1'){
			$codigo=array('H001');
		}elseif($indicador=='mineria'){
			$codigo=array('M001');
		}elseif($indicador=='null_construccion'){
			$codigo=array('C002','C003','C004','C005','C006','C007','C008','C009');
		}elseif($indicador=='servbasicos'){
			$codigo=array('SB001','SB002','SB003','SB004','SB005','SB006','SB007','SB008');
		}elseif($indicador=='tcomunicaciones'){
			$codigo=array('TC001','TC002','TC003','TC004','TC005','TC006','TC007');
		}elseif($indicador=='null_indices'){
			$codigo=array('IPC001','IPC002','IPC013','IPC014','IPC015','IPC016','IPC017','IPC018','IPC019','IPC020','IPC021','IPC022');
		}elseif($indicador=='null_salario'){
			$codigo=array('SR002','SR003','SR002','SR003','SR004','SR005','SR006','SR007','SR008','SR009','SR010','SR011','SR012','SR013','SR014');
		}elseif($indicador=='indcomexterior'){
			$codigo=array('ICE001','ICE002','ICE003','ICE004','ICE005','ICE006','ICE007','ICE008','ICE009','ICE010','ICE011','ICE012','ICE013','ICE014','ICE015','ICE016','ICE017','ICE018');
		}elseif($indicador=='tcambio1'){
			$codigo=array('TC003','TC004');
		}
		*/
		// Contatenando consulta.....
		$registros=mysqli_query($this->conexion,"SELECT DISTINCT C FROM $indicador WHERE grupo='Coyuntura'");	
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
		//echo 'xxxx:'.$_SESSION['descripcion'].'-'.$_SESSION['indicador'].'-'.$_SESSION['descripcion'].'-'.$_SESSION['departamental'];
/*
		$registros=mysqli_query($this->conexion,"select id from ".$var." where C = '".$var1."' and B = '".$var2."' and DESCRIPCION ='".$descripcion."' ") or die("Problemas en el select:".mysqli_error($this->conexion));
		while($reg=mysqli_fetch_array($registros)){
			$id=$reg["id"];
		}
		$_SESSION['id']=$id;
*/

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