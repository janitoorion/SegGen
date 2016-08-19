<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
    
    public function __construct() {
		parent::__construct();
        $this->load->model('Menus');
        $this->load->model('Utiles');
        $this->load->model('Producto/Producto');
        $this->load->model('Varios/Parametros');

        /* IDIOMA */
        $idioma = "";
        if ($this->session->userdata('idioma_seleccionado')) {
            $userdata = $this->session->userdata('idioma_seleccionado');
            $idioma = $userdata['idioma'];
        }
        else {
            $userdata = array('idioma' => 'es');
            $this->session->set_userdata('idioma_seleccionado', $userdata);
            $idioma = 'es';
        }
        
        if ($idioma == 'es'){ $this->lang->load('es','spanish'); }
        else { $this->lang->load('en','english'); }
        /* --- */
        
        /* VALIDA LOGIN */
        if (!$this->session->userdata('logged_in')) {
            if ($this->session->userdata('logged_remember')) {
                $userdata = $this->session->userdata('logged_remember');
                $remember = $userdata['remember'];
                $usuario = $userdata['usuario'];
                if ($remember == 'on'){
                    redirect('Lock', 'refresh');
                }
                else{
                    redirect('Login', 'refresh');
                }
            }
            else {
                redirect('Login', 'refresh');
            }
            redirect('Login', 'refresh'); 
        }
        /* --- */
	}
    
    /* LISTA PRODUCTOS */
    public function listaProductos($recarga = false) {
        
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Productos';
        $datos['subTituloPagina'] = 'Productos del sistema';
        
        $userdata2 = $this->session->userdata('logged_in');
        $rut_empresa = $userdata2['rut_empresa'];

        $datos['grilla'] = $this->Producto->grilla_productos("1,0", $rut_empresa, TRUE, TRUE); //EDITAR y ELIMINAR
        
        if (!$recarga){
            $this->load->view('ajax/Productos/v_lista_productos', $datos);
        } else {
            $resp = $this->load->view('ajax/Productos/v_lista_productos', $datos, true);
            echo $resp;
        }
    }
    
    public function NuevoProducto(){
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Productos';
        $datos['subTituloPagina'] = 'Productos del sistema';
        
        $datos['cboMonedas'] = $this->Parametros->cbo_monedas("1");
        $datos['cboEstados'] = $this->Parametros->cbo_estados("1");
        $datos['idProducto'] = 0;
        $datos['tituloModal'] = "Nuevo Producto";
        
        $datos['result_nombre'] = "";
        $datos['result_descripcion'] = "";
        $datos['result_costo_neto'] = "";       

        $datos['result_id_moneda'] = "0";
        $datos['result_id_estado'] = "";
        

        $resp = $this->load->view('ajax/Productos/v_producto_modal', $datos, true);
        echo $resp;
    }
    
    public function EditarProducto($id){
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Productos';
        $datos['subTituloPagina'] = 'Productos del sistema';
        
        $datos['cboMonedas'] = $this->Parametros->cbo_monedas("1");
        $datos['cboEstados'] = $this->Parametros->cbo_estados("1");
        $datos['idProducto'] = $id;
        $datos['tituloModal'] = "Editar Producto";
        
        $result = $this->Producto->get_producto($id);
        foreach ($result as $row) {
            $datos['result_nombre'] = $row->nombre;
            $datos['result_descripcion'] = $row->descripcion;
            $datos['result_costo_neto'] = $row->costo_neto;

            $datos['result_id_moneda'] = $row->moneda;
            $datos['result_id_estado'] = $row->estado;
        }
        
        $resp = $this->load->view('ajax/Productos/v_producto_modal', $datos, true);
        echo $resp;
    }
    
    public function NuevoProductoGuardar(){
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $costo_neto = $this->input->post('costo_neto');

        $moneda = $this->input->post('cboMonedas');
        $estado = $this->input->post('cboEstados');
        
        $userdata2 = $this->session->userdata('logged_in');
        $rut_empresa = $userdata2['rut_empresa'];

        if (!$this->Producto->busc_producto($nombre, $rut_empresa)){
            $data = array('nombre' => $nombre,
                          'descripcion' => $descripcion,
                          'costo_neto' => $costo_neto,
                          'moneda' => $moneda,
                          'estado' => $estado,
                          'rut_empresa' => $rut_empresa
            );
            $this->Producto->insert_producto($data);
            //creado
            $respuesta = array("status" => 'true');
        }
        else{
            //existe.
            $respuesta = array("status" => 'Ya existe un producto con ese nombre.');
        }
        echo json_encode($respuesta);
    }
    
    public function EditarProductoGuardar(){
        $id = $this->input->post('idProducto');
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $costo_neto = $this->input->post('costo_neto');

        $moneda = $this->input->post('cboMonedas');
        $estado = $this->input->post('cboEstados');

        $userdata2 = $this->session->userdata('logged_in');
        $rut_empresa = $userdata2['rut_empresa'];

        if (!$this->Producto->busc_producto_no_id($nombre, $id, $rut_empresa)){
            $data = array('id' => $id,
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                        'costo_neto' => $costo_neto,
                        'moneda' => $moneda,
                        'estado' => $estado
            );
            //actualizado
            $this->Producto->update_producto($id, $data);
            $respuesta = array("status" => 'true'); 
        }
        else{
            //existe.
            $respuesta = array("status" => 'Ya existe un producto con ese nombre.');
        }

        echo json_encode($respuesta);
    }
    
    public function EliminarProducto($id){
        $this->Producto->delete_producto($id);
        $respuesta = array("status" => 'true');
                
        echo json_encode($respuesta);
    }
    /* --- */

}