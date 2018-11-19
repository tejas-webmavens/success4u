<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customfieldsetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/Customfieldsetting_model');

		}  else {
	    	redirect('admin/login');
	    }
		
	} //function ends

	public function index()
	{
		$this->lang->load('customfieldsetting');

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
						redirect('admin/customfieldlist');
					}
				}
			} else {
				$this->data['field'] = $this->Customfieldsetting_model->Getfields();
				$this->data['cusomfield']= $this->Customfieldsetting_model->Getcusomfield();
				
				$this->load->view('admin/customfieldlist', $this->data);
			}
	    } else {
	    	redirect('admin/login');
	    	// $this->load->view('admin/login');
	    }
 		
	}


	public function addfield()
	{
		$this->lang->load('customfieldsetting');

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				
			
				$this->form_validation->set_rules('customfieldpage', 'customfieldpage', 'trim|required|alpha_numeric');
				$this->form_validation->set_rules('customfieldname', 'customfieldname', 'trim|required|alpha_numeric|callback_fieldname_check');
				$this->form_validation->set_rules('customfieldlabel', 'customfieldlabel', 'trim|required');
				$this->form_validation->set_rules('customfieldtype', 'customfieldtype', 'trim|required');
				$this->form_validation->set_rules('customfieldsize', 'customfieldsize', 'trim|required|numeric');
 				

 				if($this->form_validation->run() == TRUE)
 				{

					$data = array(
						'CustomLabel'=>$this->input->post('customfieldlabel'),
						'CustomName'=>$this->input->post('customfieldname'),
						'CustomType'=>$this->input->post('customfieldtype'),
						'CustomValue'=>$this->input->post('customfieldsize'),
						'Page' => $this->input->post('customfieldpage')
					);
				
					$result = $this->common_model->SaveRecords($data,'arm_customfields');
				
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/customfieldsetting');
 				}

				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['register']= $this->Customfieldsetting_model->getregister();
					$this->data['cusomfield']= $this->Customfieldsetting_model->Getcusomfield();

					$this->load->view('admin/addcustomfield');
				}

				
			}
			else
			{
				$this->data['register']= $this->Customfieldsetting_model->getregister();
				$this->data['cusomfield']= $this->Customfieldsetting_model->Getcusomfield();
				
				$this->load->view('admin/addcustomfield',$this->data);
				// $this->load->view('admin/generalsetting');
			} 
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

	}//function ends

	public function fieldname_check($str)
	{
		$condition = "Page=" . "'" . $this->input->post('customfieldpage') . "' AND CustomName =" . "'" . $this->input->post('customfieldname') . "'";
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_customfields');
		$this->db->where($condition);
		
		$query = $this->db->get();

		if (!$query->num_rows()>0) 
			{
				return true; 
				}
		else{
			
			$this->form_validation->set_message('fieldname_check', '<p><em class="state-error1">'.ucwords($this->lang->line('errorfieldname')).'</em></p>');
			return false;
		}
	}

} //class ends


