<?php
class Backup extends CI_Controller{

  public function __construct(){
    parent::__construct();
    // modelos
    //$this->load->model('coyuntura_model');
    //$this->load->model('actividad_economica_model');
    //$this->load->model('indicador_model');
    // $this->load->model('usuario_model');
    // $this->load->model('perfil_model');
    //$this->load->model('navegacion_model');
  }

  public function export_form(){
    if($this->session->flashdata('mensaje')){
      $data['mensaje'] = $this->session->flashdata('mensaje');
    }elseif ($this->session->flashdata('error')){ 
      $data['error'] = $this->session->flashdata('error');
    }
    $data['menu_respaldo'] = true;
  	$data['titulo'] = 'Generar Respaldo';
    // $data['actividades'] = $this->actividad_economica_model->get_all('id, descripcion','id BETWEEN 1 AND 5','','','descripcion','');
  	$this->load->view('backend/backup/backup_export_view',$data);
  }

  public function exportar_db(){
    // http://www.mediavida.com/foro/dev/hacer-copia-seguridad-codeigniter-497636
    date_default_timezone_set("Europe/Madrid");
        // Carga la clase de utilidades de base de datos
        $this->load->dbutil();
        $fecha_hora = date("Ymd_His");

        $prefs = array(
            'tables'      => array(),              // Arreglo de tablas para respaldar.
            'ignore'      => array(),           // Lista de tablas para omitir en la copia de seguridad
            'format'      => 'zip',             // gzip, zip, txt
            'filename'    => 'backup_'.$fecha_hora.'.sql',    // Nombre de archivo - NECESARIO SOLO CON ARCHIVOS ZIP
            'add_drop'    => TRUE,              // Agregar o no la sentencia DROP TABLE al archivo de respaldo
            'add_insert'  => TRUE,              // Agregar o no datos de INSERT al archivo de respaldo
            'newline'     => "\n"               // Caracter de nueva línea usado en el archivo de respaldo
        );

        // Crea una copia de seguridad de toda la base de datos y la asigna a una variable
        $copia_de_seguridad = $this->dbutil->backup($prefs); 

        //print_r($copia_de_seguridad);
        // Carga el asistente de archivos y escribe el archivo en su servidor
        $this->load->helper('file');

        if ( ! write_file('./backup/backup_'.$fecha_hora.'.zip', $copia_de_seguridad))
        {
             $this->smarty->assign('error','No se ha podido crear la copia.');
        }
        else
        {
            $this->smarty->assign('success','Copia creada satisfactoriamente');
        }

        // Carga el asistente de descarga y envía el archivo a su escritorio
        //$this->load->helper('download');
        //force_download('copia_de_seguridad.zip', $copia_de_seguridad);
        $this->smarty->view('index');
  }

  public function import_form(){
    if($this->session->flashdata('mensaje')){
      $data['mensaje'] = $this->session->flashdata('mensaje');
    }elseif ($this->session->flashdata('error')){ 
      $data['error'] = $this->session->flashdata('error');
    }
    $data['menu_respaldo'] = true;
    $data['titulo'] = 'Restaurar Respaldo';
    // $data['actividades'] = $this->actividad_economica_model->get_all('id, descripcion','id BETWEEN 1 AND 5','','','descripcion','');
    $this->load->view('backend/backup/backup_import_view',$data);
  }
  
}