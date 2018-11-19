<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payza extends CI_Controller {

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
 	


			$this->data['ap_alerturl'] = base_url().'payment/payza/status';
			$this->data['ap_returnurl'] = base_url().'payment/payza/success';
			$this->data['ap_cancelurl'] = base_url().'payment/payza/cancel';
			$this->data['payza'] = $this->paymentsetting_model->Getfielddata(3);
			$this->data['ap_merchant'] = $this->data['payza']->PaymentMerchantId;
			$this->data['payza_security'] = $this->data['payza']->PaymentMerchantKey;

			if($this->data['payza']->PaymentMode==1)
				$this->data['paymentUrl'] = $this->data['payza']->PaymentLiveUrl;
			else
				$this->data['paymentUrl'] = $this->data['payza']->PaymentTestUrl;

			$currency_condition = "Status='1'";
			$this->data['currency_setting'] = $this->common_model->GetRow($currency_condition,'arm_currency');
			$this->data['ap_currency'] = $this->data['currency_setting']->CurrencyCode;

			$this->lang->load('payment/payment',$this->session->userdata('language'));
			// load language
			// $this->lang->load('payment/payza');
		// } else {
		// 	redirect('user/shop');
		// }		

	}

	public function index() {
		
	    // $this->data['ap_itemcode'] = $this->session->userdata('MemberID');

		if($this->session->userdata('MemberID')) {
			$this->data['ap_cus1'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));	
		} else {
			$this->data['ap_cus1'] = $this->session->userdata('guest');
		}
		
		$this->data['carts'] = $this->cart->contents();
		$this->data['payza'] = $this->paymentsetting_model->Getfielddata(3);

		$shipping_rates = $this->session->userdata('shipping');
	    $shipping = $shipping_rates['shipping_rates'];
	    
	    if($this->session->userdata('cart_discount') && $this->cart->total_items() > 0) {

	      	$cart_discount_data = $this->session->userdata('cart_discount');
	      	$dicount = $cart_discount_data['discount'];
	      	$vat = $this->cart->total() * (17.5 / 100 );
        	$grand_total = $vat + $shipping - $dicount;
        	$grand_total1 = $grand_total + $this->cart->total();
	      // $coupon_code = $cart_discount_data['discount'];

	    } else {

	      	$dicount = '0.00';
	      	$vat = $this->cart->total() * (17.5 / 100 );
        	$grand_total = $vat + $shipping - $dicount;
        	$grand_total1 = $grand_total + $this->cart->total();
	      
	    }

	    $this->data['ap_description'] = 'cart';
	    $this->data['ap_purchasetype'] = "Item";

	    // $this->data['ap_itemname'] = $grand_total1;
	    // $this->data['ap_quantity'] = $grand_total1;
	    // $this->data['ap_itemcode'] = $grand_total1;
	    
	    
	    $this->data['ap_amount'] = $grand_total1;

		$this->load->view('payment/payza',$this->data);
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

	    $this->data['ap_amount'] = $this->data['packagedetails']->PackageFee;
	      $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	       $this->data['max_amount'] = $this->data['packagedetails']->max_amount;

	    $this->data['ap_description'] = 'register';
	    $this->data['ap_purchasetype'] = "service";

	    $this->data['ap_itemname'] = $this->data['packagedetails']->PackageName;
	    $this->data['ap_itemcode'] = $this->data['packagedetails']->PackageId;
	    $this->data['ap_cus1'] = $this->session->userdata('free_mem_id');
	    $this->data['register'] = 1;
	    
	   
		$this->load->view('payment/payza',$this->data);
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

	    $this->data['ap_amount'] = $this->data['packagedetails']->PackageFee;
	      $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	       $this->data['max_amount'] = $this->data['packagedetails']->max_amount;

	    $this->data['ap_description'] = 'subscription';
	    $this->data['ap_purchasetype'] = "service";

	    $this->data['ap_itemname'] = $this->data['packagedetails']->PackageName;
	    $this->data['ap_itemcode'] = $this->data['packagedetails']->PackageId;
	    $this->data['ap_cus1'] = $this->session->userdata('sub_mem_id');
	    $this->data['subscription'] = 1;
	    
	   
		$this->load->view('payment/payza',$this->data);
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

		$this->data['ap_description'] = 'upgrade';
	    $this->data['ap_purchasetype'] = "service";

	    $this->data['ap_amount'] = $this->data['packagedetails']->PackageFee;
	      $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	       $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['ap_itemname'] = $this->data['packagedetails']->PackageName;
	    $this->data['ap_itemcode'] = $this->data['packagedetails']->PackageId;
	    $this->data['ap_cus1'] = $this->session->userdata('MemberID');
	    
	   	$this->data['upgrade'] = '1';
		$this->load->view('payment/payza',$this->data);
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
	    $this->data['epins'] = '1';
	    $this->data['epincount'] = $this->input->post('epincount');
	    $this->data['packageamount'] = $this->data['packagedetails']->PackageFee;
	      $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	       $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;

	    $this->data['ap_description'] = 'epin';
	    $this->data['ap_purchasetype'] = "Item";

	    $this->data['ap_amount'] = $this->input->post('totalamount');
	    $this->data['ap_itemname'] = $this->data['packagedetails']->PackageName;
	    $this->data['ap_itemcode'] = $this->data['packagedetails']->PackageId;
	    $this->data['ap_cus1'] = $this->session->userdata('MemberID');
	    $this->data['ap_cus2'] = $this->input->post('epincount');
	    $this->data['ap_cus3'] = $this->data['packagedetails']->PackageFee;
	    
	   
		$this->load->view('payment/payza',$this->data);
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

			$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
			if($mlsetting->Id==4)
				$table = "arm_pv";
			elseif($mlsetting->Id==9)
			$table = "arm_hyip";
			elseif($mlsetting->Id==5) 
				$table = "arm_boardplan";
			else
				$table='arm_package';

			if (isset($_POST['ap_securitycode']) && ($_POST['ap_securitycode'] == $this->data['payza_security'])) {

				if($_POST['ap_description']=='register') { 
					$packageId = $_POST['ap_itemcode'];
					$PackageFee = $_POST['ap_amount'];
					$memberId = $_POST['ap_cus1'];
					$condition = "PackageId='".$packageId."'";
					$packagedetails = $this->common_model->GetRow($condition,$table);

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
				if($_POST['ap_description']=='deposit') { 
					$packageId = $_POST['ap_itemcode'];
					$PackageFee = $_POST['ap_amount'];
					$memberId = $_POST['ap_cus1'];
					$condition = "PackageId='".$packageId."'";
					$packagedetails = $this->common_model->GetRow($condition,$table);

					if($PackageFee==$packagedetails->PackageFee) {
						$condition1 = "MemberId='".$memberId."' AND PackageId='".$packageId."'";
						$data = array(
							'MemberId' => $memberId,
							'MemberStatus' => 'Active'
						);
						$result = $this->common_model->UpdateRecord($data,$condition1,'arm_members');
						if($result){
							$this->depositcommission($memberId);
							$this->data['message'] = 'Deposit successfully.';
							$this->load->view('user/success', $this->data);
						}
					}
				}

				if($_POST['ap_description']=='upgrade') { 
					$packageId = $_POST['ap_itemcode'];
					$PackageFee = $_POST['ap_amount'];
					$memberId = $_POST['ap_cus1'];
					$condition = "PackageId='".$packageId."'";
					$packagedetails = $this->common_model->GetRow($condition,$table);

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

				if($_POST['ap_description']=='subscription') { 
					$packageId = $_POST['ap_itemcode'];
					$PackageFee = $_POST['ap_amount'];
					$memberId = $_POST['ap_cus1'];
					$condition = "PackageId='".$packageId."'";
					$packagedetails = $this->common_model->GetRow($condition,$table);

					if($PackageFee==$packagedetails->PackageFee) {
						$condition1 = "MemberId='".$memberId."' AND PackageId='".$packageId."'";
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
						$result = $this->common_model->UpdateRecord($data,$condition1,'arm_members');
						if($result){
							$this->subscriptioncommission($memberId, $PackageFee, $_POST['ap_customeruniqueid']);
							$this->data['message'] = 'Upgrade successfully processed.';
							$this->load->view('user/success', $this->data);
						}
					}
				}

				if($_POST['ap_description']=='epin') {

					$totalamount = $_POST['ap_cus2'] * $_POST['ap_cus3'];

					if($totalamount==$_POST['ap_amount']) {

						$date = date("Y-m-d");
						$date = strtotime(date("Y-m-d", strtotime($date)) . " +6 month");
						$expirydate = date("Y-m-d",$date);
						
						
						for($i=1;$i<=$_POST['ap_cus2'];$i++) {
						
							$randpin = RandomEpins();

							$data = array(
								'EpinPackageId'=>$_POST['ap_itemcode'],
								'EpinAmount'=>$_POST['ap_cus3'],
								'EpinTransactionId'=>$randpin,
								'AllocatedBy'=>$_POST['ap_cus1'],
								'ExpiryDay'=>$expirydate,
								'DateAdded'=>date("Y-m-d H:i:s"),
								'EpinCount'=>'1',
								'EpinStatus'=>'1'
							);
								
							$result = $this->common_model->SaveRecords($data,'arm_epin');
						}
					}
					
				}
				
				if($_POST['ap_description']=='cart') { 

					// shopping cart 
					$this->session->unset_userdata('cart_contents');
					$this->session->unset_userdata('cart_discount');

					$orderid = $_POST['ap_cus1'];
					$condition = "o.OrderId =" . "'" . $orderid . "'";
					$this->data['order'] = $this->order_model->GetOrders($condition);
					$userorder = $this->data['order'];
					$order_total = str_replace(",","",number_format($userorder[0]->OrderTotal,2));
					
					$condition2 = "order_id =" . "'" . $orderid . "'";
					$this->data['cart_total_res'] = $this->common_model->GetResults($condition2,'arm_order_total');

					if($order_total==$_POST['ap_amount']) {
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

//depositcommission
	function depositcommission($depositid) {
		
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

			       $amountuser=$this->common_model->GetRows("MemberId='". $MemberId."'","deposit");
				
				
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
			'Description'	=> "Member Upgrade using payza id ".$txn_id,
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

	// subscription commission
	function subscriptioncommission($MemberId,$PackageFee,$txn_id) {
		
		$bal = $this->common_model->Getcusomerbalance($MemberId);
		$txnid = "SUB".rand(1111111,9999999);
		
		$data1 = array(
			'MemberId'	=>	$MemberId,
			'TransactionId'	=>	$txnid,
			'DateAdded'	=>	$date,
			'PaymentReferenceId'	=>	$txn_id,
			'Description'	=> "Member Subscription using payza id ".$txn_id,
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
				$merchant_id = $this->data['ap_merchant'];
				$PaymentMerchantPassword = $this->data['payza']->PaymentMerchantPassword;
				$PaymentMerchantApi = $this->data['payza']->PaymentMerchantApi;
				$PaymentMerchantKey = $this->data['payza']->PaymentMerchantKey;

				$this->load->library('MassPayClient');
				$payza = new MassPayClient($merchant_id,$PaymentMerchantPassword);

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
					if($membercustoms->payza) {
						
						$payer_amount = str_replace(",","",number_format($paymentdetail->Debit,2));
						$payments[$i]['receiver'] = $membercustoms->payza;
						$payments[$i]['amount'] = $payer_amount;
						$payments[$i]['note'] = 'You Withdraw request is payout';

						$post_data = $payza->buildPostVariables($payments, $this->data['ap_currency']);
				
						$send_payment = $payza->send();
						$payza->parseResponse($send_payment);
						$send_payment1 = $payza->getResponse();
						
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