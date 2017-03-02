<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_user_session')){
    function get_user_session(){
       $intance =& get_instance();
       $user_session = $intance->session->userdata('usuario');
       if(!isset($user_session) OR empty($user_session)){
        $intance->session->set_flashdata('error','¡Por favor inicia sesión!');
        redirect('backend/login');       
       } 
       else{
        return (object)$user_session;
       }      
    }
}