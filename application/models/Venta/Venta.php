<?php

class Venta extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    public function get_venta($id, $empresa){
        $query = $this->db->query("SELECT ven_enc.id, ven_enc.rut_empresa, ven_enc.folio, ven_enc.fecha, 
                                          ven_enc.cliente, ven_enc.moneda, ven_enc.total_neto, ven_enc.obs, ven_enc.estado 
                                     FROM fact_enc_venta ven_enc, glob_empresas emp  
                                    WHERE emp.rut = '" . $empresa . "'
                                      AND emp.estado = 1
                                      AND ven_enc.rut_empresa = emp.rut
                                      AND ven_enc.id = " . $id);
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}

    public function get_productos($venta){
        $query = $this->db->query("SELECT ven_det.id, ven_det.venta, ven_det.producto, ven_det.cantidad, ven_det.moneda, ven_det.costo_neto, 
                                          ven_det.estado, pro.nombre, pro.costo_neto, pro.moneda, pro.descripcion, 
                                          (ven_det.costo_neto * ven_det.cantidad) total_neto
                                     FROM fact_det_venta ven_det, fact_productos pro
                                    WHERE ven_det.venta = " . $venta . "
                                      AND pro.id = ven_det.producto");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}

    function update_venta($id, $empresa, $data){
        $this->db->where('id', $id);
        $this->db->where('rut_empresa', $empresa);
        $this->db->update('fact_enc_venta' ,$data);
    }
    
    function insert_venta($data){
        $this->db->insert('fact_enc_venta', $data);
    }
    
    function delete_venta($id, $empresa){
        $this->db->where('id', $id);
        $this->db->where('rut_empresa', $empresa);
        $this->db->delete('fact_enc_venta');
    }
    
    public function lista_ventas($estado, $empresa, $desde, $hasta){
        $query = $this->db->query("SELECT enc_ven.id, enc_ven.rut_empresa, enc_ven.folio, enc_ven.fecha, enc_ven.moneda,
                                          enc_ven.total_neto, enc_ven.obs, enc_ven.estado, cli.rut cliente, cli.nombre nombre_cliente
                                     FROM fact_enc_venta enc_ven 
                                     LEFT OUTER JOIN fact_clientes cli ON enc_ven.cliente = cli.rut
                                    WHERE enc_ven.estado in (" . $estado . ")
                                      AND enc_ven.rut_empresa = '" . $empresa . "'
                                      AND enc_ven.fecha between STR_TO_DATE('" . $desde . "', '%Y-%m-%d')
                                      AND STR_TO_DATE('" . $hasta . "', '%Y-%m-%d')");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}
    
    function grilla_ventas($estado, $empresa, $desde, $hasta, $productos, $facturar) {
        $result = $this->lista_ventas($estado, $empresa, $desde, $hasta);
        
        $titulo = '<thead>
            <tr>
                <th data-class="expand">Folio</th>
                <th data-hide="phone">Fecha</th>
                <th data-hide="phone,tablet">Cliente</th>
                <th data-hide="phone,tablet">Nombre</th>
                <th data-hide="phone,tablet">Moneda</th>
                <th data-hide="phone,tablet">Total Neto</th>
                <th data-hide="phone,tablet">Estado</th>
                <th data-hide="phone,tablet,pc">Observaciones</th>';
                if ($productos || $facturar) { $titulo = $titulo . '<td></td>'; }      
                $titulo = $titulo . '</tr>
        </thead>';
        
        $cuerpo = '<tbody>';
        if (!$result) {
        } else {
            foreach ($result as $row) {
                if ($productos) { $productos = '<a href="Ventas/Ventas/VerProductos/' . $row->id . '" data-backdrop="static" data-toggle="modal" data-target="#remoteModal" class="btn btn-primary btn-xs">Productos</a>'; }
                if ($facturar) { $facturar = '<a href="Ventas/Ventas/EmiFactura/' . $row->id . '" class="btn btn-success btn-xs btnFacturar">Facturar</a>'; }
                
                $folio = "Pendiente";
                if ($row->folio != "0"){
                    $folio = $row->folio;
                    $facturar = "";
                }

                if ($row->estado == 1){ $estado = 'Activo'; }
                else { $estado = 'Inactivo'; }
                $cuerpo = $cuerpo . '<tr>';
                $cuerpo = $cuerpo . '<td style="text-align:left;">' . $folio . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->fecha . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:left;">' . $row->cliente . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->nombre_cliente . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->moneda . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->total_neto . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $estado . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->obs . '</td>';
                                
                if ($productos||$facturar) { 
                    $cuerpo = $cuerpo . '<td style="text-align:center;">' . $productos . ' ' . $facturar . '</td>';   
                }
                           
                $cuerpo = $cuerpo . '</tr>';
            }
        }
        $cuerpo = $cuerpo . '</tbody>';
        
        return $titulo . $cuerpo;
    }
    
    function grilla_productos($venta, $eliminar) {
        $result = $this->get_productos($venta);
        
        $titulo = '<thead>
            <tr>
                <th data-class="expand">Nombre</th>
                <th data-hide="phone">Descripción</th>
                <th data-hide="phone">Cantidad</th>
                <th data-hide="phone,tablet">Moneda</th>
                <th data-hide="phone,tablet">Costo Neto</th>
                <th data-hide="phone,tablet">Total Neto</th>';
                if ($eliminar) { $titulo = $titulo . '<td></td>'; }      
                $titulo = $titulo . '</tr>
        </thead>';
        
        $cuerpo = '<tbody>';
        if (!$result) {
        } else {
            foreach ($result as $row) {
                if ($eliminar) { $eliminar = '<a href="Ventas/Ventas/EliProducto/' . $venta . '/' . $row->id . '" class="btn btn-success btn-xs btnFacturar">Eliminar</a>'; }
                
                $cuerpo = $cuerpo . '<tr>';
                $cuerpo = $cuerpo . '<td style="text-align:left;">' . $row->nombre . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:left;">' . $row->descripcion . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->cantidad . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->moneda . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:rigth;">' . $row->costo_neto . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:rigth;">' . $row->total_neto . '</td>';            
                if ($eliminar) { 
                    $cuerpo = $cuerpo . '<td style="text-align:center;">' . $eliminar . '</td>';   
                }
                           
                $cuerpo = $cuerpo . '</tr>';
            }
        }
        $cuerpo = $cuerpo . '</tbody>';
        
        return $titulo . $cuerpo;
    }
}
