<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usersetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		$this->load->model('admin/Usersetting_model');
		
		
		} else {
			redirect('admin/login');
		}
	} //function ends

	public function index()
	{

		$this->lang->load('usersetting');

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				
				//	print_r($this->input->post());
				
				$this->form_validation->set_rules('minuserpasswordlength', $this->lang->line('minuserpasswordlength'), 'trim|required|callback_minlimit_check');
				$this->form_validation->set_rules('maxuserpasswordlength', $this->lang->line('maxuserpasswordlength'), 'trim|required|callback_maxlimit_check');
				// $this->form_validation->set_rules('twofactorauthstatus', $this->lang->line('twofactorauthstatus'), 'trim|required');
				$this->form_validation->set_rules('withdrawpassordstatus', $this->lang->line('withdrawpassordstatus'), 'trim|required');
				$this->form_validation->set_rules('profilepassordstatus', $this->lang->line('profilepassordstatus'), 'trim|required');
				$this->form_validation->set_rules('accountconfirmationstatus', $this->lang->line('accountconfirmationstatus'), 'trim|required');
				$this->form_validation->set_rules('useremailchangestatus', $this->lang->line('useremailchangestatus'), 'trim|required');
				$this->form_validation->set_rules('userprofilenotifystatus', $this->lang->line('userprofilenotifystatus'), 'trim|required');
				$this->form_validation->set_rules('subscriptionstatus', $this->lang->line('subscriptionstatus'), 'trim|required');
				$this->form_validation->set_rules('subscriptiontype', $this->lang->line('subscriptiontype'), 'trim|required');
				$this->form_validation->set_rules('subscriptiongraceperiod', $this->lang->line('subscriptiongraceperiod'), 'trim|required|integer');
				
			
 				if($this->form_validation->run()== true)
 				{

 					$data = array(
					'minuserpasswordlength'=>$this->input->post('minuserpasswordlength'),
					'maxuserpasswordlength'=>$this->input->post('maxuserpasswordlength'),
					// 'twofactorauthstatus'=>$this->input->post('twofactorauthstatus'),
					'withdrawpassordstatus'=>$this->input->post('withdrawpassordstatus'),
					'profilepassordstatus'=>$this->input->post('profilepassordstatus'),
					'accountconfirmationstatus'=>$this->input->post('accountconfirmationstatus'),
					'useremailchangestatus'=>$this->input->post('useremailchangestatus'),
					'userprofilenotifystatus'=>$this->input->post('userprofilenotifystatus'),
					'subscriptionstatus'=>$this->input->post('subscriptionstatus'),
					'subscriptiontype'=>$this->input->post('subscriptiontype'),
					'subscriptiongraceperiod'=>$this->input->post('subscriptiongraceperiod'));

				$result = $this->Usersetting_model->Update($data);

				}
				else
				{
					$result =0;
				}


				if($result)
				{
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));

				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
				}

				$this->data['minuserpasswordlength']= $this->Usersetting_model->Getdata('minuserpasswordlength');
				$this->data['maxuserpasswordlength']= $this->Usersetting_model->Getdata('maxuserpasswordlength');
				// $this->data['twofactorauthstatus']= $this->Usersetting_model->Getdata('twofactorauthstatus');
				$this->data['withdrawpassordstatus']= $this->Usersetting_model->Getdata('withdrawpassordstatus');
				$this->data['profilepassordstatus']= $this->Usersetting_model->Getdata('profilepassordstatus');
				$this->data['accountconfirmationstatus']= $this->Usersetting_model->Getdata('accountconfirmationstatus');
				$this->data['useremailchangestatus']= $this->Usersetting_model->Getdata('useremailchangestatus');
				$this->data['userprofilenotifystatus']= $this->Usersetting_model->Getdata('userprofilenotifystatus');
				$this->data['subscriptionstatus']= $this->Usersetting_model->Getdata('subscriptionstatus');
				$this->data['subscriptiontype']= $this->Usersetting_model->Getdata('subscriptiontype');
				$this->data['subscriptiongraceperiod']= $this->Usersetting_model->Getdata('subscriptiongraceperiod');
				


				$this->load->view('admin/usersetting',$this->data);
			}
			else
			{
				$this->data['minuserpasswordlength']= $this->Usersetting_model->Getdata('minuserpasswordlength');
				$this->data['maxuserpasswordlength']= $this->Usersetting_model->Getdata('maxuserpasswordlength');
				// $this->data['twofactorauthstatus']= $this->Usersetting_model->Getdata('twofactorauthstatus');
				$this->data['withdrawpassordstatus']= $this->Usersetting_model->Getdata('withdrawpassordstatus');
				$this->data['profilepassordstatus']= $this->Usersetting_model->Getdata('profilepassordstatus');
				$this->data['accountconfirmationstatus']= $this->Usersetting_model->Getdata('accountconfirmationstatus');
				$this->data['useremailchangestatus']= $this->Usersetting_model->Getdata('useremailchangestatus');
				$this->data['userprofilenotifystatus']= $this->Usersetting_model->Getdata('userprofilenotifystatus');
				$this->data['subscriptionstatus']= $this->Usersetting_model->Getdata('subscriptionstatus');
				$this->data['subscriptiontype']= $this->Usersetting_model->Getdata('subscriptiontype');
				$this->data['subscriptiongraceperiod']= $this->Usersetting_model->Getdata('subscriptiongraceperiod');
				
				$this->load->view('admin/usersetting',$this->data);
			}

				
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}//function ends

	public function minlimit_check()
	{

		//echo $str,'<'.$max;
		if($this->input->post('minuserpasswordlength') <= $this->input->post('maxuserpasswordlength')) 
			{
				return true; 
			}
		else{
				
			$this->form_validation->set_message('minlimit_check', '<p><em class="state-error1">The given '.ucwords($this->lang->line('minuserpasswordlength')).' field values less than or equal to  '.ucwords($this->lang->line('maxuserpasswordlength')).'</em></p>');
			return false;
		}
	}

	public function maxlimit_check()
	{

		//echo $str,'<'.$max;
		if($this->input->post('minuserpasswordlength') <= $this->input->post('maxuserpasswordlength')) 
			{
				return true; 
			}
		else{
				
			$this->form_validation->set_message('maxlimit_check', '<p><em class="state-error1">The given '.ucwords($this->lang->line('maxuserpasswordlength')).' field values geater than or equal to  '.ucwords($this->lang->line('minuserpasswordlength')).'</em></p>');
			return false;
		}
	}



	} //class ends


