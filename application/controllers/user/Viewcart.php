<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewcart extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// if($this->session->userdata('logged_in')) {
		
			// Load database
			$this->load->model('user/shop_model');
			$this->load->model('product_model');
			
			$this->load->library('cart');

			// load language
			$this->lang->load('user/shop',$this->session->userdata('language'));
			$this->lang->load('user/common',$this->session->userdata('language'));
		// } else {
		// 	redirect('user/shop');
		// }		

	}

	public function index() {

		if($this->cart->total_items() > 0){
			$this->load->view('user/viewcart');	
		} else {
			redirect('user/shop');
		}

	}

	public function coupon() {
		
		if ($this->input->post('coupon')) {
			$coupon = $this->input->post('coupon');
		} else {
			$coupon = '';
		}

		$coupon_info = $this->shop_model->getCoupon($coupon);
		if($coupon_info) {
			$this->session->unset_userdata('cart_discount');
			if($coupon_info->CouponType=='p'){
				$discount = $this->cart->total() * ($coupon_info->Total / 100);
			} else {
				$discount = $coupon_info->Total;
			}

			if($discount>$this->cart->total()) {
				$data['error'] = 'This coupon unable to use here';
				echo json_encode($data);
			} else {
				$cart_data['CouponCode'] = $coupon_info->CouponCode;
				$cart_data['CouponType'] = $coupon_info->CouponType;
				$cart_data['discount'] = $discount;

				$this->session->set_userdata('cart_discount',$cart_data);
				
				$data['Total'] = $coupon_info->Total;
				$data['Success'] = 'Coupon code accepted';
				echo json_encode($data);
			}

		} else {
			$data['error'] = 'Coupon code is invalid or expire';
			echo json_encode($data);
		}
	}

}
?>