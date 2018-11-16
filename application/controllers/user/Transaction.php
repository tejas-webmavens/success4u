<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {
		
		// $this->load->helper('url');
		// // Load form helper library
		// $this->load->helper('form');

		// // Load form validation library
		// $this->load->library('form_validation');

		// // Load session library
		// $this->load->library('session');
		$this->load->helper('cookie');

		// Load database
		
	
		$this->lang->load('user/transaction',$this->session->userdata('language'));
		$this->lang->load('user/common',$this->session->userdata('language'));
		
		}  else {
	    	redirect('login');
	    }
	}

	

	public function index()
	{
		
		if($this->session->userdata('logged_in')) 
		{
				$ccondition="Status='1'";
				$cdetail=$this->common_model->GetRow($ccondition,'arm_currency');
				$this->data['CurrencySymbol'] =$cdetail->CurrencySymbol;
				$condition="MemberId='".$this->session->MemberID."' Order by HistoryId DESC";
				$this->data['transaction'] = $this->common_model->GetResults($condition,'arm_history');
				$this->load->view('user/transaction',$this->data);
			   
		}
		else 
		{
		$this->load->view('login');
		}
		
	}

	
	
}
