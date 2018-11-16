<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autorespond extends CI_Controller {



	public function __construct() {
		parent::__construct();
		
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {

			// Load database
			
			$this->load->model('admin/Autorespond_model');
			$this->lang->load('autorespond');
			$this->IsAdmin();
		}  else {
	    	redirect('admin/login');
	    }
		
	} //function ends

	protected function IsAdmin() {
		
		$userid = $this->session->userdata('MemberID');
		$userlevel = $this->session->userdata('UserLevel');
		if($userlevel==2) {
			$controller = $this->router->fetch_class();
			$access_list_data = $this->common_model->Subadminaccess($userid,$userlevel);
			
			$pages = json_decode($access_list_data->access_list);
			
			if(!in_array(ucfirst($controller), $pages)) {
				redirect('admin');		
			} 
		}
	}

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
						redirect('admin/autorespondlist');
					}
				}
			} else {
				$this->data['field'] = $this->Autorespond_model->Getfields();
				$this->load->view('admin/autorespondlist', $this->data['field']);
			}
	    } else {
	    	redirect('admin/login');
	    }
 		
	}


	public function addautorespond()
	{
		

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				
				$this->form_validation->set_rules('subject', 'subject', 'trim|required');
				$this->form_validation->set_rules('message', 'message', 'trim|required');
				$this->form_validation->set_rules('duration', 'duration', 'trim|required|numeric|integer');
				$this->form_validation->set_rules('limitation', 'limitation', 'trim|required|numeric|integer');
				//$this->form_validation->set_rules('content', 'content', 'trim|required');
				$this->form_validation->set_rules('status', 'status', 'trim|required');

 				if($this->form_validation->run() == true )
 				{
 					
				$data = array(
					'Subject'=>$this->input->post('subject'),
					'Message'=>urlencode($this->input->post('message')),
					'Duration'=>$this->input->post('duration'),
					'Limitation'=>$this->input->post('limitation'),
					'Status'=>$this->input->post('status')/*,
					'ContentsHtml'=>mysql_escape_string(htmlentities($this->input->post('content')))*/);

				
				$result = $this->common_model->SaveRecords($data,'arm_autoresponder');
				
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/autorespond');
 				}

				else
				{

					

					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['register']= $this->Autorespond_model->getregister();
					$this->data['productdetail']= $this->Autorespond_model->Getproductdetail();

					
					$this->load->view('admin/addautorespond');
				}

				
			}
			else
			{
				$this->data['register']= $this->Autorespond_model->getregister();
				$this->data['productdetail']= $this->Autorespond_model->Getproductdetail();

				$this->load->view('admin/addautorespond',$this->data);
				
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
		$condition = "AutoRespondId =" . "'" . $id . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_autoresponder');
		if($status) {
			$this->session->set_flashdata('success_message',$this->lang->line('successdel'));

			redirect('admin/autorespond');
		}
		
	}


	public function editautorespond($id)
	{
		
		
		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				//print_r($this->input->post());
				

				$this->form_validation->set_rules('subject', 'subject', 'trim|required');
				$this->form_validation->set_rules('message', 'message', 'trim|required');
				$this->form_validation->set_rules('duration', 'duration', 'trim|required|numeric|integer');
				$this->form_validation->set_rules('limitation', 'limitation', 'trim|required|numeric|integer');
				//$this->form_validation->set_rules('content', 'content', 'trim|required');
				$this->form_validation->set_rules('status', 'status', 'trim|required');


 				if($this->form_validation->run() == true)
 				{

				$data = array(
					'Subject'=>$this->input->post('subject'),
					'Message'=>urlencode($this->input->post('message')),
					'Duration'=>$this->input->post('duration'),
					'Limitation'=>$this->input->post('limitation'),
					'Status'=>$this->input->post('status')/*,
					'ContentsHtml'=>htmlspecialchars($this->input->post('content'))*/);

				
					$condition= "AutoRespondId='".$id."'";
					$result = $this->common_model->UpdateRecord($data,$condition,'arm_autoresponder');
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/autorespond');
 				
				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					
					$this->data['fielddata']= $this->Autorespond_model->Getfielddata($id);

					$this->load->view('admin/editautorespond',$this->data);
				}

				
				
			}
			elseif($id!='')
			{
				
				$this->data['fielddata']= $this->Autorespond_model->Getfielddata($id);
				
				$this->load->view('admin/editautorespond',$this->data);
				// $this->load->view('admin/packagesetting');
			}
			else
			{
				
				redirect('admin/autorespond');
			}

		} 
		else
		{
			redirect('admin/login');

					
		}


		}


public function enable($AutoRespondId) {
		$condition = "AutoRespondId =" . "'" . $AutoRespondId . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_autoresponder');
		if($status) {
			redirect('admin/autorespond');
		}
	}

	public function disable($AutoRespondId) {
		$condition = "AutoRespondId =" . "'" . $AutoRespondId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_autoresponder');
		if($status) {
			redirect('admin/autorespond');
		}
	}

	public function active($RequireId) {
		$condition = "RequireId =" . "'" . $RequireId . "'";

		$data = array(
			'ReuireFieldStatus' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_requirefields');
		if($status) {
			redirect('admin/autorespond');
		}
	}

	public function inactive($RequireId) {
		$condition = "RequireId =" . "'" . $RequireId . "'";

		$data = array(
			'ReuireFieldStatus' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_requirefields');
		if($status) {
			redirect('admin/autorespond');
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


