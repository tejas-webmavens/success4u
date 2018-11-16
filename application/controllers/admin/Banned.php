<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banned extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
			// Load database
			

			// load language
			$this->lang->load('banned');
		} else {
			redirect('admin/login');
		}

	}

	public function index()
	{
		$this->data['bannedip'] = $this->common_model->GetResults('','arm_banned','*');
		
		$this->load->view('admin/banned',$this->data);
	}
	public function add()
	{
		if($this->input->post()) {

			$this->form_validation->set_rules('ip', 'ip', 'trim|required|valid_ip|xss_clean');
			$this->form_validation->set_rules('banned_status', 'BannedStatus', 'trim|required|xss_clean');
			

			if ($this->form_validation->run() == TRUE) {

				$data = array(
					'Ip' => $this->input->post('ip'),
					'Status' => $this->input->post('banned_status'),
					'DateAdded' => date('Y-m-d h:i:s')
				);

				$status = $this->common_model->SaveRecords($data,'arm_banned');

				if($status) {
					$this->session->set_flashdata('success_message', 'Success! Banned IP is Updated');
					redirect('admin/banned');
				} else {
					$this->session->set_flashdata('error_message', 'Failed! Banned IP is Not Updated');
					redirect('admin/banned');
				}
			} else {
				$this->load->view('admin/addip');
			}
		} else {
			$this->load->view('admin/addip');
		} 
	}
	public function search() {
		
		if($this->input->post()) 
		{
			$condition = "isDelete= '0'";

			if($this->input->post('Ip'))
				$condition .= " AND Ip LIKE" . "'%" . $this->input->post('Ip') . "%'";

			if($this->input->post('banned_status'))
				$condition .= " AND Status =" . "'" . $this->input->post('banned_status') . "'";

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(DateAdded) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";

			$this->data['bannedip'] = $this->common_model->GetResults($condition, 'arm_banned');

			// if($this->data['bannedip'])
				$this->load->view('admin/banned',$this->data);
			// else
			// 	redirect('admin/banned');
		} else {
			$this->load->view('admin/banned');
		}
	}
	public function block($BannedId) {
		$condition = "BannedId =" . "'" . $BannedId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_banned');
		if($status) {
			redirect('admin/banned');
		}
	}

	public function unblock($BannedId) {
		$condition = "BannedId =" . "'" . $BannedId . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_banned');
		if($status) {
			redirect('admin/banned');
		}
	}

}
