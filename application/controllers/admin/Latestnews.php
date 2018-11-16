<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Latestnews extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		$this->load->model('common_model');
		$this->load->model('admin/Latestnews_model');
		$this->lang->load('latestnews');
		
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
						redirect('admin/latestnewslist');
					}
				}
			} else {
				$this->data['pages'] = $this->Latestnews_model->Getfields();
				$this->load->view('admin/latestnewslist', $this->data);
			}
	    } else {
	    	redirect('admin/login');
	    }
 		
	}

    // selected language's content list
	public function filter() {
		$this->data['pages'] = $this->common_model->GetResults("","arm_news","*");

		if($this->input->post()) {

			$LanguageId = $this->input->post('languagename');
			$lang_condition = "IsDelete='0' AND LanguageId='".$LanguageId."'";
			$this->data['pages'] = $this->common_model->GetResults($lang_condition,'arm_news','');
			
			$lang_condition = "IsDelete='0'";
			$this->data['languages'] = $this->common_model->GetResults($lang_condition,"arm_language");
			$this->load->view('admin/latestnewslist', $this->data);

		} else {

			redirect('admin/latestnewslist', $this->data);	
		}
	}


	public function updatelatestnews($id='')
	{
		
		
		if($this->session->userdata('logged_in')) 
		{
			
			$lang_condition = "IsDelete='0'";
		    $this->data['languages'] = $this->common_model->GetResults($lang_condition,"arm_language");

			if($this->input->post())
			{
				//print_r($this->input->post());
				

				$this->form_validation->set_rules('newsheader', 'newsheader', 'trim|required|callback_alpha_dash_space');
				$this->form_validation->set_rules('newsdesp', 'newsdesp', 'trim|required');
				$this->form_validation->set_rules('newsstatus', 'newsstatus', 'trim|required');
				$this->form_validation->set_rules('newstype', 'newstype', 'trim|required');
				$this->form_validation->set_rules('languagename', 'language', 'trim|required');
				

 				if($this->form_validation->run() == true)
 				{

				$data = array(
					'NewsHeader'=>$this->input->post('newsheader'),
					'NewsDescription'=>$this->input->post('newsdesp'),
					'Type'=>$this->input->post('newstype'),
					'LanguageId'=>$this->input->post('languagename'),
					'DateAdded'=>date('y-m-d H:i:s'),
					'Status'=>$this->input->post('newsstatus'));

					if($id=='')
					{
						$result = $this->common_model->SaveRecords($data,'arm_news');
					}
					else
					{
						$condition= "NewsId='".$id."'";
						$result = $this->common_model->UpdateRecord($data,$condition,'arm_news');
					}
				
					
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/latestnews');
 				
				}
				elseif($id!='')
				{
				
				$this->data['fielddata']= $this->Latestnews_model->Getfielddata($id);
				$this->data['NewsId']=$this->data['fielddata']->NewsId;
				$this->data['NewsHeader']=$this->data['fielddata']->NewsHeader;
				$this->data['NewsType']=$this->data['fielddata']->Type;
				$this->data['Status']=$this->data['fielddata']->Status;
				$this->data['NewsDescription']=$this->data['fielddata']->NewsDescription;
				$this->data['LanguageId']=$this->data['fielddata']->LanguageId;


				$this->load->view('admin/updatelatestnews',$this->data);
				// $this->load->view('admin/packagesetting');
				}
				else
				{
				
				$this->load->view('admin/updatelatestnews',$this->data);
				}

				
				
			}
			elseif($id!='')
			{
				
				$this->data['fielddata']= $this->Latestnews_model->Getfielddata($id);
				$this->data['NewsId']=$this->data['fielddata']->NewsId;
				$this->data['NewsHeader']=$this->data['fielddata']->NewsHeader;
				$this->data['NewsType']=$this->data['fielddata']->Type;
				$this->data['Status']=$this->data['fielddata']->Status;
				$this->data['NewsDescription']=$this->data['fielddata']->NewsDescription;
				$this->data['LanguageId']=$this->data['fielddata']->LanguageId;


				$this->load->view('admin/updatelatestnews',$this->data);
				// $this->load->view('admin/packagesetting');
			}
			else
			{
				
				$this->load->view('admin/updatelatestnews',$this->data);
			}

		} 
		else
		{
			redirect('admin/login');

					
		}


		}

public function delete($id) 
{
		$condition = "NewsId =" . "'" . $id . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_news');
		if($status) {
					$this->session->set_flashdata('success_message',$this->lang->line('successmessagedel'));
					redirect('admin/latestnews');
		}
		
}

public function enable($NewsId) {
		$condition = "NewsId =" . "'" . $NewsId . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_news');
		if($status) {
			redirect('admin/latestnews');
		}
	}

	public function disable($NewsId) {
		$condition = "NewsId =" . "'" . $NewsId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_news');
		if($status) {
			redirect('admin/latestnews');
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

	function alpha_dash_space($str)
	{
		if(preg_match("/^([-a-z_ ])+$/i", $str)) {
			return true;
		} else {
			$this->form_validation->set_message('alpha_dash_space', '<p><em class="state-error1">The given news header field values are only in character</em></p>');
			return false;
		}
	    // return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
	}

	} //class ends


