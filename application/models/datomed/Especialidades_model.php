<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidades_model extends CI_Model{
    protected $table = array(
        'tb_espmedicas'=>'coespecialidades',
    );
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get_total(){
        $qry = $this->db->count_all_results($this->table['tb_espmedicas']);
        return $qry;
    }
    
    public function get_current_page_records($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table['tb_espmedicas']);
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){
                $data[] = $row;
            }             
            return $data;
        }
        return false;
    }

    public function select_all(){
        $qry = $this->db->get($this->table['tb_espmedicas']);
        $result = $qry->result_array();
        return $result;         
    }    

    public function select_all_doctores_by_especialidad($id){
        /*Grupo Médicos = 5*/
        /*Selecciona solos los médicos que están activados en el sistema*/
        $sql = "SELECT u.id, u.first_name, u.last_name, u.rut FROM users AS u, users_groups AS g WHERE u.id = g.user_id AND g.group_id = 5 AND u.active = 1 and u.especialidad = ".$this->db->escape($id);
        $qry = $this->db->query($sql);
        $result = $qry->result_array();
        return $result;
    }

    
}
