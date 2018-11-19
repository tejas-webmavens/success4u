<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smtpsetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		$this->load->model('admin/Smtpsetting_model');
		
		
		}  else {
	    	redirect('admin/login');
	    }
	} //function ends

	public function index()
	{
		$this->lang->load('smtpsetting');

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				
					//print_r($this->input->post());
				
				$this->form_validation->set_rules('smtpstatus', 'smtpstatus', 'trim|required');
				$this->form_validation->set_rules('smtpmail', 'smtpmail', 'trim|required|valid_email');
				$this->form_validation->set_rules('smtppassword', 'smtppassword', 'trim|required');
				$this->form_validation->set_rules('smtpport', 'smtpport', 'trim|required');
				$this->form_validation->set_rules('smtphost', 'smtphost', 'trim|required');
				$this->form_validation->set_rules('mail_limit', 'user mail limit', 'trim|required|integer');
 			
 				if($this->form_validation->run()==true)
 				{

 				$data = array(
					'smtpstatus'=>$this->input->post('smtpstatus'),
					'smtpmail'=>$this->input->post('smtpmail'),
					'smtppassword'=>$this->input->post('smtppassword'),
					'smtpport'=>$this->input->post('smtpport'),
					'MailLimit'=>$this->input->post('mail_limit'),
					'smtphost'=>$this->input->post('smtphost'));

				$result = $this->Smtpsetting_model->Update($data);

				$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));

				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
				}

				$this->data['smtpstatus']= $this->Smtpsetting_model->Getdata('smtpstatus');
				$this->data['smtpmail']= $this->Smtpsetting_model->Getdata('smtpmail');
				$this->data['smtppassword']= $this->Smtpsetting_model->Getdata('smtppassword');
				$this->data['smtpport']= $this->Smtpsetting_model->Getdata('smtpport');
				$this->data['smtphost']= $this->Smtpsetting_model->Getdata('smtphost');
				


				$this->load->view('admin/smtpsetting',$this->data);
			}
			else
			{
				$this->data['smtpstatus']= $this->Smtpsetting_model->Getdata('smtpstatus');
				$this->data['smtpmail']= $this->Smtpsetting_model->Getdata('smtpmail');
				$this->data['smtppassword']= $this->Smtpsetting_model->Getdata('smtppassword');
				$this->data['smtpport']= $this->Smtpsetting_model->Getdata('smtpport');
				$this->data['smtphost']= $this->Smtpsetting_model->Getdata('smtphost');
				
				$this->load->view('admin/smtpsetting',$this->data);
			}

				
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}//function ends



	} //class ends


