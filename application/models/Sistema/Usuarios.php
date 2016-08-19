<?php

class Usuarios extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    public function busc_usuario($usuario, $empresa){
        $query = $this->db->query("SELECT usu.id, usu.usuario, usu.nombre, usu.email, usu.password, usu.id_perfil, 
                                          fil.nombre perfil, usu.estado, usu.rut_empresa 
                                     FROM glob_usuarios usu, glob_perfil fil, glob_empresas emp 
                                    WHERE emp.rut = '" . $empresa . "' 
                                      AND emp.estado = 1 
                                      AND usu.rut_empresa = emp.rut
                                      AND usu.usuario = '" . $usuario . "' 
                                      AND fil.id = usu.id_perfil 
                                    ORDER BY usu.nombre ASC");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}
    
    public function get_usuario($id){
        $query = $this->db->query("SELECT usu.id, usu.usuario, usu.nombre, usu.email, usu.password, usu.id_perfil, fil.nombre perfil, usu.estado, usu.rut_empresa 
                                     FROM glob_usuarios usu, glob_perfil fil
                                    WHERE usu.id = " . $id . "
                                      AND fil.id = usu.id_perfil
                                    ORDER BY usu.nombre ASC");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}
    
    public function lista_usuarios($estado, $empresa){
        $query = $this->db->query("SELECT usu.id, usu.usuario, usu.nombre, usu.email, usu.password, usu.id_perfil, 
                                          fil.nombre perfil, usu.estado, usu.rut_empresa 
                                     FROM glob_usuarios usu, glob_perfil fil, glob_empresas emp 
                                    WHERE emp.rut = '" . $empresa . "' 
                                      AND usu.rut_empresa = emp.rut 
                                      AND usu.estado in (" . $estado . ") 
                                      AND emp.estado = 1 
                                      AND fil.id = usu.id_perfil 
                                    ORDER BY usu.nombre ASC");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}
    
    function grilla_usuarios($estado, $empresa, $editar, $eliminar) {
        $result = $this->lista_usuarios($estado, $empresa);
        
        $titulo = '<thead>
            <tr>
                <th data-class="expand">ID</th>
                <th data-hide="phone">Rut</th>
                <th data-hide="phone">Nombre</th>
                <th data-hide="phone">Email</th>
                <th data-hide="phone">Perfil</th>
                <th data-hide="phone">Estado</th>';
                if ($editar || $eliminar) { $titulo = $titulo . '<td></td>'; }      
                $titulo = $titulo . '</tr>
        </thead>';
        
        $cuerpo = '<tbody>';
        if (!$result) {
            
        } else {
            foreach ($result as $row) {
                if ($editar) { $editar = '<a href="Sistema/Usuario/EditarUsuario/' . $row->id . '" data-backdrop="static" data-toggle="modal" data-target="#remoteModal" class="btn btn-primary btn-xs">Editar</a>'; }
                if ($eliminar) { $eliminar = '<a href="Sistema/Usuario/EliminarUsuario/' . $row->id . '" class="btn btn-danger btn-xs btnEliminar">Eliminar</a>'; }
                if ($row->estado == 1){ $estado = 'Activo'; }
                else { $estado = 'Inactivo'; }
                $cuerpo = $cuerpo . '<tr>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->id . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->usuario . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:left;">' . $row->nombre . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->email . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->perfil . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $estado . '</td>';
                if ($editar||$eliminar) { 
                    $cuerpo = $cuerpo . '<td style="text-align:center;">' . $editar . ' ' . $eliminar . '</td>';   
                }
                           
                $cuerpo = $cuerpo . '</tr>';
            }
        }
        $cuerpo = $cuerpo . '</tbody>';
        
        return $titulo . $cuerpo;
    }
    
    function update_usuario($id, $data){
        $this->db->where('id', $id);
        $this->db->update('glob_usuarios' ,$data);
    }
    
    function insertar_usuario($data){
        $this->db->insert('glob_usuarios', $data);
    }
    
    function eliminar_usuario($id){
        $this->db->where('id', $id);
        $this->db->delete('glob_usuarios');
    }
    
    public function nueva_password($id, $password) {
        $data = array(
            'password' => $password
        );

        $this->db->where('id', $id);
        $this->db->update('glob_usuarios', $data);
    }
}
