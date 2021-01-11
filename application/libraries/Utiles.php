<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
Varios
*/
class Utiles {
    public function get_rol_by_usuario($objeto,$rol_id){
        /*
        $objeto -> $data['info_usuario']['group_info']
        $rol_id -> númerico
        return 0 = No existe el rol
        return 1 = Existe el rol
        */
        for($n = 0; $n < count($objeto); $n++){
            if($objeto[$n]->id == $rol_id){
                $response = 1;
                break;
            }else{
                $response = 0;
                break;
            }
        }
        return $response;
    }

    public function __custom_debug($objeto){
        echo "<pre>";
        print_r($objeto);
        echo "<pre>";
        die();
    }

    public function __elimina_espacios($cadena){
        $response = trim($cadena);
        return $response;
    }
}