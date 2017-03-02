<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('usuario_model');
    $this->load->model('perfil_model');
  }

  public function index(){
    $session_set_value = $this->session->all_userdata();
    // Verificamos si remember_me existe y esta guardada en la sesion
    if (isset($session_set_value['remember_me']) && $session_set_value['remember_me'] == "1"){
      redirect('administrador/escritorio'); 
    }else{
      $data=array();
      if ($this->session->flashdata('error')){ 
        $data['error'] = $this->session->flashdata('error');
      } 
      $this->load->view('login',$data);
    }
  }

  public function login(){
    // Reglas de validacion de formulario
    $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required');
    $this->form_validation->set_rules('password', 'Contraseña', 'trim|required');
    $this->form_validation->set_message('required', 'Falta el campo %s');
    // Verificando validacion
    if($this->form_validation->run() == FALSE){              
      //$this->session->set_flashdata('error', validation_errors());
      $this->index();                  
    }else{
      $user_name=$this->input->post('usuario');
      $password=$this->input->post('password');
      $remember = $this->input->post('remember');
      $usuario=$this->usuario_model->get_values('id, nombres, apellidos, creado, perfil, thumb',array('usuario'=>$user_name, 'password'=>$password, 'estado'=>HABILITADO));
      if(!empty($usuario)){
        if(!empty($usuario_->thumb)){
          $fotografia = base_url('resources/img/usuarios/thumb/'.$usuario_->thumb);
        }else{
          $fotografia = base_url('resources/img/usuarios/thumb/default.jpg');
        }
        if($remember){
          $this->session->set_userdata('remember_me', TRUE);
        }
        // obtenemos el perfil del usuario
        $perfil = $this->perfil_model->get_values('nombre',array('id'=>$usuario->perfil));
        $perfil = $perfil->nombre; 
        // crear la variable de sesion con los datos de usuario
        $data = array(
          'id' => $usuario->id,
          'usuario' => $usuario,
          'fotografia' => $fotografia,
          'nombres' => $usuario->nombres,
          'apellidos' => $usuario->apellidos,
          'creado' => $usuario->creado,
          'perfil_id' => $usuario->perfil,                                
          'perfil' => $perfil
        );
        $this->session->set_userdata('usuario', $data);
        redirect('backend/escritorio');	
      }else{
        $this->session->set_flashdata('error', 'El inicio de sesión no es válido.');
        $this->index();
      }      
    }  	
  }

  public function logout(){
    // Destruimos los datos de la session
    $this->session->sess_destroy();
    redirect('backend/login');
  }
}