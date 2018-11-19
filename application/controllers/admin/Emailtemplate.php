<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailtemplate extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/Emailtemplate_model');
		$this->lang->load('emailtemplate');
		
		
		}  else {
	    	redirect('admin/login');
	    }
		
	} //function ends

	public function index()
	{
		

		if($this->session->userdata('logged_in')) {
			if($this->input->post('inputname')) {
				if($this->input->post('active'))
				{
					print_r($this->input->post());
					exit;
				} else {
					foreach ($this->input->post('inputname') as $customer_id) {
						print_r($this->input->post());
						//$status = $this->Packagesetting_model->DeletePackage($package_id);
					}
					
					if($status) {
						redirect('admin/emailtemplatelist');
					}
				}
			} else {
				$this->data['field'] = $this->Emailtemplate_model->Getfields();
				

				$this->load->view('admin/emailtemplatelist', $this->data['field']);
			}
	    } else {
	    	redirect('admin/login');
	    }
 		
	}


	public function addemailtemplate()
	{
		

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				
				$this->form_validation->set_rules('emailid', 'emailid', 'trim|required|valid_email');
				$this->form_validation->set_rules('sender', 'sender', 'trim|required|alpha_numeric');
				$this->form_validation->set_rules('page', 'page', 'trim|required|alpha_numeric');
				$this->form_validation->set_rules('subject', 'subject', 'trim|required');
				$this->form_validation->set_rules('emailstatus', 'emailstatus', 'trim|required');
				$this->form_validation->set_rules('message', 'content', 'trim|required');

 				if($this->form_validation->run() == true )
 				{
 					
				$data = array(
					'FromEmailId'=>$this->input->post('emailid'),
					'FromName'=>$this->input->post('sender'),
					'Page'=>$this->input->post('page'),
					'EmailSubject'=>$this->input->post('subject'),
					'EmailStatus'=>$this->input->post('emailstatus'),
					'EmailContent'=>urlencode($this->input->post('message')));

				
				$result = $this->common_model->SaveRecords($data,'arm_emailtemplate');
				
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/emailtemplate');
 				}

				else
				{

					

					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['register']= $this->Emailtemplate_model->getregister();
					$this->data['productdetail']= $this->Emailtemplate_model->Getproductdetail();

					
					$this->load->view('admin/addemailtemplate');
				}

				
			}
			else
			{
				$this->data['register']= $this->Emailtemplate_model->getregister();
				$this->data['productdetail']= $this->Emailtemplate_model->Getproductdetail();

				$this->load->view('admin/addemailtemplate',$this->data);
				
			} 
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}//function ends



public function delete($id) 
{
		$condition = "EmailTemplateId =" . "'" . $id . "'";
		$data = array(
					'IsDelete'=>'1');
		$status = $this->common_model->UpdateRecord($data,$condition, 'arm_emailtemplate');
		if($status) {
					$this->session->set_flashdata('success_message',$this->lang->line('successmessagedel'));
					redirect('admin/emailtemplate');
		}
		
	}


	public function editemailtemplate($id)
	{
		
		
		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				//print_r($this->input->post());
				

				$this->form_validation->set_rules('emailid', 'emailid', 'trim|required|valid_email');
				$this->form_validation->set_rules('sender', 'sender', 'trim|required|alpha_numeric');
				$this->form_validation->set_rules('page', 'page', 'trim|required|alpha_numeric');
				$this->form_validation->set_rules('subject', 'subject', 'trim|required');
				$this->form_validation->set_rules('emailstatus', 'emailstatus', 'trim|required');
				$this->form_validation->set_rules('message', 'content', 'trim|required');

 				if($this->form_validation->run() == true)
 				{

				$data = array(
					'FromEmailId'=>$this->input->post('emailid'),
					'FromName'=>$this->input->post('sender'),
					'Page'=>$this->input->post('page'),
					'EmailSubject'=>$this->input->post('subject'),
					'EmailStatus'=>$this->input->post('emailstatus'),
					'EmailContent'=>urlencode($this->input->post('message')));

				
					$condition= "EmailTemplateId='".$id."'";
					$result = $this->common_model->UpdateRecord($data,$condition,'arm_emailtemplate');
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/emailtemplate');
 				
				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					
					$this->data['fielddata']= $this->Emailtemplate_model->Getfielddata($id);

					$this->load->view('admin/editemailtemplate',$this->data);
				}

				
				
			}
			elseif($id!='')
			{
				
				$this->data['fielddata']= $this->Emailtemplate_model->Getfielddata($id);
				
				$this->load->view('admin/editemailtemplate',$this->data);
				// $this->load->view('admin/packagesetting');
			}
			else
			{
				
				redirect('admin/emailtemplate');
			}

		} 
		else
		{
			redirect('admin/login');

					
		}


		}


public function enable($EmailTemplateId) {
		$condition = "EmailTemplateId =" . "'" . $EmailTemplateId . "'";

		$data = array(
			'EmailStatus' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_emailtemplate');
		if($status) {
			redirect('admin/emailtemplate');
		}
	}

	public function disable($EmailTemplateId) {
		$condition = "EmailTemplateId =" . "'" . $EmailTemplateId . "'";

		$data = array(
			'EmailStatus' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_emailtemplate');
		if($status) {
			redirect('admin/emailtemplate');
		}
	}

	public function active($RequireId) {
		$condition = "RequireId =" . "'" . $RequireId . "'";

		$data = array(
			'ReuireFieldStatus' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_requirefields');
		if($status) {
			redirect('admin/emailtemplate');
		}
	}

	public function inactive($RequireId) {
		$condition = "RequireId =" . "'" . $RequireId . "'";

		$data = array(
			'ReuireFieldStatus' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_requirefields');
		if($status) {
			redirect('admin/emailtemplate');
		}
	}


	public function lvlcommission_check($str,$numbers)
	{
		
		$flag=0;
		
		
			if(!is_numeric($numbers))
			{
				$flag=1;
			}
			

		if ($flag==0) 
			{
			
				return true; 
				}
		else{
			
			$this->form_validation->set_message('lvlcommission_check', '<p><em class="state-error1">The given levelcommission field values are only in numbers</em></p>');
			return false;
		}
		
	}

	
	public function prtlvlcommission_check($str,$productlevelcommission)
	{
		
		/*print_r($str);
		echo"--sdf--";
		print_r($productlevelcommission);*/
		
		$flag=0;
			if(!is_numeric($productlevelcommission))
			{
				$flag=1;
			}

		//echo $flag;  exit;
		if ($flag==0) 
			{
				return true; 
				}
		else{
			
			$this->form_validation->set_message('prtlvlcommission_check', '<p><em class="state-error1">The given productlevelcommission field values are  only in numbers</em></p>');
			return false;
		}
		
	}

	} //class ends


