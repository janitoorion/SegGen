<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
    
    public function __construct() {
		parent::__construct();
        $this->load->model('Menus');
        $this->load->model('Utiles');
        $this->load->model('Sistema/Usuarios');
        $this->load->model('Sistema/Perfiles');
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
    
    /* LISTA USUARIO */
    public function listaUsuarios($recarga = false) {
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Usuarios';
        $datos['subTituloPagina'] = 'Usuarios del sistema';

        $userdata2 = $this->session->userdata('logged_in');
        $rut_empresa = $userdata2['rut_empresa'];

        $datos['grilla'] = $this->Usuarios->grilla_usuarios("1,0", $rut_empresa, TRUE, TRUE); //EDITAR y ELIMINAR
        
        if (!$recarga){
            $this->load->view('ajax/Sistema/Usuarios/v_lista_usuarios', $datos);
        } else {
            $resp = $this->load->view('ajax/Sistema/Usuarios/v_lista_usuarios', $datos, true);
            echo $resp;
        }
    }
    
    public function NuevoUsuario(){
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Usuarios';
        $datos['subTituloPagina'] = 'Usuarios del sistema';
        
        $datos['cboPerfiles'] = $this->Perfiles->cbo_perfiles("1");
        $datos['cboEstados'] = $this->Parametros->cbo_estados("1");
        $datos['idUsuario'] = 0;
        $datos['tituloModal'] = "Nuevo Usuario";
        
        $datos['result_id'] = "";
        $datos['result_usuario'] = "";
        $datos['result_nombre'] = "";
        $datos['result_password'] = "";
        $datos['result_email'] = "";
        $datos['result_id_perfil'] = "";
        $datos['result_id_estado'] = "";
        
        $resp = $this->load->view('ajax/Sistema/Usuarios/v_usuario_modal', $datos, true);
        echo $resp;
    }
    
    public function EditarUsuario($id){
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = 'Lista Usuarios';
        $datos['subTituloPagina'] = 'Usuarios del sistema';
        
        $datos['cboPerfiles'] = $this->Perfiles->cbo_perfiles("1");
        $datos['cboEstados'] = $this->Parametros->cbo_estados("1");
        $datos['idUsuario'] = $id;
        $datos['tituloModal'] = "Editar Usuario";
        
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
        
        $resp = $this->load->view('ajax/Sistema/Usuarios/v_usuario_modal', $datos, true);
        echo $resp;
    }
    
    public function NuevoUsuarioGuardar(){
        $usuario = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $perfil = $this->input->post('cboPerfiles');
        $estado = $this->input->post('cboEstados');
        
        $userdata2 = $this->session->userdata('logged_in');
        $rut_empresa = $userdata2['rut_empresa'];

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
    
    public function EditarUsuarioGuardar(){
        $nombre = $this->input->post('nombre');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $perfil = $this->input->post('cboPerfiles');
        $estado = $this->input->post('cboEstados');
        $id = $this->input->post('idUsuario');
        
        $data = array('nombre' => $nombre,
                      'password' => $this->Utiles->encriptar($password),
                      'email' => $email,
                      'id_perfil' => $perfil,
                      'estado' => $estado
        );
        $this->Usuarios->update_usuario($id, $data);
        $respuesta = array("status" => 'true');
                
        echo json_encode($respuesta);
    }
    
    public function EliminarUsuario($id){
        $this->Usuarios->eliminar_usuario($id);
        $respuesta = array("status" => 'true');
                
        echo json_encode($respuesta);
    }
    /* --- */    
}