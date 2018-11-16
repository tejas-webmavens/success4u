<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {
		


			redirect('user/dashboard');
		}  else {
	    	redirect('user/login');
	    }
		//$this->load->helper('url');

		// Load form helper library
		//$this->load->helper('form');
		
		// Load database
		
		// change language
		//$this->config->set_item('language', 'spanish');

		// load language
		

	}

	public function index()
	{

		redirect('user/dashboard');

	}

}
?>