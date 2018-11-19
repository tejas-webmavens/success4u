<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// if($this->session->userdata('logged_in')) {
		
			// Load database
			// $this->load->model('user/shop_model');
			// $this->load->model('product_model');
			// $this->load->model('admin/category_model');
			$this->load->model('common_model');
			$this->load->model('page_model');
			// $this->load->library('cart');

			// load language
			$this->lang->load('cms');
		// } else {
		// 	redirect('user/login');
		// }		

	}

	public function index() 
	{
		$this->view();
	}

	public function view() {

		$pageID = $this->uri->segment(3);
		$contents = '';
		
		if($this->session->userdata('language')){

        	$contents = $this->page_model->GetpageContent($pageID,$this->session->userdata('language'));

		} else {

			if($contents==''){
	        	$contents = $this->page_model->GetpageContent($pageID,$this->config->item('language'));
	    	}

    	}
    	
    	if($contents==''){ 
			redirect('my404');
		} else {
			$this->data['contents'] = $contents;
			$this->load->view('user/content',$this->data);
		}
	}

}
?>