<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boardplansetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/Boardplansetting_model');
		$this->lang->load('boardplansetting');
		
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
						//$status = $this->Pvsetting_model->DeletePackage($package_id);
					}
					
					if($status) {
						redirect('admin/boardplansetting');
					}
				}
			} else {
				$this->data['field'] = $this->Boardplansetting_model->Getfields();
				$this->load->view('admin/boardplanlist', $this->data['field']);
			}
	    } else {
	    	redirect('admin/login');
	    	// $this->load->view('admin/login');
	    }
 		
	}


	public function addboardplan()
	{
		

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				

				$levelcommission = implode(",", $this->input->post('levelcommission'));
				$prtlvlcommissions = implode(",", $this->input->post('productlevelcommission'));
				$upgradecommission = implode(",", $this->input->post('upgradecommission'));

				 	$lvlchecks = str_replace(",", "", $levelcommission);
				 	$prtlvlchecks = str_replace(",", "", $prtlvlcommissions);
				 	$upgradechecks = str_replace(",", "", $upgradecommission);
				 
				
				$this->form_validation->set_rules('packagename', 'packagename', 'trim|required|alpha_numeric');
				$this->form_validation->set_rules('packagefee', 'packagefee', 'trim|required|numeric');
				$this->form_validation->set_rules('owncommission', 'owncommission', 'trim|required|numeric');
				$this->form_validation->set_rules('directcommission', 'directcommission', 'trim|required|numeric');
				$this->form_validation->set_rules('boardcommission', 'boardcommission', 'trim|required|numeric');
				$this->form_validation->set_rules('followsponsor', 'followsponsor', 'trim|required');
				$this->form_validation->set_rules('reentrystatus', 'reentrystatus', 'trim|required');
				$this->form_validation->set_rules('reentrynextstatus', 'reentrynextstatus', 'trim|required');
				$this->form_validation->set_rules('nextbaordplan', 'nextbaordplan', 'trim|required');
				$this->form_validation->set_rules('boarddepth', 'boarddepth', 'trim|required|integer');
				$this->form_validation->set_rules('boardwidth', 'boardwidth', 'trim|required|integer');
				/*$this->form_validation->set_rules('lpair', 'leftpair', 'trim|required|integer');
				$this->form_validation->set_rules('rpair', 'rightpair', 'trim|required|integer');*/

 				$this->form_validation->set_rules('levelcommission', 'levelcommission', 'trim|xss_clean|callback_levelcommission_check['.$lvlchecks.']');
 				$this->form_validation->set_rules('productlevelcommission', 'productlevelcommission', 'trim|xss_clean|callback_prtlvlcommission_check['.$prtlvlchecks.']');
 				$this->form_validation->set_rules('upgradecommission', 'upgradecommission', 'trim|xss_clean|callback_upgradecommission_check['.$upgradechecks.']');
 				

 				if($this->form_validation->run() == true )
 				{
 					
				$data = array(
					'PackageName'=>$this->input->post('packagename'),
					'PackageFee'=>$this->input->post('packagefee'),
					'BoardWidth'=>$this->input->post('boardwidth'),
					'BoardDepth'=>$this->input->post('boarddepth'),
					'OwnCommission'=>$this->input->post('owncommission'),
					'DirectCommission'=>$this->input->post('directcommission'),
					'BoardCommission'=>$this->input->post('boardcommission'),
					'FollowSponsor'=>$this->input->post('followsponsor'),
					'ReentryBoardStatus'=>$this->input->post('reentrystatus'),
					'ReentryNextBoardStatus'=>$this->input->post('reentrynextstatus'),
					'ReentryNextBoard'=>$this->input->post('nextbaordplan'),
					'Status'=>$this->input->post('status'),
					/*'MatchingPair'=>$this->input->post('lpair').":".$this->input->post('rpair'),*/
					'LevelCommission'=>$levelcommission,
					'upgradelevel'=>$upgradecommission,
					'ProductLevelCommission'=>$prtlvlcommissions);

				
				$result = $this->common_model->SaveRecords($data,'arm_boardplan');
				
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/boardplansetting');
 				}

				else
				{

					/*if($lvlcheck!=1)
					{
						form_error('levelcommission','The given levelcommission field values are only in numbers');
						$this->form_validation->set_message('levelcommission','The given levelcommission field values are only in numbers');
					} 
					if($prtlvlcheck!=1)
					{
						form_error('levelcommission','The given productlevelcommission field values are only in numbers');
						$this->form_validation->set_message('productlevelcommission','The given levelcommission field values are only in numbers');

					}*/


					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['register']= $this->Boardplansetting_model->getregister();
					$this->data['boarddetail']= $this->Boardplansetting_model->Getboarddetail();

					//redirect('admin/packagesetting/addfield');
					$this->load->view('admin/addboardplan');
				}

				
			}
			else
			{
				$this->data['register']= $this->Boardplansetting_model->getregister();
				$this->data['boarddetail']= $this->Boardplansetting_model->Getboarddetail();
				
				$this->load->view('admin/addboardplan',$this->data);
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
		$condition = "PackageId =" . "'" . $id . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_boardplan');
		if($status) {
			redirect('admin/boardplansetting');
		}
		
	}


	public function editboardplan($id)
	{
		
		
		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
			
				$levelcommission = implode(",", $this->input->post('levelcommission'));
				$prtlvlcommissions = implode(",", $this->input->post('productlevelcommission'));
				$upgradecommission = implode(",", $this->input->post('upgradecommission'));


				 	$lvlchecks = str_replace(",", "", $levelcommission);
				 	$prtlvlchecks = str_replace(",", "", $prtlvlcommissions);
				 	$upgradechecks = str_replace(",", "", $upgradecommission);

				 
				
				$this->form_validation->set_rules('packagename', 'packagename', 'trim|required|alpha_numeric');
				$this->form_validation->set_rules('packagefee', 'packagefee', 'trim|required|numeric');
				$this->form_validation->set_rules('owncommission', 'owncommission', 'trim|required|numeric');
				$this->form_validation->set_rules('directcommission', 'directcommission', 'trim|required|numeric');
				$this->form_validation->set_rules('boardcommission', 'boardcommission', 'trim|required|numeric');
				$this->form_validation->set_rules('followsponsor', 'followsponsor', 'trim|required');
				$this->form_validation->set_rules('reentrystatus', 'reentrystatus', 'trim|required');
				$this->form_validation->set_rules('reentrynextstatus', 'reentrynextstatus', 'trim|required');
				$this->form_validation->set_rules('nextbaordplan', 'nextbaordplan', 'trim|required');
				$this->form_validation->set_rules('boarddepth', 'boarddepth', 'trim|required|integer');
				$this->form_validation->set_rules('boardwidth', 'boardwidth', 'trim|required|integer');
				/*$this->form_validation->set_rules('lpair', 'leftpair', 'trim|required|integer');
				$this->form_validation->set_rules('rpair', 'rightpair', 'trim|required|integer');*/

 				$this->form_validation->set_rules('levelcommission', 'levelcommission', 'trim|xss_clean|callback_levelcommission_check['.$lvlchecks.']');
 				$this->form_validation->set_rules('productlevelcommission', 'productlevelcommission', 'trim|xss_clean|callback_prtlvlcommission_check['.$prtlvlchecks.']');
 				$this->form_validation->set_rules('upgradecommission', 'upgradecommission', 'trim|xss_clean|callback_upgradecommission_check['.$upgradechecks.']');
 				

 				if($this->form_validation->run() == true)
 				{	

 					
				$data = array(
					'PackageName'=>$this->input->post('packagename'),
					'PackageFee'=>$this->input->post('packagefee'),
					'BoardWidth'=>$this->input->post('boardwidth'),
					'BoardDepth'=>$this->input->post('boarddepth'),
					'OwnCommission'=>$this->input->post('owncommission'),
					'DirectCommission'=>$this->input->post('directcommission'),
					'BoardCommission'=>$this->input->post('boardcommission'),
					'FollowSponsor'=>$this->input->post('followsponsor'),
					'ReentryBoardStatus'=>$this->input->post('reentrystatus'),
					'ReentryNextBoardStatus'=>$this->input->post('reentrynextstatus'),
					'ReentryNextBoard'=>$this->input->post('nextbaordplan'),
					'Status'=>$this->input->post('status'),
					/*'MatchingPair'=>$this->input->post('lpair').":".$this->input->post('rpair'),*/
					'LevelCommission'=>$levelcommission,
					'upgradelevel'=>$upgradecommission,
					'ProductLevelCommission'=>$prtlvlcommissions);

				
					$condition= "packageId='".$id."'";
					$result = $this->common_model->UpdateRecord($data,$condition,'arm_boardplan');
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/boardplansetting');
 				
				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['boarddetail']= $this->Boardplansetting_model->Getboarddetail();
					$this->data['fielddata']= $this->Boardplansetting_model->Getfielddata($id);

					//redirect('admin/packagesetting/editfield');
					$this->load->view('admin/editboardplan',$this->data);
				}

				
				
			}
			else
			{
				
				$this->data['fielddata']= $this->Boardplansetting_model->Getfielddata($id);
				$this->data['boarddetail']= $this->Boardplansetting_model->Getboarddetail();
				
				$this->load->view('admin/editboardplan',$this->data);
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
			redirect('admin/boardplansetting');
		}
	}

	public function disable($PackageId) {
		$condition = "PackageId =" . "'" . $PackageId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_pv');
		if($status) {
			redirect('admin/boardplansetting');
		}
	}


	public function levelcommission_check($str,$numbers)
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
			
			$this->form_validation->set_message('levelcommission_check', '<p><em class="state-error1">The given level commission  field values are only in numbers</em></p>');
			return false;
		}
		
	}
    

    public function upgradecommission_check($str,$numbers)
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
			
			$this->form_validation->set_message('upgradecommission_check', '<p><em class="state-error1">The given upgrade commission  field values are only in numbers</em></p>');
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


