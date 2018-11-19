<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewardcalculates extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// if($this->session->userdata('logged_in')) {
		
			// Load database
			
			$this->load->helper('reward');
			
		
			
			// load language
			
		// } else {
		// 	redirect('user/shop');
		// }		

	}

	public function index() 
	{

		Dailyreward();
		WeeklyReward();
		MonthlyReward();
		
		exit;

	}

}

