<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends CI_Controller {

	public function __construct() {
		parent::__construct();
	if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->lang->load('withdraw');
		//$this->load->library('PaypalApi');
		
		}  
		else {
    	redirect('admin/login');
    	}
	} //function ends


	public function index()
	{

		if($this->session->userdata('logged_in')) {
			
			$condition="TypeId='7' order by HistoryId DESC";
			$this->data['field'] = $this->common_model->GetResults($condition,"arm_history");
			$this->load->view('admin/withdrawrequestlist', $this->data);
			
	    } else {
	    	redirect('admin/login');
	    	// $this->load->view('admin/login');
	    }
 		
	}


	public function searchrequest() {
		
		if($this->input->post()) 
		{

			$condition = "TypeId='7'";

			if($this->input->post('username'))
			{
				$user = $this->common_model->GetRow("UserName='".$this->input->post('username')."'","arm_members");
				
				if($user!='')
				$condition .= " AND MemberId ='" .$user->MemberId."'";

			}
			
			if($this->input->post('paythrough'))
				$condition .= " AND PayThrough LIKE" . "'%" . $this->input->post('paythrough') . "%'";
			

			if($this->input->post('transactionid'))
				$condition .= " AND transactionid LIKE" . "'%" . $this->input->post('transactionid') . "%'";
			
			
			

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(DateAdded) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";

			$this->data['field'] = $this->common_model->GetResults($condition,"arm_history");

			$this->load->view('admin/withdrawrequestlist', $this->data['field']);
			
		} else {
			$condition="TypeId='7' order by HistoryId DESC";
			$this->data['field'] = $this->common_model->GetResults($condition,"arm_history");
			$this->load->view('admin/withdrawrequestlist');
		}
	}

	public function paymentFilter() {

		if($this->input->post()) {
			if($this->input->post('paymentname'))
				$condition = "TypeId='7' AND PayThrough=" . "'" . $this->input->post('paymentname') . "'";
			$this->data['field'] = $this->common_model->GetResults($condition,"arm_history");
			
			if($this->data['field']){
				$payment_condition = "PaymentId='".$this->input->post('paymentname')."'";
				$payment_data = $this->common_model->GetRow($payment_condition, 'arm_paymentsetting');
				// echo $payment_data->PaymentName;
				$this->data['action'] = base_url()."payment/".$payment_data->PaymentName."/masspayouts";
				$this->load->view('admin/withdrawrequestlist', $this->data);
			}
			else 
				redirect('admin/withdraw');
		} else {
			redirect('admin/withdraw');
		}
	}

	public function changepaid()
	{
		if($this->session->userdata('logged_in')) {

			if($this->input->post('payouts')!='')
			{
				$payouts = $this->input->post('payouts');
				for($i=0;$i<count($payouts);$i++)
				{
					$data=array('TypeId'=>'8');
					$condition="HistoryId='".$payouts[$i]."'";

					$result = $this->common_model->UpdateRecord($data,$condition,"arm_history");
				}

			}
			redirect('admin/withdraw');
			
	    } else {
	    	redirect('admin/login');
	    	// $this->load->view('admin/login');
	    }

	}

	public function payonline($paymentid)
	{
		// echo $paymentid;
		$paypaldetail = $this->common_model->GetRow("PaymentId='".$paymentid."'","arm_paymentsetting");
		$payment_name = $paypaldetail->PaymentName;

		
		exit;
		if($this->session->userdata('logged_in')) {

			if($this->input->post('payouts')!='')
			{
				$payouts = $this->input->post('payouts');

				//get paypal 
				$paypaldetail = $this->common_model->GetRow("PaymentId='2'","arm_paymentsetting");
				
				$this->load->library('PaypalApi');
				$paypal = new PaypalApi($paypaldetail->PaymentMerchantApi,$paypaldetail->PaymentMerchantPassword, $paypaldetail->PaymentMerchantKey);
				
				/*$paypal = new PaypalApi();
				$paypal->start($paypaldetail->PaymentMerchantApi,$paypaldetail->PaymentMerchantPassword, $paypaldetail->PaymentMerchantKey);
					*/
						
				for($i=0;$i<count($payouts);$i++)
				{
					$paymentdetail = $this->common_model->GetRow("HistoryId='".$payouts[$i]."'","arm_history");


					//paypal start here paypal id = 2 , bitcoin = 5
						if($paymentdetail->paythrough==2)
						{

							$memberdetail = $this->common_model->GetCustomer($paymentdetail->MemberId);

							$membercustoms = json_decode($memberdetail->CustomFields);
						//require "include/Paypal_class.php"; 
		
	    				$send_payment = $paypal->pay($membercustoms->paypal, $paymentdetail->Debit, "You Withdraw request is payout");
						
						$result=0;
						if("SUCCESS" == strtoupper($send_payment["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($send_payment["ACK"])) 
						{
							
							$data=array('TypeId'=>'8');
							$condition="HistoryId='".$payouts[$i]."'";

							$result = $this->common_model->UpdateRecord($data,$condition,"arm_history");
						}
						
							if($result)
							{
								$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
							}
							else
							{
								print_r($send_payment);
								$this->session->set_flashdata('success_message',ucwords("payment error code ".$send_payment['L_ERRORCODE0']));
							}

						}
					//paypal end here
				}

			}
			
			redirect('admin/withdraw');
			
	    } else {
	    	redirect('admin/login');
	    	// $this->load->view('admin/login');
	    }

	}
	
	public function payouts()
	{
		if($this->session->userdata('logged_in')) 
		{
				
					$condition="TypeId='8' order by HistoryId DESC";
					$this->data['field'] = $this->common_model->GetResults($condition,"arm_history");
					$this->load->view('admin/payoutlist', $this->data);
	    } 
	    else 
	    {
		   	redirect('admin/login');
		}
	}

	
	public function searchpayout(){
		
		if($this->input->post()) 
		{

			$condition = "TypeId='8'";

			if($this->input->post('username'))
			{
				$user = $this->common_model->GetRow("UserName='".$this->input->post('username')."'","arm_members");
				
				if($user!='')
				$condition .= " AND MemberId ='" .$user->MemberId."'";

			}
			
			if($this->input->post('paythrough'))
				$condition .= " AND PayThrough LIKE" . "'%" . $this->input->post('paythrough') . "%'";
			

			if($this->input->post('transactionid'))
				$condition .= " AND transactionid LIKE" . "'%" . $this->input->post('transactionid') . "%'";
			
			
			

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(DateAdded) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";

			$this->data['field'] = $this->common_model->GetResults($condition,"arm_history");

			$this->load->view('admin/payoutlist', $this->data['field']);
			
		} else {
			$condition="TypeId='8' order by HistoryId DESC";
			$this->data['field'] = $this->common_model->GetResults($condition,"arm_history");
			$this->load->view('admin/payoutlist');
		}
	}

		

} //class ends


