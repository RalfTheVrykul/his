<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ficha_model extends CI_Model{
    protected $table = array(
        'tb_ficha'=>'cofichamedica',
    );
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get_total(){
        $qry = $this->db->count_all_results($this->table['tb_ficha']);
        return $qry;
    }

    public function get_total_by_user_login_doctor($params){
        $this->db->where('rut_doctor',$params);
        $qry = $this->db->count_all_results($this->table['tb_ficha']);
        return $qry;
    }

    public function get_total_by_user_login_paciente($params){
        $this->db->where('rut_paciente',$params);
        $qry = $this->db->count_all_results($this->table['tb_ficha']);
        return $qry;
    }

    public function get_current_page_records_by_user_login_doctor($limit, $start, $params){
        /**
         * Si el rol es doctor, agregar a la respuesta sql
         * el rut del paciente para poder agendar horas al paciente.
         */
        $sql = "SELECT f.id, u.first_name, u.last_name, f.motivo_consulta, f.fecha, f.rut_doctor, f.rut_paciente, ag.tipo_atencion FROM cofichamedica AS f, users AS u, users_groups AS ug, agenda AS ag WHERE f.rut_paciente = u.rut AND u.id = ug.user_id AND f.rut_paciente = ag.rut_paciente AND ug.group_id = 4 AND f.rut_doctor = ".$this->db->escape($params)." LIMIT ".$this->db->escape($limit)." OFFSET ".$this->db->escape($start);
        $qry = $this->db->query($sql);
        return $qry->result_array();
    } 
    
    public function get_current_page_records_by_user_login_paciente($limit, $start, $params){
        $sql = "SELECT f.id, u.first_name, u.last_name, f.motivo_consulta, f.fecha, f.rut_doctor, f.rut_paciente, ag.tipo_atencion FROM cofichamedica AS f, users AS u, users_groups AS ug, agenda AS ag WHERE f.rut_doctor = u.rut AND u.id = ug.user_id AND f.rut_doctor = ag.rut_doctor AND ug.group_id = 5 AND f.rut_paciente = ".$this->db->escape($params)." LIMIT ".$this->db->escape($limit)." OFFSET ".$this->db->escape($start);
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function get_detail_by_user_login_paciente($params){
        $sql = "SELECT f.sangre, f.talla, f.peso, f.fuma, f.alcohol, f.sexo, f.id, u.first_name, u.last_name, f.motivo_consulta, f.fecha, f.rut_doctor, f.rut_paciente, ag.tipo_atencion, u.rut_colegio_medico, f.diagnostico FROM cofichamedica AS f, users AS u, users_groups AS ug, agenda AS ag WHERE f.rut_doctor = u.rut AND u.id = ug.user_id AND f.rut_doctor = ag.rut_doctor AND ug.group_id = 5 AND f.rut_paciente = ".$this->db->escape($params['rut_paciente'])." AND f.id = ".$this->db->escape($params['id']);
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function get_current_page_records($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table['tb_ficha']);
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){
                $data[] = $row;
            }             
            return $data;
        }
        return false;
    }
    
    public function selectbyid($params){
        $conditions = array(
            'id'=>$params['id']
        );
        $qry = $this->db->get_where($this->table['tb_ficha'], $conditions);
        $result = $qry->result_array();
        return $result;         
    }
    
    public function insert($params){    
        $opc = array(
            'rut_doctor'=>$params['rut_doctor'],
            'rut_paciente'=>$params['rut_paciente'],
            'motivo_consulta'=>$params['motivo_consulta'],
            'enf_actual'=>$params['enf_actual'],
            'sexo'=>$params['sexo'],
            'peso'=>$params['peso'],
            'talla'=>$params['talla'],
            'sangre'=>$params['sangre'],
            'pulso'=>$params['pulso'],
            'presion_arterial'=>$params['presion'],
            'temperatura'=>$params['temperatura'],
            'frec_respiratoria'=>$params['frec_respiratoria'],
            'int_quirur'=>$params['int_quirur'],
            'alergias'=>$params['alergias'],
            'enfermedades'=>$params['enfermedades'],
            'medicamentos'=>$params['medicamentos'],
            'fuma'=>$params['fuma'],
            'alcohol'=>$params['alcohol'],
            'enf_congenita'=>$params['enf_congenita'],
            'enf_cardiaca'=>$params['enf_cardiaca'],
            'enf_genetica'=>$params['enf_genetica'],
            'otras'=>$params['otras'],
            'diagnostico'=>$params['diagnostico'],
            'proxima_cita'=>$params['proxima_cita']
        );
        $this->db->insert($this->table['tb_ficha'],$opc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;         
    }
    
    public function update($params){
        $data = array(
            'nombre'=>$params['nombre']
        );
        $this->db->where('id', $params['id']);
        $this->db->update($this->table['tb_ficha'], $data);
        $resp = $this->db->affected_rows();
        return $resp;        
    }
    
    public function delete($id){
        $opc = array(
            'id'=>$id
        );
        $this->db->delete($this->table['tb_ficha'],$opc);
        $resp = $this->db->affected_rows();
        return $resp;        
    }
    
    public function select_all(){
        $qry = $this->db->get($this->table['tb_ficha']);
        $result = $qry->result_array();
        return $result;         
    }
    
}
