<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cod extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
			// Load database
			$this->load->model('user/shop_model');
			$this->load->model('product_model');
			
			$this->load->model('order_model');
			

			// load language
			$this->lang->load('payment/payment',$this->session->userdata('language'));
				

	}

	public function index() {
		
		$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
		$this->data['carts'] = $this->cart->contents();
		$this->load->view('payment/cod',$this->data);
	}

	
	public function codcart() {
		if($this->input->post()) {
			$custom_data = explode(', ', $this->input->post('custom'));

			$memberId = $custom_data[0];
			$orderId = $custom_data[1];

			$this->session->unset_userdata('cart_contents');
			$this->session->unset_userdata('cart_discount');

			$condition = "o.OrderId =" . "'" . $orderId . "'";
			$this->data['order'] = $this->order_model->GetOrders($condition);
			$userorder = $this->data['order'];
			$order_total = str_replace(",","",number_format($userorder[0]->OrderTotal,2));
			
			$condition2 = "order_id =" . "'" . $orderId . "'";
			$this->data['cart_total_res'] = $this->common_model->GetResults($condition2,'arm_order_total');
			
			$this->data['message'] = 'Your Order successfully processed.';
			$this->load->view('user/success', $this->data);
			

			// $condition = "o.OrderId =" . "'" . $orderId . "'";
			// $this->data['order'] = $this->order_model->GetOrders($condition);

			// $condition2 = "order_id =" . "'" . $orderId . "'";
			// $this->data['cart_total_res'] = $this->common_model->GetResults($condition2,'arm_order_total');
			
			// $this->load->view('user/invoice', $this->data);
		} else {
			redirect('user/shop');
		}

	}

	public function invoice($orderId='116') {
		$condition = "o.OrderId =" . "'" . $orderId . "'";
			$this->data['order'] = $this->order_model->GetOrders($condition);

			$condition2 = "order_id =" . "'" . $orderId . "'";
			$this->data['cart_total_res'] = $this->common_model->GetResults($condition2,'arm_order_total');
			
			$this->load->view('user/invoice', $this->data);
	}

	public function success() {
		echo "success";
		print_r($_REQUEST);
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