<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct() {
		parent::__construct();
        $this->load->library('Encrypt');
        $this->load->model('Logins');
        
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
	}
    
	public function index()	{
        if ($this->session->userdata('logged_remember')) {
            $this->session->unset_userdata('logged_remember');
        }
             
        $this->load->view('v_login');
	}
    
    function validar_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $sistema = 1;
        $remember = $this->input->post('remember');
        
        
        $result = $this->Logins->busca_usuario_login($username);

        if (!$result) {
            $status = array("STATUS" => $this->lang->line('datosNoValidos', FALSE));
        } else {
            $usuario = array();

            foreach ($result as $row) {
                if ($row->estadoEmpresa == "0"){
                    $status = array("STATUS" => $this->lang->line('empresaInactiva', FALSE));
                }
                else{
                    $des_password_db = $this->desencriptar($row->password);

                    if (strcmp($des_password_db, $password) == 0) {
                        $status = array("STATUS" => "TRUE");
                        $user = array('id' => $row->id,
                            'nombre' => $row->nombre,
                            'usuario' => $row->usuario,
                            'perfil' => $row->id_perfil,
                            'id_sistema' => $row->id_sistema,
                            'rut_empresa' => $row->rut_empresa,
                            'nombre_empresa' => $row->nombre_empresa
                        );

                        $this->session->set_userdata('logged_in', $user);
                        
                        if ($remember == 'on'){
                            $recuerdame = array('remember' => $remember,
                                                'usuario' => $row->usuario,
                                                'nombre' => $row->nombre,
                                                'id_sistema' => $row->id_sistema);
                            $this->session->set_userdata('logged_remember', $recuerdame);
                        }
                        else{
                            if ($this->session->userdata('logged_remember')) {
                                $this->session->unset_userdata('logged_remember');
                            }
                        }
                        
                    } else {
                        $status = array("STATUS" => $this->lang->line('datosNoValidos', FALSE));
                    }
                }
            }
        }
        echo json_encode($status);
    }
        
    public function encriptar($msg) {
        $encrypted_string = $this->encrypt->encode($msg);
        //echo $encrypted_string;
		return $encrypted_string;
    }

    public function desencriptar($msg) {
        $plaintext_string = $this->encrypt->decode($msg);
        return $plaintext_string;
    }
}