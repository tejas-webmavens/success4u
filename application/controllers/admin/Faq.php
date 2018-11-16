<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		$this->load->model('common_model');
		
		$this->lang->load('faq');
		
		}  else {
	    	redirect('admin/login');
	    }
	} //function ends

	public function index()
	{
		

		if($this->session->userdata('logged_in')) {

			$lang_condition = "IsDelete='0'";
		    $this->data['languages'] = $this->common_model->GetResults($lang_condition,"arm_language");

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
						redirect('admin/faqlist', $this->data);
					}
				}
			} else {
				$this->data['pages'] = $this->common_model->GetResults("","arm_faq","*");
				$this->load->view('admin/faqlist', $this->data);
			}
	    } else {
	    	redirect('admin/login');
	    }
 		
	}

// selected language's content list
	public function filter() {
		$this->data['pages'] = $this->common_model->GetResults("","arm_faq","*");

		if($this->input->post()) {

			$LanguageId = $this->input->post('languagename');
			$lang_condition = "IsDelete='0' AND LanguageId='".$LanguageId."'";
			$this->data['pages'] = $this->common_model->GetResults($lang_condition,'arm_faq','');
			
			$lang_condition = "IsDelete='0'";
			$this->data['languages'] = $this->common_model->GetResults($lang_condition,"arm_language");
			$this->load->view('admin/faqlist', $this->data);

		} else {

			redirect('admin/faqlist', $this->data);	
		}
	}


	public function updatefaq($id='')
	{
		
		
		if($this->session->userdata('logged_in')) 
		{
			$lang_condition = "IsDelete='0'";
		    $this->data['languages'] = $this->common_model->GetResults($lang_condition,"arm_language");

			if($this->input->post())
			{
				//print_r($this->input->post());
				

				// $this->form_validation->set_rules('faqheader', 'newsheader', 'trim|required|alpha_numeric');
				$this->form_validation->set_rules('faqquestion', 'faqquestion', 'trim|required');
				$this->form_validation->set_rules('faqanswer', 'faqanswer', 'trim|required');
				$this->form_validation->set_rules('faqstatus', 'faqstatus', 'trim|required');
				$this->form_validation->set_rules('faqtype', 'faqtype', 'trim|required');
				$this->form_validation->set_rules('languagename', 'language', 'trim|required');
				

 				if($this->form_validation->run() == true)
 				{

				$data = array(
					// 'FaqHeader'=>$this->input->post('faqheader'),
					'FaqQuestion'=>urlencode($this->input->post('faqquestion')),
					'FaqAnswer'=>urlencode($this->input->post('faqanswer')),
					'Type'=>$this->input->post('faqtype'),
					'LanguageId'=>$this->input->post('languagename'),
					'DateAdded'=>date('y-m-d H:i:s'),
					'Status'=>$this->input->post('faqstatus'));

					if($id=='')
					{
						$result = $this->common_model->SaveRecords($data,'arm_faq');
					}
					else
					{
						$condition= "FaqId='".$id."'";
						$result = $this->common_model->UpdateRecord($data,$condition,'arm_faq');
					}
				
					
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/faq');
 				
				}
				elseif($id!='')
				{
				
				$this->data['fielddata']= $this->common_model->GetRow("FaqId='".$id."'","arm_faq");
				$this->data['FaqId']=$this->data['fielddata']->FaqId;
				// $this->data['FaqHeader']=$this->data['fielddata']->FaqHeader;
				$this->data['FaqType']=$this->data['fielddata']->Type;
				$this->data['Status']=$this->data['fielddata']->Status;
				$this->data['FaqQuestion']=$this->data['fielddata']->FaqQuestion;
				$this->data['FaqAnswer']=$this->data['fielddata']->FaqAnswer;
				$this->data['LanguageId']=$this->data['fielddata']->LanguageId;


				$this->load->view('admin/updatefaq',$this->data);
				// $this->load->view('admin/packagesetting');
				}
				else
				{
				
				$this->load->view('admin/updatefaq',$this->data);
				}

				
				
			}
			elseif($id!='')
			{
				
				$this->data['fielddata']= $this->common_model->GetRow("FaqId='".$id."'","arm_faq");
				$this->data['FaqId']=$this->data['fielddata']->FaqId;
				// $this->data['FaqHeader']=$this->data['fielddata']->FaqHeader;
				$this->data['FaqType']=$this->data['fielddata']->Type;
				$this->data['Status']=$this->data['fielddata']->Status;
				$this->data['FaqQuestion']=$this->data['fielddata']->FaqQuestion;
				$this->data['FaqAnswer']=$this->data['fielddata']->FaqAnswer;
				$this->data['LanguageId']=$this->data['fielddata']->LanguageId;


				$this->load->view('admin/updatefaq',$this->data);
				// $this->load->view('admin/packagesetting');
			}
			else
			{
				
				$this->load->view('admin/updatefaq',$this->data);
			}

		} 
		else
		{
			redirect('admin/login');

					
		}


		}

public function delete($id) 
{
		$condition = "FaqId =" . "'" . $id . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_faq');
		if($status) {
					$this->session->set_flashdata('success_message',$this->lang->line('successmessagedel'));
					redirect('admin/faq');
		}
		
}

public function enable($FaqId) {
		$condition = "FaqId =" . "'" . $FaqId . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_faq');
		if($status) {
			redirect('admin/faq');
		}
	}

	public function disable($FaqId) {
		$condition = "FaqId =" . "'" . $FaqId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_faq');
		if($status) {
			redirect('admin/faq');
		}
	}


	} //class ends


