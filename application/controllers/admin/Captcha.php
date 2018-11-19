<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
			//$this->load->helper('url');

			// Load database
			
			$this->load->model('captcha_model');

			// load language
			$this->lang->load('captcha');
		} else {
			redirect('admin/login');
		}

	}

	public function index()
	{
		if($this->input->post()) {

			$this->form_validation->set_rules('siteKey', 'siteKey', 'trim|required|min_length[10]|xss_clean');
			$this->form_validation->set_rules('secretKey', 'secretKey', 'trim|required|min_length[10]|xss_clean');

			if ($this->form_validation->run() == TRUE) {
				
				$data['siteKey'] = $this->input->post('siteKey');
				$data['secretKey'] = $this->input->post('secretKey');
				
				$status = $this->captcha_model->SaveSettings($data,'reCaptcha');

				if($status) {
					$this->session->set_flashdata('success_message', 'Success! Captcha setting Updated');
					redirect('admin/captcha');
				} else {
					$this->session->set_flashdata('error_message', 'Failed! captcha setting not Updated');
					redirect('admin/captcha');
				}
			} else {
				$this->load->view('admin/captcha');
			}

		} 
		else {

			$condition = "Page LIKE '%reCaptcha%'";
			// if(isset($this->data['recaptcha'])) {
				$this->data['siteKey'] = $this->captcha_model->GetSettings('siteKey');
				$this->data['secretKey'] = $this->captcha_model->GetSettings('secretKey');
				$this->load->view('admin/captcha',$this->data);
			// }
			// $this->load->view('admin/captcha');
		}
	    
	}


}
