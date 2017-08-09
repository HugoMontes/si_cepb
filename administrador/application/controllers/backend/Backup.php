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
    // https://stackoverflow.com/questions/32536274/write-file-not-working-in-code-igniter
    // Load the DB utility class
    $this->load->dbutil();

    // Backup your entire database and assign it to a variable
    $backup = $this->dbutil->backup();

    // Load the file helper and write the file to your server
    $this->load->helper('file');
    write_file(FCPATH.'/backups/cepb_backup.gz', $backup);

    // Load the download helper and send the file to your desktop
    $this->load->helper('download');
    force_download('cepb_backup.gz', $backup);
  }

  public function importar_form(){
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

  // http://www.cumacoder.com/2016/01/backup-restore-database-codeigniter-3.html
  
}