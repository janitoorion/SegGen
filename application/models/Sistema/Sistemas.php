<?php

class Sistemas extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    public function lista_sistemas($estado){
        $query = $this->db->query("SELECT sis.id, sis.nombre, sis.estado 
                                     FROM glob_sistema sis
                                    WHERE sis.estado in (".$estado.")
                                    ORDER BY sis.nombre ASC");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}
    
    function grilla_sistemas($estado) {
        $result = $this->lista_sistemas($estado);
        
        $titulo = '<thead>
            <tr>
                <th data-class="expand">ID</th>
                <th data-hide="phone">Sistema</th>
                <th data-hide="phone">Estado</th>
            </tr>
        </thead>';
        
        $cuerpo = '<tbody>';
        if (!$result) {
            $cuerpo = $cuerpo . '<tr>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                                                         
                                 </tr>';
        } else {
            foreach ($result as $row) {
                if ($row->estado == 1){ $estado = 'Activo'; }
                else { $estado = 'Inactivo'; }
                $cuerpo = $cuerpo . '<tr>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->id . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:left;">' . $row->nombre . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $estado . '</td>';
                                
                $cuerpo = $cuerpo . '</tr>';
            }
        }
        $cuerpo = $cuerpo . '</tbody>';
        
        return $titulo . $cuerpo;
    }
    
    function cbo_sistemas($estado) {
        $result = $this->lista_sistemas($estado);
        $cuerpo = '';
        if (!$result) {} 
        else {
            foreach ($result as $row) {
                $cuerpo = $cuerpo . '<option value="' . $row->id . '">' . $row->nombre . '</option>';
            }    
        }
        
        return $cuerpo;
    }
    
    function update_sistema($id, $data){
        $this->db->where('id', $id);
        $this->db->update('glob_sistema' ,$data);
    }
    
    function insertar_sistema($data){
        $this->db->insert('glob_sistema', $data);
    }
    
    function eliminar_sistema($id){
        $this->db->where('id', $id);
        $this->db->delete('glob_sistema');
    }
}
