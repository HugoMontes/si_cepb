<?php
class Internacional extends CI_Controller{

  public function __construct(){
    parent::__construct();
    // modelos
    $this->load->model('historico_model');
    $this->load->model('actividad_economica_model');
    // $this->load->model('usuario_model');
    // $this->load->model('perfil_model');
    //$this->load->model('navegacion_model');
  }

  public function index(){
  	$data['titulo'] = 'Internacional';
  	//$data['actividades'] = $this->actividad_economica_model->get_all('id, descripcion',array(),'','','descripcion','');
    $this->load->view('backend/internacional/internacional_list_view',$data);  
  }

}