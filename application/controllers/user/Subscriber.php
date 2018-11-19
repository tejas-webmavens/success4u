<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriber extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {
		
		// $this->load->helper('url');
		// // Load form helper library
		// $this->load->helper('form');

		// // Load form validation library
		// $this->load->library('form_validation');

		// // Load session library
		// $this->load->library('session');
		$this->load->helper('cookie');

		// Load database
		
		$this->lang->load('subscriber',$this->session->userdata('language'));
		$this->lang->load('user/common',$this->session->userdata('language'));
		
		}  else {
	    	redirect('login');
	    }
	}

	

	public function index()
	{
		$condition="RefereId='".$this->session->MemberID."'";
		$this->data['mysubscriber'] = $this->common_model->GetResults($condition,'arm_subscribe_list');
		$this->load->view('user/mysubscriber',$this->data);
	}
	public function delete($Id) {
				
		$condition = "id =" . "'" . $Id . "'";
		$status = $this->common_model->DeleteRecord($condition,'arm_subscribe_list');
					
		if($status) {
			$this->session->set_flashdata('success_message', 'Success! Subscriber mailid are Removed');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! Subscriber mailid Not Removed.');
		}
		redirect('user/subscriber');
	}
	
}
