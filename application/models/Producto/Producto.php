<?php

class Producto extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    public function busc_producto($nombre, $empresa){
        $query = $this->db->query("SELECT pro.id, pro.nombre, pro.descripcion, pro.estado, pro.costo_neto, pro.moneda 
                                     FROM fact_productos pro, glob_empresas emp
                                    WHERE emp.rut = '" . $empresa . "'
                                      AND emp.estado = 1
                                      AND pro.rut_empresa = emp.rut
                                      AND pro.nombre = '" . $nombre . "'");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}

    public function busc_producto_no_id($nombre, $id, $empresa){
        $query = $this->db->query("SELECT pro.id, pro.nombre, pro.descripcion, pro.estado, pro.costo_neto, pro.moneda 
                                     FROM fact_productos pro, glob_empresas emp
                                    WHERE emp.rut = '" . $empresa . "'
                                      AND emp.estado = 1
                                      AND pro.rut_empresa = emp.rut
                                      AND pro.nombre = '" . $nombre . "'
                                      AND pro.id <> " . $id);
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}

    public function get_producto($id){
        $query = $this->db->query("SELECT pro.id, pro.nombre, pro.descripcion, pro.estado, pro.costo_neto, pro.moneda 
                                     FROM fact_productos pro
                                    WHERE pro.id = '" . $id . "'");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}

    function update_producto($id, $data){
        $this->db->where('id', $id);
        $this->db->update('fact_productos' ,$data);
    }
    
    function insert_producto($data){
        $this->db->insert('fact_productos', $data);
    }
    
    function delete_producto($id){
        $this->db->where('id', $id);
        $this->db->delete('fact_productos');
    }
    
    public function lista_productos($estado, $empresa){
        $query = $this->db->query("SELECT pro.id, pro.nombre, pro.descripcion, pro.estado, pro.costo_neto, pro.moneda 
                                     FROM fact_productos pro, glob_empresas emp
                                    WHERE emp.rut = '" . $empresa . "'
                                      AND emp.estado = 1
                                      AND pro.rut_empresa = emp.rut 
                                      AND pro.estado in (" . $estado . ")
                                    ORDER BY pro.nombre ASC");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}
    
    function grilla_productos($estado, $empresa, $editar, $eliminar) {
        $result = $this->lista_productos($estado, $empresa);
        
        $titulo = '<thead>
            <tr>
                <th data-class="expand">ID</th>
                <th data-hide="phone">Nombre</th>
                <th data-hide="phone,tablet">Descripcion</th>
                <th data-hide="phone,tablet">Moneda</th>
                <th data-hide="phone,tablet">Costo Neto</th>
                <th data-hide="phone,tablet">Estado</th>';
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
                                     <td></td>';
                                     if ($editar or $eliminar) { $cuerpo = $cuerpo . '<td></td>'; }                          
            $cuerpo = $cuerpo . '</tr>';
        } else {
            foreach ($result as $row) {
                if ($editar) { $editar = '<a href="Productos/Productos/EditarProducto/' . $row->id . '" data-backdrop="static" data-toggle="modal" data-target="#remoteModal" class="btn btn-primary btn-xs">Editar</a>'; }
                if ($eliminar) { $eliminar = '<a href="Productos/Productos/EliminarProducto/' . $row->id . '" class="btn btn-danger btn-xs btnEliminar">Eliminar</a>'; }
                
                if ($row->estado == 1){ $estado = 'Activo'; }
                else { $estado = 'Inactivo'; }
                $cuerpo = $cuerpo . '<tr>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->id . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->nombre . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:left;">'   . $row->descripcion . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->moneda . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:rigth;">' . $row->costo_neto . '</td>';
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
    
}
