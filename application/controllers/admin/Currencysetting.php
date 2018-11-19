<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currencysetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/Currencysetting_model');
		$this->lang->load('currencysetting');
		
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
						// redirect('admin/currencylist');
					}
				}
			} else {
				$this->data['field'] = $this->Currencysetting_model->Getfields();
				$this->load->view('admin/currencylist', $this->data['field']);
			}
	    } else {
	    	redirect('admin/login');
	    	// $this->load->view('admin/login');
	    }
 		
	}


	public function updatecurrency($id='')
	{
		

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
						 
				
				$this->form_validation->set_rules('currencyname', 'currencyname', 'trim|required|alpha|xss_clean|callback_currencyname_check1');
				$this->form_validation->set_rules('currencycode', 'currencycode', 'trim|required|alpha');
				$this->form_validation->set_rules('currencystatus', 'currencystatus', 'trim|required');
				$this->form_validation->set_rules('currencysymbol', 'currencysymbol', 'trim|required');
				$this->form_validation->set_rules('currencyvalue', 'currencyvalue', 'trim|required|numeric');
				if($id!='')
					{
						$this->form_validation->set_rules('currencyname', 'currencyname', 'trim|xss_clean|callback_currencyname_check['.$id.']');
						//$this->form_validation->set_rules('matrixcompletedcommission', 'matrixcompletedcommission', 'trim|required|numeric');

					}
/*
				$lang_img = 'uploads/LanguageImage/'.$this->input->post('languagename').'.png';
				if($_FILES['languageimage']['tmp_name']!='')
				{
					
					unlink($lang_img);
					move_uploaded_file($_FILES['languageimage']['tmp_name'], $lang_img);
				}
				
				*/

 				if($this->form_validation->run() == true )
 				{
 					
				$data = array(
					'CurrencyName'=>$this->input->post('currencyname'),
					'CurrencyCode'=>$this->input->post('currencycode'),
					'CurrencySymbol'=>$this->input->post('currencysymbol'),
					'CurrencyValue'=>$this->input->post('currencyvalue'),
					'Status'=>$this->input->post('currencystatus'));

					if($id=='')
					{
						$result = $this->common_model->SaveRecords($data,'arm_currency');
						if($this->input->post('currencystatus')==1)
						{
							$data1 = array(
							'Status'=>'0');
							$condition1= "CurrencyId !='".$this->db->insert_id()."'";
							$result = $this->common_model->UpdateRecord($data1,$condition1,'arm_currency');
						}
					}
					else
					{
						$condition= "CurrencyId='".$id."'";
						$result = $this->common_model->UpdateRecord($data,$condition,'arm_currency');
						if($this->input->post('currencystatus')==1)
						{
							$data1 = array(
							'Status'=>'0');
							$condition1= "CurrencyId !='".$id."'";
							$result = $this->common_model->UpdateRecord($data1,$condition1,'arm_currency');
						}

					}
				

				
				
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/currencysetting');
					exit;
 				}

				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					

				$this->data['field']= $this->Currencysetting_model->Getfielddata($id);
				if($this->data['field']!='')
				{
				$this->data['CurrencyId'] 		=$this->data['field']->CurrencyId;
				$this->data['CurrencyName'] 	=$this->data['field']->CurrencyName;
				$this->data['CurrencyCode'] 	=$this->data['field']->CurrencyCode;
				$this->data['CurrencySymbol'] 	=$this->data['field']->CurrencySymbol;
				$this->data['CurrencyValue'] 	=$this->data['field']->CurrencyValue;
				$this->data['Status'] =$this->data['field']->Status;
				}
					$this->load->view('admin/updatecurrency');
				}

				
			}
			else
			{
				$this->data['field']= $this->Currencysetting_model->Getfielddata($id);
				if($this->data['field']!='')
				{
				$this->data['CurrencyId'] 		=$this->data['field']->CurrencyId;
				$this->data['CurrencyName'] 	=$this->data['field']->CurrencyName;
				$this->data['CurrencyCode'] 	=$this->data['field']->CurrencyCode;
				$this->data['CurrencySymbol'] 	=$this->data['field']->CurrencySymbol;
				$this->data['CurrencyValue'] 	=$this->data['field']->CurrencyValue;
				$this->data['Status'] =$this->data['field']->Status;
				}

				$this->load->view('admin/updatecurrency',$this->data);
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
		$condition = "CurrencyId =" . "'" . $id . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_currency');
		if($status) {
			$this->session->set_flashdata('success_message',$this->lang->line('successmessagedel'));
			redirect('admin/currencysetting');
		}
		
}




public function enable($CurrencyId) {
	
		$condition1 = "CurrencyId =" . "'" . $CurrencyId . "'";

		$data1 = array(
			'Status' => '1'
		);

		$condition2 = "CurrencyId !=" . "'" . $CurrencyId . "'";

		$data2 = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data1, $condition1, 'arm_currency');
		$status1 = $this->common_model->UpdateRecord($data2, $condition2, 'arm_currency');
		if($status && $status1) {
			redirect('admin/currencysetting');
		}
	}

	public function disable($CurrencyId) {
		
		$condition = "CurrencyId =" . "'" . $CurrencyId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_currency');
		if($status) {
			redirect('admin/currencysetting');
		}
	}


	public function currencyname_check($str,$id)
	{
		
		$condition = "CurrencyName =" . "'" . $str . "' AND CurrencyId !=" . "'" . $id . "'";
		
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_currency');
		$this->db->where($condition);
		
		$query = $this->db->get();
		if (!$query->num_rows()>0) 
			{
				return true; 
				}
		else{
			
			$this->form_validation->set_message('currencyname_check', '<p><em class="state-error1">'.ucwords($this->lang->line('currencyunavaiable')).'</em></p>');
			return false;
		}
		
	}

	public function currencyname_check1($str)
	{
		
		$condition = "CurrencyName =" . "'" . $str . "'";
		
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_currency');
		$this->db->where($condition);
		
		$query = $this->db->get();
		if (!$query->num_rows()>0) 
			{
				return true; 
				}
		else{
			
			$this->form_validation->set_message('currencyname_check1', '<p><em class="state-error1">'.ucwords($this->lang->line('currencyunavaiable')).'</em></p>');
			return false;
			}
		
	}


	} //class ends


