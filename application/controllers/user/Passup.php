<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passup extends CI_Controller {

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
		
	
		$this->lang->load('user/passup',$this->session->userdata('language'));
		$this->lang->load('user/common',$this->session->userdata('language'));
		
		}  else {
	    	redirect('login');
	    }
	}

	

	public function index()
	{
		
		if($this->session->userdata('logged_in')) 
		{
				$mlmset =$this->common_model->GetRow("MatrixStatus='1'", 'arm_matrixsetting');
				if($mlmset->Id=='6'){ $table='arm_xupmatrix';}
				if($mlmset->Id=='7'){ $table='arm_oddevenmatrix';}
				$mdetail=$this->common_model->GetRow("MemberId='".$this->session->MemberID."'",$table);
				
				$mndetail=$this->common_model->GetRow("MemberId='".$this->session->MemberID."'",'arm_members');
				$dndetail=$this->common_model->GetRow("MemberId='".$mdetail->DirectId."'",'arm_members');
				$this->data['membername'] = $mndetail->UserName;
				$this->data['directname'] = $dndetail->UserName;
				$this->data['passupreceive'] 	= json_decode($mdetail->PassedUpReceive);
				$this->data['passupsend'] 		= json_decode($mdetail->PassedUpSend);
				$this->load->view('user/passup',$this->data);
			   
		}
		else 
		{
		$this->load->view('login');
		}
		
	}

	
	
}
