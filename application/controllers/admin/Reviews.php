<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
			//$this->load->helper('url');

			// Load form helper library
			//$this->load->helper('form');
			
			// Load database
			
			$this->load->model('product_model');
			$this->load->model('admin/category_model');
			
			// change language
			//$this->config->set_item('language', 'spanish');

			// load language
			$this->lang->load('review');
		} else {
	    	redirect('admin/login');
	    }

	}

	public function index()
	{
		$condition = '';
		$tableName = 'arm_review';
		$this->data['reviews'] = $this->common_model->GetResults($condition,$tableName,'*');
		$this->load->view('admin/products/reviews',$this->data);
	    	
	}
	
	public function delete($ReviewId) {
		$condition = "ReviewId =" . "'" . $ReviewId . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_review');

		if($status) {
			$this->session->set_flashdata('success_message', 'Success! Review Removed');
			redirect('admin/reviews');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! Review Not Removed');
			redirect('admin/reviews');
		}
		
	}

	public function active($ReviewiD) {
		$condition = "ReviewiD =" . "'" . $ReviewiD . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_review');
		if($status) {
			redirect('admin/reviews');
		}
	}

	public function inactive($ReviewiD) {
		$condition = "ReviewiD =" . "'" . $ReviewiD . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_review');
		if($status) {
			redirect('admin/reviews');
		}
	}

	
	
	


}
