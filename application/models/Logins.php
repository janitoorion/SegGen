<?php

class Logins extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function busca_usuario_login($username){

        $query = $this->db->query("SELECT usu.rut_empresa
                                     FROM glob_usuarios usu
                                    WHERE usu.estado = 1 
                                      AND usu.usuario = '". $username . "'");
        if ($query->num_rows() > 0) {
            $usuario = $query->result();
            $empresa = $usuario[0]->rut_empresa;

            if ($empresa <> null || $empresa <> ''){
                $query = $this->db->query("SELECT usu.id, usu.usuario, usu.nombre, usu.password, usu.id_perfil, sis.id id_sistema, 
                                                usu.rut_empresa, emp.nombre nombre_empresa, emp.estado estadoEmpresa
                                            FROM glob_usuarios usu, glob_perfil per, glob_sistema sis, glob_empresas emp
                                            WHERE usu.estado = 1 
                                            AND usu.usuario = '" . $username . "' 
                                            AND emp.rut = usu.rut_empresa
                                            AND per.id = usu.id_perfil 
                                            AND per.estado = 1 
                                            AND sis.id = per.id_sistema 
                                            AND sis.estado = 1");

                if ($query->num_rows() > 0) {
                    return $query->result();
                } else {
                    return FALSE;
                }

            }else{
                $query = $this->db->query("SELECT usu.id, usu.usuario, usu.nombre, usu.password, usu.id_perfil, sis.id id_sistema, 
                                                usu.rut_empresa, '' nombre_empresa, 1 estadoEmpresa
                                            FROM glob_usuarios usu, glob_perfil per, glob_sistema sis
                                            WHERE usu.estado = 1 
                                            AND usu.usuario = '" . $username . "' 
                                            AND per.id = usu.id_perfil 
                                            AND per.estado = 1 
                                            AND sis.id = per.id_sistema 
                                            AND sis.estado = 1");

                if ($query->num_rows() > 0) {
                    return $query->result();
                } else {
                    return FALSE;
                }

            }

        } else {
            return FALSE;
        }

	}
    
}
