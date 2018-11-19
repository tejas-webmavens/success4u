<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {

			//$this->load->helper('url');

			// Load form helper library
			//$this->load->helper('form');
			
			// Load database
			
			$this->load->model('order_model');
			$this->load->model('product_model');
			$this->load->model('admin/income_model');
			$this->load->model('admin/Epin_model');
			
			// change language
			//$this->config->set_item('language', 'spanish');

			// load language
			$this->lang->load('customers');
			$this->lang->load('orders');
			$this->lang->load('withdraw');
			$this->lang->load('epin');
			$this->lang->load('report');

	 	} else {
	    	redirect('admin/login');

	    }

	}

	public function index()
	{

		$this->data['customers'] = $this->common_model->GetCustomers();
		// $this->load->view('admin/customers', $this->data['customers']);
		
		$this->load->view('admin/report/customers',$this->data);
	   	
	}

	public function customers(){
		$this->data['customers'] = $this->common_model->GetCustomers();
		$this->load->view('admin/report/customers',$this->data);
	}
	public function customersSearch() {

		if($this->input->post()) 
		{
			$condition = "isDelete= '0'";

			if($this->input->post('firstname'))
				$condition .= " AND FirstName LIKE" . "'%" . $this->input->post('firstname') . "%'";

			if($this->input->post('username'))
				 $condition .= " AND UserName LIKE" . "'%" . $this->input->post('username') . "%'";

			if($this->input->post('email'))
				$condition .= " AND Email LIKE" . "'%" . $this->input->post('email') . "%'";

			if($this->input->post('status'))
				$condition .= " AND MemberStatus =" . "'" . $this->input->post('status') . "'";

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(DateAdded) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";
			else if($this->input->post('datepicker1'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "'";
			else if($this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) <=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker2'))) . "'";

			$this->data['customers'] = $this->common_model->GetResults($condition, 'arm_members');
			$this->load->view('admin/report/customers', $this->data);

		} else {
			redirect('admin/report/customers');
		}
	}

	public function sales() {

		$this->data['orders'] = $this->order_model->GetOrders();
		$this->data['category'] = $this->product_model->GetCategory();
		$this->load->view('admin/report/orders',$this->data);
	}

	public function salesSearch() {

		if($this->input->post()) {
			$condition = "isDelete='0'";

			if($this->input->post('username'))
				$condition .= " AND FirstName LIKE" . "'%" . $this->input->post('username') . "%'";

			if($this->input->post('payment_mode'))
				$condition .= " AND PaymentMethod =" . "'" . $this->input->post('payment_mode') . "'"; 

			if($this->input->post('total'))
				$condition .= " AND OrderTotal =" . "'" . $this->input->post('total') . "'";

			if($this->input->post('status'))
				$condition .= " AND Status =" . "'" . $this->input->post('status') . "'";

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(DateAdded) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";
			else if($this->input->post('datepicker1'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "'";
			else if($this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) <=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker2'))) . "'";

			$this->data['category'] = $this->product_model->GetCategory();
			$this->data['products'] = $this->common_model->GetResults($condition, 'arm_order');
			
			$this->data['orders'] = $this->order_model->GetOrdersList($condition);
			
			$this->load->view('admin/report/orders', $this->data);
			
		} else {
			redirect('admin/report/orders');
		}
	}

	public function payout() {
		$condition="TypeId='8' order by HistoryId DESC";
		$this->data['field'] = $this->common_model->GetResults($condition,"arm_history");
		$this->load->view('admin/report/payouts', $this->data);
	}

	public function payoutSearch() {
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
			$this->load->view('admin/report/payouts', $this->data['field']);
			
		} else {
			redirect('admin/report/payouts');
		}
	}

	public function commission() {
		$condition="TypeId='4' order by HistoryId DESC";
		$this->data['field'] = $this->common_model->GetResults($condition,"arm_history");
		$this->load->view('admin/report/commission', $this->data);
	}

	public function commissionSearch() {
		if($this->input->post()) 
		{

			$condition = "TypeId='4'";
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
			$this->load->view('admin/report/commission', $this->data['field']);
			
		} else {
			redirect('admin/report/commission');
		}
	}

	public function reward() {
		$condition="TypeId='4' AND Description LIKE '%Reward%' order by HistoryId DESC";
		$this->data['field'] = $this->common_model->GetResults($condition,"arm_history");
		$this->load->view('admin/report/reward', $this->data);
	}

	public function rewardSearch() {
		if($this->input->post()) 
		{

			$condition = "TypeId='4' AND Description LIKE '%Reward%'";
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
			$this->load->view('admin/report/reward', $this->data['field']);
			
		} else {
			redirect('admin/report/reward');
		}
	}


	public function epin() {
		$condition="isDelete='0' order by EpinRecordId DESC";
		$this->data['field'] = $this->common_model->GetResults($condition,"arm_epin");
		// print_r($this->data);exit;
		$this->load->view('admin/report/epin', $this->data);
	}

	public function epinSearch() {
		if($this->input->post()) 
		{

			$condition = "isDelete='0'";
			
			
			// if($this->input->post('paythrough'))
			// 	$condition .= " AND PayThrough LIKE" . "'%" . $this->input->post('paythrough') . "%'";

			if($this->input->post('transactionid'))
				$condition .= " AND EpinTransactionId LIKE" . "'%" . $this->input->post('transactionid') . "%'";

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(ExpiryDay) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(ExpiryDay) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";
				
			if($this->input->post('username'))
			{
				$user = $this->common_model->GetRow("UserName='".$this->input->post('username')."'","arm_members");
				if(isset($user->MemberId))
				$condition .= " AND AllocatedBy ='" .$user->MemberId."' OR UsedBy ='" .$user->MemberId."'";
			}
			$this->data['field'] = $this->common_model->GetResults($condition,"arm_epin");
			
			$this->load->view('admin/report/epin', $this->data['field']);
			
		} else {
			redirect('admin/report/epin');
		}
	}


	public function bonus() {
		$condition="TypeId='5' order by HistoryId DESC";
		$this->data['field'] = $this->common_model->GetResults($condition,"arm_history");
		$this->load->view('admin/report/bonus', $this->data);
	}

	public function bonusSearch() {
		if($this->input->post()) 
		{

			$condition = "TypeId='5'";
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
			$this->load->view('admin/report/bonus', $this->data['field']);
			
		} else {
			redirect('admin/report/bonus');
		}
	}
	public function chart()
	{

		echo "['income', 2150, 1180, 1190, 1000, 1070, 1800, 1150, 1180, 1190, 1000, 1070, 1800],
                    ['expenses', 910, 3020, 760, 1080, 850, 940, 910, 1020, 760, 1080, 850, 940]";
    }

}
