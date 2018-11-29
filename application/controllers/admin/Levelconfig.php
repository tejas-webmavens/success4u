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
				$data = $this->flip_keys($data);
				foreach ($data as $_data) {
					if(isset($_data['id'])){
						$wh = 'id='.$_data['id'];
						$result = $this->common_model->UpdateRecord($_data, $wh, 'arm_levelconfig');
					}
					else{
						$this->common_model->SaveRecords($_data, 'arm_levelconfig');
					}
				}

				$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
				redirect('admin/levelconfig');
			}
			else{
				$this->data['field'] = $this->Levelconfig_model->GetAllLevelSetup();
				$this->data['levelcount'] = count($this->data['field']);
				$this->load->view('admin/levelconfig', $this->data);
			}
		}
		else{
			redirect('admin/login');
		}
	}

	function flip_keys($array){
		$new_array = array();
		foreach ($array as $outerKey=>$idata) {
		   	foreach ($idata as $innerKey=>$innerdata) {
		      	$new_array[$innerKey][$outerKey] = $innerdata;
		    }
		}

		return $new_array;
	}
}