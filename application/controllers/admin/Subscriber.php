<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriber extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		

		// change language
		//$this->config->set_item('language', 'spanish');

		// load language
		$this->lang->load('subscriber');
		
		}  else {
	    	redirect('admin/login');
	    }
	}

	public function index()
	{
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
			
			$this->data['subscriber'] = $this->common_model->GetResults('','arm_subscribe_list');
			$this->load->view('admin/subscriber', $this->data['subscriber']);
		}
 		
	}
	
	
	public function delete($Id) {
				
		$condition = "id =" . "'" . $Id . "'";
		$status = $this->common_model->DeleteRecord($condition,'arm_subscribe_list');
					
		if($status) {
			$this->session->set_flashdata('success_message', 'Success! Subscriber mailid are Removed');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! Subscriber mailid Not Removed.');
		}
		redirect('admin/subscriber');
	}
	

	public function DeleteAll() {
		if($this->input->post('subscriber')) {
			foreach ($this->input->post('subscriber') as $key => $value) {

			}
		}
		
	}
	
}
