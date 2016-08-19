<?php

class Utiles extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function validaRut($rut){
        $suma = 0;
        if(strpos($rut,"-")==false){
            $RUT[0] = substr($rut, 0, -1);
            $RUT[1] = substr($rut, -1);
        }else{
            $RUT = explode("-", trim($rut));
        }
        
        $elRut = str_replace(".", "", trim($RUT[0]));
        $factor = 2;
        
        for($i = strlen($elRut)-1; $i >= 0; $i--):
            $factor = $factor > 7 ? 2 : $factor;
            $suma += $elRut{$i}*$factor++;
        endfor;
        
        $resto = $suma % 11;
        $dv = 11 - $resto;
        
        if($dv == 11){
            $dv=0;
        }else if($dv == 10){
            $dv="k";
        }else{
            $dv=$dv;
        }
        
        if($dv == trim(strtolower($RUT[1]))){
            return true;
        }else{
            return false;
        }
    }
    
    public function encriptar($msg) {
        $this->load->library('Encrypt');
        $encrypted_string = $this->encrypt->encode($msg);
        return $encrypted_string;
    }

    public function desencriptar($msg) {
        $this->load->library('Encrypt');
        $plaintext_string = $this->encrypt->decode($msg);
        return $plaintext_string;
    }
}
