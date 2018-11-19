<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registersetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/registersetting_model');

		}  else {
	    	redirect('admin/login');
	    }
		
	} //function ends

	public function index()
	{
		$this->lang->load('registersetting');

		if($this->session->userdata('logged_in')) {
			if($this->input->post('inputname')) {
				if($this->input->post('active'))
				{
					print_r($this->input->post());
					exit;
				} else {
					foreach ($this->input->post('inputname') as $customer_id) {
						print_r($this->input->post());
						//$status = $this->registersetting_model->DeleteCustomer($customer_id);
					}
					
					if($status) {
						redirect('admin/requirelist');
					}
				}
			} else {
				$this->data['field'] = $this->registersetting_model->Getfields();
				$this->load->view('admin/requirelist', $this->data['field']);
			}
	    } else {
	    	redirect('admin/login');
	    	// $this->load->view('admin/login');
	    }
 		
	}


	public function addfield()
	{
		$this->lang->load('registersetting');

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
			
				$this->form_validation->set_rules('fieldname', 'fieldname', 'trim|required|xss_clean|callback_fieldname_check|callback_fieldmatch_check');
				$this->form_validation->set_rules('fieldrequire', 'fieldrequire', 'trim|required');
				$this->form_validation->set_rules('fieldenable', 'fieldenable', 'trim|required');
				$this->form_validation->set_rules('fieldposition', 'fieldposition', 'trim|required|numeric|xss_clean|callback_position_check['.$this->input->post('fieldname').']');
 				

 				if($this->form_validation->run() == true)
 				{

					$data = array(
						'ReuireFieldName'=>$this->input->post('fieldname'),
						'ReuireFieldStatus'=>$this->input->post('fieldrequire'),
						'FieldEnableStatus'=>$this->input->post('fieldenable'),
						'FieldPosition'=>$this->input->post('fieldposition'),
						'Page' => 'register'
					);

					$condition= "ReuireFieldName='".$this->input->post('fieldname')."'";
					$resultchk = $this->common_model->GetResults($condition,'arm_requirefields','*'); 
				
					if(!$resultchk) 
					{
						$result = $this->common_model->SaveRecords($data,'arm_requirefields');
					}
					else
					{
						$condition= "RequireId='".$resultchk[0]->RequireId."'";
						$result = $this->common_model->UpdateRecord($data,$condition,'arm_requirefields');
					}

					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/registersetting');
 				}

				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['register']= $this->registersetting_model->getregister();
					$this->data['cusomfield']= $this->registersetting_model->Getcusomfield();

					$this->load->view('admin/addrequirefield');
				}

				
			}
			else
			{
				$this->data['register']= $this->registersetting_model->getregister();
				$this->data['cusomfield']= $this->registersetting_model->Getcusomfield();

				$this->load->view('admin/addrequirefield',$this->data);
				// $this->load->view('admin/generalsetting');
			} 
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}//function ends

	public function editfield($id)
	{
		$this->lang->load('registersetting');
		
		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
			
				$this->form_validation->set_rules('fieldname', 'fieldname', 'trim|required|callback_fieldmatch_check');
				$this->form_validation->set_rules('fieldrequire', 'fieldrequire', 'trim|required');
				$this->form_validation->set_rules('fieldenable', 'fieldenable', 'trim|required');
				$this->form_validation->set_rules('fieldposition', 'fieldposition', 'trim|required|numeric|xss_clean|callback_position_check['.$this->input->post('fieldname').']');
 				

 				if($this->form_validation->run() == true)
 				{

					$data = array(
						'ReuireFieldName'=>$this->input->post('fieldname'),
						'ReuireFieldStatus'=>$this->input->post('fieldrequire'),
						'FieldEnableStatus'=>$this->input->post('fieldenable'),
						'FieldPosition'=>$this->input->post('fieldposition'),
						'Page' => 'register'
					);

					$condition= "ReuireFieldName='".$this->input->post('fieldname')."'";
					$resultchk = $this->common_model->GetResults($condition,'arm_requirefields','*'); 
					
					if(!$resultchk) 
					{
						$result = $this->common_model->SaveRecords($data,'arm_requirefields');
					}
					else
					{
						$condition= "RequireId='".$resultchk[0]->RequireId."'";
						$result = $this->common_model->UpdateRecord($data,$condition,'arm_requirefields');
					}
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/registersetting');
 				}

				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['register']= $this->registersetting_model->getregister();
					$this->data['cusomfield']= $this->registersetting_model->Getcusomfield();
					$this->data['fielddata']= $this->registersetting_model->Getfielddata($id);
					$this->load->view('admin/editrequirefield',$this->data);
				}

				
				
			}
			else
			{
				$this->data['register']= $this->registersetting_model->getregister();
				$this->data['cusomfield']= $this->registersetting_model->Getcusomfield();
				$this->data['fielddata']= $this->registersetting_model->Getfielddata($id);
				
				$this->load->view('admin/editrequirefield',$this->data);
				// $this->load->view('admin/generalsetting');
			} 
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}


	public function enable($RequireId) {
		$condition = "RequireId =" . "'" . $RequireId . "' AND ReuireFieldName NOT IN ('UserName','Password','Email','Phone','FirstName')";

		$data = array(
			'FieldEnableStatus' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_requirefields');
		if($status) {
			redirect('admin/registersetting');
		}
	}

	public function disable($RequireId) {
		$condition = "RequireId =" . "'" . $RequireId . "' AND ReuireFieldName NOT IN ('UserName','Password','Email','Phone','FirstName')";

		$data = array(
			'FieldEnableStatus' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_requirefields');
		if($status) {
			redirect('admin/registersetting');
		}
	}

	public function active($RequireId) {
		$condition = "RequireId =" . "'" . $RequireId . "' AND ReuireFieldName NOT IN ('UserName','Password','Email','Phone','FirstName')";

		$data = array(
			'ReuireFieldStatus' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_requirefields');
		if($status) {
			redirect('admin/registersetting');
		}
	}

	public function inactive($RequireId) {
		$condition = "RequireId =" . "'" . $RequireId . "' AND ReuireFieldName NOT IN ('UserName','Password','Email','Phone','FirstName')";

		$data = array(
			'ReuireFieldStatus' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_requirefields');
		if($status) {
			redirect('admin/registersetting');
		}
	}


	public function position_check($str,$fieldname)
	{
		
			$condition = "FieldPosition =" . "'" . $str . "' AND ReuireFieldName !=" . "'" . $fieldname . "'";
		
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_requirefields');
		$this->db->where($condition);
		
		$query = $this->db->get();
		
		if (!$query->num_rows()>0) 
			{
				return true; 
				}
		else{
			
			$this->form_validation->set_message('position_check', '<p><em class="state-error1">This position is unavailable</em></p>');
			return false;
		}
		
	}

	public function fieldname_check($str)
	{
		
			$condition = "ReuireFieldName =" . "'" . $str . "'";
		
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_requirefields');
		$this->db->where($condition);
		$query = $this->db->get();
		//echo $this->db->last_query();
		

		if (!$query->num_rows()>0) 
			{
				return true; 
			}
		else{
			
			$this->form_validation->set_message('fieldname_check', '<p><em class="state-error1">This fieldname is already inserted </em></p>');
			return false;
		}
		
	}


	public function fieldmatch_check($str)
	{ 
		$fields = array('UserName','Password','Email','Phone','FirstName');
		if (!in_array($str, $fields)) 
			{
				return true; 
			}
		else{
			
			$this->form_validation->set_message('fieldmatch_check', '<p><em class="state-error1">'.ucwords($this->lang->line('errorresever')).'</em></p>');
			return false;
		}

	}

} //class ends


