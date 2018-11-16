<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ranksetting extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
			// Load database
			
			$this->load->model('admin/Ranksetting_model');
			$this->lang->load('rank');
		
		}  else {
	    	redirect('admin/login');
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
				} 
				else {

					foreach ($this->input->post('inputname') as $customer_id) {
						print_r($this->input->post());
						//$status = $this->Pvsetting_model->DeletePackage($package_id);
					}
					
					if($status) {
						redirect('admin/pvlist');
					}
				}
			} else {
				$this->data['field'] = $this->Ranksetting_model->Getcareer();
				print_r($this->data['field']);
				$this->load->view('admin/rank', $this->data['field']);
			}
	    } else {
	    	redirect('admin/login');
	    	// $this->load->view('admin/login');
	    }
	}


	public function addfield()
	{
		

		if($this->session->userdata('logged_in')) 
		{
			
			   
			if($this->input->post())
			{
				// print_r($this->input->post());
				$dats=$this->input->post();
				// print_r($dats);
				// exit;
			
				// $this->form_validation->set_rules('downlinemembercount', 'downlinemembercount', 'trim|numberic');
				// $this->form_validation->set_rules('referalcount', 'referalcount', 'trim|numeric');
				// $this->form_validation->set_rules('targetbalance', 'targetbalance', 'trim|numeric');
				// $this->form_validation->set_rules('rank','rank','trim|alphanumeric');


			
 			// 	if($this->form_validation->run() == true)
 			// 	{
	 				$membercount=$this->input->post('downlinemembercount');
					$refer=$this->input->post('referalcount');
					$target=$this->input->post('targetbalance');
				  	if($membercount=="" && $refer=="" && $target=="")

					{
						$this->session->set_flashdata('error_message',"Pls add Any One Field required for to set rank");
						$this->load->view('admin/addrank');

					}
					else
					{
						$data = array(
						'Membercount'=>$this->input->post('downlinemembercount'),
						'ReferalCount'=>$this->input->post('referalcount'),
						'balanceAmount'=>$this->input->post('targetbalance'),
						'Rank'=>$this->input->post('rank'),
						'Status'=>$this->input->post('status')
						
					);
					
					
				
					$result = $this->common_model->SaveRecords($data,'arm_ranksetting');
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/ranksetting');

					}

 					
						
 			// 	}

				// else
				// {

				// 	$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
				// 	$this->load->view('admin/addrank');
				// }

				
			}
			else
			{
				
				$this->load->view('admin/addrank');
			
			} 
		}
		else
		{
			redirect('admin/login');
		}
 		

	}
	//function ends

	public function delete($id) 
	{
		$condition = "rank_id =" . "'" . $id . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_ranksetting');
		if($status) {
			redirect('admin/ranksetting');
		}
		
	}


	public function editfield($id)
	{
		// echo $id;
		
		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
			
				
				
				// $this->form_validation->set_rules('rewardrank', 'rewardrank', 'trim|required');
				// $this->form_validation->set_rules('rewardpoint', 'rewardpoint', 'trim|required|numeric');
				// $this->form_validation->set_rules('reward', 'reward', 'trim|required');

				
				

 			// 	if($this->form_validation->run() == true)
 			// 	{
 				  $membercount=$this->input->post('downlinemembercount');
					$refer=$this->input->post('referalcount');
					$target=$this->input->post('targetbalance');
				  	if($membercount=="" && $refer=="" && $target=="")

					{
						$this->session->set_flashdata('error_message',"Pls add Any One Field required for to set rank");
						$this->load->view('admin/addrank');

					}
					else
					{
 					
					$data = array(
						'Membercount'=>$this->input->post('downlinemembercount'),
						'ReferalCount'=>$this->input->post('referalcount'),
						'balanceAmount'=>$this->input->post('targetbalance'),
						'Rank'=>$this->input->post('rank'),
						'Status'=>$this->input->post('status')
						
					);
				
					$condition= "rank_id='".$id."'";
					$result = $this->common_model->UpdateRecord($data,$condition,'arm_ranksetting');
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/ranksetting');
				  }
 				
				// }
				// else
				// {
				// 	$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					
				// 	$this->data['fielddata']= $this->Ranksetting_model->Getcareerdata($id);
					
				// 	$this->load->view('admin/editrank',$this->data);
				// }
				
			}
			else
			{
				$this->data['fielddata']= $this->Ranksetting_model->Getcareerdata($id);
				
				$this->load->view('admin/editrank',$this->data);
				// $this->load->view('admin/packagesetting');
			}

		} 
		else
		{
			redirect('admin/login');
		}

 		//header("Refresh:5;url=".base_url()."index.php/welcome");

	}


	public function enable($PackageId) {
		$condition = "PackageId =" . "'" . $PackageId . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_pv');
		if($status) {
			redirect('admin/pvsetting');
		}
	}

	public function disable($PackageId) {
		$condition = "PackageId =" . "'" . $PackageId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_pv');
		if($status) {
			redirect('admin/pvsetting');
		}
	}


	public function active($rank_id) {
		$condition = "rank_id =" . "'" . $rank_id . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_ranksetting');
		if($status) {
			redirect('admin/ranksetting');
		}
	}

	public function inactive($rank_id) {
		$condition = "rank_id =" . "'" . $rank_id . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_ranksetting');
		if($status) {
			redirect('admin/ranksetting');
		}
	}


	

} //class ends


