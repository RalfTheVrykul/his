<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Especialidades extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'admin/especialidades_model',
            'ion_auth_model'
        ));
        $this->load->library(
            array(
                'notificaciones',
                'ion_auth'
            ));
    }
    
    public function index(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                //Paginación
                $limit_per_page = 10;//Limite para mostrar por página
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->especialidades_model->get_total();
                if ($total_records > 0){
                    $data["results"] = $this->especialidades_model->get_current_page_records($limit_per_page, $start_index);             
                    $config['base_url'] = site_url() . '/admin/especialidades/index';
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;
                    //
                    $this->pagination->initialize($config);
                    $data["links"] = $this->pagination->create_links();
                }
                $this->vistas->__render_admin($data,'especialidades_lista');
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }        
    }
    
    public function create(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('nombre', 'Especialidad', 'required|trim|min_length[3]|max_length[40]');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'especialidades_create');
                }else{
                    $params['nombre'] = $this->input->post('nombre');
                    $resp = $this->especialidades_model->insert($params);
                    if(is_null($resp)){
                        $data['message'] = "Error al crear nueva especialidad.";
                    }else{
                        $data['message'] = "Exito al crear nueva especialidad."
                                . "&nbsp;<a href=\"".$this->agent->referrer()  ."\">Volver</a>";
                    }            
                    $this->vistas->__render_admin($data, 'error');
        
                }
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }        
    }
    public function edit($id = NULL){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                if($id){
                    $params['categoria_id'] = $id;
                    $data['categoria_select'] = $this->especialidades_model->selectbyid($params);            
                }                  
                $data['info_usuario'] = $this->permisos->get_user_data();
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('id', 'ID', 'trim');
                $this->form_validation->set_rules('nombre', 'Especialidad', 'required|trim|min_length[3]|max_length[40]');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'especialidades_edit');
                }else{
                    $params['id'] = $this->input->post('id');
                    $params['nombre'] = $this->input->post('nombre');
                    $resp = $this->especialidades_model->update($params);
                    if(is_null($resp)){
                        $data['message'] = "Error al editar especialidad.";
                    }else{
                        $data['message'] = "Exito al editar especialidad."
                                . "&nbsp;<a href=\"".$this->agent->referrer()  ."\">Volver</a>";
                    }            
                    $this->vistas->__render_admin($data, 'error');
        
                }
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }       
    }
    public function delete($id = NULL){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                if($id){
                    $resp = $this->especialidades_model->delete($id);
                    if($resp > 0){
                            $data['message'] = "Exito al eliminar especialidad."
                            . "&nbsp;<a href=\"".$this->agent->referrer()."\">Volver</a>";
                    }else{
                        $data['message'] = "Error al eliminar especialidad.";
                    }            
                    $this->vistas->__render_admin($data,'error');
                }
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }        
    }
}
