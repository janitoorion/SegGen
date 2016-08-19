<?php

class Menus extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function menu_padre($sistema, $perfil) {
        $query = $this->db->query("select men.id, men.texto, men.texto_en, men.url, men.id_padre, men.icono, men.orden, men.estado 
                                     from glob_sistema sis, glob_perfil fil, glob_menu_perfil mpe, glob_menu men 
                                    where sis.id = " . $sistema . "
                                      and sis.estado = 1 
                                      and fil.id_sistema = sis.id
                                      and fil.id = " . $perfil . "
                                      and fil.estado = 1 
                                      and mpe.id_sistema = sis.id 
                                      and mpe.id_perfil = fil.id 
                                      and mpe.estado = 1 
                                      and men.id = mpe.id_menu 
                                      and men.estado = 1 
                                      and men.id_padre = 0
                                    order by men.orden asc");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    function menu_hijo($sistema, $perfil, $id) {
        $query = $this->db->query("select men.id, men.texto, men.texto_en, men.url, men.id_padre, men.icono, men.orden, men.estado 
                                     from glob_sistema sis, glob_perfil fil, glob_menu_perfil mpe, glob_menu men 
                                    where sis.id = " . $sistema . "
                                      and sis.estado = 1 
                                      and fil.id_sistema = sis.id
                                      and fil.id = " . $perfil . "
                                      and fil.estado = 1 
                                      and mpe.id_sistema = sis.id 
                                      and mpe.id_perfil = fil.id 
                                      and mpe.estado = 1 
                                      and men.id = mpe.id_menu 
                                      and men.estado = 1 
                                      and men.id_padre = " . $id . "
                                    order by men.orden asc");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
}
