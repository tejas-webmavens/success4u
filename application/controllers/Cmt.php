<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmt extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// $this->load->model('user/shop_model');
		
		// $this->load->library('cart');
		//$this->load->helper('url');
		// $this->load->helper('cms_helper');
		// Load form helper library
		//$this->load->helper('form');
		$this->load->model('MemberCommission_model');

		// Load database
		
		// change language
		//$this->config->set_item('language', 'spanish');

		// load language
		
		
	}

	public function index()
	{
		print_r($this->session);
		echo"test file for product commission";

		// $this->ProductCommission_model->check(141,189);


		$this->MemberCommission_model->process('152','arm_forcedmatrix','MemberId');
	}
	// public function contents() {
	// 	$this->load->view('user/content');
	// }

}
?>