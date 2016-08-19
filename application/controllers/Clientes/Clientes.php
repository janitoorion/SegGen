<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {
    
    public function __construct() {
		parent::__construct();
        $this->load->model('Menus');
        $this->load->model('Utiles');
        $this->load->model('Cliente/Cliente');
        $this->load->model('Varios/Parametros');
        $this->load->model('Sistema/Otros');
        
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
    
    /* LISTA CLIENTES */
    public function listaClientes($recarga = false) {
        
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Clientes';
        $datos['subTituloPagina'] = 'Clientes del sistema';
                
        $userdata2 = $this->session->userdata('logged_in');
        $rut_empresa = $userdata2['rut_empresa'];

        $datos['grilla'] = $this->Cliente->grilla_clientes("1,0", $rut_empresa, TRUE, TRUE); //EDITAR y ELIMINAR
        
        if (!$recarga){
            $this->load->view('ajax/Clientes/v_lista_clientes', $datos);
        } else {
            $resp = $this->load->view('ajax/Clientes/v_lista_clientes', $datos, true);
            echo $resp;
        }
    }
    
    public function NuevoCliente(){
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Clientes';
        $datos['subTituloPagina'] = 'Clientes del sistema';
        
        $datos['cboRegiones'] = $this->Otros->cbo_regiones("0");
        $datos['cboProvincias'] = $this->Otros->cbo_provincias("0");
        $datos['cboComunas'] = $this->Otros->cbo_comunas("0");
        $datos['cboEstados'] = $this->Parametros->cbo_estados("1");
        $datos['idCliente'] = 0;
        $datos['tituloModal'] = "Nuevo Cliente";
        
        $datos['result_rut'] = "";
        $datos['result_nombre'] = "";
        $datos['result_contacto'] = "";
        $datos['result_email'] = "";
        $datos['result_telefono'] = "";
        $datos['result_movil'] = "";
        $datos['result_direccion'] = "";
        $datos['result_codigo_postal'] = "";
        
        $datos['result_id_region'] = "0";
        $datos['result_id_provincia'] = "0";
        $datos['result_id_comuna'] = "0";

        $datos['result_id_estado'] = "";
        

        $resp = $this->load->view('ajax/Clientes/v_cliente_modal', $datos, true);
        echo $resp;
    }
    
    public function EditarCliente($id){
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Clientes';
        $datos['subTituloPagina'] = 'Clientes del sistema';
        
        $datos['cboRegiones'] = $this->Otros->cbo_regiones();
        
        $datos['cboEstados'] = $this->Parametros->cbo_estados("1");
        $datos['idCliente'] = $id;
        $datos['tituloModal'] = "Editar Cliente";
        
        $userdata2 = $this->session->userdata('logged_in');
        $rut_empresa = $userdata2['rut_empresa'];

        $result = $this->Cliente->get_cliente($id, $rut_empresa);
        foreach ($result as $row) {
            $datos['cboProvincias'] = $this->Otros->cbo_provincias($row->region);
            $datos['cboComunas'] = $this->Otros->cbo_comunas($row->provincia);
        
            $datos['result_rut'] = $row->rut;
            $datos['result_nombre'] = $row->nombre;
            $datos['result_contacto'] = $row->contacto;
            $datos['result_email'] = $row->email;
            $datos['result_telefono'] = $row->telefono;
            $datos['result_movil'] = $row->movil;
            $datos['result_direccion'] = $row->direccion;
            $datos['result_codigo_postal'] = $row->codigo_postal;

            $datos['result_id_region'] = $row->region;
            $datos['result_id_provincia'] = $row->provincia;
            $datos['result_id_comuna'] = $row->comuna;
            $datos['result_id_estado'] = $row->estado;
        }
        
        $resp = $this->load->view('ajax/Clientes/v_cliente_modal', $datos, true);
        echo $resp;
    }
    
    public function NuevoClienteGuardar(){
        $rut = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $contacto = $this->input->post('contacto');
        $email = $this->input->post('email');
        $telefono = $this->input->post('telefono');
        $movil = $this->input->post('movil');
        $direccion = $this->input->post('direccion');
        $codigo_postal = $this->input->post('codigo_postal');

        $region = $this->input->post('cboRegiones');
        $provincia = $this->input->post('cboProvincias');
        $comuna = $this->input->post('cboComunas');

        $estado = $this->input->post('cboEstados');
        
        $userdata2 = $this->session->userdata('logged_in');
        $rut_empresa = $userdata2['rut_empresa'];

        if (!$this->Cliente->busc_cliente($rut, $rut_empresa)){
            $data = array('rut' => $rut,
                          'nombre' => $nombre,
                          'contacto' => $contacto,
                          'email' => $email,
                          'telefono' => $telefono,
                          'movil' => $movil,
                          'direccion' => $direccion,
                          'codigo_postal' => $codigo_postal,
                          'region' => $region,
                          'provincia' => $provincia,
                          'comuna' => $comuna,
                          'estado' => $estado,
                          'rut_empresa' => $rut_empresa
            );
            $this->Cliente->insert_cliente($data);
            //creado
            $respuesta = array("status" => 'true');
        }
        else{
            //existe.
            $respuesta = array("status" => 'Ya existe un cliente con ese rut.');
        }
        echo json_encode($respuesta);
    }
    
    public function EditarClienteGuardar(){
        $rut = $this->input->post('idCliente');
        $nombre = $this->input->post('nombre');
        $contacto = $this->input->post('contacto');
        $email = $this->input->post('email');
        $telefono = $this->input->post('telefono');
        $movil = $this->input->post('movil');
        $direccion = $this->input->post('direccion');
        $codigo_postal = $this->input->post('codigo_postal');

        $region = $this->input->post('cboRegiones');
        $provincia = $this->input->post('cboProvincias');
        $comuna = $this->input->post('cboComunas');

        $estado = $this->input->post('cboEstados');
        
        $userdata2 = $this->session->userdata('logged_in');
        $rut_empresa = $userdata2['rut_empresa'];

        $data = array('rut' => $rut,
					  'nombre' => $nombre,
					  'contacto' => $contacto,
					  'email' => $email,
					  'telefono' => $telefono,
					  'movil' => $movil,
					  'direccion' => $direccion,
					  'codigo_postal' => $codigo_postal,
					  'region' => $region,
					  'provincia' => $provincia,
					  'comuna' => $comuna,
					  'estado' => $estado
		);
		
		$this->Cliente->update_cliente($rut, $rut_empresa, $data);
        $respuesta = array("status" => 'true'); 
        echo json_encode($respuesta);
    }
    
    public function EliminarCliente($rut){
        $userdata2 = $this->session->userdata('logged_in');
        $rut_empresa = $userdata2['rut_empresa'];

        $this->Cliente->delete_cliente($rut, $rut_empresa);
        $respuesta = array("status" => 'true');
                
        echo json_encode($respuesta);
    }
    /* --- */

	public function GetProvincias($region){
		if ($region <> "0"){
			$respuesta = array("status" => 'true', "datos" => $this->Otros->cbo_provincias($region));
			echo json_encode($respuesta);
		}
		else{
			$respuesta = array("status" => 'true', "datos" => "");
			echo json_encode($respuesta);
		}
	}
	
	public function GetComunas($provincia){
		$respuesta = array("status" => 'true', "datos" => $this->Otros->cbo_comunas($provincia));
		echo json_encode($respuesta);
	}
}