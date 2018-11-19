<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfectmoney extends CI_Controller {

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
 			

			$this->data['status_url'] = base_url().'payment/perfectmoney/status';
			$this->data['payment_url'] = base_url().'payment/perfectmoney/success';
			$this->data['nopayment_url'] = base_url().'payment/perfectmoney/cancel';
			$this->data['perfectmoney'] = $this->paymentsetting_model->Getfielddata(8);
			$this->data['payee_account'] = $this->data['perfectmoney']->PaymentMerchantId;
			$this->data['payer_password'] = $this->data['perfectmoney']->PaymentMerchantPassword;
			$this->data['PaymentMerchantKey'] = $this->data['perfectmoney']->PaymentMerchantKey;
			$this->data['PaymentMerchantApi'] = $this->data['perfectmoney']->PaymentMerchantApi;

			$currency_condition = "Status='1'";
			$this->data['currency_setting'] = $this->common_model->GetRow($currency_condition,'arm_currency');
			$this->data['currency'] = $this->data['currency_setting']->CurrencyCode;

			$this->lang->load('payment/payment',$this->session->userdata('language'));
			// load language
			// $this->lang->load('payment/paypal');
		// } else {
		// 	redirect('user/shop');
		// }		

	}

	public function index() {

		if($this->session->userdata('MemberID')) {
			$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
			$this->data['FirstName'] = $this->data['user']->FirstName;
			$this->data['LastName'] = $this->data['user']->LastName;
			$this->data['Address'] = $this->data['user']->Address;
			$this->data['City'] = $this->data['user']->City;
			$this->data['Zip'] = $this->data['user']->Zip;
			$this->data['Country'] = $this->data['user']->Country;
			$this->data['Email'] = $this->data['user']->Email;
		} else {
			$this->data['user'] = $this->session->userdata('guest');
			$this->data['FirstName'] = $this->data['user']->FirstName;
			$this->data['LastName'] = $this->data['user']->LastName;
			$this->data['Address'] = $this->data['user']->Address;
			$this->data['City'] = $this->data['user']->City;
			$this->data['Zip'] = $this->data['user']->Zip;
			$this->data['Country'] = $this->data['user']->Country;
			$this->data['Email'] = $this->data['user']->Email;
		}

		$this->data['memberid'] = $this->session->userdata('MemberID');
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

		$this->data['amount'] = $grand_total1;
		
		$this->load->view('payment/perfectmoney',$this->data);
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
	    $this->data['register'] = '1';
		
	    $this->data['Memberid'] = $this->session->userdata('free_mem_id');
	    if($mlsetting->Id==9)
	    {
	    	$this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	        $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    }
	    else
	    {
	    	$this->data['amount'] = $this->data['packagedetails']->PackageFee;

	    }
	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
	    $this->data['memo'] = 'register';
	    $this->data['label'] = 'register';
	    
	   
		$this->load->view('payment/perfectmoney',$this->data);
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
	    $this->data['subscription'] = '1';
		
	    $this->data['Memberid'] = $this->session->userdata('sub_mem_id');
	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;
	      // $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	      //  $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
	    $this->data['memo'] = 'subscription';
	    $this->data['label'] = 'subscription';
	    
	   
		$this->load->view('payment/perfectmoney',$this->data);
	}

	public function upgrade() {

		if($this->session->userdata('MemberID')) {
			$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
			$this->data['Memberid'] = $this->data['user']->MemberId;
		}

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
	    // $this->input->post('package')
	    $condition="PackageId='".$this->input->post('package')."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
	    $this->data['upgrade'] = '1';

	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;
	      // $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	      //  $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
	    $this->data['memo'] = 'upgrade';
	    $this->data['label'] = 'upgrade';

		$this->load->view('payment/perfectmoney',$this->data);
	}

	public function deposit() {

		if($this->session->userdata('MemberID')) {
			$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
			$this->data['Memberid'] = $this->data['user']->MemberId;
		}

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
	    // $this->input->post('package')
	    $condition="PackageId='".$this->input->post('package')."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
	    $this->data['deposit'] = '1';

	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;
	      $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	       $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
	    $this->data['memo'] = 'deposit';
	    $this->data['label'] = 'deposit';

		$this->load->view('payment/perfectmoney',$this->data);
	}

	public function buyepin() {
		if($this->session->userdata('MemberID')) {
			$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
			$this->data['Memberid'] = $this->data['user']->MemberId;
		}

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
	    $this->data['epins'] = '1';
	    $this->data['epincount'] = $this->input->post('epincount');
	    $this->data['packageamount'] = $this->data['packagedetails']->PackageFee;
	      // $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	      //  $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['amount'] = $this->input->post('totalamount');
	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
	    $this->data['memo'] = 'epins';
		$this->load->view('payment/perfectmoney',$this->data);
	}



	public function status() {

		if(isset($_POST) && sizeof($_POST) >0) {
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: ARMCIP Team- <tech@armcip.com>' . "\r\n";
			
			
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

			$md5_hash_alt = strtoupper(md5('6O7e946JgpIZChcXArhStbTxx'));

			$string=$_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.$_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.$_POST['PAYMENT_BATCH_NUM'].':'.$_POST['PAYER_ACCOUNT'].':'.$md5_hash_alt.':'.$_POST['TIMESTAMPGMT'];

			$hash=strtoupper(md5($string));
			
			if($hash==$_POST['V2_HASH'])
			{
				// First we save the data then we check if it was all fine

				$sId 		= $_POST['PAYMENT_BATCH_NUM'];
				$order_id 	= $_POST['PAYMENT_ID'];
				$fAmount 	= $_POST['PAYMENT_AMOUNT'];
				$lr_paidby 	= $_POST['PAYER_ACCOUNT'];
				
				$user_id 		= 	$order_id;
				$transactionid 	= 	$sId;
				$amount			=	$fAmount;
				$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
				if($mlsetting->Id==4)
					$table = "arm_pv";
				elseif($mlsetting->Id==9)
					$table = "arm_hyip";
				elseif($mlsetting->Id==5) 
					$table = "arm_boardplan";
				else
					$table='arm_package';

		
				if($_POST['PAYEE_ACCOUNT']==$this->data['payee_account'] && $_POST['PAYMENT_UNITS']==$this->data['currency'])
				{
					if($_POST['SUGGESTED_MEMO']=='epin') {

						if($totalamount==$_POST['ap_amount']) {

							$date = date("Y-m-d");
							$date = strtotime(date("Y-m-d", strtotime($date)) . " +6 month");
							$expirydate = date("Y-m-d",$date);
							
							
							for($i=1;$i<=$_POST['ap_cus2'];$i++) {
							
								$randpin = RandomEpins();

								$data = array(
									'EpinPackageId'=>$_POST['ap_cus1'],
									'EpinAmount'=>$_POST['ap_cus1'],
									'EpinTransactionId'=>$randpin,
									'AllocatedBy'=>$_POST['ap_itemcode'],
									'ExpiryDay'=>$expirydate,
									'DateAdded'=>date("Y-m-d H:i:s"),
									'EpinCount'=>'1',
									'EpinStatus'=>'1'
								);
									
								$result = $this->common_model->SaveRecords($data,'arm_epin');
							}
						}
						
					}
					if($_POST['SUGGESTED_MEMO']=='upgrade') { 
						$packageId = $_POST['ap_cus1'];
						$PackageFee = $amount;
						$memberid = $_POST['ap_itemcode'];
						$condition = "PackageId='".$packageId."'";
						$packagedetails = $this->common_model->GetRow($condition,$table);

						if($PackageFee==$packagedetails->PackageFee) {

							$date = date('y-m-d h:i:s');
							$data = array(
								'SubscriptionsStatus'	=>	'Active',
								'MemberStatus'	=>	'Active',
								'ModifiedDate'	=>	$date,
								'PackageId'	=>	$packageId
							);

							$condition = "MemberId='".$memberId."'";
							$result = $this->common_model->UpdateRecord($data,$condition,'arm_members');
							if($result){
								$this->upgradeComm($memberId,$PackageFee, $_POST['txn_id']);
								$this->data['message'] = 'Upgrade successfully processed.';
								$this->load->view('user/success', $this->data);
							}
						}
						
						
					}
					if($_POST['SUGGESTED_MEMO']=='register') { 

						$packageId = $_POST['ap_cus1'];
						$PackageFee = $amount;
						$memberid = $_POST['ap_itemcode'];
						$condition = "PackageId='".$packageId."'";
						$packagedetails = $this->common_model->GetRow($condition,$table);

						if($PackageFee==$packagedetails->PackageFee) {
							$condition1 = "MemberId='".$memberId."' AND PackageId='".$packageId."'";
							$data = array(
								'MemberId' => $memberid,
								'MemberStatus' => 'Active'
							);
							$result = $this->common_model->UpdateRecord($data,$condition1,'arm_members');
							if($result){
								$this->registerCommission($memberid);
								$this->data['message'] = 'Registration successfully processed.';
								$this->load->view('user/success', $this->data);
							}
						}
						
					}

						if($_POST['SUGGESTED_MEMO']=='deposit') { 

						$packageId = $_POST['CUST_NUMO'];
						$PackageFee = $_POST['PAYMENT_AMOUNT'];
						$memberid = $_POST['PAYMENT_ID'];
						// $condition = "PackageId='".$packageId."'";
						// $packagedetails = $this->common_model->GetRow($condition,$table);

						if($PackageFee) {
							// $condition1 = "MemberId='".$memberId."' AND PackageId='".$packageId."'";
							// $data = array(
							// 	'MemberId' => $memberid,
							// 	'MemberStatus' => 'Active'
							// );
							// $result = $this->common_model->UpdateRecord($data,$condition1,'arm_members');
							// if($result){
								$this->depositcommission($memberid);
								$this->data['message'] = 'Deposit successfully processed.';
								$this->load->view('user/success', $this->data);
							// }
						}
						
					}
					if($_POST['SUGGESTED_MEMO']=='subscription') { 

						$packageId = $_POST['ap_cus1'];
						$PackageFee = $amount;
						$memberid = $_POST['ap_itemcode'];
						$condition = "PackageId='".$packageId."'";
						$packagedetails = $this->common_model->GetRow($condition,$table);

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
							$data = array(
								'MemberStatus' => 'Active',
								'SubscriptionsStatus' => 'Active',
								'EndDate'=>$EndDate
							);
							$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
							$resultmat = $this->common_model->UpdateRecord("Status='1'","MemberId='".$memberId."'",$mlsetting->TableName);
							
							$result = $this->common_model->UpdateRecord($data,$condition1,'arm_members');
							if($result){
								$this->subscriptioncommission($memberId,$PackageFee, $_POST['txn_id']);
								$this->data['message'] = 'subscription successfully processed.';
								$this->load->view('user/success', $this->data);
							}
						}
						
					}
					if($_POST['SUGGESTED_MEMO']=='cart') { 
						
						// shopping cart 
						$this->session->unset_userdata('cart_contents');
						$this->session->unset_userdata('cart_discount');
						$condition = "o.OrderId =" . "'" . $orderid . "'";
						$this->data['order'] = $this->order_model->GetOrders($condition);
						$userorder = $this->data['order'];
						$order_total = str_replace(",","",number_format($userorder[0]->OrderTotal,2));
						
						$condition2 = "order_id =" . "'" . $orderid . "'";
						$this->data['cart_total_res'] = $this->common_model->GetResults($condition2,'arm_order_total');

						if($order_total==$value_in_btc) {
							$this->ProductCommission_model->check($memberid,$orderid);
							$this->data['message'] = 'Your Order successfully processed.';
							$this->load->view('user/success', $this->data);
						} else {
							$this->data['message'] = 'Your Order not success.';
							$this->load->view('user/fail', $this->data);
						}
					}
				}
			}
		} else {
			redirect('user/shop');
		}	

	}

	public function success() {

		if(isset($_POST)) {
			$this->data['message'] = 'Your Payment has been success';
			$this->load->view('user/success');
		} else {
			redirect('user/shop');
		}
	}
	

	public function cancel() {
		$this->data['message'] = 'Your Payment is canceled';
		$this->load->view('user/fail');
	}

	//depositcommission
	function depositcommission($depositid) {
		
		$userid=$this->common_model->GetRow("id='".$depositid."'","deposit");
		$MemberId=$userid->MemberId;
		$this->Memberboardprocess_model->process($MemberId);

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
				$monomdet = $this->common_model->GetRow("MemberId='". $MemberId."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");
				$MemberId = $monomdet->MonoLineId;

			} else if($mlsetting->Id==4) {

				$table = "arm_binarymatrix";

			} else if($mlsetting->Id==5) {

				$table = "arm_boardmatrix";
				$field = "BoardMemberId";
				$brdmdet = $this->common_model->GetRow("MemberId='". $MemberId."' order by BoardMemberId ASC LIMIT 0,1","arm_boardmatrix");
				$MemberId = $brdmdet->BoardMemberId;

			} else if($mlsetting->Id==6) {

				$table = "arm_xupmatrix";

			} else if($mlsetting->Id==7) {

				$table = "arm_oddevenmatrix";
			}
			elseif($mlsetting->Id==9){
				$table="arm_binaryhyip";

			    $amountuser=$this->common_model->GetRow("id='". $depositid."'","deposit");
				
				
					$memberleft=$this->common_model->GetRow("LeftId='".$MemberId."'","arm_binaryhyip");

				   if($memberleft!="")
					    {
					    $amountleft=$memberleft->LeftCarryForward;
					    $totalleft=$amountleft+$amountuser->amount;
					    }
					    else
					    {
					     $amountleft=0;
					     $totalleft=$amountleft+$amountuser->amount;
					    }
					   
						$memberright=$this->common_model->GetRow("RightId='".$MemberId."'","arm_binaryhyip");
						if($memberright!="")
						{
							$amountright=$memberright->RightCarryForward;
					     $totalright=$amountright+$amountuser->amount;
						}
						else
						{
							$amountright=0;
							 $totalright=$amountright+$amountuser->amount;
						}
					    
						if($memberleft)
						{
						 $this->Memberboardprocess_model->binaryhyip($MemberId,$table);
						 $update=$this->db->query("update `arm_binaryhyip` set LeftCarryForward='".$totalleft."' where LeftId='".$MemberId."'");
						 $this->MemberCommission_model->paircommissionhyip();
						 $this->Memberboardprocess_model->Totaldowncount($table);
						}
						elseif($memberright)
						{
							 $this->Memberboardprocess_model->binaryhyip($MemberId,$table);
						 $update=$this->db->query("update `arm_binaryhyip` set RightCarryForward='".$totalright."' where RightId='".$MemberId."'");
						  $this->MemberCommission_model->paircommissionhyip();
						 $this->Memberboardprocess_model->Totaldowncount($table);
						}
						else
						{
						$this->Memberboardprocess_model->binaryhyip($MemberId,$table);
						 // $update=$this->db->query("update `arm_binaryhyip` set LeftcarryForward='".$amountuser->amount."'")
						 $this->Memberboardprocess_model->Totaldowncount($table);
						}

			}
	
			$res_comm_status = $this->MemberCommission_model->process($MemberId,$table,$field);
			if($res_comm_status)
				return true;
			else
				return false;
		
	}

	// register commission
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
			elseif($mlsetting->Id==9){
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
			'Description'	=> "Member Upgrade using paypal id ".$txn_id,
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

		elseif($mlsetting->Id==9){
			$table = "arm_binaryhyip";
		}

		$commision_status = $this->MemberCommission_model->process($MemberId,$table,$field);
		if($commision_status)
			return true;
		else
			return false;
	}

	//subscription commission 
	function subscriptioncommission($MemberId,$PackageFee,$txn_id) {
		
		$bal = $this->common_model->Getcusomerbalance($MemberId);
		$txnid = "SUB".rand(1111111,9999999);
		
		$data1 = array(
			'MemberId'	=>	$MemberId,
			'TransactionId'	=>	$txnid,
			'DateAdded'	=>	$date,
			'PaymentReferenceId'	=>	$txn_id,
			'Description'	=> "Member Subscription using Perfectmoney id ".$txn_id,
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

		elseif($mlsetting->Id==9){
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
				$payer_account = $this->data['payee_account'];
				$PassPhrase = $this->data['payer_password'];
				//list of payouts
				$payouts = $this->input->post('payouts');

				$recipients_address = '';
				foreach ($payouts as $key => $value) {
					// geting withdraw info
					$paymentdetail = $this->common_model->GetRow("HistoryId='".$value."'","arm_history");
					// geting user details
					$memberdetail = $this->common_model->GetCustomer($paymentdetail->MemberId);
					// geting user bitcoin address
					$membercustoms = json_decode($memberdetail->CustomFields);

					// check user have payout id
					if($membercustoms->perfectmoney) {

						$login_id = $this->data['PaymentMerchantApi'];
						$payee_account = $membercustoms->perfectmoney;
						$payment_amount = $paymentdetail->Debit;
						$recipients_address .= '"'.$membercustoms->bitcoin.'" : '.$paymentdetail->Debit.', ';
						// trying to open URL to process PerfectMoney Spend request
						// echo "<br/>";
						// echo 'https://perfectmoney.is/acct/confirm.asp?AccountID=myaccount&PassPhrase='.$PassPhrase.'&Payer_Account='.$payer_account.'&Payee_Account='.$payee_account.'&Amount='.$payment_amount;
						$f=fopen('https://perfectmoney.is/acct/confirm.asp?AccountID='.$login_id.'&PassPhrase='.$PassPhrase.'&Payer_Account='.$payer_account.'&Payee_Account='.$payee_account.'&Amount='.$payment_amount, 'rb');

						if($f===false){
						   echo 'error openning url';
						}

						// getting data
						$out=array(); $out="";
						while(!feof($f)) $out.=fgets($f);

						fclose($f);

						// searching for hidden fields
						if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){
						   echo 'Ivalid output';
						   exit;
						}

						$ar="";
						foreach($result as $item){
						   $key=$item[1];
						   $ar[$key]=$item[2];
						}

						$data1	=	array(
							'TypeId'	=>	'8',
							'Description' => json_encode($ar)
						);
						
						$condition="HistoryId='".$value."'";
						$result = $this->common_model->UpdateRecord($data1,$condition,"arm_history");

					}
				}
				if($result) {
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/withdraw');
				} else {
					$this->session->set_flashdata('success_message',ucwords("payment error code ".json_encode($ar)));
					redirect('admin/withdraw');
				}
				
			} else {
				redirect('admin/withdraw');
			}
		}
	}


}
?>