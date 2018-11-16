<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// $this->load->model('user/shop_model');
		
		// $this->load->library('cart');
		//$this->load->helper('url');
		// $this->load->helper('cms_helper');
		// Load form helper library
		//$this->load->helper('form');
		$this->load->model('admin/Smtpsetting_model');
		// Load database
		
		// change language
		//$this->config->set_item('language', 'spanish');

		// load language
		
		$this->lang->load('user/contactus');

	}

	public function index()
	{
		$siteset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitestatus'", "arm_setting");
		if($siteset->ContentValue=="Off")
		{
			redirect("offsite"); exit;
		}

		if($this->input->post())
		{
			$this->form_validation->set_rules('name', 'name', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
			$this->form_validation->set_rules('subject', 'subject', 'trim|required');
			$this->form_validation->set_rules('message', 'messages', 'trim|required');
			

			if($this->form_validation->run() == TRUE)
			{

			$smtpstatus = $this->Smtpsetting_model->Getdata('smtpstatus');
			$smtpmail = $this->Smtpsetting_model->Getdata('smtpmail');
			$smtppassword = $this->Smtpsetting_model->Getdata('smtppassword');
			$smtpport = $this->Smtpsetting_model->Getdata('smtpport');
			$smtphost = $this->Smtpsetting_model->Getdata('smtphost');
			$maillimit = $this->Smtpsetting_model->Getdata('mail_limit');

				$config = array();
				$config['protocol'] 		= "sendmail";
			    $config['useragent']        = "CodeIgniter";
			    $config['mailpath']         = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
			    $config['protocol']         = "smtp";
			    $config['smtp_host']        = $smtphost;
			    $config['smtp_port']        = $smtpport;
			    $config['mailtype'] 		= 'html';
			    $config['charset']  		= 'utf-8';
			    $config['newline']  		= "\r\n";
			    $config['wordwrap'] 		= TRUE;
			
				$this->email->clear(TRUE);

				$this->email->from($this->input->post('email'),$this->input->post('name'));
				$this->email->reply_to($this->input->post('email'),$this->input->post('name'));
				$sitename = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitename'","arm_setting");

				$this->email->to($smtpmail, $sitename->ContentValue);
				$this->email->subject($this->input->post('subject'));
		    	$this->email->message($this->input->post('subject'));    
		    	// echo "<pre>".$smtpmail; print_r($this->input->post());exit;
		    	$Mail_status = $this->email->send();
		    	if($Mail_status)
		    	{
		    		$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
		    	}
		    	else
		    	{
		    		$this->session->set_flashdata('error_message',$this->lang->line('errormessagemail'));
		    	}
		    }
		    else
		    	{
		    		$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
		    	}

				$this->load->view('user/contactus');

		}
		else
		{

		$this->load->view('user/contactus');

		}
		
	}
	// public function contents() {
	// 	$this->load->view('user/content');
	// }

}
?>