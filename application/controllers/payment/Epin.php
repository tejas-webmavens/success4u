<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Epin extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// if($this->session->userdata('logged_in')) {
			
			
			$this->lang->load('payment/payment',$this->session->userdata('language'));
			// Load database
			/*$this->load->model('user/shop_model');
			$this->load->model('product_model');
			
			$this->load->model('order_model');
			$this->load->model('admin/paymentsetting_model');
			$this->load->helper('epin_helper');

			$this->data['return'] = base_url().'payment/paypal/success';
			$this->data['notify_url'] = base_url().'payment/paypal/ipn';
			$this->data['cancel_return'] = base_url().'payment/paypal/cancel';

			$this->data['paypal'] = $this->paymentsetting_model->Getfielddata(2);
			$this->data['merchant'] = $this->data['paypal']->PaymentMerchantId;
			if($this->data['paypal']->PaymentMode==1)
				$this->data['paymentUrl'] = $this->data['paypal']->PaymentLiveUrl;
			else
				$this->data['paymentUrl'] = $this->data['paypal']->PaymentTestUrl;
			$this->data['currency'] = 'USD';

			// load language
			$this->lang->load('payment/paypal');*/
		// } else {
		// 	redirect('user/shop');
		// }		

	}

	public function index() {

		echo ucwords("<p> unvailable epins for cart process</p>");
	}

	public function register() {

		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==9)
			$table = "arm_hyip";
		elseif($mlsetting->Id==5) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$this->data['register'] = '1';
		
		$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('free_mem_id'));
			
		if($this->data['user']->SubscriptionsStatus=='Free'){
			$condition="PackageId='".$this->data['user']->PackageId."'";
			$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		}

		
		$this->data['PackageId'] = $this->data['packagedetails']->PackageId;
		$this->data['amount'] = $this->data['packagedetails']->PackageFee;
		// $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
		// $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
		$this->data['package'] = $this->data['packagedetails']->PackageName; 
		$this->data['MemberId'] = $this->data['user']->MemberId;
		$this->load->view('payment/epin',$this->data);
	}

	public function subscription() {
		

		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==9)
			$table = "arm_hyip";
		elseif($mlsetting->Id==5) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$this->data['subscription'] = '1';
		
		$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('sub_mem_id'));
			
		
		$condition="PackageId='".$this->data['user']->PackageId."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		$this->data['PackageId'] = $this->data['user']->PackageId;
		$this->data['amount'] = $this->data['packagedetails']->PackageFee;
		$this->data['min_amount'] = $this->data['packagedetails']->min_amount;
		$this->data['max_amount'] = $this->data['packagedetails']->max_amount;
		$this->data['package'] = $this->data['packagedetails']->PackageName; 
		$this->data['MemberId'] = $this->data['user']->MemberId;
		$this->load->view('payment/epin',$this->data);
	}

	public function upgrade() {


		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==9)
			$table = "arm_hyip";
		elseif($mlsetting->Id==5 || $mlsetting->Id==8) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$this->data['upgrade'] = '1';
		$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
			
		$condition="PackageId='".$this->input->post('package')."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		$this->data['PackageId'] = $this->data['packagedetails']->PackageId;
		$pvlist = explode(",",$this->data['packagedetails']->upgradelevel);
		$this->data['amount'] = $pvlist[1];
		$this->data['min_amount'] = $this->data['packagedetails']->min_amount;
		$this->data['max_amount'] = $this->data['packagedetails']->max_amount;
		$this->data['package'] = $this->data['packagedetails']->PackageName;
		$this->data['MemberId'] = $this->data['user']->MemberId;
		$this->load->view('payment/epin',$this->data);
	}

	public function board() {

		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==9)
			$table = "arm_hyip";
		elseif($mlsetting->Id==5) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$this->data['board'] = '1';
		
		$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('board_mem_id'));
			
		if(strtolower($this->data['user']->SubscriptionsStatus)=='package'){
			$condition="PackageId='".$this->data['user']->PackageId."'";
			$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		}

		$this->data['PackageId'] = $this->data['packagedetails']->PackageId;
		$this->data['amount'] = $this->data['packagedetails']->PackageFee;
		$this->data['min_amount'] = $this->data['packagedetails']->min_amount;
		$this->data['max_amount'] = $this->data['packagedetails']->max_amount;
		$this->data['package'] = $this->data['packagedetails']->PackageName; 
		$this->data['MemberId'] = $this->data['user']->MemberId;
		$this->load->view('payment/epin',$this->data);
	}

	
	public function ipn() {
		echo "ipn";
		print_r($_POST);

	}

	public function cancel() {
		echo "cancel";
		print_r($_POST);

	}




}
?>