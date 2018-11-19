<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pvsetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/Pvsetting_model');
		$this->lang->load('pvsetting');
		
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
						redirect('admin/pvlist');
					}
				}
			} else {
				$this->data['field'] = $this->Pvsetting_model->Getfields();
				$this->load->view('admin/pvlist', $this->data['field']);
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

				$matchingbonus = implode(",", $this->input->post('matchingbonus'));
				$prtlvlcommissions = implode(",", $this->input->post('productlevelcommission'));
				$lvlpv = implode(",", $this->input->post('pv'));

			 	$matchchecks = str_replace(",", "", $matchingbonus);
			 	$prtlvlchecks = str_replace(",", "", $prtlvlcommissions);
			 	$pvlvlchecks = str_replace(",", "", $lvlpv);
				 
				
				$this->form_validation->set_rules('packagename', 'packagename', 'trim|required|alpha');
				$this->form_validation->set_rules('packagefee', 'packagefee', 'trim|required|numeric');
				$this->form_validation->set_rules('owncommission', 'owncommission', 'trim|required|numeric');
				$this->form_validation->set_rules('directcommission', 'directcommission', 'trim|required|numeric');
				$this->form_validation->set_rules('paircommission', 'paircommission', 'trim|required|numeric');
				$this->form_validation->set_rules('dailymaximumpv', 'dailymaximumpv', 'trim|required|numeric');
				$this->form_validation->set_rules('dailymaximumpairs', 'dailymaximumpairs', 'trim|required|integer');
				$this->form_validation->set_rules('paircommissionstatus', 'paircommissionstatus', 'trim|required');
				$this->form_validation->set_rules('paircommissiontype', 'paircommissiontype', 'trim|required');
				/*$this->form_validation->set_rules('lpair', 'leftpair', 'trim|required|integer');
				$this->form_validation->set_rules('rpair', 'rightpair', 'trim|required|integer');*/

 				$this->form_validation->set_rules('matchingbonus', 'matchingbonus', 'trim|xss_clean|callback_matchingbonus_check['.$matchchecks.']');
 				$this->form_validation->set_rules('productlevelcommission', 'productlevelcommission', 'trim|xss_clean|callback_prtlvlcommission_check['.$prtlvlchecks.']');

 				if($this->form_validation->run() == true )
 				{
 					
					$data = array(
						'PackageName'=>$this->input->post('packagename'),
						'PackageFee'=>$this->input->post('packagefee'),
						'OwnCommission'=>$this->input->post('owncommission'),
						'DirectCommission'=>$this->input->post('directcommission'),
						'PairCommissionStatus'=>$this->input->post('paircommissionstatus'),
						'PairCommission'=>$this->input->post('paircommission'),
						'PairCommissionType'=>$this->input->post('paircommissiontype'),
						'DailyMaximumPv'=>$this->input->post('dailymaximumpv'),
						'DailyMaximumPairs'=>$this->input->post('dailymaximumpairs'),
						/*'MatchingPair'=>$this->input->post('lpair').":".$this->input->post('rpair'),*/
						'MatchingBonus'=>$matchingbonus,
						'ProductLevelCommissions'=>$prtlvlcommissions,
						'pv'=>$lvlpv
					);
				
					$result = $this->common_model->SaveRecords($data,'arm_pv');
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/pvsetting');
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
					$this->data['register']= $this->Pvsetting_model->getregister();
					$this->data['productdetail']= $this->Pvsetting_model->Getproductdetail();

					//redirect('admin/packagesetting/addfield');
					$this->load->view('admin/addpvfield');
				}

				
			}
			else
			{
				$this->data['register']= $this->Pvsetting_model->getregister();
				$this->data['productdetail']= $this->Pvsetting_model->Getproductdetail();

				$this->load->view('admin/addpvfield',$this->data);
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
		$status = $this->common_model->DeleteRecord($condition, 'arm_pv');
		if($status) {
			redirect('admin/pvsetting');
		}
		
	}


	public function editfield($id)
	{
		
		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
			
				$matchingbonus = implode(",", $this->input->post('matchingbonus'));
				$prtlvlcommissions = implode(",", $this->input->post('productlevelcommission'));
				$lvlpv = implode(",", $this->input->post('pv'));

			 	$matchchecks = str_replace(",", "", $matchingbonus);
			 	$prtlvlchecks = str_replace(",", "", $prtlvlcommissions);
			 	$pvlvlchecks = str_replace(",", "", $lvlpv);
				
				$this->form_validation->set_rules('packagename', 'packagename', 'trim|required|alpha');
				$this->form_validation->set_rules('packagefee', 'packagefee', 'trim|required|numeric');
				$this->form_validation->set_rules('owncommission', 'owncommission', 'trim|required|numeric');
				$this->form_validation->set_rules('directcommission', 'directcommission', 'trim|required|numeric');
				$this->form_validation->set_rules('paircommission', 'paircommission', 'trim|required|numeric');
				$this->form_validation->set_rules('dailymaximumpv', 'dailymaximumpv', 'trim|required|numeric');
				$this->form_validation->set_rules('dailymaximumpairs', 'dailymaximumpairs', 'trim|required|integer');
				$this->form_validation->set_rules('paircommissionstatus', 'paircommissionstatus', 'trim|required');
				$this->form_validation->set_rules('paircommissiontype', 'paircommissiontype', 'trim|required');
				/*$this->form_validation->set_rules('lpair', 'leftpair', 'trim|required|integer');
				$this->form_validation->set_rules('rpair', 'rightpair', 'trim|required|integer');*/

 				$this->form_validation->set_rules('matchingbonus', 'matchingbonus', 'trim|xss_clean|callback_matchingbonus_check['.$matchchecks.']');
 				$this->form_validation->set_rules('productlevelcommission', 'productlevelcommission', 'trim|xss_clean|callback_prtlvlcommission_check['.$prtlvlchecks.']');
 				
 				if($this->form_validation->run() == true)
 				{
 					
					$data = array(
						'PackageName'=>$this->input->post('packagename'),
						'PackageFee'=>$this->input->post('packagefee'),
						'OwnCommission'=>$this->input->post('owncommission'),
						'DirectCommission'=>$this->input->post('directcommission'),
						'PairCommissionStatus'=>$this->input->post('paircommissionstatus'),
						'PairCommission'=>$this->input->post('paircommission'),
						'PairCommissionType'=>$this->input->post('paircommissiontype'),
						'DailyMaximumPv'=>$this->input->post('dailymaximumpv'),
						'DailyMaximumPairs'=>$this->input->post('dailymaximumpairs'),
						/*'MatchingPair'=>$this->input->post('lpair').":".$this->input->post('rpair'),*/
						'MatchingBonus'=>$matchingbonus,
						'ProductLevelCommissions'=>$prtlvlcommissions,
						'pv'=>$lvlpv
					);
				
					$condition= "packageId='".$id."'";
					$result = $this->common_model->UpdateRecord($data,$condition,'arm_pv');
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/pvsetting');
 				
				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['productdetail']= $this->Pvsetting_model->Getproductdetail();
					$this->data['fielddata']= $this->Pvsetting_model->Getfielddata($id);

					//redirect('admin/packagesetting/editfield');
					$this->load->view('admin/editpvfield',$this->data);
				}
				
			}
			else
			{
				$this->data['fielddata']= $this->Pvsetting_model->Getfielddata($id);
				$this->data['productdetail']= $this->Pvsetting_model->Getproductdetail();
				$this->load->view('admin/editpvfield',$this->data);
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


	public function matchingbonus_check($str,$numbers)
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
			$this->form_validation->set_message('matchingbonus_check', '<p><em class="state-error1">The given matchingbonus field values are only in numbers</em></p>');
			return false;
		}
		
	}

	
	public function prtlvlcommission_check($str,$productlevelcommission)
	{
		
		
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


