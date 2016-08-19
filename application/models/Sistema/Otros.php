<?php

class Otros extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    public function lista_regiones(){
        $query = $this->db->query("SELECT reg.id_re, reg.str_descripcion FROM glob_regiones reg 
                                    ORDER BY reg.id_re ASC");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}

    function cbo_regiones() {
        $result = $this->lista_regiones();
        $cuerpo = '';
        if (!$result) {} 
        else {
            foreach ($result as $row) {
                $cuerpo = $cuerpo . '<option value="' . $row->id_re . '">' . $row->str_descripcion . '</option>';
            }    
        }
        
        return $cuerpo;
    }
    
    public function lista_provincias($region){
        $query = $this->db->query("SELECT pro.id_pr, pro.str_descripcion FROM glob_provincias pro
                                    WHERE pro.id_re = " . $region . " 
                                    ORDER BY pro.id_pr ASC");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}

    function cbo_provincias($region) {
        $result = $this->lista_provincias($region);
        $cuerpo = '';
        if (!$result) {} 
        else {
            foreach ($result as $row) {
                $cuerpo = $cuerpo . '<option value="' . $row->id_pr . '">' . $row->str_descripcion . '</option>';
            }    
        }
        
        return $cuerpo;
    }

    public function lista_comunas($provincia){
        $query = $this->db->query("SELECT com.id_co, com.str_descripcion FROM glob_comunas com 
                                    WHERE com.id_pr = " . $provincia . " 
                                    ORDER BY com.id_co ASC");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}

    function cbo_comunas($provincia) {
        $result = $this->lista_comunas($provincia);
        $cuerpo = '';
        if (!$result) {} 
        else {
            foreach ($result as $row) {
                $cuerpo = $cuerpo . '<option value="' . $row->id_co . '">' . $row->str_descripcion . '</option>';
            }    
        }
        
        return $cuerpo;
    }
}
