<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/Testimonial_model');
		$this->lang->load('testimonial');
		
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
						redirect('admin/testimoniallist');
					}
				}
			} else {
				$this->data['field'] = $this->Testimonial_model->Getfields();
				$this->load->view('admin/testimoniallist', $this->data['field']);
			}
	    } else {
	    	redirect('admin/login');
	    }
 		
	}


	public function addtestimonial()
	{
		

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				/*print_r($this->input->post());
				print_r($_FILES);
				echo "uploads/testimonial/".date('Ymdhis').$_FILES['userlogo']['name'];
				exit;*/

 			// 	if($_FILES['userlogo']['tmp_name']!='')
				// {
				// 	$ulimage="uploads/testimonial/".date('Ymdhis').$_FILES['userlogo']['name'];
				// 	move_uploaded_file($_FILES['userlogo']['tmp_name'], $ulimage);
				// }

				$this->form_validation->set_rules('memberid', 'memberid', 'trim|required');
				$this->form_validation->set_rules('subject', 'subject', 'trim|required');
				$this->form_validation->set_rules('message', 'message', 'trim|required');
				$this->form_validation->set_rules('status', 'status', 'trim|required');
				if($_FILES['userlogo']['tmp_name']!='')
					$this->form_validation->set_rules('userlogo', 'userlogo', 'trim|callback_validate_image');
				

 				if($this->form_validation->run() == true )
 				{
						
						$data = array(
							'MemberId'=>$this->input->post('memberid'),
							'Subject'=>$this->input->post('subject'),
							'Message'=>urlencode($this->input->post('message')),
							'Status'=>$this->input->post('status'),
							'DateAdded'=>date('Y-m-d H:i:s')
						);

						if($_FILES['userlogo']['tmp_name']!='')
						$data['UserLogo'] = $this->upload->data('file_name');
						
						$result = $this->common_model->SaveRecords($data,'arm_testimonial');
						$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
						redirect('admin/testimonial');
 				}

				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['members'] = $this->common_model->GetCustomers();
					$this->load->view('admin/addtestimonial',$this->data);
				}

				
			}
			else
			{
				
				$this->data['members'] = $this->common_model->GetCustomers();

				$this->load->view('admin/addtestimonial',$this->data);
				
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
		$condition = "TestimonialId =" . "'" . $id . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_testimonial');
		if($status) {
					$this->session->set_flashdata('success_message',$this->lang->line('successmessagedel'));
					redirect('admin/testimonial');
		}
		
	}


	public function edittestimonial($id)
	{
		
		
		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{

				$this->form_validation->set_rules('memberid', 'memberid', 'trim|required');
				$this->form_validation->set_rules('subject', 'subject', 'trim|required');
				$this->form_validation->set_rules('message', 'message', 'trim|required');
				$this->form_validation->set_rules('status', 'status', 'trim|required');
				if($_FILES['userlogo']['tmp_name']!='')
					$this->form_validation->set_rules('userlogo', 'userlogo', 'trim|callback_validate_image');
				

 				if($this->form_validation->run() == true )
 				{
 					
					$data = array(
						'MemberId'=>$this->input->post('memberid'),
						'Subject'=>$this->input->post('subject'),
						'Message'=>urlencode($this->input->post('message')),
						'Status'=>$this->input->post('status'),
						'DateAdded'=>date('Y-m-d H:i:s')
					);

					if($_FILES['userlogo']['tmp_name']!='')
						$data['UserLogo'] = $this->upload->data('file_name');
									
					$condition= "TestimonialId='".$id."'";
					$result = $this->common_model->UpdateRecord($data,$condition,'arm_testimonial');
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/testimonial');
 				
				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['fielddata']= $this->Testimonial_model->Getfielddata($id);
					$this->data['members'] = $this->common_model->GetCustomers();
					$this->load->view('admin/edittestimonial',$this->data);
				}

				
				
			}
			elseif($id!='')
			{
				
				$this->data['fielddata']= $this->Testimonial_model->Getfielddata($id);
				$this->data['members'] = $this->common_model->GetCustomers();

				$this->load->view('admin/edittestimonial',$this->data);
				// $this->load->view('admin/packagesetting');
			}
			else
			{
				
				redirect('admin/testimonial');
			}

		} 
		else
		{
			redirect('admin/login');

					
		}


	}


	public function enable($TestimonialId) {
		$condition = "TestimonialId =" . "'" . $TestimonialId . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_emailtemplate');
		if($status) {
			redirect('admin/testimonial');
		}
	}

	public function disable($TestimonialId) {
		$condition = "TestimonialId =" . "'" . $TestimonialId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_emailtemplate');
		if($status) {
			redirect('admin/testimonial');
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

	public function validate_image()
	{
		$config['upload_path'] = './uploads/testimonial/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userlogo')) {
			
			
			$this->session->set_flashdata('error_message', 'profile image extension invalid. '.$this->upload->display_errors());
			return false;
			
		} else {
			// return $data;
			return true;
		}
		
	}

} //class ends


