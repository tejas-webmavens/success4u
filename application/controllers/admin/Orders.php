<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct() {
		parent::__construct();

		//$this->load->helper('url');

		// Load form helper library
		//$this->load->helper('form');
		
		// Load database
		
		$this->load->model('product_model');
		$this->load->model('order_model');
		$this->load->model('ProductCommission_model');
 			
		// change language
		//$this->config->set_item('language', 'spanish');

		// load language
		$this->lang->load('orders');

	}

	public function index()
	{
 		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {

			$condition = '';
			$tableName = 'arm_order';
			//$this->data['users'] = $this->common_model->GetCustomers();
			// $this->data['orders'] = $this->common_model->GetResults($condition,$tableName,'*');
			$this->data['orders'] = $this->order_model->GetOrders();
			$this->data['category'] = $this->product_model->GetCategory();
			$this->load->view('admin/products/orders',$this->data);
	    } else {
	    	redirect('admin/login');

	    }	
	}

	public function search(){
		
		if($this->input->post()) 
		{
			// print_r($this->input->post());

			$condition = "isDelete='0'";

			if($this->input->post('username'))
				//$url .= '&FirstName=' . $this->input->post('firstname');
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

			//$condition = "o.OrderId =" . "'" . $OrderId . "'";
			$this->data['orders'] = $this->order_model->GetOrdersList($condition);
			
			//print_r($this->data['orders']);
			// $this->data['orders'] = $this->order_model->GetOrders();
			
			
			$this->load->view('admin/products/orders', $this->data);
			
		} else {
			//$this->session->set_flashdata('error_message', 'Enter field value to search');
			redirect('admin/orders');
		}
	}

	public function add($OrderId=''){
		

		if($this->input->post()) {

			if($this->input->post('OrderId')) {
				
				$data = array(
					
					'Status' => $this->input->post('order_status'),
					'Comment' => urlencode($this->input->post('comment')),
					'ModifiedDate' => date('Y-m-d h:i:s')
				);
				
				$condition = "OrderId=".$this->input->post('OrderId');
				$status = $this->common_model->UpdateRecord($data, $condition, 'arm_order');
				

				if($status){
					$orderdet = $this->common_model->GetRow($condition, 'arm_order');
						if($this->input->post('order_status')=='paid' && $orderdet->CommissionStatus=='0')
						{
						    //product commission
							$memorder = $this->common_model->GetRow($condition,'arm_order'); 
							$setpcomm = $this->ProductCommission_model->check($memorder->MemberId,$this->input->post('OrderId'));
							$cdata = array('CommissionStatus' =>'1');
							$cstatus = $this->common_model->UpdateRecord($cdata, $condition, 'arm_order');
						}

					$this->session->set_flashdata('success_message', $this->lang->line('success_message'));
					redirect('admin/orders');
				} else {
					$this->session->set_flashdata('error_message', $this->lang->line('error_message'));
					
					$condition = "OrderId =" . "'" . $OrderId . "'";
					$this->data['order'] = $this->order_model->GetOrders($condition);
					$this->load->view('admin/products/editinvoice', $this->data);
					
				}

			} else {
		
				$this->form_validation->set_rules('order_user', 'OrderUser', 'trim|required|xss_clean');
				$this->form_validation->set_rules('order_product[]', 'OrderProduct', 'trim|required|xss_clean');
				$this->form_validation->set_rules('product_quantity', 'ProductQuantity', 'trim|required|is_natural_no_zero|xss_clean');

				if ($this->form_validation->run() == TRUE) {

					 
						$customers = $this->common_model->GetCustomer($this->input->post('order_user'));
						//$product_info = $this->product_model->GetProduct($this->input->post('order_product'));

						$data = array(

							'OrderNumber' => "OD".random_string('numeric', 10),
							'MemberId' => $this->input->post('order_user'),
							'FirstName' => $customers->FirstName,
							'LastName' => $customers->LastName,
							'Email' => $customers->Email,
							'Phone' => $customers->Phone,
							'Address1' => ($customers->Address) ? $customers->Address : '',
							'City' => ($customers->City) ? $customers->City : '',
							'State' => ($customers->State) ? $customers->State : '',
							'Country' => ($customers->Country) ? $customers->Country : '',
							'ShipFirstName' => $customers->FirstName,
							'ShipLastName' => $customers->LastName,
							'ShipPhone' => $customers->Phone,
							'ShipAddress1' => ($customers->Address) ? $customers->Address : '',
							'ShipCity' => ($customers->City) ? $customers->City : '',
							'ShipState' => ($customers->State) ? $customers->State : '',
							'ShipCountry' => ($customers->Country) ? $customers->Country : '',
							'PaymentMethod' => 'bank',
							'Status' => '1',
							'DateAdded' =>  date('Y-m-d h:i:s')
						);

						$status = $this->common_model->SaveRecords($data, 'arm_order');
						
						$OrderId = $this->db->insert_id();

						$order_total = 0;
						if($this->input->post('order_product')) {
							
							$products = $this->input->post('order_product');
							foreach($products as $product) {

								$product_info = $this->product_model->GetProduct($product);
								$order_total =  $order_total + $product_info->Price;

								$product_data = array(
									'OrderId' => $OrderId,
									'ProductId' => $product,
									'ProductName' => $product_info->ProductName,
									'Quantity' => $this->input->post('product_quantity'),
									'Price' => $product_info->Price,
									'Total' => $product_info->Price * $this->input->post('product_quantity')
								);

								$product_status = $this->common_model->SaveRecords($product_data, 'arm_order_product');	
							}

							if($product_status) {
								$data = array(
									'OrderTotal' => $order_total,
								);
						
								$condition = "OrderId=".$OrderId;
								$status = $this->common_model->UpdateRecord($data, $condition, 'arm_order');

								$data1 = array(
										'order_id' => $OrderId,
										'code' => 'sub_total',
										'title' => 'Sub total',
										'value' => $order_total,
										'sort_order' => '0'
									);
								$this->common_model->SaveRecords($data1, 'arm_order_total');


							}
						}
					

					if($status){
						$this->session->set_flashdata('success_message', $this->lang->line('success_message'));
						redirect('admin/orders');
					} else {
						// if($this->input->post('OrderId')) {
						// 	$condition = "OrderId =" . "'" . $OrderId . "'";
						// 	$this->data['order'] = $this->product_model->GetProductRow($condition,'arm_order');
						// 	$this->load->view('admin/products/editinvoice', $this->data);
						// } else {
							$this->session->set_flashdata('error_message', $this->lang->line('error_message'));
							$this->load->view('admin/products/addorder');
						//}
					}

				} else {
					$this->data['users'] = $this->common_model->GetCustomers();
					$this->data['product'] = $this->product_model->GetProducts();
					$this->load->view('admin/products/addorder',$this->data);
				}
			}

		} else {
			if($OrderId) {
				// $condition = "OrderId =" . "'" . $OrderId . "'";
				// $this->data['product'] = $this->product_model->GetProductRow($condition,'arm_order');

				$condition = "o.OrderId =" . "'" . $OrderId . "'";
				$this->data['order'] = $this->order_model->GetOrders($condition);
				// print_r($this->data['order']);exit;
				// $this->data['order'] = $this->product_model->GetProductRow($condition,'arm_order');
				if($this->data['order']){
					$this->load->view('admin/products/editinvoice', $this->data);	
				} else {
					redirect('admin/orders');
				}

				//$this->data['category'] = $this->product_model->GetCategory();
				//print_r($this->data);exit;
				//$this->load->view('admin/products/addorder', $this->data);
			} else {
				$this->data['users'] = $this->common_model->GetCustomers();
				$this->data['product'] = $this->product_model->GetProducts();
				$this->load->view('admin/products/addorder',$this->data);
			}
			
		}
		// $this->load->view('admin/products/addproduct');
	}
	
	public function delete($OrderId) {
		$condition = "OrderId =" . "'" . $OrderId . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_order');

		if($status) {
			$this->session->set_flashdata('success_message', 'Success! Orders Removed');
			redirect('admin/orders');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! Orders Not Removed');
			redirect('admin/orders');
		}
		
	}

	public function DeleteAll() {
		if($this->input->post('orders')) {
			foreach ($this->input->post('orders') as $key => $value) {
				$condition = "OrderId =" . "'" . $value . "'";
				$data = array(
					'isDelete' => '1'
				);

				$status = $this->common_model->UpdateRecord($data, $condition, 'arm_order');
			}
			if($status) {
				$this->session->set_flashdata('success_message', 'Success! Selected Orders removed');
				redirect('admin/orders');
			} else {
				$this->session->set_flashdata('error_message', 'Failed! Selected Orders not removed');
				redirect('admin/orders');
			}
		} else {
			redirect('admin/orders');
		}
	}

	public function active($OrderId) {
		$condition = "OrderId =" . "'" . $OrderId . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_order');
		if($status) {
			redirect('admin/orders');
		}
	}

	public function inactive($OrderId) {
		$condition = "OrderId =" . "'" . $OrderId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_order');
		if($status) {
			redirect('admin/orders');
		}
	}

	public function edit($OrderId) {

		$condition = "o.OrderId =" . "'" . $OrderId . "'";
		$this->data['order'] = $this->order_model->GetOrders($condition);
		$this->load->view('admin/products/editinvoice', $this->data);

	}

	public function invoice($OrderId) {
		$condition = "o.OrderId =" . "'" . $OrderId . "'";
		$this->data['order'] = $this->order_model->GetOrders($condition);
		$this->load->view('admin/products/orderinvoice', $this->data);

	}
	public function GetUserOrder($MemberId) {
		$condition = "o.MemberId =" . "'" . $MemberId . "'";
		$this->data['order'] = $this->order_model->GetOrders($condition);
		$this->load->view('admin/products/orderinvoice', $this->data);

	}


}
