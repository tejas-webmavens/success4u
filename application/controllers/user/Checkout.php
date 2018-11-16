<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// if($this->session->userdata('logged_in')) {
		
			// Load database
			$this->load->model('user/shop_model');
			$this->load->model('product_model');
			
			$this->load->model('order_model');
			$this->load->model('admin/paymentsetting_model');
			// $this->load->model('productcommission_model');
		$this->load->model('ProductCommission_model');



			$currency_condition = "Status='1'";
			$this->data['currency_setting'] = $this->common_model->GetRow($currency_condition,'arm_currency');
			$this->data['x_currency_code'] = $this->data['currency_setting']->CurrencyCode;

			// load language
			$this->lang->load('user/shop');
		// } else {
		// 	redirect('user/shop');
		// }		

	}

	public function index() {

		if($this->cart->total_items() > 0){
			$this->data['ref']=$this->session->ReferalId;
			if($this->data['ref'])
			{
			$this->load->view('user/checkout',$this->data);	

			}
			else
			{
			$this->load->view('user/checkout');	

			}
		} else {
			redirect('user/shop');
		}

	}

	public function login() {

		if($this->input->post()) {
				

				$data = array(
					'username' => $this->input->post('email'),
					'password' => SHA1(SHA1($this->input->post('password')))
				);


				$result = $this->common_model->registerlogin($data);
				 // echo $this->db->last_query();
				 // exit;

				if ($result) {
					$array = array(
						"logged_in" => TRUE,
						"full_name" => $result->FirstName.' '.$result->MiddleName.''.$result->LastName,
						"MemberID" => $result->MemberId,
						"Email" => $result->Email,
						"admin_login" => FALSE
					);
					// exit;

				
					$this->session->set_userdata($array);


					$json['success'] = 'Success! Login';


					 $json['redirect'] = "user/dashboard";

					// echo json_encode($json);
					// redirect('user/checkout');
					
				} 

				else {
					$json['error'] = 'Failed! Login';
				}

				echo json_encode($json);
			
			// $this->data['post'] = $this->input->post();
			// $this->load->view('user/checkout/login',$this->data);	
		}
		 else {
			$this->load->view('user/checkout/login');	

		}
	}

	public function payment_address() {
		
		$this->data['country'] = $this->common_model->GetCountry();
		$this->data['addresses'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
		$this->load->view('user/checkout/payment_address',$this->data);	
	}

	public function register() {
		
		$ref=$this->session->ReferalId;
		 // echo $ref;
		
		if($this->input->post()) {

			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[arm_members.Email]|xss_clean');
			// $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[arm_members.UserName]|min_length[5]|max_length[16]|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[16]|matches[confirmPassword]|xss_clean');
			$this->form_validation->set_rules('confirmPassword', 'confirmPassword', 'trim|required|min_length[6]|max_length[16]|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean|min_length[10]|max_length[13]');
			$this->form_validation->set_rules('country', 'country', 'trim|required|xss_clean');

			if ($this->form_validation->run() == TRUE) {

				$data = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					// 'username' => $this->input->post('username'),
					'password' => SHA1(SHA1($this->input->post('password'))),
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'phone' => $this->input->post('phone'),
					'Country' => $this->input->post('country'),
					'DateAdded' =>  date('Y-m-d h:i:s'),
					'Ip' => $this->input->ip_address(),
					
				);
				if($ref)
				{
					$check=$this->common_model->GetRow("UserName='".$ref."'","arm_members");
					$data['DirectId']=$check->MemberId;

				}
				else
				{
					$data['DirectId']='0';
				}

				

				$status = $this->common_model->SaveRecords($data, 'arm_members');
			     
			     

				if($status){
					$json['success'] = 'success Registration';
					// $this->session->set_flashdata('success_message', 'Success! User details Updated');
					// redirect('admin/customers');
				} else {
					$json['error'] = 'Failed Registration';
					// $this->session->set_flashdata('error_message', 'Failed! User details not Updated');
					// $this->load->view('admin/addcustomer');		
				}
				echo json_encode($json);
			} else {
				$this->load->view('user/checkout');
			}
		} else {
			$data['country'] = $this->common_model->GetCountry();
			$this->load->view('user/checkout/register',$data);
		}
	}

	public function guest() {
		// $ref=$this->session->ReferalId;

		if($this->input->post()) {
			$checkdirect=$this->common_model->GetRow('UserName='.$this->input->post('referal').'',"arm_members");


			$data = array(
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'password' => SHA1(SHA1($this->input->post('password'))),
				'address' => $this->input->post('address'),
				'city' => $this->input->post('city'),
				'phone' => $this->input->post('phone'),
				'Country' => $this->input->post('country'),
				'DateAdded' =>  date('Y-m-d h:i:s'),
				'DirectId'=>$checkdirect->MemberId,
				'Ip' => $this->input->ip_address(),
				
			);
			// $data['DirectId']=$checkdirect->MemberId;
		
			$status = $this->session->set_userdata('guest',$data);
				// $status = $this->common_model->SaveRecords($data, 'arm_members');

			if($status){
				$json['success'] = 'success guest checkout';
				// $this->session->set_flashdata('success_message', 'Success! User details Updated');
				// redirect('admin/customers');
			} else {
				$json['error'] = 'Failed guest checkout';
				// $this->session->set_flashdata('error_message', 'Failed! User details not Updated');
				// $this->load->view('admin/addcustomer');		
			}
			echo json_encode($json);
			
		} else {
			$data['country'] = $this->common_model->GetCountry();
			$data['ref']=$this->session->ReferalId;
			$this->load->view('user/checkout/guest',$data);
		}

		
	}

	public function shipping() {
		$this->session->unset_userdata('shippingaddress');
		if($this->input->post()) {
			if($this->input->post('payment_address')=='new') {
				$tooo = array(
			        "FirstName"    => $this->input->post('firstname'),
			        "LastName"	=>	$this->input->post('lastname'),
			    	"Address" => $this->input->post('address'),
			    	"City"    => $this->input->post('city'),
			    	"State"   => $this->input->post('state'),
			    	"Country"     => $this->input->post('country'),
			    	"zip"     => $this->input->post('zip'),
			    	"Phone"     => $this->input->post('phone')
			    );
			    $this->session->set_userdata('shippingaddress',$tooo);
			}
			$this->load->library('easy/EasyPost');
			
			$easypost_api = New EasyPost();

			if($this->input->post('firstname')) {
 				$ship_datas = $easypost_api->Calc($this->input->post());

			} else {
				
				$customers = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
				$data = array(
					
					'firstname' => $customers->FirstName,
					'lastname' => $customers->LastName,
					'email' => $customers->Email,
					'phone' => $customers->Phone,
					'address' => ($customers->Address) ? $customers->Address : '',
					'city' => ($customers->City) ? $customers->City : '',
					'zip' => ($customers->Zip) ? $customers->Zip : '',
					'state' => ($customers->State) ? $customers->State : '',
					'country' => ($customers->Country) ? $customers->Country : ''
				);
				$ship_datas = $easypost_api->Calc($data);
				
			}
			
 			if($ship_datas) { 
 				
 				// foreach ($ship_datas as $row) { 
 				// 	$ship_rate[]['id'] = $row->id;
 				// 	$ship_rate[]['carrier'] = $row->carrier;
 				// 	$ship_rate[]['rate'] = $row->rate;
 				// 	$ship_rate[]['list_rate'] = $row->list_rate;
 				// 	$ship_rate[]['delivery_days'] = $row->delivery_days;
 				// 	$ship_rate[]['list_rate'] = $row->list_rate;
 				// }
 				 $this->data['shipping_api'] = $ship_datas;

 				$condition = "Country =" . "'" . $this->input->post('country') . "'";
				$check= $this->common_model->GetRow($condition, 'arm_shipping','Rates,FastDelivery');	
				// echo $this->db->last_query();
				if($check!="")
				{
					$this->data['shipping']=$check;
				}
				else
				{
					$this->data['shipp']='freeshipping';
				}



 			} else {
 				$condition = "Country =" . "'" . $this->input->post('country') . "'";
				$this->data['shipping'] = $this->common_model->GetRow($condition, 'arm_shipping','Rates,FastDelivery');	
				// print_r($this->data['shipping']);exit;
 			}

			
			// echo $this->db->last_query();
			$this->load->view('user/checkout/shipping',$this->data);
		} else {
			$this->load->view('user/checkout/shipping');
		}
	}

	public function checkuser() {

		// $ref=$this->input->post('ReferalId')
		$ref=$this->session->ReferalId;
		$str = $this->input->post('email');

		if(valid_email($str))
			$condition = "Email =" . "'" . $str . "'";
		else
			$condition = "UserName =" . "'" . $str . "'";
		
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);

		$query = $this->db->get();
		if ($query->num_rows()>0) {
			$json['error'] = 'E-Mail Address is already registered!';
		} else {
			// print_r($this->input->post());
			$data = array(
				'FirstName' => $this->input->post('firstname'),
				'LastName' => $this->input->post('lastname'),
				'Email' => $this->input->post('email'),
				'MemberStatus' => 'Active',
				// 'username' => $this->input->post('username'),
				'Password' => SHA1(SHA1($this->input->post('password'))),
				'Phone' => $this->input->post('phone'),
				'Address' => $this->input->post('address'),
				'City' => $this->input->post('city'),
				'Zip' => $this->input->post('zip'),
				'State' => $this->input->post('state'),
				'Country' => $this->input->post('country'),
				'UserType' => '3',
				'DateAdded' =>  date('Y-m-d h:i:s'),
				'Ip' => $this->input->ip_address()
				// 'DirectId' => $sponsor->MemberId
			);
			if($ref)
			{
				 $checkdirect=$this->common_model->GetRow("UserName='".$ref."'","arm_members");
				$direct_id=$checkdirect->MemberId;
				$data['DirectId']=$direct_id;
			}
			else
			{
				$data['DirectId']='0';
			}

			$this->session->set_userdata('register',$data);
			
			if($this->session->userdata('register')) {
				//$json['regid'] = $insert_id;
				$json['success'] = 'User not available';
			}
			else {
				$json['error'] = 'guest user';
			}

			// $status = $this->common_model->SaveRecords($data, 'arm_members');
			// if($status) {
			// 	$insert_id = $this->db->insert_id();
			// 	$this->session->set_userdata('MemberID',$insert_id);
			// 	$json['Memberid'] = $insert_id;
			// 	$json['success'] = 'Register Success!';
			// }
			// else 
			// 	$json['error'] = 'Register Fail!';
			// $json['success'] = 'User not available';
		}
		echo json_encode($json);
	}

	public function checkguestuser() {
		$this->load->library('session');
		$str = $this->input->post('email');

		if(valid_email($str))
			$condition = "Email =" . "'" . $str . "'";
		else
			$condition = "UserName =" . "'" . $str . "'";
		
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);

		$query = $this->db->get();
		if ($query->num_rows()>0) {
			$json['error'] = 'E-Mail Address is already registered!';
		} else {
			$checkdirect=$this->common_model->GetRow("UserName='".$this->input->post('referal')."'","arm_members");

			// print_r($this->input->post());
			$data = array(
				'FirstName' => $this->input->post('firstname'),
				'LastName' => $this->input->post('lastname'),
				'Email' => $this->input->post('email'),
				'Phone' => $this->input->post('phone'),
				'Address' => $this->input->post('address'),
				'City' => $this->input->post('city'),
				'Zip' => $this->input->post('zip'),
				'State' => $this->input->post('state'),
				'Country' => $this->input->post('country'),
				'DirectId'=>$checkdirect->MemberId,
				'Ip' => $this->input->ip_address()
			);
			
			$this->session->set_userdata('guest',$data);
			
			if($this->session->userdata('guest')) {
				$this->session->unset_userdata('MemberID');
				$json['success'] = 'User not available';
			}
			else {
				$json['error'] = 'guest user';
			}
			
		}
		echo json_encode($json);
	}

	public function payment_method() {

		if($this->input->post('payment_method')) {

			$json['method'] = $this->input->post('payment_method');

			// switch ($this->input->post('payment_method')) {
			// 	case 'paypalcart':
			// 		$json['method'] = 'paypal';
			// 		break;
			// 	case 'codcart':
			// 		$json['method'] = 'cod';
			// 		break;
			// 	case 'bitcoin':
			// 		$json['method'] = 'bitcoin';
			// 		break;
			// 	default:
			// 		$json['error'] = 'Fail Method not available';
			// 		break;
			// }
			echo json_encode($json);
		} else {
			$this->data['paymentdetails'] = $this->paymentsetting_model->Getpaymentdetails();
			$this->load->view('user/checkout/payment_method',$this->data);
		}
		

		// if($this->input->post('payment_method')=='paypal') {

		// 	$json['success'] = 'payment method selected';

		// 	echo json_encode($json);
		// 	// $this->load->view('user/checkout/payment_method');

		// } else {
		// 	$this->load->view('user/checkout/payment_method');
		// }
	}
	

	public function conform() {

		if($this->session->userdata('MemberID'))
		 {
		 	$paymentmode=$this->input->post('payment_method');
		 	// exit;
			$customers = $this->common_model->GetCustomer($this->session->userdata('MemberID'));

			if($paymentmode=='AccountBalance')
			{
		 	 	$bal=$this->common_model->Getcusomerbalance($this->session->userdata('MemberID'));
	
			 	 	$totalamount=$this->cart->total();
			 	 	$total=$totalamount;
				     $customers = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
	
	
			 	 	// if($bal >= $total)
			 	 	// {
			 	 		$data = array(
	
						'OrderNumber' => "OD".random_string('numeric', 10),
						'MemberId' => $customers->MemberId,
						'FirstName' => $customers->FirstName,
						'LastName' => $customers->LastName,
						'Email' => $customers->Email,
						'Phone' => $customers->Phone,
						'Address1' => ($customers->Address) ? $customers->Address : '',
						'City' => ($customers->City) ? $customers->City : '',
						'Zip' => ($customers->Zip) ? $customers->Zip : '',
						'State' => ($customers->State) ? $customers->State : '',
	
						'Country' => ($customers->Country) ? $customers->Country : '',
						'PaymentMethod' => $this->input->post('payment_method'),
						// 'Status' => 'paid',
						'DateAdded' =>  date('Y-m-d h:i:s')
					);
	
		 	 // }
		 	 // else
		 	 // {
		 	 // 	$this->session->set_flashdata('error_message',"Sorry Your Account Balance Low Please Use Another Payment Way for Product Purchase");
		 	 // }


			}
			else
			{
					$data = array(
	
						'OrderNumber' => "OD".random_string('numeric', 10),
						'MemberId' => $customers->MemberId,
						'FirstName' => $customers->FirstName,
						'LastName' => $customers->LastName,
						'Email' => $customers->Email,
						'Phone' => $customers->Phone,
						'Address1' => ($customers->Address) ? $customers->Address : '',
						'City' => ($customers->City) ? $customers->City : '',
						'Zip' => ($customers->Zip) ? $customers->Zip : '',
						'State' => ($customers->State) ? $customers->State : '',
						'Country' => ($customers->Country) ? $customers->Country : '',
						'PaymentMethod' => $this->input->post('payment_method'),
						'Status' => '1',
					    'DateAdded' =>  date('Y-m-d h:i:s')
					);

			}


			$ship_address = $this->session->userdata('shippingaddress');
			
			if($this->session->userdata('shippingaddress')) {
				
				$data['ShipFirstName'] = ($ship_address['FirstName']) ? $ship_address['FirstName'] : $customers->FirstName;
				$data['ShipLastName'] = ($ship_address['LastName']) ? $ship_address['LastName'] : $customers->LastName;
				$data['ShipPhone'] = ($ship_address['Phone']) ? $ship_address['Phone'] : $customers->Phone;
				$data['ShipAddress1'] = ($ship_address['Address']) ? $ship_address['Address'] : $customers->Address;
				$data['ShipCity'] = ($ship_address['City']) ? $ship_address['City'] : $customers->City;
				$data['ShipState'] = ($ship_address['State']) ? $customers->State : $customers->State;
				$data['ShipCountry'] = ($ship_address['Country']) ? $ship_address['Country'] : $customers->Country;
					
			}

			$member_id = $this->session->userdata('MemberID');


		} 
		else
		 {
			if($this->session->userdata('register')) 
			{
				$customers = $this->session->userdata('register');
				// $subscriptiontype=$this->common_model->GetRow("KeyValue='subscriptiontype' AND Page='usersetting'","arm_setting");
				// if($subscriptiontype->ContentValue=='monthly')
				// {
				// 	$period=30;
				// }
				// else
				// {
				// 	$period=365;
				// }
				


				$reg_data = array(
					'FirstName' => $customers['FirstName'],
					'LastName' => $customers['LastName'],
					'Email' => $customers['Email'],
					'Phone' => $customers['Phone'],
					'Address' => $customers['Address'],
					'City' => $customers['City'],
					'Zip' => $customers['Zip'],
					'State' => $customers['State'],
					'Country' => $customers['Country'],
					'MemberStatus' => 'Free',
                 	'Password' => $customers['Password'],
					'UserType' => '2',
					'DateAdded' =>  date('Y-m-d h:i:s'),
					'Ip' => $customers['Ip'],
					'DirectId'=>$customers['DirectId'],
					 // 'PackageId'=>'1',
					 // 'StartDate'=>date('Y-m-d h:i:s'),
					 // 'EndDate'=>
				);
				// $endate = strtotime("+".$period." day", strtotime(date('Y-m-d h:i:s')));
				// $reg_data['EndDate']=date('Y-m-d H:i:s ', $endate);
				
				
				
				$status = $this->common_model->SaveRecords($reg_data, 'arm_members');
				
				

			}
			else
			 {
				$customers = $this->session->userdata('guest');
				
				$guest_data = array(
					'FirstName' => $customers['FirstName'],
					'LastName' => $customers['LastName'],
					'Email' => $customers['Email'],
					'Phone' => $customers['Phone'],
					'Address' => $customers['Address'],
					'City' => $customers['City'],
					'Zip' => $customers['Zip'],
					'State' => $customers['State'],
					'Country' => $customers['Country'],
					'MemberStatus' => 'guest',
					'DirectId'=>$customers['DirectId'],
					'UserType' => '4',
					'DateAdded' =>  date('Y-m-d h:i:s'),
					'Ip' => $customers['Ip']
				);
				
				$status = $this->common_model->SaveRecords($guest_data, 'arm_members');
				// print_r($status);
				// echo "<br>";
				// exit;
				
			}

				if($status)
			  	 {
					$member_id = $this->db->insert_id();
					$this->session->set_userdata('userid',$member_id);

				}
			// $total=$this->cart->total();
			

				$data = array(

				'OrderNumber' => "OD".random_string('numeric', 10),
				'MemberId' => $member_id,
				'FirstName' => $customers['FirstName'],
				'LastName' => $customers['LastName'],
				'Email' => $customers['Email'],
				'Phone' => $customers['Phone'],
				'Address1' => $customers['Address'],
				'City' => $customers['City'],
				'Zip' => $customers['Zip'],
				'State' => $customers['State'],
				'Country' => $customers['Country'],
				'PaymentMethod' => $this->input->post('payment_method'),
				'ShipFirstName' => $customers['FirstName'],
				'ShipLastName' => $customers['LastName'],
				'ShipPhone' => $customers['Phone'],
				'ShipAddress1' => $customers['Address'],
				'ShipCity' => $customers['City'],
				'ShipZip' => $customers['Zip'],
				'ShipState' => $customers['State'],
				'ShipCountry' => $customers['Country'],
				'Status' => '1',
				'DateAdded' =>  date('Y-m-d h:i:s')
			);
		}

		$order_status = $this->common_model->SaveRecords($data, 'arm_order');
		

		if($order_status)
			$OrderId = $this->db->insert_id();
				
		     $order_total = 0;

		if($this->cart->contents())
		 {
			
			$products = $this->cart->contents();
			
			// $products = $this->input->post('order_product');
			foreach($products as $product) 
			{

				$product_data = array(
					'OrderId' => $OrderId,
					'ProductId' => str_replace('CIP_', '', $product['id']),
					'ProductName' => $product['name'],
					'Quantity' => $product['qty'],
					'Price' => $product['price'],
					'Total' => $product['subtotal']
				);
				// print_r($product_data);

				$product_status = $this->common_model->SaveRecords($product_data, 'arm_order_product');
				
			}
			$shipping_rates = $this->session->userdata('shipping');
			$shipping = $shipping_rates['shipping_rates'];
			if($product_status) 
			{

			    if($this->session->userdata('cart_discount') && $this->cart->total_items() > 0)
			     {
			      $cart_discount_data = $this->session->userdata('cart_discount');
			      $dicount = $cart_discount_data['discount'];
			      // $shipping = $this->session->userdata('shipping');

			      $vat = $this->cart->total() * (17.5 / 100 );
			      $grand_total = $vat + $shipping - $dicount;
			      $grand_total1 = $this->cart->total() + $grand_total;

			      $coupon_code = $cart_discount_data['discount'];

			    } 
			    else 
			    {
			      $dicount = '0.00';
			      // $shipping = '2.00';
			      // $shipping = $this->session->userdata('shipping');
			      $vat = $this->cart->total() * (17.5 / 100 );
			      $grand_total = $vat + $shipping - $dicount;
			      $grand_total1 = $this->cart->total() + $grand_total;
			    }

				$data1 = array(
					'order_id' => $OrderId,
					'code' => 'sub_total',
					'title' => 'Sub total',
					'value' => $this->cart->total(),
					'sort_order' => '0'
				);
				$this->common_model->SaveRecords($data1, 'arm_order_total');

				$data2 = array(
					'order_id' => $OrderId,
					'code' => 'shipping_cost',
					'title' => 'Shipping cost',
					'value' => $shipping,
					'sort_order' => '1'
				);
				$this->common_model->SaveRecords($data2, 'arm_order_total');

				$data3 = array(
					'order_id' => $OrderId,
					'code' => 'discount',
					'title' => 'Discount',
					'value' => $dicount,
					'sort_order' => '2'
				);
				$this->common_model->SaveRecords($data3, 'arm_order_total');

				$data4 = array(
					'order_id' => $OrderId,
					'code' => 'vat',
					'title' => 'VAT',
					'value' => $vat,
					'sort_order' => '3'
				);
				$this->common_model->SaveRecords($data4, 'arm_order_total');

				$data5 = array(
					'order_id' => $OrderId,
					'code' => 'order_total',
					'title' => 'Total',
					'value' => $grand_total1,
					'sort_order' => '4'
				);
				$this->common_model->SaveRecords($data5, 'arm_order_total');
				

				$order_total_data = array(
					'OrderId' => $OrderId,
					'OrderTotal' => $grand_total1,
				);

				$condition = "OrderId=".$OrderId;
				$update=$this->common_model->UpdateRecord($order_total_data, $condition, 'arm_order');
				if($update)
				{
					$checkpayment=$this->common_model->GetRow('OrderId='.$OrderId.'',"arm_order");
					$payment=$checkpayment->PaymentMethod;
					$totalamt=$checkpayment->OrderTotal;	
					if($payment=='AccountBalance')
					{
							
						$userid=$this->session->MemberID;
						
						$bal = $this->common_model->Getcusomerbalance($userid);
						 $orderamount=$checkpayment->OrderTotal;
						 if($bal >= $orderamount)
						 {

							$debit=$bal-$totalamt;
	
				    		$trnid = 'ORP'.rand(1111111,9999999);
							$date = date('y-m-d h:i:s');
							$data = array(
							'MemberId'=>$userid,
							'Credit'=>'0.00',
							'Debit'=>$totalamt,		
							'Description'=>'Debit Balance For  Product Purchase',
							'TransactionId'=>$trnid,
							'TypeId'=>'26',
							'Balance'=>$debit,
							'DateAdded'=>$date
						     );
	
							$userhis = $this->common_model->SaveRecords($data,'arm_history');
						if($userhis)
						{
							$data1=array('Status'=>'paid');
							$condi="OrderId='".$OrderId."'";

							$updatestatus=$this->common_model->UpdateRecord($data1,$condi,"arm_order");
							 $con="OrderId='".$OrderId."' ORDER BY Id DESC";

							 $ordercount=$this->common_model->GetRowCount($con,"arm_order_product");
							 // echo $this->db->last_query();
							 $checkproduct=$this->common_model->GetResults($con,"arm_order_product");
							foreach ($checkproduct as $key => $value)
								 {
										
									$checkcount=$this->common_model->GetRow('ProductId='.$value->ProductId.'',"arm_product");
									
										$count=$checkcount->Quantity;

										$data=array('Quantity'=>$count-$value->Quantity);
										$con="ProductId='".$value->ProductId."'";
										$update=$this->common_model->UpdateRecord($data,$con,"arm_product");
										

										if($update)
										{
											$checkstackstatus=$this->common_model->GetRow('ProductId='.$value->ProductId.'',"arm_product");
									

											if($checkstackstatus->Quantity==0)
											{
												$data1=array('StockStatusId'=>'0');
												$updatstack=$this->common_model->UpdateRecord($data1,$con,"arm_product");
											}
										}

								}


						$commission=$this->ProductCommission_model->check($userid,$OrderId);
						// echo "<br>";
						$data=array('CommissionStatus'=>'1');
						$con="OrderId='".$OrderId."'";
						$update=$this->common_model->UpdateRecord($data,$con,"arm_order");		


						$this->session->set_flashdata('success_message',"Successfully Purchase");
						$this->session->unset_userdata('cart_contents');
						$this->session->unset_userdata('cart_discount');
						}
						// else
						// {
						// 	$this->session->set_flashdata('error_message',"Sorry Your Account Balance Low Please Use Another Payment Way for Product Purchase");
						// }	
					 }
						else
						{
							$this->session->set_flashdata('error_message',"Sorry Your Account Balance Low Please Use Another Payment Way for Product Purchase");
						}				


		 		}
						 // exit;

		}

				
				if($order_status) {
					switch (strtolower($this->input->post('payment_method'))) {
						case 'cod':
							$json['field'] = '<input type="hidden" name="custom" value="'.$member_id.', '.$OrderId.'"/>';
							break;
						case 'AccountBalance':
							$json['field'] = '<input type="hidden" name="custom" value="'.$member_id.','.$OrderId.'"/>';
							break;

						case 'paypal':
							$json['field'] = '<input type="hidden" name="custom" value="'.$member_id.', '.$OrderId.'"/>';
							break;
						case 'payza':
							$json['field'] = '<input type="hidden" name="ap_cus1" value="'.$OrderId.'"/>';
							break;
						case 'bitcoin':
							$json['field'] = '<input type="hidden" name="custom" value="'.$OrderId.'"/>';
							break;
						case 'payeer':
							$json['field'] = '<input type="hidden" name="custom" value="'.$member_id.', '.$OrderId.'"/>';
							break;
						case 'perfectmoney':
							$json['field'] = '<input type="hidden" name="custom" value="'.$member_id.', '.$OrderId.'"/>';
							break;
						case 'okpay':
							$json['field'] = '<input type="hidden" name="custom" value="'.$member_id.', '.$OrderId.'"/>';
							break;
						case 'authorizenetsim':
							
							$authorizenetsim = $this->paymentsetting_model->Getpaymentdata($this->input->post('payment_method'));
							$x_login = $authorizenetsim->PaymentMerchantId;
							$x_key = $authorizenetsim->PaymentMerchantKey;
							
							$x_fp_hash1 = hash_hmac('md5', $x_login . '^' . $OrderId . '^' . time() . '^' . number_format($grand_total1,2) . '^' . $this->data['x_currency_code'], $x_key);
							$json['field'] = '<input type="hidden" value="'.$OrderId.'" name="x_fp_sequence"><input type="hidden" value="'.time().'" name="x_fp_timestamp" /><input type="hidden" name="x_cust_id" value="'.$OrderId.'"/><input type="hidden" name="x_fp_hash" value="'.$x_fp_hash1.'"/>';
							break;

						
					}
					$json['success'] = 'process is success';

					// $this->session->set_flashdata('Success',"Su")
					
				} else {
					$json['error'] = 'process is failed';
					
				}
				echo json_encode($json);
			}
		}
		
	}

	public function country($country_id) {

		$json = array();

		$condition = "country_id =" . "'" . $country_id . "'";
		$zones = $this->common_model->GetResults($condition, 'arm_zone');
		$select = '<option value="0"> -- Select Zone -- </option>';
		foreach ($zones as $row) { 
			$select .= '<option value="'.$row->code.'">'.$row->name.'</option>';
		}
		echo $select;
	}

	public function invoice() {
		$OrderId = '14';
		$condition = "o.OrderId =" . "'" . $OrderId . "'";
		$this->data['order'] = $this->order_model->GetOrders($condition);
		$this->load->view('user/invoice', $this->data);
		// $this->load->view('user/invoice');
	}





public function check_bal($str)
	{
		echo $str;

		// $totalamount=$this->cart->;
		$total=$this->cart->total();
		$userid=$this->session->MemberID;
		$bal=$this->common_model->Getcusomerbalance($userid);

		echo $total;
		exit;

			if($bal >= $total)
			{
				return true;
			}
			else
			{
			$this->form_validation->set_message('balance_check',ucwords($this->lang->line('errorbalance')));
			return false;
	}

	
}

}
?>
