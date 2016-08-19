<?php

class Perfiles extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    public function lista_perfiles($estado){
        $query = $this->db->query("SELECT fil.id, fil.nombre, fil.id_sistema, sis.nombre sistema, fil.estado 
                                     FROM glob_perfil fil, glob_sistema sis
                                    WHERE fil.estado in (".$estado.")
                                      AND sis.id = fil.id_sistema
                                      AND sis.estado in (".$estado.")
                                      AND fil.id <> 4
                                    ORDER BY fil.nombre ASC");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
	}
    
    function grilla_perfiles($estado) {
        $result = $this->lista_perfiles($estado);
        
        $titulo = '<thead>
            <tr>
                <th data-class="expand">ID</th>
                <th data-hide="phone">Perfil</th>
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
                                     <td></td>
                                                                         
                                 </tr>';
        } else {
            foreach ($result as $row) {
                if ($row->estado == 1){ $estado = 'Activo'; }
                else { $estado = 'Inactivo'; }
                $cuerpo = $cuerpo . '<tr>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->id . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $row->nombre . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:left;">' . $row->sistema . '</td>';
                $cuerpo = $cuerpo . '<td style="text-align:center;">' . $estado . '</td>';
                                
                $cuerpo = $cuerpo . '</tr>';
            }
        }
        $cuerpo = $cuerpo . '</tbody>';
        
        return $titulo . $cuerpo;
    }
    
    function cbo_perfiles($estado) {
        $result = $this->lista_perfiles($estado);
        $cuerpo = '';
        if (!$result) {} 
        else {
            foreach ($result as $row) {
                $cuerpo = $cuerpo . '<option value="' . $row->id . '">' . $row->nombre . '</option>';
            }    
        }
        
        return $cuerpo;
    }
    
    function update_perfil($id, $data){
        $this->db->where('id', $id);
        $this->db->update('glob_perfil' ,$data);
    }
    
    function insertar_perfil($data){
        $this->db->insert('glob_perfil', $data);
    }
    
    function eliminar_perfil($id){
        $this->db->where('id', $id);
        $this->db->delete('glob_perfil');
    }
        
}
