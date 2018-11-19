<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income extends CI_Controller {

	public function __construct() {
		parent::__construct();

		//$this->load->helper('url');

		// Load form helper library
		//$this->load->helper('form');
		
		// Load database
		
		$this->load->model('admin/income_model');

		
		
		// change language
		//$this->config->set_item('language', 'spanish');

		// load language
		$this->lang->load('income');

	}

	public function index()
	{
 		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
			
			// $condition = '';
			// $tableName = 'arm_history';
			$this->data['members'] = $this->common_model->GetCustomers();
			$this->data['types'] = $this->common_model->GetResults('','arm_transaction_type','*');
			$this->data['income'] = $this->income_model->GetTransactions();
			
			$this->load->view('admin/finance/income',$this->data);
	    } else {
	    	redirect('admin/login');

	    }	
	}

	public function search(){
		
		if($this->input->post()) 
		{
			//print_r($this->input->post());

			$condition = "h.isDelete= '0'";

			if($this->input->post('member'))
				//$url .= '&FirstName=' . $this->input->post('firstname');
				$condition .= " AND m.MemberId =" . "'" . $this->input->post('member') . "'";

			if($this->input->post('trans_type'))
				//$url .= '&UserName=' . $this->input->post('username');
				 $condition .= " AND t.TypeId =" . "'" . $this->input->post('trans_type') . "'";

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(h.DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(h.DateAdded) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";
			else if($this->input->post('datepicker1'))
				$condition .= " AND DATE(h.DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "'";
			else if($this->input->post('datepicker2'))
				$condition .= " AND DATE(h.DateAdded) <=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker2'))) . "'";

			$this->data['members'] = $this->common_model->GetCustomers();
			$this->data['types'] = $this->common_model->GetResults('','arm_transaction_type','*');

			$this->data['income'] = $this->income_model->GetTransactions($condition);

			// $this->data['income'] = $this->common_model->GetResults($condition, 'arm_history', '*');
			//print_r($this->data['income']);exit;
			$this->load->view('admin/finance/income', $this->data);
			
		} else {
			//$this->session->set_flashdata('error_message', 'Enter field value to search');
			redirect('admin/income');
		}
	}

	
	
	public function delete($couponId) {
		$condition = "couponId =" . "'" . $couponId . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_history');

		if($status) {
			$this->session->set_flashdata('success_message', 'Success! income Removed');
			redirect('admin/income');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! income Not Removed');
			redirect('admin/income');
		}
		
	}

	public function active($couponId) {
		$condition = "couponId =" . "'" . $couponId . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_history');
		if($status) {
			redirect('admin/income');
		}
	}

	public function inactive($couponId) {
		$condition = "couponId =" . "'" . $couponId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_history');
		if($status) {
			redirect('admin/income');
		}
	}

	
	
	


}
