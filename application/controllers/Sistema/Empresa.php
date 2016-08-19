<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {
    
    public function __construct() {
		parent::__construct();
        $this->load->model('Menus');
        $this->load->model('Utiles');
        $this->load->model('Sistema/Empresas');
        $this->load->model('Sistema/Usuarios');
        $this->load->model('Varios/Parametros');
        $this->load->model('Sistema/Perfiles');
        
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
    
    /* LISTA EMPRESAS */
    public function listaEmpresas($recarga = false) {
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Empresas';
        $datos['subTituloPagina'] = 'Empresas del sistema';
        
        $datos['grilla'] = $this->Empresas->grilla_empresas("1,0", TRUE, TRUE); //EDITAR y ELIMINAR
        
        if (!$recarga){
            $this->load->view('ajax/Sistema/Empresas/v_lista_empresas', $datos);
        } else {
            $resp = $this->load->view('ajax/Sistema/Empresas/v_lista_empresas', $datos, true);
            echo $resp;
        }
    }
    
    public function NuevaEmpresa(){
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Empresas';
        $datos['subTituloPagina'] = 'Empresas del sistema';
        
        $datos['cboEstados'] = $this->Parametros->cbo_estados("1");
        $datos['idEmpresa'] = 0;
        $datos['tituloModal'] = "Nueva Empresa";
        
        $datos['result_rut'] = "";
        $datos['result_nombre'] = "";
        $datos['result_id_estado'] = "";
        
        $resp = $this->load->view('ajax/Sistema/Empresas/v_empresa_modal', $datos, true);
        echo $resp;
    }
    
    public function EditarEmpresa($rut){
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Empresas';
        $datos['subTituloPagina'] = 'Empresas del sistema';
        
        $datos['cboEstados'] = $this->Parametros->cbo_estados("1");
        $datos['idEmpresa'] = $rut;
        $datos['tituloModal'] = "Editar Empresa";
        
        $result = $this->Empresas->get_empresa($rut);
        
        foreach ($result as $row) {
            $datos['result_rut'] = $row->rut;
            $datos['result_nombre'] = $row->nombre;
            $datos['result_id_estado'] = $row->estado;
        }
        
        $resp = $this->load->view('ajax/Sistema/Empresas/v_empresa_modal', $datos, true);
        echo $resp;
    }
    
    public function NuevaEmpresaGuardar(){
        $rut = strtoupper($this->input->post('rut'));
        $nombre = strtoupper($this->input->post('nombre'));
        $estado = $this->input->post('cboEstados');
                
        if (!$this->Empresas->busc_empresa($rut, $nombre)){
            $data = array('rut' => $rut,
                          'nombre' => $nombre,
                          'estado' => $estado,
                          'creacion' => date('Y-m-d H:i:s'),
                          'modificacion' => date('Y-m-d H:i:s')
            );
            $this->Empresas->insert_empresa($data);
            //creado
            $respuesta = array("status" => 'true');
        }
        else{
            //existe.
            $respuesta = array("status" => 'Ya existe un registro con ese nombre o rut.');
        }
        echo json_encode($respuesta);
    }
    
    public function EditarEmpresaGuardar(){
        $nombre = strtoupper($this->input->post('nombre'));
        $estado = strtoupper($this->input->post('cboEstados'));
        $rut = $this->input->post('idEmpresa');
        
        $data = array('nombre' => $nombre,
                      'estado' => $estado,
                      'modificacion' => date('Y-m-d H:i:s')
        );

        $this->Empresas->update_empresa($rut, $data);
        $respuesta = array("status" => 'true');
                
        echo json_encode($respuesta);
    }
    
    public function EliminarEmpresa($rut){
        $this->Empresas->delete_empresa($rut);
        $respuesta = array("status" => 'true');
                
        echo json_encode($respuesta);
    }
    /* --- */   

    /* LISTA USUARIO */
    public function listaUsuarios($empresa = false, $recarga = false) {
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Usuarios';
        $datos['subTituloPagina'] = 'Usuarios del sistema';
        $datos['idEmpresaSel'] = "";
        if (!$empresa){
            $datos['cboEmpresas'] = $this->Empresas->cbo_empresas("1,0");

            $datos['grilla'] = $this->Empresas->grilla_usuarios("1,0", $empresa, TRUE, TRUE); //EDITAR y ELIMINAR

            if (!$recarga){
                $this->load->view('ajax/Sistema/Empresas/v_lista_usuarios', $datos);
            } else {
                $resp = $this->load->view('ajax/Sistema/Empresas/v_lista_usuarios', $datos, true);
                echo $resp;
            }
        } else{
            echo $this->Empresas->grilla_usuarios("1,0", $empresa, TRUE, TRUE); //EDITAR y ELIMINAR
        }
        
    }

    public function listaUsuariosRec($empresa) {
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Usuarios';
        $datos['subTituloPagina'] = 'Usuarios del sistema';

        $datos['cboEmpresas'] = $this->Empresas->cbo_empresas("1,0");
        $datos['idEmpresaSel'] = $empresa;

        $datos['grilla'] = $this->Empresas->grilla_usuarios("1,0", $empresa, TRUE, TRUE); //EDITAR y ELIMINAR
        $this->load->view('ajax/Sistema/Empresas/v_lista_usuarios', $datos);
            
    }
    
    public function NuevoUsuario($empresa){
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Usuarios';
        $datos['subTituloPagina'] = 'Usuarios del sistema';
        
        $datos['cboPerfiles'] = $this->Perfiles->cbo_perfiles("1");
        $datos['cboEstados'] = $this->Parametros->cbo_estados("1");
        $datos['idUsuario'] = 0;
        $datos['tituloModal'] = "Nuevo Usuario";
        
        $result = $this->Empresas->get_empresa($empresa);
        foreach ($result as $row) {
            $datos['result_nombreEmpresa'] = $row->nombre;
        }
        $datos['idEmpresa'] = $empresa;

        $datos['result_id'] = "";
        $datos['result_usuario'] = "";
        $datos['result_nombre'] = "";
        $datos['result_password'] = "";
        $datos['result_email'] = "";
        $datos['result_id_perfil'] = "";
        $datos['result_id_estado'] = "";
        
        $resp = $this->load->view('ajax/Sistema/Empresas/v_usuario_modal', $datos, true);
        echo $resp;
    }
    
    public function EditarUsuario($id, $empresa){
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Usuarios';
        $datos['subTituloPagina'] = 'Usuarios del sistema';
        
        $datos['cboPerfiles'] = $this->Perfiles->cbo_perfiles("1");
        $datos['cboEstados'] = $this->Parametros->cbo_estados("1");
        $datos['idUsuario'] = $id;
        $datos['tituloModal'] = "Editar Usuario";
        
        $result = $this->Empresas->get_empresa($empresa);
        foreach ($result as $row) {
            $datos['result_nombreEmpresa'] = $row->nombre;
        }
        $datos['idEmpresa'] = $empresa;

        $result = $this->Usuarios->get_usuario($id);
        foreach ($result as $row) {
            $datos['result_id'] = $row->id;
            $datos['result_usuario'] = $row->usuario;
            $datos['result_nombre'] = $row->nombre;
            $datos['result_password'] = $this->Utiles->desencriptar($row->password);
            $datos['result_email'] = $row->email;
            $datos['result_id_perfil'] = $row->id_perfil;
            $datos['result_id_estado'] = $row->estado;
        }
        
        $resp = $this->load->view('ajax/Sistema/Empresas/v_usuario_modal', $datos, true);
        echo $resp;
    }
    
    public function NuevoUsuarioGuardar(){
        $usuario = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $perfil = $this->input->post('cboPerfiles');
        $estado = $this->input->post('cboEstados');
        $rut_empresa = $this->input->post('idEmpresa');

        if (!$this->Usuarios->busc_usuario($usuario, $rut_empresa)){
            $data = array('usuario' => $usuario,
                          'nombre' => $nombre,
                          'password' => $this->Utiles->encriptar($password),
                          'email' => $email,
                          'id_perfil' => $perfil,
                          'estado' => $estado,
                          'rut_empresa' => $rut_empresa
            );
            $this->Usuarios->insertar_usuario($data);
            //creado
            $respuesta = array("status" => 'true');
        }
        else{
            //existe.
            $respuesta = array("status" => 'Ya existe un registro con ese usuario o rut.');
        }
        echo json_encode($respuesta);
    }
    
    public function EliminarUsuario($id){
        $this->Usuarios->eliminar_usuario($id);
        $respuesta = array("status" => 'true');
                
        echo json_encode($respuesta);
    }
    /* --- */   
}