<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountBalance extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// if($this->session->userdata('logged_in')) {
			
			
			$this->lang->load('payment/payment',$this->session->userdata('language'));

			$this->load->model('user/shop_model');
		$this->load->model('product_model');
		
		$this->load->model('order_model');
		$this->load->model('admin/paymentsetting_model');
		$this->load->helper('epin_helper');
		$this->load->model('MemberCommission_model');
		$this->load->model('Memberboardprocess_model');
		$this->load->model('ProductCommission_model');

		
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
		if($this->session->userdata('MemberID')) {
			$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));	
		} else {
			$this->data['user'] = $this->session->userdata('guest');
		}
		
		$this->data['carts'] = $this->cart->contents();

		$shipping_rates = $this->session->userdata('shipping');
	    $shipping = $shipping_rates['shipping_rates'];
	    
	    if($this->session->userdata('cart_discount') && $this->cart->total_items() > 0) {

	      	$cart_discount_data = $this->session->userdata('cart_discount');
	      	$dicount = $cart_discount_data['discount'];
	      	$vat = $this->cart->total() * (17.5 / 100 );
        	$grand_total = $vat + $shipping - $dicount;
        	$grand_total1 = $grand_total + $this->cart->total();

	    } else {

	      	$dicount = '0.00';
		    $vat = $this->cart->total() * (17.5 / 100 );
        	$grand_total = $vat + $shipping - $dicount;
        	$grand_total1 = $grand_total + $this->cart->total();
	      
	    }

	    $this->data['Memberid'] = ($this->session->userdata('MemberID')) ? $this->session->userdata('MemberID') : $this->session->userdata('userid');
	    $this->data['amount'] = number_format($grand_total1,2);
	    $this->data['label'] = 'cart';
		
		
		$this->load->view('payment/accountbalance',$this->data);


	// echo ucwords("<p> Bankwire transactions unvailable for cart process</p>");
	}
	public function register() {
		
		$ckip = $this->common_model->GetRowCount("MemberId='".$this->session->userdata('free_mem_id')."' AND EntryFor='MTA' AND AdminStatus='0'","arm_memberpayment");
		if($ckip>0)
		{
			echo ucwords("<br><h2><p> Bankwire details already updated For this member. pls wait untill admin accept / decline.</p></h2>");
	
		}
		else
		{
		
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==5 || $mlsetting->Id==8) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$this->data['register'] = '1';
		
		$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('free_mem_id'));
			
		
		$condition="PackageId='".$this->data['user']->PackageId."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		$this->data['PackageId'] = $this->data['user']->PackageId;
		$this->data['amount'] = $this->data['packagedetails']->PackageFee;
		$this->data['package'] = $this->data['packagedetails']->PackageName; 
		$this->data['Memberid'] = $this->data['user']->MemberId;
		$this->load->view('payment/bankwire',$this->data);
	}
	

	}

	public function subscription() {
		
		$ckip = $this->common_model->GetRowCount("MemberId='".$this->session->userdata('sub_mem_id')."' AND EntryFor='MTAS' AND AdminStatus='0'","arm_memberpayment");
		if($ckip>0)
		{
			echo ucwords("<br><h2><p> Bankwire details already updated For this member. pls wait untill admin accept / decline.</p></h2>");
	
		}
		else
		{
		
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==5 || $mlsetting->Id==8) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$this->data['subscription'] = '1';
		
		$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('sub_mem_id'));
			
		
		$condition="PackageId='".$this->data['user']->PackageId."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		$this->data['PackageId'] = $this->data['user']->PackageId;
		$this->data['amount'] = $this->data['packagedetails']->PackageFee;
		$this->data['package'] = $this->data['packagedetails']->PackageName; 
		$this->data['Memberid'] = $this->data['user']->MemberId;
		$this->load->view('payment/bankwire',$this->data);
	}
	

	}

	public function upgrade() {

		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==5) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

	    
	    $condition="PackageId='".$this->input->post('package')."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);

	    $this->data['Memberid'] = $this->session->userdata('MemberID');
	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;
	    $this->data['label'] = 'upgrade';
	    $this->data['upgrade'] = '1';
	    
	   	$this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
		$this->load->view('payment/accountbalance',$this->data);
	}


	// public function upgrade() {

	// $ckip = $this->common_model->GetRowCount("MemberId='".$this->session->userdata('MemberID')."' AND EntryFor='MTAU'  AND AdminStatus='0'","arm_memberpayment");
	// 	if($ckip>0)
	// 	{
	// 		echo ucwords("<br><h2><p> Bankwire details already updated For this member. pls wait untill admin accept / decline.</p></h2>");
	// 	}
	// 	else
	// 	{
	// 	$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
	// 	if($mlsetting->Id==4)
	// 		$table = "arm_pv";
	// 	elseif($mlsetting->Id==5 || $mlsetting->Id==8) 
	// 		$table = "arm_boardplan";
	// 	else
	// 		$table='arm_package';

	// 	$this->data['upgrade'] = '1';
		
	// 	$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
			
	// 	$condition="PackageId='".$this->input->post('package')."'";
	// 	$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
	// 	$this->data['PackageId'] = $this->data['packagedetails']->PackageId;
	// 	                    	$this->data['amount'] = $this->data['packagedetails']->PackageFee;

		
	// 	// $this->data['amount'] = $pvlist[1];
	// 	$this->data['package'] = $this->data['packagedetails']->PackageName; 
	// 	$this->data['MemberId'] = $this->data['user']->MemberId;
	// 	if($mlsetting->Id==8){
	// 	$pvlist = explode(",",$this->data['packagedetails']->upgradelevel);


	// 		$memberid = $this->session->userdata('MemberID');
	// 		$spids = $this->common_model->GetRowCount("MemberId = '".$memberid."' AND EntryFor='MTAU'",'arm_memberpayment');
 //                    $count_spill = $spids;
                  
 //                    if($count_spill < 4){
 //                    $field = "MemberId";
	// 				$usermlmdetail = $this->common_model->GetRow("".$field."='".$memberid."'",'arm_boardmatrix1');
	// 				$dcondition = "MemberId='".$usermlmdetail->DirectId."' order by BoardMemberId limit 0,1";
	// 				$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');
 //                    	if($count_spill == '1'){
 //                    		$this->data['amount'] = $pvlist[2];
 //                    		$spilloverid = $ddetails->SpilloverId;

	// 				$dcondition = "BoardMemberId='".$spilloverid."' order by BoardMemberId limit 0,1";
	// 				$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

	// 				$spill = $ddetails->SpilloverId;
	// 				$dcondition1 = "BoardMemberId='".$spill."' order by BoardMemberId limit 0,1";
	// 				$ddetails1 = $this->common_model->GetRow($dcondition1,'arm_boardmatrix1');

	// 				$final = $ddetails1->MemberId;


 //                    	}elseif ($count_spill == '2') {
 //                    		$this->data['amount'] = $pvlist[3];
 //                    		$spilloverid = $ddetails->SpilloverId;

	// 				$dcondition = "BoardMemberId='".$spilloverid."' order by BoardMemberId limit 0,1";
	// 				$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

	// 				$spill = $ddetails->SpilloverId;
	// 				$dcondition1 = "BoardMemberId='".$spill."' order by BoardMemberId limit 0,1";
	// 				$ddetails1 = $this->common_model->GetRow($dcondition1,'arm_boardmatrix1');

	// 				$spill1 = $ddetails1->SpilloverId;
	// 				$dcondition2 = "BoardMemberId='".$spill1."' order by BoardMemberId limit 0,1";
	// 				$ddetails2 = $this->common_model->GetRow($dcondition2,'arm_boardmatrix1');
                    
	// 				$final = $ddetails2->MemberId;


 //                    	}elseif ($count_spill == '3') {
 //                    		$this->data['amount'] = $pvlist[4];
 //                    		$spilloverid = $ddetails->SpilloverId;

	// 				$dcondition = "BoardMemberId='".$spilloverid."' order by BoardMemberId limit 0,1";
	// 				$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

	// 				$spill = $ddetails->SpilloverId;
	// 				$dcondition1 = "BoardMemberId='".$spill."' order by BoardMemberId limit 0,1";
	// 				$ddetails1 = $this->common_model->GetRow($dcondition1,'arm_boardmatrix1');

	// 				$spill1 = $ddetails1->SpilloverId;
	// 				$dcondition2 = "BoardMemberId='".$spill1."' order by BoardMemberId limit 0,1";
	// 				$ddetails2 = $this->common_model->GetRow($dcondition2,'arm_boardmatrix1');
                    
	// 				$spill2 = $ddetails2->MemberId;

	// 				$dcondition3 = "BoardMemberId='".$spill2."' order by BoardMemberId limit 0,1";
	// 				$ddetails3 = $this->common_model->GetRow($dcondition3,'arm_boardmatrix1');
	// 				$final = $ddetails3->MemberId;
					
                    		
 //                    	}else{
	// 					$this->data['amount'] = $pvlist[1];
	// 					$spilloverid = $ddetails->SpilloverId;

	// 				$dcondition = "BoardMemberId='".$spilloverid."' order by BoardMemberId limit 0,1";
	// 				$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

	// 				$final = $ddetails->MemberId;

 //                    	}

                    	 
 //                   $this->data['paydetail'] = $this->common_model->GetRow("MemberId='".$final."'","arm_members");


 //                    }

 //                    else{
	// 		$this->data['paydetail'] = $this->common_model->GetRow("PaymentName='bankwire'","arm_paymentsetting");
                  
 //                    }



	// 	// $field = "MemberId";
	// 	// $boardpackage = $this->common_model->GetRow("PackageId='1'","arm_boardplan");
	// 	// $usermlmdetail = $this->common_model->GetRow("".$field."='".$this->session->userdata('MemberID')."'",'arm_boardmatrix1');
	// 	// $dcondition = "MemberId='".$usermlmdetail->DirectId."' order by BoardMemberId limit 0,1";
	// 	// $ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

	// 	// $chec_spill = $ddetails->SpilloverId;

 //  //       $spillid = $this->common_model->GetRow("BoardMemberId='".$chec_spill."'","arm_boardmatrix1");






	//     }
 //        else{
	// 		$this->data['paydetail'] = $this->common_model->GetRow("PaymentName='bankwire'","arm_paymentsetting");
 //        }
	// 	$this->load->view('payment/accountbalance',$this->data);
	// 	}
	// }

	
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