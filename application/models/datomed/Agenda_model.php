<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_model extends CI_Model{
    protected $table = array(
        'tb_agenda'=>'agenda',
    );
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get_total(){
        $qry = $this->db->count_all_results($this->table['tb_agenda']);
        return $qry;
    }

    public function get_total_by_user_login_paciente($params){
        $this->db->where('rut_paciente',$params);
        $qry = $this->db->count_all_results($this->table['tb_agenda']);
        return $qry;
    }    

    public function get_total_by_user_login_doctor($params){
        $this->db->where('rut_doctor',$params);
        $qry = $this->db->count_all_results($this->table['tb_agenda']);
        return $qry;
    }    

    public function get_current_page_records($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table['tb_agenda']);
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){
                $data[] = $row;
            }             
            return $data;
        }
        return false;
    }

    public function get_current_page_records_by_user_login_paciente($limit, $start, $params){
        $sql = "SELECT a.id, u.first_name, u.last_name, a.fecha, a.hora, a.tipo_atencion, a.motivo, a.estado FROM agenda AS a, users AS u, users_groups as ug WHERE a.rut_doctor = u.rut AND u.id = ug.user_id AND ug.group_id = 5 and rut_paciente = ".$this->db->escape($params)." LIMIT ".$this->db->escape($limit)." OFFSET ".$this->db->escape($start);
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function get_current_page_records_by_user_login_doctor($limit, $start, $params){
        /**
         * Si el rol es doctor, agregar a la respuesta sql
         * el rut del paciente para poder agendar horas al paciente.
         */
        $sql = "SELECT a.id, u.rut, a.rut_paciente,u.first_name, u.last_name, a.fecha, a.hora, a.tipo_atencion, a.motivo, a.estado FROM agenda AS a, users AS u, users_groups as ug WHERE a.rut_paciente = u.rut AND u.id = ug.user_id AND ug.group_id = 4 and rut_doctor = ".$this->db->escape($params)." LIMIT ".$this->db->escape($limit)." OFFSET ".$this->db->escape($start);
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }    
    
    public function selectbyid($params){
        $conditions = array(
            'id'=>$params['blog_id']
        );
        $qry = $this->db->get_where($this->table['tb_agenda'], $conditions);
        $result = $qry->result_array();
        return $result;         
    }
    
    public function insert($params){
        $fecha_format = date("Y-m-d", strtotime($params['fecha']));
        $opc = array(
            'rut_doctor'=>$params['rut_doctor'],
            'rut_paciente'=>$params['rut_paciente'],
            'fecha'=>$fecha_format,
            'hora'=>$params['hora'],
            'tipo_atencion'=>$params['atencion'],
            'motivo'=>$params['motivo']
        );
        $this->db->insert($this->table['tb_agenda'],$opc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;         
    }

    public function update($params){
        $fecha_format = date("Y-m-d", strtotime($params['fecha']));
        $data = array(
            'fecha'=>$fecha_format,
            'hora'=>$params['hora'],
            'tipo_atencion'=>$params['atencion'],
            'motivo'=>$params['motivo']
        );
        $this->db->where('id', $params['id']);
        $this->db->update($this->table['tb_agenda'], $data);
        $resp = $this->db->affected_rows();
        return $resp;        
    }

    public function delete($id){
        $opc = array(
            'id'=>$id
        );
        $this->db->delete($this->table['tb_agenda'],$opc);
        $resp = $this->db->affected_rows();
        return $resp;        
    }    
    public function selectbyid_paciente($params){
        $sql = "SELECT a.id, a.fecha, a.hora, a.motivo, a.tipo_atencion, e.nombre, u.first_name, u.last_name FROM agenda AS a, users AS u, coespecialidades AS e WHERE a.rut_doctor = u.rut AND u.especialidad = e.id AND a.id = ".$this->db->escape($params['agenda_id'])." AND a.estado <> 3";
        $qry = $this->db->query($sql);
        return $qry->result_array();       
    }    
    private function time_format($h){
        //return gmdate("H:i:s", $h);
        return substr($h, 0, 1) == "0" ? substr($h, 1) : $h;
    }

}
