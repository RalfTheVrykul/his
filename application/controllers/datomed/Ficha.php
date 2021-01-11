<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ficha extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'datomed/agenda_model',
            'datomed/medicos_model',
            'datomed/especialidades_model',
            'datomed/ficha_model',
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
            //Si el rol es doctor
            if($response_rol == 1){
                $total_records = $this->ficha_model->get_total_by_user_login_doctor($data['info_usuario']['user_info']->rut);
                if ($total_records > 0){
                    $data["results"] = $this->ficha_model->get_current_page_records_by_user_login_doctor($limit_per_page, $start_index, $data['info_usuario']['user_info']->rut);
                }
            }else{
                $total_records = $this->ficha_model->get_total_by_user_login_paciente($data['info_usuario']['user_info']->rut);
                if ($total_records > 0){
                    $data["results"] = $this->ficha_model->get_current_page_records_by_user_login_paciente($limit_per_page, $start_index, $data['info_usuario']['user_info']->rut);
                }                
            }                           
            $total_records = $this->ficha_model->get_total();
            if ($total_records > 0){
                $config['base_url'] = site_url() . '/datomed/ficha/index';
                $config['total_rows'] = $total_records;
                $config['per_page'] = $limit_per_page;
                $config["uri_segment"] = 4;
                //
                $this->pagination->initialize($config);
                $data["links"] = $this->pagination->create_links();
            }
            $this->vistas->__render($data,'ficha_lista');
        }else{
            redirect("login/index", 'refresh');
        }        
    }
    
    public function create($rut_paciente = NULL, $tipo_atencion = NULL){        
        if($this->ion_auth->logged_in()){
            //get rut desde doctor
            if($rut_paciente && $tipo_atencion){
                $data['rut_paciente'] = $rut_paciente;
                $data['tipo_atencion'] = $tipo_atencion;
            }
            $data['info_usuario'] = $this->permisos->get_user_data();
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $this->form_validation->set_rules('rut_paciente', 'RUT/DNI Paciente', 'required|trim|min_length[3]|max_length[40]');
            $this->form_validation->set_rules('motivo', 'Motivo Consulta', 'required|trim|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('enf_actual', 'Enfermedad Actual', 'required|trim|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('sexo', 'Sexo', 'required|trim|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('peso', 'Peso', 'required|trim|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('talla', 'Talla', 'required|trim|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('sangre', 'Tipo Sangre', 'required|trim|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('pulso', 'Pulso', 'required|trim|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('presion', 'Presi&oacute;n', 'required|trim|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('temperatura', 'Temperatura', 'required|trim|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('frec', 'Frecuancia Cardio', 'required|trim|min_length[2]|max_length[120]');
            $this->form_validation->set_rules('int_quirur', 'Intervenciones Quirúrgicas', 'required|trim|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('alergias', 'Alergias', 'required|trim|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('enfermedades', 'Enfermedades Previas', 'required|trim|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('medicamentos', 'Medicamentos', 'required|trim|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('fuma', 'Fuma', 'required|trim|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('alcohol', 'Alcohol', 'required|trim|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('enf_congenita', 'Enf. Cong&eacute;nita', 'required|trim|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('enf_cardiaca', 'Enf. Card&iacute;aca', 'required|trim|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('enf_genetica', 'Enf. Gen&eacute;tica', 'required|trim|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('otras', 'Otras', 'required|trim|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('diagnostico', 'Diagn&oacute;stico', 'required|trim|min_length[2]|max_length[1000]');
            $this->form_validation->set_rules('proxima_cita', 'Pr&oacute;xima Cita', 'required|trim|min_length[2]|max_length[200]');
            if ($this->form_validation->run() == FALSE){
                $this->vistas->__render($data, 'ficha_create');
            }else{
                $params['rut_paciente'] = $this->input->post('rut_paciente');
                $params['enf_actual'] = $this->input->post('enf_actual');
                $params['motivo_consulta'] = $this->input->post('motivo');
                $params['sexo'] = $this->input->post('sexo');
                $params['peso'] = $this->input->post('peso');
                $params['talla'] = $this->input->post('talla');
                $params['sangre'] = $this->input->post('sangre');
                $params['pulso'] = $this->input->post('pulso');
                $params['presion'] = $this->input->post('presion');
                $params['frec_respiratoria'] = $this->input->post('frec');
                $params['temperatura'] = $this->input->post('temperatura');
                $params['int_quirur'] = $this->input->post('int_quirur');
                $params['alergias'] = $this->input->post('alergias');
                $params['enfermedades'] = $this->input->post('enfermedades');
                $params['medicamentos'] = $this->input->post('medicamentos');
                $params['fuma'] = $this->input->post('fuma');
                $params['alcohol'] = $this->input->post('alcohol');
                $params['enf_congenita'] = $this->input->post('enf_congenita');
                $params['enf_cardiaca'] = $this->input->post('enf_cardiaca');
                $params['enf_genetica'] = $this->input->post('enf_genetica');
                $params['otras'] = $this->input->post('otras');
                $params['diagnostico'] = $this->input->post('diagnostico');
                $params['proxima_cita'] = $this->input->post('proxima_cita');
                $params['rut_doctor'] = $data['info_usuario']['user_info']->rut;
                //
                $resp = $this->ficha_model->insert($params);
                if(is_null($resp)){
                    $data['message'] = "Error al crear nueva ficha.";
                }else{
                    $data['message'] = "Exito al crear nueva ficha."
                            . "&nbsp;<a href=\"".$this->agent->referrer()  ."\">Volver</a>";
                }            
                $this->vistas->__render($data, 'error');
    
            }
        }else{
            redirect("login/index", 'refresh');
        }        
    }

    public function detail($id = NULL){
        if($this->ion_auth->logged_in()){
            if($id){
                $params["id"] = $id;
                $resultado = $this->ficha_model->selectbyid($params);
            }else{
                redirect("login/index", 'refresh');
            }            
            $param["rut_doctor"] = $resultado[0]["rut_doctor"];
            $param["rut_paciente"] = $resultado[0]["rut_paciente"];
            $param["id"] = $resultado[0]["id"];
            $data["results"] = $this->ficha_model->get_detail_by_user_login_paciente($param);
            $data['info_usuario'] = $this->permisos->get_user_data();
            //$this->utiles->__custom_debug($data["results"]);
            $this->vistas->__render($data, 'ficha_detail');
        }else{
            redirect("login/index", 'refresh');
        }
    }

}
