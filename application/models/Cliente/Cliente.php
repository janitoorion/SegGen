<?php

class Cliente extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    public function busc_cliente($rut, $empresa){
        $query = $this->db->query("SELECT cli.rut, cli.nombre, cli.contacto, cli.email, cli.telefono, 
                                          cli.movil, cli.direccion, cli.region, cli.provincia, cli.comuna, 
                                          cli.codigo_postal, cli.estado 
                                     FROM fact_clientes cli, glob_empresas emp 
                                    WHERE emp.rut = '" . $empresa . "'
                                      AND emp.estado = 1
                                      AND cli.rut_empresa = emp.rut
                                      AND cli.rut = '" . $rut . "'");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}

    public function get_cliente($id, $empresa){
        $query = $this->db->query("SELECT cli.rut, cli.nombre, cli.contacto, cli.email, cli.telefono, 
                                          cli.movil, cli.direccion, cli.region, 
                                          cli.provincia, cli.comuna, 
                                          cli.codigo_postal, cli.estado 
                                     FROM fact_clientes cli, glob_empresas emp
                                    WHERE emp.rut = '" . $empresa . "'
                                      AND emp.estado = 1 
                                      AND cli.rut_empresa =emp.rut
                                      AND cli.rut = '" . $id . "'");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}

    function update_cliente($id, $empresa, $data){
        $this->db->where('rut', $id);
        $this->db->where('rut_empresa', $empresa);
        $this->db->update('fact_clientes' ,$data);
    }
    
    function insert_cliente($data){
        $this->db->insert('fact_clientes', $data);
    }
    
    function delete_cliente($id, $empresa){
        $this->db->where('rut', $id);
        $this->db->where('rut_empresa', $empresa);
        $this->db->delete('fact_clientes');
    }
    
    public function lista_clientes($estado, $empresa){
        $query = $this->db->query("SELECT cli.rut, cli.nombre, cli.contacto, cli.email, cli.telefono, 
                                          cli.movil, cli.direccion, reg.str_descripcion region, 
                                          pro.str_descripcion provincia, com.str_descripcion comuna, 
                                          cli.codigo_postal, cli.estado 
                                     FROM fact_clientes cli
									 LEFT OUTER JOIN glob_regiones reg ON cli.region = reg.id_re
                                     LEFT OUTER JOIN glob_provincias pro ON cli.provincia = pro.id_pr
                                     LEFT OUTER JOIN glob_comunas com ON cli.comuna = com.id_co
                                     , glob_empresas emp
                                    WHERE cli.estado in (" . $estado . ")
                                      AND emp.rut = cli.rut_empresa
                                      AND emp.rut = '" . $empresa . "'
                                      AND emp.estado = 1
                                    ORDER BY cli.nombre ASC");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}
    
    function grilla_clientes($estado, $empresa, $editar, $eliminar) {
        $result = $this->lista_clientes($estado, $empresa);
        
        $titulo = '<thead>
            <tr>
                <th data-class="expand">Rut</th>
                <th data-hide="phone">Nombre</th>
                <th data-hide="phone,tablet">Contacto</th>
                <th data-hide="phone,tablet">Email</th>
                <th data-hide="phone,tablet,pc">Telefono</th>
                <th data-hide="phone,tablet,pc">Movil</th>
                <th data-hide="phone,tablet,pc">Direccion</th>
                <th data-hide="phone,tablet,pc">Region</th>
                <th data-hide="phone,tablet,pc">Provincia</th>
                <th data-hide="phone,tablet,pc">Comuna</th>
                <th data-hide="phone,tablet,pc">Codigo Postal</th>
                <th data-hide="phone,tablet,pc">Estado</th>';
                if ($editar || $eliminar) { $titulo = $titulo . '<td></td>'; }      
                $titulo = $titulo . '</tr>
        </thead>';
        
        $cuerpo = '<tbody>';
        if (!$result) {
            $cuerpo = $cuerpo . '<tr>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>';
                                     if ($editar or $eliminar) { $cuerpo = $cuerpo . '<td></td>'; }                          
            $cuerpo = $cuerpo . '</tr>';
        } else {
            foreach ($result as $row) {
                if ($editar) { $editar = '<a href="Clientes/Clientes/EditarCliente/' . $row->rut . '" data-backdrop="static" data-toggle="modal" data-target="#remoteModal" class="btn btn-primary btn-xs">Editar</a>'; }
                if ($eliminar) { $eliminar = '<a href="Clientes/Clientes/EliminarCliente/' . $row->rut . '" class="btn btn-danger btn-xs btnEliminar">Eliminar</a>'; }
                
                if ($row->estado == 1){ $estado = 'Activo'; }
                else { $estado = 'Inactivo'; }
                $cuerpo = $cuerpo . '<tr>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->rut . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->nombre . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:left;">' . $row->contacto . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->email . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->telefono . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->movil . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->direccion . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->region . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:left;">' . $row->provincia . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->comuna . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->codigo_postal . '</td>';
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
    
    function cbo_clientes($estado, $empresa) {
        $result = $this->lista_clientes($estado, $empresa);
        $cuerpo = '';
        if (!$result) {} 
        else {
            foreach ($result as $row) {
                $cuerpo = $cuerpo . '<option value="' . $row->rut . '">' . '(' . $row->rut . ') ' . $row->nombre . '</option>';
            }    
        }
        
        return $cuerpo;
    }
}
