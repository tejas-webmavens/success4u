<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Levelconfig extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
			// Load database
			$this->load->model('admin/Levelconfig_model');
			$this->lang->load('levelconfig');
		} else {
	    	redirect('admin/login');
	    }
	} //function ends

	public function index() {
		if($this->session->userdata('logged_in')) {
			if($this->input->post('increase_per_trans')) {
				$data = $this->input->post();
				$wh = "id=1";
				$result = $this->common_model->UpdateRecord($data, $wh, 'arm_levelconfig');
				$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
				redirect('admin/levelconfig');
			}
			else{
				$this->data['field'] = $this->Levelconfig_model->Getlevelsetup(1);
				$this->load->view('admin/levelconfig', $this->data['field']);
			}
		}
		else{
			redirect('admin/login');
		}
	}
}