<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bitcoin extends CI_Controller {

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
		$this->load->model('admin/Smtpsetting_model');

 			
			
			$this->data['bitcoin'] = $this->paymentsetting_model->Getfielddata(5);
			$this->data['guid']	=	$this->data['bitcoin']->PaymentMerchantId;
			$this->data['main_password']	=	$this->data['bitcoin']->PaymentMerchantPassword;
			$this->data['second_password'] = $this->data['bitcoin']->PaymentMerchantKey;

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
		$this->data['amount'] = $grand_total1;
		$this->data['label'] = 'cart';
		
		$this->load->view('payment/bitcoin',$this->data);
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
	    $this->data['orderid'] = $this->session->userdata('free_mem_id');
	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;
	    $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	    $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['label'] = 'register';
		$this->data['Memberid'] = $this->data['userdetails']->MemberId;

	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
	    
		$this->load->view('payment/bitcoin',$this->data);
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
	    $this->data['orderid'] = $this->session->userdata('sub_mem_id');
	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;
	    $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	    $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['label'] = 'subscription';
	    $this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
	    
		$this->load->view('payment/bitcoin',$this->data);
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
		$this->data['upgrade'] = '1';
	    $this->data['orderid'] = $this->session->userdata('MemberID');
	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;
	    $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	    $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['label'] = 'upgrade';
	   	$this->data['packageid'] = $this->data['packagedetails']->PackageId;
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
		$this->data['deposit'] = '1';
	    $this->data['orderid'] = $this->session->userdata('MemberID');
	    $this->data['amount'] = $this->data['packagedetails']->PackageFee;
	    $this->data['min_amount'] = $this->data['packagedetails']->min_amount;
	    $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
	    $this->data['label'] = 'deposit';
	   	$this->data['packageid'] = $this->data['packagedetails']->PackageId;
	    $this->data['package'] = $this->data['packagedetails']->PackageName;
		$this->load->view('payment/bitcoin',$this->data);
	}

	public function buyepin() {

		$this->data['orderid'] = $this->session->userdata('MemberID');
	    $this->data['amount'] = $this->input->post('totalamount');
	    $this->data['label'] = 'buyepin';

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
	   
		$this->load->view('payment/bitcoin',$this->data);
	}

	// create bitcoin address
	public function confirmbitcoin() {

		
		if($this->input->post()) {

			if($this->input->post('custom')) {
				$custom_data = explode(', ', $this->input->post('custom'));
				$memberId = $custom_data[0];
				$orderId = $custom_data[1];
			} else {
				// $memberId = $this->session->userdata('MemberID') ;	
				$memberId = $this->input->post('user') ;	
			}
			
			// $to = $this->data['bitcoin']->PaymentMerchantApi;
			$amount = number_format($this->input->post('amount'),2);
						$lbl_name = $this->input->post('label');
						$add ="payment";


			// $guid = $this->data['guid'];
			// $main_password = $this->data['main_password'];
			// $second_password = $this->data['second_password'];
			// $lbl_name = $this->input->post('label');

			// $json_url = "https://blockchain.info/merchant/$guid/new_address?password=$main_password&second_password=$second_password&label=$lbl_name&amount=$amount";

			// $ch = curl_init();
			// curl_setopt($ch,CURLOPT_URL,$json_url);
			// curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			// $json_data=curl_exec($ch);
			// curl_close($ch);
			
			
			// $json_data = file_get_contents($json_url);
				
			// $json_feed = json_decode($json_data);
			// if($json_feed) {
			// 	$add = '';
			// 	foreach($json_feed as $key=>$value)
			// 	{
			// 		$add.= $value.',';
			// 	}
			// 	$ex = explode(',',$add);
			// 	$address = $ex[0];
			$this->data['bitcoin'] = $this->paymentsetting_model->Getfielddata(5);
			$guid =	$this->data['bitcoin']->PaymentMerchantId;
			$address = $guid;
				switch ($lbl_name) {
					case 'cart':
						$data = array(
							'CustomField' => $address
						);
						$condition = "OrderId =" . "'" . $orderId . "'";
						$this->common_model->UpdateRecord($data, $condition, 'arm_order');

						$data = array(
							'address' => $address,
							'UserId' => $memberId,
							'Total' => $amount,
							'label' => 'cart',
							'post_content' => $add
						);
						
						$this->common_model->SaveRecords($data, 'arm_bitcoin_data');

						$mempack = $this->common_model->GetRow("MemberId='".$memberId."'","arm_members");
						$txnid = "PAY".rand(1111111,9999999);
						$data1 = array(
						'AdminStatus'=>'0',
						'MemberStatus'=>'1',
						'ReceiveBy'=>'1',
						'EntryFor'=>'MTP',
						'PaymentAmount'=>$amount,
						'PackageId'=>$mempack->PackageId,
						'MemberId'=>$memberId,
						'APaymentAttachemt'=>'',
						'APaymentReference'=>$txnid,
						'DateAdded'=>date('y-m-d H:i:s'));
						$mtmresult = $this->common_model->SaveRecords($data1,"arm_memberpayment");

						$this->data['message'] = 'This is your bitcoin address to final step for payment.';
						$this->data['address'] = $address;

						// $this->data['carts'] = $this->cart->contents();
						// $shipping_rates = $this->session->userdata('shipping');
					 //    $shipping = $shipping_rates['shipping_rates'];
					    
					    
					 //    if($this->session->userdata('cart_discount') && $this->cart->total_items() > 0) {

					 //      	$cart_discount_data = $this->session->userdata('cart_discount');
						//     $dicount = $cart_discount_data['discount'];
					 //    	$vat = $this->cart->total() * (17.5 / 100 );
				  //       	$grand_total = $vat + $shipping - $dicount;
				  //       	$grand_total1 = $grand_total + $this->cart->total();

					 //    } else {

					 //      	$dicount = '0.00';
					 //      	$vat = $this->cart->total() * (17.5 / 100 );
					     
				  //       	$grand_total = $vat + $shipping - $dicount;
				  //       	$grand_total1 = $grand_total + $this->cart->total();
					      
					 //    }
						// $this->data['amount'] = $grand_total1;
						// $this->data['label'] = 'cart';

						$smtpstatus = $this->Smtpsetting_model->Getdata('smtpstatus');
						$smtpmail = $this->Smtpsetting_model->Getdata('smtpmail');
						$smtppassword = $this->Smtpsetting_model->Getdata('smtppassword');
						$smtpport = $this->Smtpsetting_model->Getdata('smtpport');
						$smtphost = $this->Smtpsetting_model->Getdata('smtphost');
						$maillimit = $this->Smtpsetting_model->Getdata('mail_limit');

						$config = array();
						$config['protocol'] 		= "sendmail";
					    $config['useragent']        = "CodeIgniter";
					    $config['mailpath']         = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
					    $config['protocol']         = "smtp";
					    $config['smtp_host']        = $smtphost;
					    $config['smtp_port']        = $smtpport;
					    $config['mailtype'] 		= 'html';
					    $config['charset']  		= 'utf-8';
					    $config['newline']  		= "\r\n";
					    $config['wordwrap'] 		= TRUE;
						// $this->email->initialize($config);
						$this->email->clear(TRUE);
                        
                        $message = $this->common_model->GetRow("Page='order'","arm_emailtemplate");
						$site = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'","arm_setting");
			   		
					   	$emailcont = urldecode($message->EmailContent);
				   		$user_name = $this->common_model->GetRow("MemberId='".$memberId."'","arm_members");

					   		
				   		$logo = '<img src="'.base_url().$site->ContentValue.'">'; 
				   		$emailcont = str_replace('[LOGO]', $logo, $emailcont);
				   	$emailcont = str_replace('[FIRSTNAME]', $user_name->UserName, $emailcont);
				   	$emailcont = str_replace('[MESSAGE]', $this->data['message'], $emailcont);
				   	$emailcont = str_replace('[ADDRESS]', $this->data['address'], $emailcont);

				   		$adminid = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='adminmailid'","arm_setting");
				   	$this->email->from($smtpmail, 'TBCMONEY');
				   	$this->email->to($user_name->Email);
					$this->email->subject($message->EmailSubject);
					$body =
							'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
							<html xmlns="http://www.w3.org/1999/xhtml">
							<head>
							    <meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
							    <title>Register Member Details</title>
							    <style type="text/css">
							        body {
							            font-family: Arial, Verdana, Helvetica, sans-serif;
							            font-size: 16px;
							        }
							    </style>
							</head>
							<body><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
							'.$emailcont.'
							</body>
							</html>';

							
			    	$this->email->message($body);    
					$this->email->set_mailtype("html");
				
			    	$Mail_status = $this->email->send();

						$this->load->view('user/payment_confirm', $this->data);
						break;
					case 'epin':
						$data = array(
							'address' => $address,
							'UserId' => $memberId,
							'Total' => $amount,
							'label' => 'epin',
							'post_content' => $add
						);
						
						$this->common_model->SaveRecords($data, 'arm_bitcoin_data');

						$mempack = $this->common_model->GetRow("MemberId='".$memberId."'","arm_members");
						$txnid = "EPI".rand(1111111,9999999);
						$data1 = array(
						'AdminStatus'=>'0',
						'MemberStatus'=>'1',
						'ReceiveBy'=>'1',
						'EntryFor'=>'MTA',
						'PaymentAmount'=>$amount,
						'PackageId'=>$mempack->PackageId,
						'MemberId'=>$memberId,
						'APaymentAttachemt'=>'',
						'APaymentReference'=>$txnid,
						'DateAdded'=>date('y-m-d H:i:s'));
						$mtmresult = $this->common_model->SaveRecords($data1,"arm_memberpayment");

						$this->data['message'] = 'This is you bitcoin address to final step for payment.';
						$this->data['address'] = $address;
						$this->load->view('user/payment_confirm', $this->data);
						break;
					case 'register':
						$data = array(
							'address' => $address,
							'UserId' => $memberId,
							'Total' => $amount,
							'label' => 'register',
							'post_content' => $add
						);
						
						$this->common_model->SaveRecords($data, 'arm_bitcoin_data');
                        
                        $mempack = $this->common_model->GetRow("MemberId='".$memberId."'","arm_members");
						$txnid = "REG".rand(1111111,9999999);
						$data1 = array(
						'AdminStatus'=>'0',
						'MemberStatus'=>'1',
						'ReceiveBy'=>'1',
						'EntryFor'=>'MTA',
						'PaymentAmount'=>$amount,
						'PackageId'=>$mempack->PackageId,
						'MemberId'=>$memberId,
						'APaymentAttachemt'=>'',
						'APaymentReference'=>$txnid,
						'DateAdded'=>date('y-m-d H:i:s'));
						$mtmresult = $this->common_model->SaveRecords($data1,"arm_memberpayment");
						$this->data['message'] = 'This is you bitcoin address to final step for payment.';
						$this->data['address'] = $address;
						$this->load->view('user/payment_confirm', $this->data);
						break;
					case 'subscription':
						$data = array(
							'address' => $address,
							'UserId' => $memberId,
							'Total' => $amount,
							'label' => 'subscription',
							'post_content' => $add
						);
						
						$this->common_model->SaveRecords($data, 'arm_bitcoin_data');

						$mempack = $this->common_model->GetRow("MemberId='".$memberId."'","arm_members");
						$txnid = "SUB".rand(1111111,9999999);
						$data1 = array(
						'AdminStatus'=>'0',
						'MemberStatus'=>'1',
						'ReceiveBy'=>'1',
						'EntryFor'=>'MTAS',
						'PaymentAmount'=>$amount,
						'PackageId'=>$mempack->PackageId,
						'MemberId'=>$memberId,
						'APaymentAttachemt'=>'',
						'APaymentReference'=>$txnid,
						'DateAdded'=>date('y-m-d H:i:s'));
						$mtmresult = $this->common_model->SaveRecords($data1,"arm_memberpayment");

						$this->data['message'] = 'This is you bitcoin address to final step for payment.';
						$this->data['address'] = $address;
						$this->load->view('user/payment_confirm', $this->data);
						break;
					case 'upgrade':
						$data = array(
							'address' => $address,
							'UserId' => $memberId,
							'Total' => $amount,
							'label' => 'register',
							'post_content' => $add
						);
						
						$this->common_model->SaveRecords($data, 'arm_bitcoin_data');

						$mempack = $this->common_model->GetRow("MemberId='".$memberId."'","arm_members");
						$txnid = "UPG".rand(1111111,9999999);
						$data1 = array(
						'AdminStatus'=>'0',
						'MemberStatus'=>'1',
						'ReceiveBy'=>'1',
						'EntryFor'=>'MTAU',
						'PaymentAmount'=>$amount,
						'PackageId'=>$mempack->PackageId,
						'MemberId'=>$memberId,
						'APaymentAttachemt'=>'',
						'APaymentReference'=>$txnid,
						'DateAdded'=>date('y-m-d H:i:s'));
						$mtmresult = $this->common_model->SaveRecords($data1,"arm_memberpayment");
						$this->data['message'] = 'This is you bitcoin address to final step for payment.';
						$this->data['address'] = $address;
						$this->load->view('user/payment_confirm', $this->data);
						break;
				}
			// } else {
			// 	$this->data['message'] = 'This is you bitcoin address not generated pease try some other time.';
			// 	$this->load->view('user/fail');
			// }
			
		} else {
			// $this->data['message'] = 'This is you bitcoin address to final step for payment.';
			// $this->data['address'] = '1Aqtk3uyYka6XUc4SFe7xqSWkTeyxba949';
			// $this->load->view('user/success', $this->data);
			redirect('user/shop');
		}

	}

	// mass payouts
	public function masspayouts() {

		// check admin login
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {

			// check payouts checked
			if($this->input->post('payouts')!='')
			{
				//list of payouts
				$payouts = $this->input->post('payouts');

				$guid = $this->data['guid'];
				$main_password = $this->data['main_password'];
				$second_password = $this->data['second_password'];

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

						// multi user payout
						// $recipients_address .= '"'.$membercustoms->bitcoin.'" : '.$paymentdetail->Debit.', ';

						// single user payout
						$recipients_address = '"'.$membercustoms->bitcoin.'" : '.$paymentdetail->Debit;
						$recipients = urlencode('{'.$recipients_address.'}');

						$json_url = "https://blockchain.info/merchant/$guid/sendmany?password=$main_password&second_password=$second_password&recipients=$recipients";

						$json_data = file_get_contents($json_url);

						$json_feed = json_decode($json_data);

						if($json_feed) {
							
							$message = $json_feed->message;
							$txid = $json_feed->tx_hash;
							
							if($txid) {
								$data1	=	array(
									'TypeId'	=>	'8',
									'PaymentReferenceId' => $txid
								);
								
								$condition="HistoryId='".$value."'";
								$result = $this->common_model->UpdateRecord($data1,$condition,"arm_history");
							}

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
				
				// multi user payout
				// $recipients = urlencode('{'.rtrim($recipients_address,', ').'}');

				// $json_url = "https://blockchain.info/merchant/$guid/sendmany?password=$main_password&second_password=$second_password&recipients=$recipients";

				// $json_data = file_get_contents($json_url);

				// $json_feed = json_decode($json_data);

				// if($json_feed) {
					
				// 	$message = $json_feed->message;
				// 	$txid = $json_feed->tx_hash;
					
				// 	if($txid) {
				// 		$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
				// 		redirect('admin/withdraw');
				// 	} else {
				// 		$this->session->set_flashdata('success_message',ucwords("payment error code ".$message));
				// 		redirect('admin/withdraw');
				// 	}

				// } 
				
			} else {
				redirect('admin/withdraw');
			}
		}
	}


	public function success() {
		//192.168.2.13/ARMCIdP/payment/bitcoin/success?address=1EAyQA3BBu5PqLRapeTGpekp843MBndJYM
		if(isset($_GET) && sizeof($_GET) >0 ) {
			$transaction_hash = $_GET['transaction_hash'];
			$value_in_btc 	  = $_GET['value'] / 100000000;
			$address 		  = $_GET['address'];
			$label 			  = $_GET['label'];
			$confirmations	  = $_GET['confirmations'];
			$trans_hash	 	  = $_GET['transaction_hash'];

			$condition = "address='".$address."'";
			$bitcoin_data = $this->common_model->GetRow($condition, 'arm_bitcoin_data');

			$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
				if($mlsetting->Id==4)
					$table = "arm_pv";
				elseif($mlsetting->Id==5) 
					$table = "arm_boardplan";
				else
					$table='arm_package';
			
			$user_address = $bitcoin_data->address;
			$userid = $bitcoin_data->UserId;
			$orderid = $bitcoin_data->OrderId;
			$label = $bitcoin_data->label;

			if($label=='upgrade') { 
				$packageId = $orderid;
				$PackageFee = $value_in_btc;
				$memberId = $userid;
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
						$this->upgradeComm($memberId,$PackageFee, $_POST['txn_id']);
						$this->data['message'] = 'Upgrade successfully processed.';
						$this->load->view('user/success', $this->data);
					}
				}
			}
			if($label=='register') { 
				$packageId = $orderid;
				$PackageFee = $value_in_btc;
				$memberId = $userid;
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
			if($label=='subscription') { 
				$packageId = $orderid;
				$PackageFee = $value_in_btc;
				$memberId = $userid;
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
						'SubscriptionsStatus' => 'Active',
						'MemberStatus' => 'Active',
						'EndDate'=>$EndDate
					);
					$result = $this->common_model->UpdateRecord($data,$condition1,'arm_members');
					if($result){
						$this->subscriptioncommission($memberId,$PackageFee,$_POST['txn_id']);
						$this->data['message'] = 'subscription successfully processed.';
						$this->load->view('user/success', $this->data);
					}
				}
			}
			
			if($label=='cart') {
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
				$table = "arm_binaryhyip";
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
			'Description'	=> "Member Upgrade using bitcoin id ".$txn_id,
			'Credit'	=>	$PackageFee,
			'Debit'	=>	$PackageFee,
			'Balance'	=>	$bal,
			'paythrough'=>'Ewallet',
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

	function subscriptioncommission($MemberId,$PackageFee,$txn_id) {
		
		$bal = $this->common_model->Getcusomerbalance($MemberId);
		$txnid = "SUB".rand(1111111,9999999);
		
		$data1 = array(
			'MemberId'	=>	$MemberId,
			'TransactionId'	=>	$txnid,
			'DateAdded'	=>	$date,
			'PaymentReferenceId'	=>	$txn_id,
			'Description'	=> "Member Subscription using bitcoin id ".$txn_id,
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


}
?>