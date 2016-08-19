<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
		parent::__construct();
        $this->load->model('Menus');
        
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
        /* LOGIN */
        if ($this->session->userdata('logged_in')) {
            $userdata = $this->session->userdata('logged_in');
            $id = $userdata['id'];
            $nombre = $userdata['nombre'];
            $perfil = $userdata['perfil'];
            $usuario = $userdata['usuario'];
            $sistema = $userdata['id_sistema'];
            $rut_empresa = $userdata['rut_empresa'];
            $nombre_empresa = $userdata['nombre_empresa'];
        }
        else {
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
        $datos['datosUsuario'] = $this->session->userdata('logged_in');
        /* --- */
        
        /* BANDERAS */
        if ($this->session->userdata('idioma_seleccionado')) {
            $userdata = $this->session->userdata('idioma_seleccionado');
            $idioma = $userdata['idioma'];
        }
        else {
            $idioma = 'es';
        }
        $datos['idioma'] = $idioma;
        $datos['banderas'] = $this->banderasIdioma($idioma);      
        /* --- */
          
        $datos['menuUsuario'] = $this->crear_menu((int)$sistema, (int)$perfil);
        $this->load->view('v_home', $datos);
	}
    
    function banderasIdioma($idioma){
        $banderas = ""; 
        $banderas = $banderas . "<li class=''>";        
        
        if ($idioma == 'en'){        
            $banderas = $banderas . "<a href='#' class='dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <img src='assets/img/blank.gif' class='flag flag-us' alt='English'> <span> English</span> <i class='fa fa-angle-down'></i> </a>";
            $banderas = $banderas . "<ul class='dropdown-menu pull-right'>";
            $banderas = $banderas . "<li>";
            $banderas = $banderas . "<a id='cambioIdioma' href='javascript:void(0);' class='es'><img src='assets/img/blank.gif' class='flag flag-es' alt='Español'> Español</a>";
            $banderas = $banderas . "<li>";
            $banderas = $banderas . "</ul>";
        }
        else if ($idioma == 'es'){
            $banderas = $banderas . "<a href='#' class='dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <img src='assets/img/blank.gif' class='flag flag-es' alt='Español'> <span> Español</span> <i class='fa fa-angle-down'></i> </a>";
            $banderas = $banderas . "<ul class='dropdown-menu pull-right'>";
            $banderas = $banderas . "<li>";
            $banderas = $banderas . "<a id='cambioIdioma' href='javascript:void(0);' class='en'><img src='assets/img/blank.gif' class='flag flag-us' alt='English'> English</a>";
            $banderas = $banderas . "<li>";
            $banderas = $banderas . "</ul>";
        }
        
        $banderas = $banderas . "</li>";
        
        return $banderas;
    }
        
    function cambiarIdioma($idioma){ 
        if ($idioma == 'en'){
            $this->lang->load('en','english');
        }
        else if ($idioma == 'es'){
            $this->lang->load('es','spanish');
        }
        
        $user = array('idioma' => $idioma);

        $this->session->set_userdata('idioma_seleccionado', $user);
        redirect('Home', 'refresh');
        
    }
    
    function crear_menu($sistema, $perfil) {
        if ($this->session->userdata('idioma_seleccionado')) {
            $userdata = $this->session->userdata('idioma_seleccionado');
            $idioma = $userdata['idioma'];
        }
        else{
            $idioma = 'es';
        }
        
        $menu = "<li class=''><a href='Inicio/Index' title='" . $this->lang->line('Inicio', FALSE) . "'><i class='fa fa-lg fa-fw txt-color-blue fa-home'></i><span class='menu-item-parent'>" . $this->lang->line('Inicio', FALSE) . "</span></a></li>";
                  
        $menu = $menu . $this->crear_menu_nivel_1($sistema, $perfil, $idioma);

        return $menu;
    }
    
    function crear_menu_nivel_1($sistema, $perfil, $idioma) {
        $nivel1 = "";
        
        $padre = $this->Menus->menu_padre($sistema, $perfil);
        if (!$padre) {
            return "";
        } else {
            foreach ($padre as $row) {          
                $hijo = $this->Menus->menu_hijo($sistema, $perfil, $row->id);
                $item = "";
                if (!$hijo) {
                    if ($idioma == "es"){
                        $item = $item . "<li><a href='" . $row->url . "'>" . $row->icono . $row->texto . "</a></li>";
                    }else{
                        $item = $item . "<li><a href='" . $row->url . "'>" . $row->icono . $row->texto_en . "</a></li>";
                    }
                } else {
                    $item = $item . "<li class='class='top-menu-invisible'>";
                    if ($idioma == "es"){
                        $item = $item . "<a href='#'>" . $row->icono . "<span class='menu-item-parent'>" . $row->texto . "</span></a>";
                    }else{
                        $item = $item . "<a href='#'>" . $row->icono . "<span class='menu-item-parent'>" . $row->texto_en . "</span></a>";
                    }
                    $item = $item . "<ul>";
                    $item = $item . $this->crear_menu_sub_niveles($sistema, $perfil, $row->id, $idioma);
                    $item = $item . "</ul>";
                    $item = $item . "</li>";
                }
                $nivel1 = $nivel1 . $item;
            }
        }
        return $nivel1;
    }
    
    function crear_menu_sub_niveles($sistema, $perfil, $id_item, $idioma) {
        $masnivel = "";
        
        $hijos = $this->Menus->menu_hijo($sistema, $perfil, $id_item);
        if (!$hijos) {
            return "";
        }
        else{
            foreach ($hijos as $row) {          
                $masHijos = $this->Menus->menu_hijo($sistema, $perfil, $row->id);
                $item = "";
                if (!$masHijos) {
                    if ($idioma == "es"){
                        $item = $item . "<li><a href='" . $row->url . "'>" . $row->icono . $row->texto . "</a></li>";
                    }else{
                        $item = $item . "<li><a href='" . $row->url . "'>" . $row->icono . $row->texto_en . "</a></li>";
                    }
                } else {
                    $item = $item . "<li>";
                    if ($idioma == "es"){
                        $item = $item . "<a href='#'>" . $row->icono . $row->texto . "</a>";
                    }else{
                        $item = $item . "<a href='#'>" . $row->icono . $row->texto_en . "</a>";
                    }
                    $item = $item . "<ul>";
                    $item = $item . $this->crear_menu_sub_niveles($sistema, $perfil, $row->id, $idioma);
                    $item = $item . "</ul>";
                    $item = $item . "</li>";
                }
                $masnivel = $masnivel . $item;
            }
        }
        return $masnivel;
    }
            
    function logout() {
        if ($this->session->userdata('logged_in')) {
            $this->session->unset_userdata('logged_in');
        }
        
        redirect('Home', 'refresh');
    }
    
}