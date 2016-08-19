<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
    
    public function __construct() {
		parent::__construct();
        $this->load->model('Menus');
        $this->load->model('Utiles');
        
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
    
    public function Index($recarga = false)
    {
        $userdata = $this->session->userdata('idioma_seleccionado');
        $datos['idioma_seleccionado'] = $userdata['idioma'];
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        $datos['tituloPagina'] = $this->lang->line('Inicio', FALSE);
        $datos['subTituloPagina'] = $this->lang->line('Bienvenido', FALSE);
        
        if (!$recarga){
            $this->load->view('v_inicio', $datos);
        } else {
            $resp = $this->load->view('v_inicio', $datos, true);
            echo $resp;
        }
    }
    
}