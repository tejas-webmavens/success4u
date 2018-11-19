<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Latestnews extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {
		
			// Load database
			
			$this->load->model('admin/testimonial_model');
			$this->load->model('common_model');
			$this->load->model('page_model');

			// load language
			$this->lang->load('cms');

			$this->load->library('pagination');

			// load language
			$this->lang->load('user/latestnews',$this->session->userdata('language'));
			$this->lang->load('user/common',$this->session->userdata('language'));
		/*} else {
			redirect('user');
		}		*/

	}

	public function index() {

		$this->load->model('admin/testimonial_model');

		if($this->session->userdata('language')){
        
	        $this->data['latestnews'] = $this->page_model->GetNewsContent($this->session->userdata('language'));
	        if($this->data['latestnews']==''){ 
		        
		         $this->data['latestnews'] = $this->page_model->GetNewsContent($this->config->item('language'));	
		         
	        	}
			
		}
		else{
		$this->data['latestnews'] = $this->page_model->GetNewsContent($this->config->item('language'));	
		}
		$this->load->view('user/viewlatestnews',$this->data);

	}

	

}


?>