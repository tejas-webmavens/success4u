<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// if($this->session->userdata('logged_in')) {

			// load language
			$this->lang->load('user/shop',$this->session->userdata('language'));
			$this->lang->load('user/common',$this->session->userdata('language'));
		// } else {
		// 	redirect('user/shop');
		// }		

	}

	public function index() {

	}

	public function save() {

		if($this->input->post()) {
			
			$shipping_data['shipping_rates'] = $this->input->post('shipping_rates');

			$ship_status = $this->session->set_userdata('shipping',$shipping_data);
			// $shipping = $this->session->userdata('shipping');
			// echo $shipping['shipping_rates'];
			if($ship_status){
				$json['success'] = 'shipping method selected';
				echo json_encode($json);				
			} 
			$json['success'] = 'shipping method selected';
			echo json_encode($json);
				
		} else {
			$json['error'] = 'shipping method not selected';
			echo json_encode($json);
			
		}
	}
}
?>