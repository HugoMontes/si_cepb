<?php
class Escritorio extends CI_Controller{

    public function __construct(){
        parent::__construct();
        // modelos
        /*
        $this->load->model('pagina_model');
        $this->load->model('pagina_predisenada_model');        
        $this->load->model('noticia_model');
        $this->load->model('especialista_trabajador_model');
        $this->load->model('especialista_especialidad_model');
        */
    }
    
    public function index(){
      /* 
	    $data['noticias_publicadas'] = $this->noticia_model->get_count(array('estado'=>PUBLICADO),'');
      $data['noticias_publicadas_capacitacion'] = $this->noticia_capacitacion_model->get_count(array('estado'=>PUBLICADO),'');
      $data['testimonios_publicados'] = $this->testimonio_model->get_count(array('estado'=>PUBLICADO),'');
      $data['especialistas_publicados'] = $this->especialista_trabajador_model->get_count(array('estado'=>PUBLICADO),'');
      $data['especialidades_publicados'] = $this->especialista_especialidad_model->get_count(array('estado'=>PUBLICADO),'');
      $data['paginas_visitadas'] = $this->pagina_model->get_all('',array('estado'=>PUBLICADO),'','5','hits DESC','');
      $data['paginas_predisenadas_visitadas'] = $this->pagina_predisenada_model->get_all('',array('estado'=>PUBLICADO),'','5','hits DESC','');       
      $data['paginas_recientes'] = $this->pagina_model->get_all('',array(),'','5','creado DESC','');
      */
      $data['menu_escritorio'] = true;
      $data['titulo'] = 'Escritorio';
      get_user_session();
      $this->load->view('backend/escritorio',$data);       
	}
}