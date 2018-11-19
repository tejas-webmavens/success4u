<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packagesetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/Packagesetting_model');
		$this->lang->load('packagesetting');
		
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
						redirect('admin/packagelist');
					}
				}
			} else {
				$this->data['field'] = $this->Packagesetting_model->Getfields();
				$this->load->view('admin/packagelist', $this->data['field']);
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
				

				  $lvlcommissions = implode(",", $this->input->post('levelcommission'));
				  $prtlvlcommissions = implode(",", $this->input->post('productlevelcommission'));

				 	$lvlchecks = str_replace(",", "", $lvlcommissions);
				 	$prtlvlchecks = str_replace(",", "", $prtlvlcommissions);
				 
				
				$this->form_validation->set_rules('packagename', 'packagename', 'trim|required');
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

 				$this->form_validation->set_rules('levelcommission', 'levelcommission', 'trim|xss_clean|callback_lvlcommission_check['.$lvlchecks.']');
 				$this->form_validation->set_rules('productlevelcommission', 'productlevelcommission', 'trim|xss_clean|callback_prtlvlcommission_check['.$prtlvlchecks.']');
 				

 				if($this->form_validation->run() == true )
 				{

 					$scondition = "ProductName='".$this->input->post('product')."'";
 					$productdetail  =$this->common_model->GetRow($scondition,'arm_product', 'ProductId');
 					
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
					'ProductId'=>$productdetail->ProductId,
					'ProductName'=>$this->input->post('product'),
					'OwnCommission'=>$this->input->post('owncommission'),
					'LevelCompletedCommission'=>$this->input->post('levelcompletedcommission'),
					'MatrixCompletionCommission'=>$this->input->post('matrixcompletedcommission'),
					'LevelCommissions'=>$lvlcommissions,
					'ProductLevelCommissions'=>$prtlvlcommissions);

				
				$result = $this->common_model->SaveRecords($data,'arm_package');
				
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/packagesetting');
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
					$this->data['register']= $this->Packagesetting_model->getregister();
					$this->data['productdetail']= $this->Packagesetting_model->Getproductdetail();

					//redirect('admin/packagesetting/addfield');
					$this->load->view('admin/addpackagefield');
				}

				
			}
			else
			{
				$this->data['register']= $this->Packagesetting_model->getregister();
				$this->data['productdetail']= $this->Packagesetting_model->Getproductdetail();

				$this->load->view('admin/addpackagefield',$this->data);
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
		$status = $this->common_model->DeleteRecord($condition, 'arm_package');
		if($status) {
			redirect('admin/packagesetting');
		}
		
	}


	public function editfield($id)
	{
		
		
		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
			
				$lvlcommission = implode(",", $this->input->post('levelcommission'));
				$prtlvlcommission = implode(",", $this->input->post('productlevelcommission'));

				 $lvlcheck = str_replace(",", "", $lvlcommission);
				 $prtlvlcheck = str_replace(",", "", $prtlvlcommission);
				 

				
				$this->form_validation->set_rules('packagename', 'packagename', 'trim|required');
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

 					$scondition = "ProductName='".$this->input->post('product')."'";
 					$productdetail  =$this->common_model->GetRow($scondition,'arm_product', 'ProductId');
 				
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
					'ProductId'=>$productdetail->ProductId,
					'ProductName'=>$this->input->post('product'),
					'OwnCommission'=>$this->input->post('owncommission'),
					'LevelCompletedCommission'=>$this->input->post('levelcompletedcommission'),
					'MatrixCompletionCommission'=>$this->input->post('matrixcompletedcommission'),
					'LevelCommissions'=>$lvlcommission,
					'ProductLevelCommissions'=>$prtlvlcommission);

				
					$condition= "packageId='".$id."'";
					$result = $this->common_model->UpdateRecord($data,$condition,'arm_package');
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/packagesetting');
 				
				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['productdetail']= $this->Packagesetting_model->Getproductdetail();
					$this->data['fielddata']= $this->Packagesetting_model->Getfielddata($id);

					//redirect('admin/packagesetting/editfield');
					$this->load->view('admin/editpackagefield',$this->data);
				}

				
				
			}
			else
			{
				
				$this->data['fielddata']= $this->Packagesetting_model->Getfielddata($id);
				$this->data['productdetail']= $this->Packagesetting_model->Getproductdetail();
				$this->load->view('admin/editpackagefield',$this->data);
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

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_package');
		if($status) {
			redirect('admin/packagesetting');
		}
	}

	public function disable($PackageId) {
		$condition = "PackageId =" . "'" . $PackageId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_package');
		if($status) {
			redirect('admin/packagesetting');
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


