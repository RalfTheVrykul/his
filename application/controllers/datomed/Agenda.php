<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'datomed/agenda_model',
            'datomed/medicos_model',
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
            //Verifico si el usuario es médico (5)
            $response_rol = $this->utiles->get_rol_by_usuario($data['info_usuario']['group_info'],5);
            //Paginación
            $limit_per_page = 10;//Limite para mostrar por página
            $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data["rol"] = $response_rol;
            //Si el rol es doctor
            if($response_rol == 1){
                $total_records = $this->agenda_model->get_total_by_user_login_doctor($data['info_usuario']['user_info']->rut);
                if ($total_records > 0){
                    $data["results"] = $this->agenda_model->get_current_page_records_by_user_login_doctor($limit_per_page, $start_index, $data['info_usuario']['user_info']->rut);
                }
            }else{
                $total_records = $this->agenda_model->get_total_by_user_login_paciente($data['info_usuario']['user_info']->rut);
                if ($total_records > 0){
                    $data["results"] = $this->agenda_model->get_current_page_records_by_user_login_paciente($limit_per_page, $start_index, $data['info_usuario']['user_info']->rut);
                }                
            }                     
            $config['base_url'] = site_url() . '/datomed/agenda/index';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 4;
            //
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();            
            $this->vistas->__render($data,'agenda_lista');
        }else{
            redirect("login/index", 'refresh');
        }     
    }
    
    public function create(){
        if($this->ion_auth->logged_in()){
            $data['info_usuario'] = $this->permisos->get_user_data();
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $this->form_validation->set_rules('especialidad_med_create', 'Especialidad', 'required|trim');
            $this->form_validation->set_rules('agenda_medico_med_create', 'M&eacute;dico', 'required|trim');
            $this->form_validation->set_rules('atencion', 'Tipo de Atenci&oacute;n', 'required|trim');
            $this->form_validation->set_rules('fecha', 'Fecha', 'required|trim');
            $this->form_validation->set_rules('hora', 'Hora', 'required|trim');
            $this->form_validation->set_rules('motivo', 'Motivo Consulta', 'required|trim|min_length[3]|max_length[150]');            
            
            if ($this->form_validation->run() == FALSE){
                $data['medicos_lista'] = $this->medicos_model->select_all_doctores();
                $data['esp_lista'] = $this->especialidades_model->select_all();
                $this->vistas->__render($data, 'agenda_create');
            }else{
                $params['especialidad'] = $this->input->post('especialidad_med_create');
                $params['rut_doctor'] = $this->input->post('agenda_medico_med_create');
                $params['rut_paciente'] = $data['info_usuario']['user_info']->rut;
                $params['atencion'] = $this->input->post('atencion');
                $params['fecha'] = $this->input->post('fecha');
                $params['hora'] = $this->input->post('hora');
                $params['motivo'] = $this->input->post('motivo');
                
                $resp = $this->agenda_model->insert($params);
                
                if(is_null($resp)){
                    $data['message'] = "Error al solicitar nueva cita m&eacute;dica."
                                        . "&nbsp;<a href=\"".$this->agent->referrer()  ."\">Volver</a>";
                }else{
                    $data['message'] = "Exito al solicitar nueva cita m&eacute;dica."
                            . "&nbsp;<a href=\"".$this->agent->referrer()  ."\">Volver</a>";
                }           
                $this->vistas->__render($data, 'error');
    
            }
        }else{
            redirect("login/index", 'refresh');
        }
        
    }
    public function edit($id = NULL){
        if($this->ion_auth->logged_in()){
            if($id){
                $params['agenda_id'] = $id;
                $data['agenda_seleccion'] = $this->agenda_model->selectbyid_paciente($params);            
            }
            $data['info_usuario'] = $this->permisos->get_user_data();
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $this->form_validation->set_rules('atencion', 'Tipo de Atenci&oacute;n', 'required|trim');
            $this->form_validation->set_rules('fecha', 'Fecha', 'required|trim');
            $this->form_validation->set_rules('hora', 'Hora', 'required|trim');
            $this->form_validation->set_rules('motivo', 'Motivo Consulta', 'required|trim|min_length[3]|max_length[150]');            
                
            if ($this->form_validation->run() == FALSE){
                //$data['agenda_seleccion'] = $this->agenda_model->selectbyid_paciente($params); 
                $this->vistas->__render($data, 'agenda_edit');
            }else{            
                $params['id'] = $this->input->post('id');
                $params['rut_paciente'] = $data['info_usuario']['user_info']->rut;
                $params['atencion'] = $this->input->post('atencion');
                $params['fecha'] = $this->input->post('fecha');
                $params['hora'] = $this->input->post('hora');
                $params['motivo'] = $this->input->post('motivo');
                
                $resp = $this->agenda_model->update($params);
                
                if($resp > 0){
                    $data['message'] = "Exito al editar cita m&eacute;dica."
                                        . "&nbsp;<a href=\"".$this->agent->referrer()  ."\">Volver</a>";
                }else{
                    $data['message'] = "Error al editar cita m&eacute;dica."
                            . "&nbsp;<a href=\"".$this->agent->referrer()  ."\">Volver</a>";
                }           
                $this->vistas->__render($data, 'error');
    
            } 
        }else{
            redirect("login/index", 'refresh');
        }        
    }
    public function delete($id = NULL){
        if($this->ion_auth->logged_in()){
            $data['info_usuario'] = $this->permisos->get_user_data();
            if($id){
                $resp = $this->agenda_model->delete($id);
                if($resp > 0){
                        $data['message'] = "Exito al eliminar cita m&eacute;dica."
                        . "&nbsp;<a href=\"".$this->agent->referrer()."\">Volver</a>";
                }else{
                    $data['message'] = "Error al eliminar cita m&eacute;dica.";
                }            
                $this->vistas->__render($data,'error');
            }
        }else{
            redirect("login/index", 'refresh');
        }        
    }

    public function get_medico_by_especialidad(){
        header('Content-Type: application/json');
        if($this->ion_auth->logged_in()){            
            $params['id_especialidad'] = $this->input->post('id');
            $resp = $this->medicos_model->select_all_doctores_by_especialidad($params);
            echo json_encode($resp);
        }else{
            redirect("login/index", 'refresh');
        }
        
    }

}
