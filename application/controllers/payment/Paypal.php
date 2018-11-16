<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paypal extends CI_Controller {

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
 			

			$this->data['return'] = base_url().'payment/paypal/success';
			$this->data['notify_url'] = base_url().'payment/paypal/ipn';
			$this->data['cancel_return'] = base_url().'payment/paypal/cancel';

			$this->data['paypal'] = $this->paymentsetting_model->Getfielddata(2);
			$this->data['merchant'] = $this->data['paypal']->PaymentMerchantId;
			if($this->data['paypal']->PaymentMode==1)
				$this->data['paymentUrl'] = $this->data['paypal']->PaymentLiveUrl;
			else
				$this->data['paymentUrl'] = $this->data['paypal']->PaymentTestUrl;
			
			$currency_condition = "Status='1'";
			$this->data['currency_setting'] = $this->common_model->GetRow($currency_condition,'arm_currency');
			$this->data['currency'] = $this->data['currency_setting']->CurrencyCode;

			// load language
			// $this->lang->load('payment/paypal');
			$this->lang->load('payment/payment',$this->session->userdata('language'));
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
			$guestuser = $this->session->userdata('guest');
			$this->data['FirstName'] = $guestuser['FirstName'];
			$this->data['LastName'] = $guestuser['LastName'];
			$this->data['Address'] = $guestuser['Address'];
			$this->data['City'] = $guestuser['City'];
			$this->data['Zip'] = $guestuser['Zip'];
			$this->data['Country'] = $guestuser['Country'];
			$this->data['Email'] = $guestuser['Email'];
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
		$this->data['amount'] = $grand_total1;
		
		$this->load->view('payment/paypal',$this->data);
	}

	public function register() {

		if($this->session->userdata('free_mem_id')) {
			$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('free_mem_id'));
			$this->data['FirstName'] = $this->data['user']->FirstName;
			$this->data['LastName'] = $this->data['user']->LastName;
			$this->data['Address'] = $this->data['user']->Address;
			$this->data['City'] = $this->data['user']->City;
			$this->data['Zip'] = $this->data['user']->Zip;
			$this->data['Country'] = $this->data['user']->Country;
			$this->data['Email'] = $this->data['user']->Email;
			$this->data['Memberid'] = $this->data['user']->MemberId;
			$this->data['PackageId'] = $this->data['user']->PackageId;

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



		$condition="PackageId='".$this->data['PackageId']."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		$this->data['register'] = '1';
	    $this->data['orderid'] = $this->session->userdata('free_mem_id');
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
	    $this->data['label'] = 'register';
	    
	    
		$this->load->view('payment/paypal',$this->data);
	}

	public function subscription() {

		if($this->session->userdata('sub_mem_id')) {
			$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('sub_mem_id'));
			$this->data['FirstName'] = $this->data['user']->FirstName;
			$this->data['LastName'] = $this->data['user']->LastName;
			$this->data['Address'] = $this->data['user']->Address;
			$this->data['City'] = $this->data['user']->City;
			$this->data['Zip'] = $this->data['user']->Zip;
			$this->data['Country'] = $this->data['user']->Country;
			$this->data['Email'] = $this->data['user']->Email;
			$this->data['Memberid'] = $this->data['user']->MemberId;
			$this->data['PackageId'] = $this->data['user']->PackageId;

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

		$condition="PackageId='".$this->data['PackageId']."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		$this->data['subscription'] = '1';
	    $this->data['orderid'] = $this->session->userdata('sub_mem_id');
	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;
	    // $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	    // $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
	    $this->data['label'] = 'subscription';
	    
	    
		$this->load->view('payment/paypal',$this->data);
	}

	public function upgrade() {

		if($this->session->userdata('MemberID')) {
			$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
			$this->data['FirstName'] = $this->data['user']->FirstName;
			$this->data['LastName'] = $this->data['user']->LastName;
			$this->data['Address'] = $this->data['user']->Address;
			$this->data['City'] = $this->data['user']->City;
			$this->data['Zip'] = $this->data['user']->Zip;
			$this->data['Country'] = $this->data['user']->Country;
			$this->data['Email'] = $this->data['user']->Email;
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
		$this->data['upgrade'] = '1';
	    // $this->data['orderid'] = $this->session->userdata('MemberID');
	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;
	    // $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	    // $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
	    $this->data['label'] = 'upgrade';
	   
		$this->load->view('payment/paypal',$this->data);
	}


public function deposit() {

		if($this->session->userdata('MemberID')) {
			$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
			$this->data['FirstName'] = $this->data['user']->FirstName;
			$this->data['LastName'] = $this->data['user']->LastName;
			$this->data['Address'] = $this->data['user']->Address;
			$this->data['City'] = $this->data['user']->City;
			$this->data['Zip'] = $this->data['user']->Zip;
			$this->data['Country'] = $this->data['user']->Country;
			$this->data['Email'] = $this->data['user']->Email;
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
		$this->data['deposit'] = '1';
	    // $this->data['orderid'] = $this->session->userdata('MemberID');
	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;
	    $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	    $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
	    $this->data['label'] = 'deposit';
	   
		$this->load->view('payment/paypal',$this->data);
	}

	public function buyepin() {

		if($this->session->userdata('MemberID')) {
			$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
			$this->data['FirstName'] = $this->data['user']->FirstName;
			$this->data['LastName'] = $this->data['user']->LastName;
			$this->data['Address'] = $this->data['user']->Address;
			$this->data['City'] = $this->data['user']->City;
			$this->data['Zip'] = $this->data['user']->Zip;
			$this->data['Country'] = $this->data['user']->Country;
			$this->data['Email'] = $this->data['user']->Email;
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

	    $this->data['itemcode'] = $this->session->userdata('MemberID');
	    $this->data['amount'] = $this->input->post('totalamount');

	    $condition="PackageId='".$this->input->post('package')."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
	    $this->data['epins'] = '1';
	    $this->data['epincount'] = $this->input->post('epincount');
	    $this->data['packageamount'] = $this->data['packagedetails']->PackageFee;
	    // $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	    // $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['label'] = 'buyepins';
	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
	   
		$this->load->view('payment/paypal',$this->data);
	}

	public function success() {
		
		if(isset($_POST) && sizeof($_POST) > 0) {
			print_r($_POST);
			
			
			if($_POST['payment_status']=='Completed') {
				$pos = strpos($_POST['custom'], ',');
				if ($pos === false)  {
					$memberId = $_POST['custom'];
				}
				else {
					$custom_data = explode(', ', $_POST['custom']);
					$memberId = $custom_data[0];
					$orderId = $custom_data[1];
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

				if(isset($_POST['option_selection1'])) {
					switch ($_POST['option_selection1']) {
						case 'register':
							// member registration
						// print_r($_POST);
							$packageId = $_POST['option_name1'];
							// $PackageFee = $_POST['option_name2'];

							$condition = "PackageId='".$packageId."'";
							$packagedetails = $this->common_model->GetRow($condition,$table);

							if($_POST['mc_gross']==$packagedetails->PackageFee) {
								$condition1 = "MemberId='".$memberId."' AND PackageId='".$packageId."'";
								$data = array(
									'MemberId' => $memberId,
									'MemberStatus' => 'Active'
									// 'PackageId'	=> $_POST['option_name1'],
									// 'SubscriptionsStatus' => 'Active'
								);
								$result = $this->common_model->UpdateRecord($data, $condition1, 'arm_members');
								if($result){
									$this->registerCommission($memberId);
									$this->data['message'] = 'Registration successfully processed.';
									$this->load->view('user/success', $this->data);
								}
								else
									echo "not update member";
							}
							break;
						case 'upgrade':
							// member upgrade
							$packageId = $_POST['option_name1'];
							$PackageFee = $_POST['mc_gross'];

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
							break;
							case 'deposit':
							// member registration
						// print_r($_POST);
							$packageId = $_POST['option_name1'];
							// $PackageFee = $_POST['option_name2'];
							$depositid=$_POST['custom'];
							$amount=$_POST['amount'];

							

							if($amount) {
								
									$this->depositcommission($depositid);
									$this->data['message'] = 'Deposit successfully.';
									$this->load->view('user/success', $this->data);
								}
								
							
							break;
						case 'subscription':
							// member upgrade
							$packageId = $_POST['option_name1'];
							$PackageFee = $_POST['mc_gross'];

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
									$this->subscriptioncommission($memberId,$PackageFee, $_POST['txn_id']);
									$this->data['message'] = 'Subscription successfully processed.';
									$this->load->view('user/success', $this->data);
								}
							}
							
							break;
						case 'buyepins':
							// buyepins
							$date = date("Y-m-d");
							$date = strtotime(date("Y-m-d", strtotime($date)) . " +6 month");
							$expirydate = date("Y-m-d",$date);
							
							for($i=1;$i<=$_POST['option_name3'];$i++) {
							
								$randpin = RandomEpins();

								$data = array(
									'EpinPackageId'	=>	$_POST['option_name1'],
									'EpinAmount'	=>	$_POST['option_name4'],
									'EpinTransactionId'	=>	$randpin,
									'AllocatedBy'	=>	$memberId,
									'ExpiryDay'		=>	$expirydate,
									'DateAdded'		=>	date("Y-m-d H:i:s"),
									'EpinCount'		=>	'1',
									'EpinStatus'	=>	'1'
								);
									
								$result = $this->common_model->SaveRecords($data,'arm_epin');
							}
							break;
					}
				} else {

					// shopping cart 
					$this->session->unset_userdata('cart_contents');
					$this->session->unset_userdata('cart_discount');
					$condition = "o.OrderId =" . "'" . $orderId . "'";
					$this->data['order'] = $this->order_model->GetOrders($condition);
					$userorder = $this->data['order'];
					$order_total = str_replace(",","",number_format($userorder[0]->OrderTotal,2));
					
					$condition2 = "order_id =" . "'" . $orderId . "'";
					$this->data['cart_total_res'] = $this->common_model->GetResults($condition2,'arm_order_total');

					if($order_total==$_POST['mc_gross'] && $_POST['payment_status']=='Completed') {
						// $this->load->view('user/invoice', $this->data);
							$condition3 = "OrderId =" . "'" . $orderId . "'";
							$sdata= array( 'Status'=>'paid');
							$this->common_model->UpdateRecord($sdata,$condition3,"arm_order");
							$this->ProductCommission_model->check($userorder[0]->MemberId,$orderId);
						$this->data['message'] = 'Your Order successfully processed.';
						$this->load->view('user/success', $this->data);
					} else {
						// echo "shopping cart";
						$this->data['message'] = 'Your Order not success.';
						$this->load->view('user/fail', $this->data);
						// $this->load->view('user/fail');
					}
				}
			} else {
				$this->data['message'] = 'Your Order failed please contact support team.';
				$this->load->view('user/fail');
			}
		
		} else {
			redirect('user/shop');
		}

	}

	public function ipn() {
		echo "ipn";
		print_r($_POST);

	}


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

			      $amountuser=$this->common_model->GetRows("id='". $depositid."'","deposit");
				
				
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
			'DateAdded'	=>	date('Y-m-d H:i:s'),
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
		// $MemberId = $memberid;

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
			$table = "arm_binaryhyip";
		}

		$commision_status = $this->MemberCommission_model->process($MemberId,$table,$field);
		if($commision_status)
			return true;
		else
			return false;
	}

	// upgrade commission
	function subscriptioncommission($MemberId,$PackageFee,$txn_id) {
		
		$bal = $this->common_model->Getcusomerbalance($MemberId);
		$txnid = "SUB".rand(1111111,9999999);
		
		$data1 = array(
			'MemberId'	=>	$MemberId,
			'TransactionId'	=>	$txnid,
			'DateAdded'	=>	date('Y-m-d H:i:s'),
			'PaymentReferenceId'	=>	$txn_id,
			'Description'	=> "Member Subscription using paypal id ".$txn_id,
			'Credit'	=>	$PackageFee,
			'Debit'	=>	$PackageFee,
			'Balance'	=>	$bal,
			'TypeId'	=>	"19"
		);

		$result1 = $this->common_model->SaveRecords($data1,'arm_history');
	
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
		$field = "MemberId";
		// $MemberId = $memberid;

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
			$table = "arm_binaryhyip";
		}

		$commision_status = $this->MemberCommission_model->process($MemberId,$table,$field);
		if($commision_status)
			return true;
		else
			return false;
	}

	public function cancel() {
		$this->data['message'] = 'Your Payment is canceled';
		$this->load->view('user/fail');
	}

	// mass payouts
	public function masspayouts() {

		// check admin login
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {

			// check payouts checked
			if($this->input->post('payouts')!='')
			{
				$merchant_id = $this->data['merchant'];
				$PaymentMerchantPassword = $this->data['paypal']->PaymentMerchantPassword;
				$PaymentMerchantApi = $this->data['paypal']->PaymentMerchantApi;
				$PaymentMerchantKey = $this->data['paypal']->PaymentMerchantKey;

				$this->load->library('PaypalApi');
				$paypal = new PaypalApi($PaymentMerchantApi, $PaymentMerchantPassword, $PaymentMerchantKey);

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
					if($membercustoms->paypal) {
						$payer_amount = str_replace(",","",number_format($paymentdetail->Debit,2));

						$send_payment = $paypal->pay($membercustoms->paypal, $payer_amount, "You Withdraw request is payout");
						// print_r($send_payment);
						
						if("SUCCESS" == strtoupper($send_payment["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($send_payment["ACK"])) {
							
							$data1	=	array(
								'TypeId'	=>	'8',
								'PaymentReferenceId' => $send_payment['CORRELATIONID']
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