<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {
    
    public function __construct() {
		parent::__construct();
        $this->load->model('Menus');
        $this->load->model('Utiles');
        $this->load->model('Varios/Parametros');
        $this->load->model('Sistema/Otros');
        $this->load->model('Venta/Venta');
        $this->load->model('Cliente/Cliente');
        $this->load->model('Producto/Producto');

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
    
    /* LISTA VENTAS */
    public function listaVentas($desde = FALSE, $hasta = FALSE) {
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Ventas';
        $datos['subTituloPagina'] = 'Ventas del sistema';
                
        $userdata2 = $this->session->userdata('logged_in');
        $rut_empresa = $userdata2['rut_empresa'];
        
        if (!$desde || !$hasta){
            $datos['desde'] = date('Y-m-d');
            $datos['hasta'] = date('Y-m-d');
        }
        else{
            $datos['desde'] = $desde;
            $datos['hasta'] = $hasta;
        }

        $datos['grilla'] = $this->Venta->grilla_ventas("1,0", $rut_empresa, $datos['desde'], $datos['hasta'], TRUE, FALSE);
        
        $this->load->view('ajax/Ventas/v_lista_ventas', $datos);
    }
    
    public function VerProductos($venta){
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['idVenta'] = $venta;
        $datos['tituloModal'] = "Productos";
        
        $datos['grilla'] = $this->Venta->grilla_productos($venta, false);

        $resp = $this->load->view('ajax/Ventas/v_productos_modal', $datos, true);
        echo $resp;
    }
    /* --- */
    
    /* LISTA VENTAS */
    public function IngresarVenta($venta = FALSE) {
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Ingresar Ventas';
        $datos['subTituloPagina'] = 'Ingreso del las Venta';
                
        $userdata2 = $this->session->userdata('logged_in');
        $rut_empresa = $userdata2['rut_empresa'];
        
        $datos['cboClientes'] = $this->Cliente->cbo_clientes("1", $rut_empresa);
        $datos['grilla'] = $this->Venta->grilla_productos("0", true);
        $datos['fecha'] = date('Y-m-d');
        $this->load->view('ajax/Ventas/v_nueva_venta', $datos);
    }
    /* --- */
}