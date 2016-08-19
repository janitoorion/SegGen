<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lock extends CI_Controller {
    
    public function __construct() {
		parent::__construct();
	}
    
	public function index()	{
        if (!$this->session->userdata('logged_remember')){
            redirect('Login', 'refresh');
        }
        
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
        
        $datos['rememberData'] = $this->session->userdata('logged_remember');          
        $this->load->view('v_lock',$datos);
        
	}
    
}