<?php 

class LoginController{
	
	private $conexion;

	function __construct($cad_conexion){
		require_once($cad_conexion);
		$this->conexion=$con=$conexion;
	}

	function index(){
		header("Location: http://localhost/estadistico2/pages/backend/index.php"); /* Redirect browser */
		exit();
	}

	function login(){
		$pagina=$this->load_template('Busqueda de registros');
		$html = $this->load_page('../pages/backend/home.php');
  		$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$html , $pagina);
		$this->view_page($pagina);
	}

	private function load_template($title='Sin Titulo'){
		$pagina = $this->load_page('../pages/backend/template/page.php');
	 	$header = $this->load_page('../pages/backend/template/header.php');
	 	$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
	 	$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);
	 	$menu_left = $this->load_page('../pages/backend/template/menuizquierda.php');
	 	$pagina = $this->replace_content('/\#MENULEFT\#/ms' ,$menu_left , $pagina);
	  	return $pagina;
	}

	private function load_page($page){
  		return file_get_contents($page);
 	}

	
	private function view_page($html){
  		echo $html;
 	}

 	private function replace_content($in='/\#CONTENIDO\#/ms', $out,$pagina){
   		return preg_replace($in, $out, $pagina);
 	}
}