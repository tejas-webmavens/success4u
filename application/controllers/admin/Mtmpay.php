<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtmpay extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {

		//$this->load->helper('url');

		// Load form helper library
		//$this->load->helper('form');
		
		// Load database
		$this->load->model('MemberCommission_model');
		
		$this->load->model('Memberboardprocess_model');

		
		
		// change language
		//$this->config->set_item('language', 'spanish');

		// load language
		$this->lang->load('mtmadmin');
	}
	else
	{
		redirect('admin');
	}

	}

	public function index()
	{
	   
 		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
			
			// $condition = '';
			// $tableName = 'arm_history';
			
				$cdetail=$this->common_model->GetRow("Status='1'",'arm_currency');
			
				$this->data['members'] = $this->common_model->GetCustomers();
				$this->data['CurrencySymbol'] =$cdetail->CurrencySymbol;
				$condition = "MemberStatus='0' AND AdminStatus='0'";
			$this->data['transactions'] = $this->common_model->GetResults($condition,'arm_memberpayment','*');
			
			
			$this->load->view('admin/mtmpay',$this->data);
	    } else {
	    	redirect('admin/login');

	    }	
	}

	public function search(){
		
		if($this->input->post()) 
		{
			//print_r($this->input->post());

			$condition = "Status= '0'";

			
			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(DateAdded) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";
			else if($this->input->post('datepicker1'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "'";
			else if($this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) <=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker2'))) . "'";

			if($this->input->post('member'))
				$condition .= " AND MemberId =" . "'" . $this->input->post('member') . "' OR ReceiveBy =" . "'" . $this->input->post('member') . "'";

			
			$cdetail=$this->common_model->GetRow("Status='1'",'arm_currency');
			$this->data['members'] = $this->common_model->GetCustomers();	
			$this->data['CurrencySymbol'] =$cdetail->CurrencySymbol;
			$this->data['transactions'] = $this->common_model->GetResults($condition,'arm_memberpayment','*');

			// $this->data['transactions'] = $this->common_model->GetResults($condition, 'arm_history', '*');
			//print_r($this->data['transactions']);exit;
			$this->load->view('admin/mtmpay', $this->data);
			
		} else {
			//$this->session->set_flashdata('error_message', 'Enter field value to search');
			redirect('admin/mtmpay');
		}
	}

	
	
	public function delete($Id) {
		$condition = "Payid =" . "'" . $Id . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_memberpayment');

		if($status) {
			$this->session->set_flashdata('success_message',$this->lang->line('successmessagedel'));
			redirect('admin/mtmpay');
		} else {
			$this->session->set_flashdata('error_message', $this->lang->line('errormessagedel'));
			redirect('admin/mtmpay');
		}
		
	}

	public function accept($id='')
	{
		if($id!='')
		{
			$decdet = $this->common_model->GetRow("Payid='".$id."'","arm_memberpayment");
			if($decdet->AdminStatus=='0' && $decdet->MemberStatus=='1' )
			{
				$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
				if($mlsetting->Id==6 && $mlsetting->MTMPayStatus=='1')
				$this->Memberboardprocess_model->process($decdet->MemberId);
			
				$this->session->set_flashdata('success_message',$this->lang->line('successmessageaccept'));
				$data = array("AdminStatus"=>"1","MemberStatus"=>"1");
				$data1 = array("SubscriptionsStatus"=>"Active");
				$this->common_model->UpdateRecord($data1,"MemberId='".$decdet->MemberId."'","arm_members");
				$this->common_model->UpdateRecord($data,"Payid='".$id."'","arm_memberpayment");
			}
			elseif($decdet->MemberStatus=='0' && $decdet->AdminStatus=='0')
			{
				$this->session->set_flashdata('success_message',$this->lang->line('successmessageaccept'));
				$data = array("AdminStatus"=>"1","MemberStatus"=>"1");
				$data1 = array("SubscriptionsStatus"=>"Active");
				$this->common_model->UpdateRecord($data1,"MemberId='".$decdet->MemberId."'","arm_members");
				$this->common_model->UpdateRecord($data,"Payid='".$id."'","arm_memberpayment");
			}
			$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			if($mlsetting->Id==8 && $decdet->EntryFor=='MTAU')
			{

                             
			}else{
				$field = "MemberId";
				$memberid = $decdet->MemberId;
				if($mlsetting->Id==1)
				{
					$table = "arm_forcedmatrix";
					$this->Memberboardprocess_model->setforcematrix($memberid,$table);
				}
				else if($mlsetting->Id==2)
				{
					$table = "arm_unilevelmatrix";
					$this->Memberboardprocess_model->setunilevelmatrix($memberid,$table);
				}
				else if($mlsetting->Id==3)
				{
					$table = "arm_monolinematrix";
					$field = "MonoLineId";
					$this->Memberboardprocess_model->setmonolinematrix($memberid,$table);
				}
				else if($mlsetting->Id==4)
				{
					$table = "arm_binarymatrix";
					$this->Memberboardprocess_model->binarymatrix($memberid,$table);
				}
				else if($mlsetting->Id==5)
				{
					$table = "arm_boardmatrix";
					$this->Memberboardprocess_model->setboardmatrix($memberid,$table);
				}
				else if($mlsetting->Id==6)
				{
					$table = "arm_xupmatrix";
					$this->Memberboardprocess_model->setxupmatrix($memberid,$table);
				}
				else if($mlsetting->Id==7)
				{
					$table = "arm_oddevenmatrix";
					$this->Memberboardprocess_model->setoddevenmatrix($memberid,$table);
				}
				else if($mlsetting->Id==8)
				{
					$table = "arm_boardmatrix1";
					$this->Memberboardprocess_model->setboardmatrix1($memberid,$table);
				}
						$this->Memberboardprocess_model->Totaldowncount();
				

							// $this->Memberboardprocess_model->process($memberid);
				$this->MemberCommission_model->process($memberid,$table,$field);
			}

			redirect("admin/mtmpay");
		}
		else
		{
			$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
			redirect("admin/mtmpay");
			exit;
		}

	}

	
	public function decline($id='')
	{

		if($id!='')
		{

			$decdet = $this->common_model->GetRow("Payid='".$id."'","arm_memberpayment");
			
			if($decdet->AdminStatus	==0)
			{
				$data = array("AdminStatus"=>"2","MemberStatus"=>"2");
				$dd = $this->common_model->UpdateRecord($data,"Payid='".$id."'","arm_memberpayment");
				if($dd)
				$this->session->set_flashdata('success_message',$this->lang->line('successmessagedecline'));
			}
			
			redirect("admin/mtmpay");
		}
		else
		{
			$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
			redirect("admin/mtmpay");
			exit;
		}

	}

	


}
