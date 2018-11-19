<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bitcoin extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
		// Load database
		$this->load->model('user/shop_model');
		$this->load->model('product_model');
		
		$this->load->model('order_model');
		$this->load->model('admin/paymentsetting_model');
		$this->load->helper('epin_helper');
		$this->load->model('MemberCommission_model');
		$this->load->model('Memberboardprocess_model');
		$this->load->model('ProductCommission_model');
			
		$this->data['return'] = base_url().'payment/bitcoin/success';
		$this->data['notify_url'] = base_url().'payment/bitcoin/status';
		$this->data['cancel_return'] = base_url().'payment/bitcoin/cancel';
		$this->data['bitcoin'] = $this->paymentsetting_model->Getfielddata(5);
		$this->data['merchant_id'] = $this->data['bitcoin']->PaymentMerchantId;
		$this->data['secret'] = $this->data['bitcoin']->PaymentMerchantPassword;
		$this->data['public_key'] = $this->data['bitcoin']->PaymentMerchantApi;
		$this->data['private_key'] = $this->data['bitcoin']->PaymentMerchantKey;


		$currency_condition = "Status='1'";
		$this->data['currency_setting'] = $this->common_model->GetRow($currency_condition,'arm_currency');
		$this->data['curr'] = $this->data['currency_setting']->CurrencyCode;

		$this->lang->load('payment/payment',$this->session->userdata('language'));

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
	    $this->data['amount'] = $grand_total1;
	    $this->data['label'] = 'cart';
	   
	  

		
		
		$this->load->view('payment/bitcoin',$this->data);
	}

	public function checkbitcoin()
	{
		$package=$this->input->post('on1');
		$packageid=$this->input->post('ov1');
		$amount=$this->input->post('amount');
		$userid=$this->input->post('item_number');


			$txnid="REG".rand(1111111,9999999);
			$data1 = array(
						'AdminStatus'=>'0',
						'MemberStatus'=>'1',
						'ReceiveBy'=>'1',
						'EntryFor'=>'MTA',
						'Paymentway'=>'Bitcoin',
						'PaymentAmount'=>$amount,
						'PackageId'=>$packageid,
						'MemberId'=>$userid,
						'APaymentAttachemt'=>'',
						'APaymentReference'=>$txnid,
						'DateAdded'=>date('y-m-d H:i:s'));
			$insert1=$this->common_model->SaveRecords($data1,"arm_memberpayment");		

	}

	public function register() {
		$this->data['userdetails'] = $this->common_model->GetCustomer($this->session->userdata('free_mem_id'));

		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==5) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$condition="PackageId='".$this->data['userdetails']->PackageId."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		
	    $this->data['Memberid'] = $this->session->MemberID;
	    if($mlsetting->Id==9)
	    {
	    $this->data['amount1'] = $this->data['packagedetails']->min_amount;
	    $this->data['amount2'] = $this->data['packagedetails']->max_amount;

	    }
	    else
	    {
	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;

	    }
	    $this->data['label'] = 'register';
	    $this->data['register'] = '1';

        $this->data['Memberid'] = ($this->session->userdata('MemberID')) ? $this->session->userdata('MemberID') : $this->session->userdata('userid');
	    
	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
		$this->load->view('payment/bitcoin',$this->data);
	}


	public function subscription() {
		$this->data['userdetails'] = $this->common_model->GetCustomer($this->session->userdata('sub_mem_id'));

		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==5) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$condition="PackageId='".$this->data['userdetails']->PackageId."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		
	    $this->data['Memberid'] = $this->session->userdata('sub_mem_id');
	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;
	    $this->data['label'] = 'subscription';
	    $this->data['subscription'] = '1';
	    
	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
		$this->load->view('payment/bitcoin',$this->data);
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

	     if($mlsetting->Id==9)
	    {
	    $this->data['amount1'] = $this->data['packagedetails']->min_amount;
	    $this->data['amount2'] = $this->data['packagedetails']->max_amount;

	    }
	    else
	    {
	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;

	    }
	    // $this->data['amount'] = $this->data['packagedetails']->PackageFee;
	    $this->data['label'] = 'upgrade';
	    $this->data['upgrade'] = '1';
	    $this->data['Memberid'] = ($this->session->userdata('MemberID')) ? $this->session->userdata('MemberID') : $this->session->userdata('userid');

	    
	   	$this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
		$this->load->view('payment/bitcoin',$this->data);
	}

	public function buyepin() {

		$this->data['Memberid'] = $this->session->userdata('MemberID');
	    $this->data['amount'] = $this->input->post('totalamount');
	    $this->data['label'] = 'epin';
	    $this->data['epins'] = '1';

	    $mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==5) 
			$table = "arm_boardplan";
		else
			$table='arm_package';
		
	    $condition="PackageId='".$this->input->post('package')."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
	    $this->data['epins'] = '1';
	    $this->data['epincount'] = $this->input->post('epincount');
	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['packageamount'] = $this->data['packagedetails']->PackageFee;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
	   
		$this->load->view('payment/bitcoin',$this->data);
	}

	public function deposit() {

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

	    $this->data['m_orderid'] = $this->session->userdata('MemberID');
	    $this->data['m_amount'] = $this->data['packagedetails']->PackageFee;
	  	$this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	    $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['m_desc'] = 'deposit';
	    $this->data['deposit'] = '1';
	    
	   	$this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
		$this->load->view('payment/bitcoin',$this->data);
	}

	public function status() {

		if(isset($_REQUEST) && sizeof($_REQUEST) >0) {

			$data = array(
				'payment' => 'bitcoin',
				'post_content' => json_encode($_REQUEST),
				'datetime' => date('Y-m-d H:i:s')
			);
			$this->db->insert('arm_ipn_process', $data);
    		
    		$order_currency = $this->data['curr'];
    
		    if (isset($_SERVER['HTTP_HMAC']) && !empty($_SERVER['HTTP_HMAC'])) {
		        $request = file_get_contents('php://input');
		        if ($request !== FALSE && !empty($request)) {
		            if (isset($_REQUEST['merchant']) && $_REQUEST['merchant'] == trim($this->data['merchant_id'])) {
		                $hmac = hash_hmac("sha512", $request, trim($this->data['secret']));
		                if ($hmac == $_SERVER['HTTP_HMAC']) {
		                    $auth_ok = true;
		                } else {
		                    $error_msg = 'HMAC signature does not match';
		                }
		            } else {
		            	$error_msg = 'No or incorrect Merchant ID passed';
		        	}
			    } else {
			        $error_msg = 'Error reading POST data';
			    }
			} else {

			   	if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
					if ($_SERVER['PHP_AUTH_USER'] == trim($this->data['merchant_id']) && $_SERVER['PHP_AUTH_PW'] == trim($this->data['secret']) ) {
				    	$auth_ok = true;
				  	} else {
					    $error_msg = "Invalid merchant id/ipn secret".$_SERVER['PHP_AUTH_USER']."<br/> ".$_SERVER['PHP_AUTH_PW'];
					}
				} else {
					$error_msg = "Invalid PHP_AUTH_USER PHP_AUTH_PW".json_encode($_SERVER);
				}

			}

			

			// $auth_ok = true;
			if ($auth_ok) {
			    if ($_REQUEST['ipn_type'] == "button") {
			        if ($_REQUEST['merchant'] == trim($this->data['merchant_id'])) {
			            if ($_REQUEST['currency1'] == $order_currency) {

			                $txn_id = $_REQUEST['txn_id']; 
			                $item_name = $_REQUEST['item_name']; 
			                $item_number = $_REQUEST['item_number']; 
			                $amount1 = floatval($_REQUEST['amount1']); 
			                $amount2 = floatval($_REQUEST['amount2']); 
			                $currency1 = $_REQUEST['currency1']; 
			                $currency2 = $_REQUEST['currency2']; 
			                $status = intval($_REQUEST['status']); 
			                $status_text = $_REQUEST['status_text'];
			                if ($status >= 100 || $status == 2) {

			                	// payment success
			                	$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
								if($mlsetting->Id==4)
									$table = "arm_pv";
								elseif($mlsetting->Id==5) 
									$table = "arm_boardplan";
								else
									$table='arm_package';
							
								if($_REQUEST['item_name']=='epin') {

									$totalamount = $_REQUEST['custom'] * $_REQUEST['quantity'];

									if($totalamount==$amount1) {

										$date = date("Y-m-d");
										$date = strtotime(date("Y-m-d", strtotime($date)) . " +6 month");
										$expirydate = date("Y-m-d",$date);
										
										
										for($i=1;$i<=$_REQUEST['quantity'];$i++) {
										
											$randpin = RandomEpins();

											$data = array(
												'EpinPackageId'=>$_REQUEST['ov1'],
												'EpinAmount'=>$_REQUEST['custom'],
												'EpinTransactionId'=>$randpin,
												'AllocatedBy'=>$_REQUEST['item_number'],
												'ExpiryDay'=>$expirydate,
												'DateAdded'=>date("Y-m-d H:i:s"),
												'EpinCount'=>'1',
												'EpinStatus'=>'1'
											);
												
											$result = $this->common_model->SaveRecords($data,'arm_epin');
										}
									}
									
								}
								if($_REQUEST['item_name']=='upgrade') { 

									$packageId = $_REQUEST['ov1'];
									$PackageFee = $amount1;
									$memberId = $_REQUEST['item_number'];
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
											$this->upgradeComm($memberId,$PackageFee, $_REQUEST['txn_id']);
											$this->data['message'] = 'Upgrade successfully processed.';
											$this->load->view('user/success', $this->data);
										}
									}
									
								}
								if($_REQUEST['item_name']=='subscription') { 

									$packageId = $_REQUEST['ov1'];
									$PackageFee = $amount1;
									$memberId = $_REQUEST['item_number'];
									$condition = "PackageId='".$packageId."'";
									$packagedetails = $this->common_model->GetRow($condition,$table);

									if($PackageFee==$packagedetails->PackageFee) {

										$date = date('y-m-d h:i:s');

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
										$data = array(
											'SubscriptionsStatus'	=>	'Active',
											'MemberStatus'	=>	'Active',
											'ModifiedDate'	=>	$date,
											'EndDate'	=>	$EndDate
										);

										$condition = "MemberId='".$memberId."'";
										$result = $this->common_model->UpdateRecord($data,$condition,'arm_members');
										if($result){
											$this->subscriptioncommission($memberId,$PackageFee, $_REQUEST['txn_id']);
											$this->data['message'] = 'Upgrade successfully processed.';
											$this->load->view('user/success', $this->data);
										}
									}
									
								}
								if($_REQUEST['item_name']=='register') { 
									$error_msg = "insert error";

									$packageId = $_REQUEST['ov1'];
									$PackageFee = $amount1;
									$memberId = $_REQUEST['item_number'];
									$condition = "PackageId='".$packageId."'";
									$packagedetails = $this->common_model->GetRow($condition,$table);

									if($_REQUEST['amount1']==$packagedetails->PackageFee) {
										$condition1 = "MemberId='".$memberId."' AND PackageId='".$packageId."'";
										$data = array(
											'MemberId' => $memberId,
											'MemberStatus' => 'Active'
										);
										$result = $this->common_model->UpdateRecord($data,$condition1,'arm_members');
										$error_msg = "query:".$this->db->last_query();
										if($result){
											/*
											$check=$this->common_model->GetRow('MemberId='.$memberId.'',"arm_memberpayment");
											if($check)
											{
											 	$condition2="MemberId='".$memberId."' AND PackageId='".$packageId."'";
											 	$data1=array('AdminStatus'=>'3');
											 	$result1=$this->common_model->UpdateRecord($data1,$condition2,"arm_memberpayment");
											}*/
											$error_msg .= "reg Coomm:";
											$this->registerCommission($memberId);
											// $this->data['message'] = 'Registration successfully processed.';
											// $this->load->view('user/success', $this->data);
										} else {
											$error_msg .= "insert error";
										}
									} else {
										$error_msg .= "payment amount is differ";
									}

								}

								if($_REQUEST['item_name']=='deposit') { 


						$packageId = $_REQUEST['ap_cus1'];
						$PackageFee = $_REQUEST['amountf'];
						$depositid = $_REQUEST['item_number'];
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
								$this->depositcommission($depositid);
								$this->data['message'] = 'Deposit successfully.';
								$this->load->view('user/success', $this->data);
							// }
						}

					}
								if($_REQUEST['item_name']=='cart') { 
									// shopping cart 
									$orderid = $_REQUEST['custom'];
									$value_in_btc=number_format($_REQUEST['amount1'],2);
									// echo $value_in_btc;
									

									$this->session->unset_userdata('cart_contents');
									$this->session->unset_userdata('cart_discount');
									$condition = "o.OrderId =" . "'" . $orderid . "'";
									$this->data['order'] = $this->order_model->GetOrders($condition);
									$userorder = $this->data['order'];
									$order_total = str_replace(",","",number_format($userorder[0]->OrderTotal,2));
									// echo $order_total;
									
									$condition2 = "order_id =" . "'" . $orderid . "'";
									$this->data['cart_total_res'] = $this->common_model->GetResults($condition2,'arm_order_total');

									if($order_total==$value_in_btc) {
										$condition3 = "OrderId =" . "'" . $orderid . "'";
										$sdata= array( 'Status'=>'paid');
										$this->common_model->UpdateRecord($sdata,$condition3,"arm_order");
										// echo $this->db->last_query();
										// exit;
										$this->ProductCommission_model->check($userorder[0]->MemberId,$orderid);
										$this->data['message'] = 'Your Order successfully processed.';
										$this->load->view('user/success', $this->data);
									} else {
										$this->data['message'] = 'Your Order not success.';
										$this->load->view('user/fail', $this->data);
									}
								}

			                } else if ($status < 0) {
			                    $error_msg = "payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent";
			                } else { 
			                    $error_msg = "payment is pending, you can optionally add a note to the order page";
			                }
			            } else {
			            	$error_msg .= "invalid currency".$order_currency;
			            }
			        } else {
			        	$error_msg .= "invalid merchant".$order_currency;
			        }
			    } else {
			        $error_msg .= "invalid button".$_REQUEST['merchant'];
			    }
			} else {
				$error_msg .= "auth false";
			}

			if($error_msg) {
			    $data = array(

					'payment' => 'bitcoin',
					'post_content' => $error_msg.' '.json_encode($_REQUEST),
					'datetime' => date('Y-m-d H:i:s')
				);
				$ipn=$this->db->insert('arm_ipn_process', $data);
				/*
				if($ipn)
				{
					$status=$_REQUEST['status'];
					$memberid=$_REQUEST['item_number'];
					$packageid=$_REQUEST['ov1'];
					if($status==0)
					{
						$data2=array('AdminStatus'=>5);
						$condition2="MemberId='".$memberid."'AND PackageId='".$packageid."'";
						$update2=$this->common_model->UpdateRecord($data2,$condtion2,"arm_memberpayment");
					}
				}
				*/
			}
			
		} else {
			redirect('user/shop');
		}

	}

	public function success() {

		if(isset($_POST)) {

			$memberId = ($this->session->userdata('MemberID')) ? $this->session->userdata('MemberID') : $this->session->userdata('userid') ;
			$orders = $this->order_model->GetUserOrder($memberId);
		
		} else {
			redirect('user/shop');
		}
	}
	

	public function cancel() {
		$this->data['message'] = 'Your Payment is canceled';
		$this->load->view('user/fail');
	}

	// register commission
	function registerCommission($MemberId) {
		
		$this->Memberboardprocess_model->process($MemberId);

		$condition = "MemberId='".$MemberId."'";
		
		$mdata = array(
			'AdminStatus'	=>	'1'
		);
		$result = $this->common_model->UpdateRecord($mdata,$condition,'arm_memberpayment');

		$data = array(
			'SubscriptionsStatus'	=>	'Active',
			'MemberStatus'	=>	'Active'
		);
		
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
			'Description'	=> "Member Upgrade using Coinpayment id ".$txn_id,
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
			'Description'	=> "Member Subscription using Coinpayment id ".$txn_id,
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

				$recipients_address = '';
				foreach ($payouts as $key => $value) {
					// geting withdraw info
					$paymentdetail = $this->common_model->GetRow("HistoryId='".$value."'","arm_history");
					// geting user details
					$memberdetail = $this->common_model->GetCustomer($paymentdetail->MemberId);
					// geting user bitcoin address
					$membercustoms = json_decode($memberdetail->CustomFields);
					// check user have payout id
					if($membercustoms->bitcoin) {

						$url ='https://blockchain.info/tobtc?currency='.$this->data['curr'].'&value='.$paymentdetail->Debit;
						$content = file_get_contents($url);
						$json = json_decode($content, true);
						$toatalbtc = number_format($json,8);

						$bitcoin = $this->paymentsetting_model->Getfielddata(5);

					    // Set the API command and required fields 
					    $req['version'] = 1; 
					    $req['cmd'] = 'create_withdrawal';
					    $req['key'] = $this->data['public_key']; 
					    $req['amount'] = $toatalbtc;
					    $req['currency'] = 'BTC';
					    $req['address'] = $accountNumber;
					    $req['format'] = 'json';
					     
					    // Generate the query string 
					    $post_data = http_build_query($req, '', '&'); 
					     
					    // Calculate the HMAC signature on the POST data 
					    $hmac = hash_hmac('sha512', $post_data, $this->data['private_key']); 
					     
					    // Create cURL handle and initialize (if needed) 
					    static $ch = NULL; 
					    if ($ch === NULL) { 
					        $ch = curl_init('https://www.coinpayments.net/api.php'); 
					        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); 
					        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
					        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
					    } 
					    curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac)); 
					    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); 
					     
					    // Execute the call and close cURL handle      
					    $data = curl_exec($ch);                 
					    // Parse and return data if successful. 
					    if ($data !== FALSE) { 
					        if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
					            $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING); 
					        } else { 
					            $dec = json_decode($data, TRUE); 
					        } 
					        if ($dec !== NULL && count($dec)) {
						        if($dec['error']=='ok'){
						        	$data1	=	array(
										'TypeId'	=>	'8'
									);
									
									$condition="HistoryId='".$value."'";
									$result = $this->common_model->UpdateRecord($data,$condition,"arm_history");
						        } else {
						        	$data1	=	array(
										'Description' => $dec
									);
									
									$condition="HistoryId='".$value."'";
									$result = $this->common_model->UpdateRecord($data1,$condition,"arm_history");
									return FALSE;
						        	
						        }
					        	
					        } else {
					        	$data1	=	array(
									'Description' => $dec
								);
								
								$condition="HistoryId='".$value."'";
								$result = $this->common_model->UpdateRecord($data1,$condition,"arm_history");
								return FALSE;
					        } 
					    } else { 
					    	$data = array(
								'payment' => 'bitcon',
								'post_content' => json_encode($data),
								'datetime' => date('Y-m-d H:i:s')
							);
							$this->db->insert('arm_ipn_process', $data);
							return FALSE;
					    }
						
					}
				}
				
				if($result) {
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/withdraw');
				} else {
					$this->session->set_flashdata('success_message',ucwords("payment error code ".$message));
					redirect('admin/withdraw');
				}
				
			} else {
				redirect('admin/withdraw');
			}
		}
	}


}
?>