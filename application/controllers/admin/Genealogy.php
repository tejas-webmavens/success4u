<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Genealogy extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {

			// $this->load->helper('url');
			// // Load form helper library
			// $this->load->helper('form');

			// // Load form validation library
			// $this->load->library('form_validation');

			// // Load session library
			// $this->load->library('session');
			$this->load->helper('cookie');

			// Load database
			
			//$this->load->model('user/fund_model');
			$this->lang->load('usergenealogy');
		
		}  else {
	    	redirect('admin/login');
	    }
	}


	public function index()
	{
		if($this->session->userdata('logged_in')) 
		{
			$this->load->view('admin/genealogy');
		}
		else 
		{
			redirect('admin/login');
		}
	}

	public function view($id)
	{
		if($this->session->userdata('logged_in')) 
		{
			$this->data['id'] = $id;



			$this->load->view('admin/genealogy',$this->data,1);
		}
		else 
		{
			redirect('admin/login');
		}
	}

	public function plan1($id)
	{		
		if($this->session->userdata('logged_in')) 
		{
			$this->data['id'] = $id;
			// $this->load->view('admin/genealogy',$this->data);	  
			$this->load->view('admin/genealogyplan1',$this->data);
		}
		else 
		{
			redirect('admin/login');
		}
	}

	public function plan2($id)
	{
		if($this->session->userdata('logged_in')) 
		{
			$this->data['id'] = $id;
			// $this->load->view('admin/genealogy',$this->data);	  
			$this->load->view('admin/genealogyplan2',$this->data);
		}
		else 
		{
			redirect('admin/login');
		}
	}
	
}
