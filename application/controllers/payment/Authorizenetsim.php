<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorizenetsim extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// if($this->session->userdata('logged_in')) {
		
			// Load database
			$this->load->model('user/shop_model');
			$this->load->model('product_model');
			
			$this->load->model('order_model');
			$this->load->model('admin/paymentsetting_model');
			$this->load->helper('epin_helper');
			$this->load->model('MemberCommission_model');
			$this->load->model('Memberboardprocess_model');
			$this->load->model('ProductCommission_model');
 			
			$this->data['authorizenetsim'] = $this->paymentsetting_model->Getfielddata(11);
			$this->data['x_login'] = $this->data['authorizenetsim']->PaymentMerchantId;
			$this->data['x_key'] = $this->data['authorizenetsim']->PaymentMerchantKey;
			
			
			if($this->data['authorizenetsim']->PaymentMode==1){
				//live mode
				$this->data['paymenturl'] = $this->data['authorizenetsim']->PaymentLiveUrl;
				$this->data['x_test_request'] = 'false';
			}
			else{
				$this->data['paymenturl'] = $this->data['authorizenetsim']->PaymentTestUrl;
				$data['x_test_request'] = 'true';
			}

			$currency_condition = "Status='1'";
			$this->data['currency_setting'] = $this->common_model->GetRow($currency_condition,'arm_currency');
			$this->data['x_currency_code'] = $this->data['currency_setting']->CurrencyCode;

			$this->lang->load('payment/payment',$this->session->userdata('language'));
			// load language
			// $this->lang->load('payment/authorizenetsim');
		// } else {
		// 	redirect('user/shop');
		// }		

	}

	public function index() {
		
	    // $this->data['x_itemcode'] = $this->session->userdata('MemberID');

		if($this->session->userdata('MemberID')) {
			$this->data['ap_cus1'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));	
		} else {
			$this->data['ap_cus1'] = $this->session->userdata('guest');
		}
		
		$this->data['carts'] = $this->cart->contents();
		$this->data['authorizenetsim'] = $this->paymentsetting_model->Getfielddata(3);

		$shipping_rates = $this->session->userdata('shipping');
	    $shipping = $shipping_rates['shipping_rates'];
	    
	    if($this->session->userdata('cart_discount') && $this->cart->total_items() > 0) {

	      	$cart_discount_data = $this->session->userdata('cart_discount');
	      	$dicount = $cart_discount_data['discount'];
	      	// $vat = $this->cart->total() * (17.5 / 100 );
        	$grand_total = $shipping - $dicount;
        	$grand_total1 = $grand_total + $this->cart->total();
	      // $coupon_code = $cart_discount_data['discount'];

	    } else {

	      	$dicount = '0.00';
	      	// $vat = $this->cart->total() * (17.5 / 100 );
        	$grand_total = $shipping - $dicount;
        	$grand_total1 = $grand_total + $this->cart->total();
	      
	    }
	    // Start authorized fields

	    $this->data['x_amount'] = number_format($grand_total1,2);
		$this->data['x_show_form'] = 'PAYMENT_FORM';
		$this->data['x_type'] = 'AUTH_CAPTURE';
		$this->data['x_relay_response'] = 'true';
		$this->data['x_description'] = 'cart';
		$this->data['x_process_type'] = 'cart';
		$this->data['x_fp_timestamp'] = time();
		$this->data['x_fp_sequence'] = '1';
		$this->data['x_fp_hash'] = hash_hmac('md5', $this->data['x_login'] . '^' . $this->data['x_fp_sequence'] . '^' . $this->data['x_fp_timestamp'] . '^' . $this->data['x_amount'] . '^' . $this->data['x_currency_code'], $this->data['x_key']);

		// $this->data['x_fp_timestamp'] = time();
		// $this->data['x_fp_sequence'] = '1';

		// End authorized fields
		

		$this->load->view('payment/authorizenetsim',$this->data);
	}

	public function register() {

		$this->data['userdetails'] = $this->common_model->GetCustomer($this->session->userdata('free_mem_id'));
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==9)
			$table = "arm_hyip";
		elseif($mlsetting->Id==5) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$condition="PackageId='".$this->data['userdetails']->PackageId."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);

		// Start authorized fields
		$this->data['x_fp_sequence'] = $this->session->userdata('free_mem_id');
		$this->data['x_fp_timestamp'] = time();
		$this->data['x_amount'] = number_format($this->data['packagedetails']->PackageFee,2);
			$this->data['min_amount'] = $this->data['packagedetails']->min_amount;
		$this->data['max_amount'] = $this->data['packagedetails']->max_amount;
		
		$this->data['x_show_form'] = 'PAYMENT_FORM';
		$this->data['x_type'] = 'AUTH_CAPTURE';
		$this->data['x_relay_response'] = 'true';
		$this->data['x_fp_hash'] = hash_hmac('md5', $this->data['x_login'] . '^' . $this->data['x_fp_sequence'] . '^' . $this->data['x_fp_timestamp'] . '^' . $this->data['x_amount'] . '^' . $this->data['x_currency_code'], $this->data['x_key']);
		$this->data['x_packageid'] = $this->data['packagedetails']->PackageId;
		$this->data['x_packagename'] = $this->data['packagedetails']->PackageName;
		$this->data['x_description'] = 'register';
		$this->data['x_process_type'] = 'register';
		// End authorized fields
	    
	    $this->data['register'] = 1;
	    
	   
		$this->load->view('payment/authorizenetsim',$this->data);
	}

	public function subscription() {

		$this->data['userdetails'] = $this->common_model->GetCustomer($this->session->userdata('sub_mem_id'));
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==9)
			$table = "arm_hyip";
		elseif($mlsetting->Id==5) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$condition="PackageId='".$this->data['userdetails']->PackageId."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);

		// Start authorized fields
		$this->data['x_fp_sequence'] = $this->session->userdata('sub_mem_id');
		$this->data['x_fp_timestamp'] = time();
		$this->data['x_amount'] = number_format($this->data['packagedetails']->PackageFee,2);
			$this->data['min_amount'] = $this->data['packagedetails']->min_amount;
		$this->data['max_amount'] = $this->data['packagedetails']->max_amount;
		
		$this->data['x_show_form'] = 'PAYMENT_FORM';
		$this->data['x_type'] = 'AUTH_CAPTURE';
		$this->data['x_relay_response'] = 'true';
		$this->data['x_fp_hash'] = hash_hmac('md5', $this->data['x_login'] . '^' . $this->data['x_fp_sequence'] . '^' . $this->data['x_fp_timestamp'] . '^' . $this->data['x_amount'] . '^' . $this->data['x_currency_code'], $this->data['x_key']);
		$this->data['x_packageid'] = $this->data['packagedetails']->PackageId;
		$this->data['x_packagename'] = $this->data['packagedetails']->PackageName;
		$this->data['x_description'] = 'subscription';
		$this->data['x_process_type'] = 'subscription';
		// End authorized fields
	    
	    $this->data['subscription'] = 1;
	    
	   
		$this->load->view('payment/authorizenetsim',$this->data);
	}

	public function upgrade() {
		
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==9)
			$table = "arm_hyip";
		elseif($mlsetting->Id==5) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$this->data['memberid'] = $this->session->userdata('MemberID');
	    $condition="PackageId='".$this->input->post('package')."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);

		// Start authorized fields
		$this->data['x_fp_sequence'] = $this->session->userdata('MemberID');
		$this->data['x_fp_timestamp'] = time();
		$this->data['x_amount'] = number_format($this->data['packagedetails']->PackageFee,2);
			$this->data['min_amount'] = $this->data['packagedetails']->min_amount;
		$this->data['max_amount'] = $this->data['packagedetails']->max_amount;
		
		$this->data['x_show_form'] = 'PAYMENT_FORM';
		$this->data['x_type'] = 'AUTH_CAPTURE';
		$this->data['x_relay_response'] = 'true';
		$this->data['x_fp_hash'] = hash_hmac('md5', $this->data['x_login'] . '^' . $this->data['x_fp_sequence'] . '^' . $this->data['x_fp_timestamp'] . '^' . $this->data['x_amount'] . '^' . $this->data['x_currency_code'], $this->data['x_key']);
		$this->data['x_packageid'] = $this->data['packagedetails']->PackageId;
		$this->data['x_packagename'] = $this->data['packagedetails']->PackageName;
		$this->data['x_process_type'] = 'upgrade';
		// End authorized fields

	    
	    
	   	$this->data['upgrade'] = '1';
		$this->load->view('payment/authorizenetsim',$this->data);
	}

	public function buyepin() {

		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==9)
			$table = "arm_hyip";
		elseif($mlsetting->Id==5) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

	    $condition="PackageId='".$this->input->post('package')."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);

	    // Start authorized fields
		$this->data['x_fp_sequence'] = $this->session->userdata('MemberID');
		$this->data['x_fp_timestamp'] = time();
		$this->data['x_amount'] = number_format($this->input->post('totalamount'),2);
			$this->data['min_amount'] = $this->data['packagedetails']->min_amount;
		$this->data['max_amount'] = $this->data['packagedetails']->max_amount;
		
		$this->data['x_show_form'] = 'PAYMENT_FORM';
		$this->data['x_type'] = 'AUTH_CAPTURE';
		$this->data['x_relay_response'] = 'true';
		
		$this->data['x_fp_hash'] = hash_hmac('md5', $this->data['x_login'] . '^' . $this->data['x_fp_sequence'] . '^' . $this->data['x_fp_timestamp'] . '^' . $this->data['x_amount'] . '^' . $this->data['x_currency_code'], $this->data['x_key']);
		$this->data['x_packageid'] = $this->data['packagedetails']->PackageId;
		$this->data['x_packagename'] = $this->data['packagedetails']->PackageName;
		$this->data['x_description'] = 'epins';
		$this->data['x_process_type'] = 'epins';
		$this->data['x_count'] = $this->input->post('epincount');
	    $this->data['x_packagefee'] = $this->data['packagedetails']->PackageFee;
		// End authorized fields

	   	$this->data['epins'] = '1';
		$this->load->view('payment/authorizenetsim',$this->data);
	}

	public function status() {

		if(isset($_POST) && sizeof($_POST) >0) {
			
			$postcontent='<table cellpadding="0" cellspacing="0" border="0" width="549">';
			 
			foreach($_POST as $key=>$value)
			{
				$postcontent.='<tr>
	    			<td valign="top" align="left" width="150"><p style="margin:5px 0; padding:0; font-family:Verdana, Arial, Helvetica,
					 sans-serif; font-size:12px; line-height:22px; color:#555555;">'.$key.'</p></td><td valign="top" align="left" width="10">
					 <p style="margin:5px 0; padding:0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; line-height:22px; color:#555555;">:</p>
					 </td><td valign="top" align="left" width="440"><p style="margin:5px 0; padding:0; font-family:Verdana, Arial, Helvetica, sans-serif; 
					 font-size:12px; line-height:22px; color:#555555; font-weight:bold;">'.$value.'</p></td>
	               </tr>';
			}
			
			$postcontent.='</table>';
			
			$table = html_entity_decode($postcontent);
			
			$data = array(
				'postcontent' => $table
			);
			$this->db->insert('arm_test',$data);

			if (md5($this->data['x_login'] . $_POST['x_trans_id'] . $_POST['x_amount']) == strtolower($_POST['x_MD5_Hash'])) {
				
				if($_POST['x_process_type']=='register') { 
					$packageId = $_POST['x_packageid'];
					$PackageFee = $_POST['x_amount'];
					$memberId = $_POST['x_cust_id'];
					$condition = "PackageId='".$packageId."'";
					$packagedetails = $this->common_model->GetRow($condition,'arm_package');

					if($PackageFee==$packagedetails->PackageFee) {
						$condition1 = "MemberId='".$memberId."' AND PackageId='".$packageId."'";
						$data = array(
							'MemberId' => $memberId,
							'MemberStatus' => 'Active'
						);
						$result = $this->common_model->UpdateRecord($data,$condition1,'arm_members');
						if($result){
							$this->registerCommission($memberId);
							$this->data['message'] = 'Registration successfully processed.';
							$this->load->view('user/success', $this->data);
						}
					}
				}

				if($_POST['x_process_type']=='upgrade') { 
					$packageId = $_POST['x_packageid'];
					$PackageFee = $_POST['x_amount'];
					$memberId = $_POST['x_cust_id'];
					$condition = "PackageId='".$packageId."'";
					$packagedetails = $this->common_model->GetRow($condition,'arm_package');

					if($PackageFee==$packagedetails->PackageFee) {
						$condition1 = "MemberId='".$memberId."' AND PackageId='".$packageId."'";
						$date = date('y-m-d h:i:s');
						$data = array(
							'SubscriptionsStatus'	=>	'Active',
							'MemberStatus'	=>	'Active',
							'ModifiedDate'	=>	$date,
							'PackageId'	=>	$packageId
						);

						$condition = "MemberId='".$memberId."'";
						$result = $this->common_model->UpdateRecord($data,$condition1,'arm_members');
						if($result){
							$this->upgradeComm($memberId, $PackageFee, $_POST['ap_customeruniqueid']);
							$this->data['message'] = 'Upgrade successfully processed.';
							$this->load->view('user/success', $this->data);
						}
					}
				}

				if($_POST['x_process_type']=='subscription') { 
					$packageId = $_POST['x_packageid'];
					$PackageFee = $_POST['x_amount'];
					$memberId = $_POST['x_cust_id'];
					$condition = "PackageId='".$packageId."'";
					$packagedetails = $this->common_model->GetRow($condition,'arm_package');

					if($PackageFee==$packagedetails->PackageFee) {
						$date = date('Y-m-d H:i:s');
						$subscriptiontype=$this->common_model->GetRow("KeyValue='subscriptiontype' AND Page='usersetting'","arm_setting");
						if($subscriptiontype->ContentValue=='monthly')
						{
							$period=30;
						}
						else
						{
							$period=365;
						}
						$endate = strtotime("+".$period." day", strtotime($date));
						$EndDate=date('Y-m-d H:i:s ', $endate);

						$condition1 = "MemberId='".$memberId."' AND PackageId='".$packageId."'";
						$date = date('y-m-d h:i:s');
						$data = array(
							'SubscriptionsStatus'	=>	'Active',
							'MemberStatus'	=>	'Active',
							'ModifiedDate'	=>	$date,
							'EndDate'=> $EndDate
							
						);

						$condition = "MemberId='".$memberId."'";
						$result = $this->common_model->UpdateRecord($data,$condition1,'arm_members');
						if($result){
							$this->subscriptioncommission($memberId, $PackageFee, $_POST['ap_customeruniqueid']);
							$this->data['message'] = 'Upgrade successfully processed.';
							$this->load->view('user/success', $this->data);
						}
					}
				}

				if($_POST['x_process_type']=='epin') {

					$totalamount = $_POST['x_count'] * $_POST['x_packagefee'];

					if($totalamount==$_POST['x_amount']) {

						$date = date("Y-m-d");
						$date = strtotime(date("Y-m-d", strtotime($date)) . " +6 month");
						$expirydate = date("Y-m-d",$date);
						
						
						for($i=1;$i<=$_POST['x_count'];$i++) {
						
							$randpin = RandomEpins();

							$data = array(
								'EpinPackageId'=>$_POST['x_packageid'],
								'EpinAmount'=>$_POST['x_packagefee'],
								'EpinTransactionId'=>$randpin,
								'AllocatedBy'=>$_POST['x_cust_id'],
								'ExpiryDay'=>$expirydate,
								'DateAdded'=>date("Y-m-d H:i:s"),
								'EpinCount'=>'1',
								'EpinStatus'=>'1'
							);
								
							$result = $this->common_model->SaveRecords($data,'arm_epin');
						}
					}
					
				}
				
				if($_POST['x_process_type']=='cart') { 

					// shopping cart 
					$this->session->unset_userdata('cart_contents');
					$this->session->unset_userdata('cart_discount');

					$orderid = $_POST['x_cust_id'];
					$condition = "o.OrderId =" . "'" . $orderid . "'";
					$this->data['order'] = $this->order_model->GetOrders($condition);
					$userorder = $this->data['order'];
					$order_total = str_replace(",","",number_format($userorder[0]->OrderTotal,2));
					
					$condition2 = "order_id =" . "'" . $orderid . "'";
					$this->data['cart_total_res'] = $this->common_model->GetResults($condition2,'arm_order_total');

					if($order_total==$_POST['x_amount']) {
						$condition3 = "OrderId =" . "'" . $orderid . "'";
						$sdata= array( 'Status'=>'paid');
						$this->common_model->UpdateRecord($sdata,$condition3,"arm_order");
						$this->ProductCommission_model->check($userorder[0]->MemberId,$orderid);
						$this->data['message'] = 'Your Order successfully processed.';
						$this->load->view('user/success', $this->data);
					} else {
						$this->data['message'] = 'Your Order not success.';
						$this->load->view('user/fail', $this->data);
					}
				}
			} else {
				$this->data['message'] = 'Payment Authorization Failed.';
				$this->load->view('user/fail', $this->data);
			}
		} else {
			redirect('user/shop');
		}

	}

	public function success() {
		$this->data['message'] = 'Your Payment has been successfully procesed';
		$this->load->view('user/success');
	}
	

	public function cancel() {
		$this->data['message'] = 'Your Payment is canceled';
		$this->load->view('user/fail');
	}
	
	// register commission
	function registerCommission($MemberId) {
		
		$this->Memberboardprocess_model->process($MemberId);

		$data = array(
			'SubscriptionsStatus'	=>	'Active',
			'MemberStatus'	=>	'Active'
		);

		$condition = "MemberId='".$MemberId."'";
		$result = $this->common_model->UpdateRecord($data,$condition,'arm_members');
		if($result)
		{
			$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
				
			$field = "MemberId";
			$MemberId = $MemberId;
			if($mlsetting->Id==1) {

				$table = "arm_forcedmatrix";

			} else if($mlsetting->Id==2) {

				$table = "arm_unilevelmatrix";

			} else if($mlsetting->Id==3) {

				$table = "arm_monolinematrix";
				$field = "MonoLineId";
				$monomdet = $this->common_model->GetRow("MemberId='". $memberid."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");
				$MemberId = $monomdet->MonoLineId;

			} else if($mlsetting->Id==4) {

				$table = "arm_binarymatrix";

			} else if($mlsetting->Id==5) {

				$table = "arm_boardmatrix";
				$field = "BoardMemberId";
				$brdmdet = $this->common_model->GetRow("MemberId='". $memberid."' order by BoardMemberId ASC LIMIT 0,1","arm_boardmatrix");
				$MemberId = $brdmdet->BoardMemberId;

			} else if($mlsetting->Id==6) {

				$table = "arm_xupmatrix";

			} else if($mlsetting->Id==7) {

				$table = "arm_oddevenmatrix";
			}
			elseif($mlsetting->Id==9)
			{
				$table="arm_binaryhyip";
			}
			

			$res_comm_status = $this->MemberCommission_model->process($MemberId,$table,$field);
			if($res_comm_status)
				return true;
			else
				return false;
		}
	}

	// upgrade commission
	function upgradeComm($MemberId,$PackageFee,$txn_id) {
		
		$bal = $this->common_model->Getcusomerbalance($MemberId);
		$txnid = "UPG".rand(1111111,9999999);
		
		$data1 = array(
			'MemberId'	=>	$MemberId,
			'TransactionId'	=>	$txnid,
			'DateAdded'	=>	$date,
			'PaymentReferenceId'	=>	$txn_id,
			'Description'	=> "Member Upgrade using authorizenetsim id ".$txn_id,
			'Credit'	=>	$PackageFee,
			'Debit'	=>	$PackageFee,
			'Balance'	=>	$bal,
			'TypeId'	=>	"19"
		);

		$result1 = $this->common_model->SaveRecords($data1,'arm_history');
	
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
		$field = "MemberId";
		$MemberId = $memberid;

		if($mlsetting->Id==1) {

			$table = "arm_forcedmatrix";

		} else if($mlsetting->Id==2) {

			$table = "arm_unilevelmatrix";

		} else if($mlsetting->Id==3) {

			$table = "arm_monolinematrix";
			$field = "MonoLineId";
			$monomdet = $this->common_model->GetRow("MemberId='". $memberid."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");
			$MemberId = $monomdet->MonoLineId;

		} else if($mlsetting->Id==4) {

			$table = "arm_binarymatrix";

		} else if($mlsetting->Id==5) {

			$table = "arm_boardmatrix";
			$field = "BoardMemberId";
			$brdmdet = $this->common_model->GetRow("MemberId='". $memberid."' order by BoardMemberId ASC LIMIT 0,1","arm_boardmatrix");
			$MemberId = $brdmdet->BoardMemberId;

		} else if($mlsetting->Id==6) {

			$table = "arm_xupmatrix";

		} else if($mlsetting->Id==7) {

			$table = "arm_oddevenmatrix";
		}

			elseif($mlsetting->Id==9)
			{
				$table="arm_binaryhyip";
			}
		

		$commision_status = $this->MemberCommission_model->process($MemberId,$table,$field);
		if($commision_status)
			return true;
		else
			return false;
	}

	// subscription commission
	function subscriptioncommission($MemberId,$PackageFee,$txn_id) {
		
		$bal = $this->common_model->Getcusomerbalance($MemberId);
		$txnid = "SUB".rand(1111111,9999999);
		
		$data1 = array(
			'MemberId'	=>	$MemberId,
			'TransactionId'	=>	$txnid,
			'DateAdded'	=>	$date,
			'PaymentReferenceId'	=>	$txn_id,
			'Description'	=> "Member subscription using authorizenetsim id ".$txn_id,
			'Credit'	=>	$PackageFee,
			'Debit'	=>	$PackageFee,
			'Balance'	=>	$bal,
			'TypeId'	=>	"19"
		);

		$result1 = $this->common_model->SaveRecords($data1,'arm_history');
	
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
		$field = "MemberId";
		$MemberId = $memberid;

		if($mlsetting->Id==1) {

			$table = "arm_forcedmatrix";

		} else if($mlsetting->Id==2) {

			$table = "arm_unilevelmatrix";

		} else if($mlsetting->Id==3) {

			$table = "arm_monolinematrix";
			$field = "MonoLineId";
			$monomdet = $this->common_model->GetRow("MemberId='". $memberid."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");
			$MemberId = $monomdet->MonoLineId;

		} else if($mlsetting->Id==4) {

			$table = "arm_binarymatrix";

		} else if($mlsetting->Id==5) {

			$table = "arm_boardmatrix";
			$field = "BoardMemberId";
			$brdmdet = $this->common_model->GetRow("MemberId='". $memberid."' order by BoardMemberId ASC LIMIT 0,1","arm_boardmatrix");
			$MemberId = $brdmdet->BoardMemberId;

		} else if($mlsetting->Id==6) {

			$table = "arm_xupmatrix";

		} else if($mlsetting->Id==7) {

			$table = "arm_oddevenmatrix";
		}

			elseif($mlsetting->Id==9)
			
			{
				$table = "arm_binaryhyip";
			}

		$commision_status = $this->MemberCommission_model->process($MemberId,$table,$field);
		if($commision_status)
			return true;
		else
			return false;
	}

	// mass payouts
	public function masspayouts() {

		// check admin login
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {

			// check payouts checked
			if($this->input->post('payouts')!='')
			{
				$merchant_id = $this->data['ap_merchant'];
				$PaymentMerchantPassword = $this->data['authorizenetsim']->PaymentMerchantPassword;
				$PaymentMerchantApi = $this->data['authorizenetsim']->PaymentMerchantApi;
				$PaymentMerchantKey = $this->data['authorizenetsim']->PaymentMerchantKey;

				$this->load->library('MassPayClient');
				$authorizenetsim = new MassPayClient($merchant_id,$PaymentMerchantPassword);

				//list of payouts
				$payouts = $this->input->post('payouts');

				$payments = array();
				$i = 0;
				foreach ($payouts as $key => $value) {
					// geting withdraw info
					$paymentdetail = $this->common_model->GetRow("HistoryId='".$value."'","arm_history");
					// geting user details
					$memberdetail = $this->common_model->GetCustomer($paymentdetail->MemberId);
					// geting user bitcoin address
					$membercustoms = json_decode($memberdetail->CustomFields);
					// check user have payout id
					if($membercustoms->authorizenetsim) {
						
						$payer_amount = str_replace(",","",number_format($paymentdetail->Debit,2));
						$payments[$i]['receiver'] = $membercustoms->authorizenetsim;
						$payments[$i]['amount'] = $payer_amount;
						$payments[$i]['note'] = 'You Withdraw request is payout';

						$post_data = $authorizenetsim->buildPostVariables($payments, $this->data['ap_currency']);
				
						$send_payment = $authorizenetsim->send();
						$authorizenetsim->parseResponse($send_payment);
						$send_payment1 = $authorizenetsim->getResponse();
						
						if($send_payment1['RETURNCODE']==100) {
							$data1	=	array(
								'TypeId'	=>	'8',
								'PaymentReferenceId'	=>	$send_payment1['REFERENCENUMBER']
							);
							
							$condition="HistoryId='".$value."'";
							$result = $this->common_model->UpdateRecord($data1,$condition,"arm_history");
						} else {
							$data1	=	array(
								'Description'	=>	'Payment Failed'
							);
							
							$condition="HistoryId='".$value."'";
							$this->common_model->UpdateRecord($data1,$condition,"arm_history");
						}
						
					}
					
				}

				if($result) {
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/withdraw');
				} else {
					$this->session->set_flashdata('success_message',ucwords("payment error code ".$send_payment['L_ERRORCODE0']));
					redirect('admin/withdraw');
				}
				
			} else {
				redirect('admin/withdraw');
			}
		}
	}


}
?>