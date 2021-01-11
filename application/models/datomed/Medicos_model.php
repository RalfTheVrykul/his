<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicos_model extends CI_Model{
    protected $table = array(
        'tb_doctores'=>'users',
    );
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get_total(){
        $qry = $this->db->count_all_results($this->table['tb_doctores']);
        return $qry;
    }
    
    public function get_current_page_records($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table['tb_doctores']);
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){
                $data[] = $row;
            }             
            return $data;
        }
        return false;
    }
    
    public function select_all_doctores(){
        /*Grupo Médicos = 5*/
        /*Selecciona solos los médicos que están activados en el sistema*/
        $sql = "SELECT u.id, u.first_name, u.last_name, u.rut FROM users AS u, users_groups AS g WHERE u.id = g.user_id AND g.group_id = 5 AND u.active = 1";
        $qry = $this->db->query($sql);
        $result = $qry->result_array();
        return $result;
    }

    public function select_all_doctores_by_especialidad($params){
        /*Grupo Médicos = 5*/
        /*Selecciona solos los médicos que están activados en el sistema*/
        $sql = "SELECT u.id, u.first_name, u.last_name, u.rut FROM users AS u, users_groups AS g WHERE u.id = g.user_id AND g.group_id = 5 AND u.active = 1 and u.especialidad = ".$this->db->escape($params['id_especialidad']);
        $qry = $this->db->query($sql);
        $result = $qry->result_array();
        return $result;
    }

    
}
