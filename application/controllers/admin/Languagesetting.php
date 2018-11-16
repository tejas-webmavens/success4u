<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Languagesetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/Languagesetting_model');
		$this->lang->load('languagesetting');
		
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
						redirect('admin/languagelist');
					}
				}
			} else {
				$this->data['field'] = $this->Languagesetting_model->Getfields();
				$this->load->view('admin/languagelist', $this->data['field']);
			}
	    } else {
	    	redirect('admin/login');
	    	// $this->load->view('admin/login');
	    }
 		
	}


	public function updatelanguage($id='')
	{
		

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				
				$this->form_validation->set_rules('languagename', 'languagename', 'trim|required|alpha|xss_clean|callback_languagename_check1');
				$this->form_validation->set_rules('languagecode', 'languagecode', 'trim|required|alpha');
				$this->form_validation->set_rules('languagestatus', 'languagestatus', 'trim|required');
				//$this->form_validation->set_rules('languageimage', 'languageimage', 'trim|required');
				if($id!='')
				{
					$this->form_validation->set_rules('languagename', 'languagename', 'trim|xss_clean|callback_languagename_check['.$id.']');
					//$this->form_validation->set_rules('matrixcompletedcommission', 'matrixcompletedcommission', 'trim|required|numeric');

				}

				$lang_img = 'uploads/LanguageImage/'.$this->input->post('languagename').'.png';
				if($_FILES['languageimage']['tmp_name']!='')
				{
					if($id!='')
					{
						unlink($lang_img);
					}
					move_uploaded_file($_FILES['languageimage']['tmp_name'], $lang_img);
				}
				
				

 				if($this->form_validation->run() == true )
 				{
 					
					$data = array(
						'LanguageName'=>$this->input->post('languagename'),
						'LanguageCode'=>$this->input->post('languagecode'),
						'LanguageImage'=>$lang_img,
						'Status'=>$this->input->post('languagestatus')
					);

					if($id=='')
					{
						$result = $this->common_model->SaveRecords($data,'arm_language');
						if($this->input->post('languagestatus')==1)
						{
							$data1 = array('Status'=>'0');
							$condition1= "LanguageId!='".$this->db->insert_id()."'";
							$result = $this->common_model->UpdateRecord($data1,$condition1,'arm_language');
						}
					}
					else
					{
						$condition= "LanguageId='".$id."'";
						$result = $this->common_model->UpdateRecord($data,$condition,'arm_language');
						if($this->input->post('languagestatus')==1)
						{
							$data1 = array('Status'=>'0');
							$condition1= "LanguageId!='".$id."'";
							$result = $this->common_model->UpdateRecord($data1,$condition1,'arm_language');
						}

					}
					

					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/languagesetting');
 				}

				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['field']= $this->Languagesetting_model->Getfielddata($id);
					if($this->data['field']!='')
					{
						$this->data['LanguageId'] =$this->data['field']->LanguageId;
						$this->data['LanguageName'] =$this->data['field']->LanguageName;
						$this->data['LanguageCode'] =$this->data['field']->LanguageCode;
						$this->data['LanguageImage'] =$this->data['field']->LanguageImage;
						$this->data['Status'] =$this->data['field']->Status;
					}
					$this->load->view('admin/updatelanguage',$this->data);
				}

				
			}
			else
			{
				$this->data['field']= $this->Languagesetting_model->Getfielddata($id);
				if($this->data['field']!='')
				{
					$this->data['LanguageId'] =$this->data['field']->LanguageId;
					$this->data['LanguageName'] =$this->data['field']->LanguageName;
					$this->data['LanguageCode'] =$this->data['field']->LanguageCode;
					$this->data['LanguageImage'] =$this->data['field']->LanguageImage;
					$this->data['Status'] =$this->data['field']->Status;
				}

				$this->load->view('admin/updatelanguage',$this->data);
				// $this->load->view('admin/generalsetting');
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
		if($id!='1') {
			$condition = "LanguageId =" . "'" . $id . "'";
			$status = $this->common_model->DeleteRecord($condition, 'arm_language');
			if($status) {
				$this->session->set_flashdata('success_message',$this->lang->line('successmessagedel'));
				redirect('admin/languagesetting');
			}
		}
		
	}

/*
	public function editlanguage($id)
	{
		
		
		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
			
				$lvlcommission = implode(",", $this->input->post('levelcommission'));
				$prtlvlcommission = implode(",", $this->input->post('productlevelcommission'));

				 $lvlcheck = str_replace(",", "", $lvlcommission);
				 $prtlvlcheck = str_replace(",", "", $prtlvlcommission);
				 

				
				$this->form_validation->set_rules('packagename', 'packagename', 'trim|required|alpha');
				$this->form_validation->set_rules('packagefee', 'packagefee', 'trim|required|numeric');
				$this->form_validation->set_rules('renewalstatus', 'renewalstatus', 'trim|required');
				$this->form_validation->set_rules('renewalfee', 'renewalfee', 'trim|required|numeric');
				$this->form_validation->set_rules('recurringstatus', 'recurringstatus', 'trim|required');
				$this->form_validation->set_rules('recurringfee', 'recurringfee', 'trim|required');
				$this->form_validation->set_rules('autodebitstatus', 'autodebitstatus', 'trim|required');
				$this->form_validation->set_rules('product', 'product', 'trim|required');
				$this->form_validation->set_rules('owncommission', 'owncommission', 'trim|required|numeric');
				$this->form_validation->set_rules('levelcompletedcommission', 'levelcompletedcommission', 'trim|required|numeric');
				$this->form_validation->set_rules('matrixcompletedcommission', 'matrixcompletedcommission', 'trim|required|numeric');

 				$this->form_validation->set_rules('levelcommission', 'levelcommission', 'trim|xss_clean|callback_lvlcommission_check['.$lvlcheck.']');
 				$this->form_validation->set_rules('productlevelcommission', 'productlevelcommission', 'trim|xss_clean|callback_prtlvlcommission_check['.$prtlvlcheck.']');
 				
 				if($this->form_validation->run() == true)
 				{

				$data = array(
					'PackageName'=>$this->input->post('packagename'),
					'PackageFee'=>$this->input->post('packagefee'),
					'RenewalStatus'=>$this->input->post('renewalstatus'),
					'RenewalFee'=>$this->input->post('renewalfee'),
					'RenewalTerm'=>$this->input->post('recurringstatus'),
					'AutoDebitStatus'=>$this->input->post('autodebitstatus'),
					'AutoCreateOrderStatus'=>$this->input->post('autocreateorderstatus'),
					'RecurringStatus'=>$this->input->post('recurringstatus'),
					'RecurringFee'=>$this->input->post('recurringfee'),
					'ProductId'=>$this->input->post('recurringstatus'),
					'ProductName'=>$this->input->post('product'),
					'OwnCommission'=>$this->input->post('owncommission'),
					'LevelCompletedCommission'=>$this->input->post('levelcompletedcommission'),
					'MatrixCompletionCommission'=>$this->input->post('matrixcompletedcommission'),
					'LevelCommissions'=>$lvlcommission,
					'ProductLevelCommissions'=>$prtlvlcommission);

				
					$condition= "packageId='".$id."'";
					$result = $this->common_model->UpdateRecord($data,$condition,'arm_package');
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/languagesetting');
 				
				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['productdetail']= $this->Languagesetting_model->Getproductdetail();
					$this->data['fielddata']= $this->Languagesetting_model->Getfielddata($id);

					//redirect('admin/packagesetting/editfield');
					$this->load->view('admin/editlanguage',$this->data);
				}

				
				
			}
			else
			{
				
				$this->data['fielddata']= $this->Languagesetting_model->Getfielddata($id);
				$this->data['productdetail']= $this->Languagesetting_model->Getproductdetail();
				$this->load->view('admin/editlanguage',$this->data);
				// $this->load->view('admin/packagesetting');
			}

		} 
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}*/


	public function enable($LanguageId) {
	
		$condition1 = "LanguageId =" . "'" . $LanguageId . "'";

		$data1 = array(
			'Status' => '1'
		);

		$condition2 = "LanguageId !=" . "'" . $LanguageId . "'";

		$data2 = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data1, $condition1, 'arm_language');
		$status1 = $this->common_model->UpdateRecord($data2, $condition2, 'arm_language');
		if($status && $status1) {
			redirect('admin/languagesetting');
		}
	}

	public function disable($LanguageId) {
		
		$condition = "LanguageId =" . "'" . $LanguageId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_language');
		if($status) {
			redirect('admin/languagesetting');
		}
	}


	public function languagename_check($str,$id)
	{
		
		$condition = "LanguageName =" . "'" . $str . "' AND LanguageId !=" . "'" . $id . "'";
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_language');
		$this->db->where($condition);
		
		$query = $this->db->get();
		if (!$query->num_rows()>0) 
		{
			return true; 
		}
		else
		{
			$this->form_validation->set_message('languagename_check', '<p><em class="state-error1">'.ucwords($this->lang->line('langunavaiable')).'</em></p>');
			return false;
		}
	}

	public function languagename_check1($str)
	{
		
		$condition = "LanguageName =" . "'" . $str . "'";
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_language');
		$this->db->where($condition);
		
		$query = $this->db->get();
		if (!$query->num_rows()>0) 
		{
			return true; 
		}
		else
		{
			$this->form_validation->set_message('languagename_check1', '<p><em class="state-error1">'.ucwords($this->lang->line('langunavaiable')).'</em></p>');
			return false;
		}
	}


} //class ends


