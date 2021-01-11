<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'datomed/especialidades_model',
            'ion_auth_model'
        ));
        $this->load->library(
            array(
                'notificaciones',
                'ion_auth',
                'utiles'
            ));
    }
    
    public function index(){
        if($this->ion_auth->logged_in()){
            $data['info_usuario'] = $this->permisos->get_user_data();            
            $response_rol = $this->utiles->get_rol_by_usuario($data['info_usuario']['group_info'],5);
            if($response_rol == 1){
                //si el user es doctor
                $data['especialidades'] = $this->especialidades_model->select_all();
            }
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $this->form_validation->set_rules('id', 'ID', 'trim');
            $this->form_validation->set_rules('rut', 'RUT/DNI', 'trim');
            $this->form_validation->set_rules('passwordoriginal', 'Contrase&ntilde;a', 'trim|min_length[6]');
            $this->form_validation->set_rules('passwordcheck', 'Contrase&ntilde;a no coincide', 'trim|matches[passwordoriginal]');
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('apellido', 'Apellidos', 'required|trim|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('direccion', 'Direcci&oacute;n', 'required|trim|min_length[3]|max_length[200]');
            $this->form_validation->set_rules('rut_m', 'RUT Colegio M&eacute;dico', 'trim|min_length[3]|max_length[20]');
            $this->form_validation->set_rules('especialidad', 'Especialidad', 'trim');
            if ($this->form_validation->run() == FALSE){
                $this->vistas->__render($data, 'usuarios_edit');
            }else{
                if($this->input->post('passwordoriginal') && $response_rol == 0){
                    //Edición de paciente
                    $opc = array(
                        'first_name' => $this->input->post('nombre'),
                        'last_name' => $this->input->post('apellido'),
                        'direccion'=>$this->input->post('direccion'),
                        'password'=>$this->input->post('passwordoriginal')
                    );                
                }elseif($this->input->post('passwordoriginal') && $response_rol == 1){
                    //Edición doctor
                    $opc = array(
                        'first_name' => $this->input->post('nombre'),
                        'last_name' => $this->input->post('apellido'),
                        'direccion'=>$this->input->post('direccion'),
                        'rut_colegio_medico'=>$this->input->post('rut_m'),
                        'especialidad'=>$this->input->post('especialidad'),
                        'password'=>$this->input->post('passwordoriginal')
                    );               
                }elseif(empty($this->input->post('passwordoriginal')) && $response_rol == 0){
                    //Edición paciente sin contraseña
                    $opc = array(
                        'first_name' => $this->input->post('nombre'),
                        'last_name' => $this->input->post('apellido'),
                        'direccion'=>$this->input->post('direccion')
                    );                           
                }elseif(empty($this->input->post('passwordoriginal')) && $response_rol == 1){
                    $opc = array(
                        'first_name' => $this->input->post('nombre'),
                        'last_name' => $this->input->post('apellido'),
                        'direccion'=>$this->input->post('direccion'),
                        'rut_colegio_medico'=>$this->input->post('rut_m'),
                        'especialidad'=>$this->input->post('especialidad')
                    );   
                }
                if($this->ion_auth->update($this->input->post('id'), $opc)){
                    $data['message'] = "Exito en la edici&oacute;n del usuario."
                            . "&nbsp;<a href=\"".$this->agent->referrer()."\">Volver</a>";                
                }else{
                    $data['message'] = "Error en la edici&oacute;n del usuario. Intente nuevamente."
                            . "&nbsp;<a href=\"".$this->agent->referrer()."\">Volver</a>";                
                }
                $this->vistas->__render($data, 'error');
            }
        }else{
            redirect("login/index", 'refresh');
        }          
    }
    
}