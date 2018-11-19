<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LanguageSwitcher extends CI_Controller
{
    public function __construct() {
        parent::__construct();     
    }
 
    public function switchLang($language = "") {

    	$language = $this->uri->segment(2);

        
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('language', $language);
        
        // redirect("user/dashboard");
        redirect($_SERVER['HTTP_REFERER']);
        
    }
}