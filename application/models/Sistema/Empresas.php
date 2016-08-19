<?php

class Empresas extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->model('Sistema/Usuarios');
    }
    
    public function busc_empresa($rut, $nombre){
        $query = $this->db->query("SELECT emp.rut, emp.nombre, emp.estado,
                                          DATE_FORMAT(emp.creacion,'%d/%m/%Y') creacion,
                                          DATE_FORMAT(emp.modificacion,'%d/%m/%Y') modificacion
                                     FROM glob_empresas emp 
                                    WHERE upper(emp.rut) = upper('" . $rut . "') or upper(emp.nombre) = upper('" . $nombre . "')
                                    ORDER BY emp.nombre asc");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}

    public function busc_empresa_otra($rut, $nombre){
        $query = $this->db->query("SELECT emp.rut, emp.nombre, emp.estado,
                                          DATE_FORMAT(emp.creacion,'%d/%m/%Y') creacion,
                                          DATE_FORMAT(emp.modificacion,'%d/%m/%Y') modificacion 
                                     FROM glob_empresas emp 
                                    WHERE upper(emp.nombre) = upper('" . $nombre . "') 
                                      AND upper(emp.rut) <> upper('" . $rut . "')
                                    ORDER BY emp.nombre asc");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}
    
    public function get_empresa($rut){
        $query = $this->db->query("SELECT emp.rut, emp.nombre, emp.estado,
                                          DATE_FORMAT(emp.creacion,'%d/%m/%Y') creacion,
                                          DATE_FORMAT(emp.modificacion,'%d/%m/%Y') modificacion
                                     FROM glob_empresas emp 
                                    WHERE emp.rut = '" . $rut . "'");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}
    
    public function lista_empresas($estado){
        $query = $this->db->query("SELECT emp.rut, emp.nombre, emp.estado,
                                          DATE_FORMAT(emp.creacion,'%d/%m/%Y') creacion,
                                          DATE_FORMAT(emp.modificacion,'%d/%m/%Y') modificacion 
                                     FROM glob_empresas emp 
                                    WHERE emp.estado in (" . $estado . ") 
                                    ORDER BY emp.nombre ASC");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}
    
    function grilla_empresas($estado, $editar, $eliminar) {
        $result = $this->lista_empresas($estado);
        
        $titulo = '<thead>
            <tr>
                <th data-class="expand">Rut</th>
                <th data-hide="phone">Nombre</th>
                <th data-hide="phone">Creación</th>
                <th data-hide="phone">Modificación</th>
                <th data-hide="phone">Estado</th>';
                if ($editar || $eliminar) { $titulo = $titulo . '<td></td>'; }      
                $titulo = $titulo . '</tr>
        </thead>';
        
        $cuerpo = '<tbody>';
        if (!$result) {
        } else {
            foreach ($result as $row) {
                if ($editar) { $editar = '<a href="Sistema/Empresa/EditarEmpresa/' . $row->rut . '" data-backdrop="static" data-toggle="modal" data-target="#remoteModal" class="btn btn-primary btn-xs">Editar</a>'; }
                if ($eliminar) { $eliminar = '<a href="Sistema/Empresa/EliminarEmpresa/' . $row->rut . '" class="btn btn-danger btn-xs btnEliminar">Eliminar</a>'; }
                
                if ($row->estado == 1){ $estado = 'Activo'; }
                else { $estado = 'Inactivo'; }
                $cuerpo = $cuerpo . '<tr>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->rut . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:left;">' . $row->nombre . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->creacion . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->modificacion . '</td>';
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

    function grilla_usuarios($estado, $empresa, $editar, $eliminar) {   
        $result = $this->Usuarios->lista_usuarios($estado, $empresa);
        
        $titulo = '<thead>
            <tr>
                <th data-class="expand">Rut</th>
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
                if ($editar) { $editar = '<a href="Sistema/Empresa/EditarUsuario/' . $row->id . '/' . $empresa . '" data-backdrop="static" data-toggle="modal" data-target="#remoteModal" class="btn btn-primary btn-xs">Editar</a>'; }
                if ($eliminar) { $eliminar = '<a href="Sistema/Empresa/EliminarUsuario/' . $row->id . '" class="btn btn-danger btn-xs btnEliminar">Eliminar</a>'; }
                if ($row->estado == 1){ $estado = 'Activo'; }
                else { $estado = 'Inactivo'; }
                $cuerpo = $cuerpo . '<tr>';
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

    function update_empresa($rut, $data){
        $this->db->where('rut', $rut);
        $this->db->update('glob_empresas' ,$data);
    }
    
    function insert_empresa($data){
        $this->db->insert('glob_empresas', $data);
    }
    
    function delete_empresa($rut){
        $this->db->where('rut', $rut);
        $this->db->delete('glob_empresas');
    }
    
    function cbo_empresas($estado) {
        $result = $this->lista_empresas($estado);
        $cuerpo = '';
        if (!$result) {} 
        else {
            foreach ($result as $row) {
                $cuerpo = $cuerpo . '<option value="' . $row->rut . '">' . $row->nombre . '</option>';
            }    
        }
        
        return $cuerpo;
    }
}
