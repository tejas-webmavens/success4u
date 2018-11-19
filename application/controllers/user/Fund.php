<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fund extends CI_Controller {

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
		
		$this->load->model('user/fund_model');
		$this->lang->load('userfund',$this->session->userdata('language'));
		$this->lang->load('user/common',$this->session->userdata('language'));
		
		}  else {
	    	redirect('login');
	    }
	}

	

	public function index()
	{
		
		if($this->input->post())
		{
			$transferstatus = $this->fund_model->Getdata('transferstatus');
			
		if($transferstatus==1)
		{
				

			$this->form_validation->set_rules('username', 'username', 'trim|required|alpha_numeric|callback_username_check');
			$this->form_validation->set_rules('nameverify', 'nameverify', 'trim|required');
			$this->form_validation->set_rules('transferamount', 'transferamount', 'trim|required|numeric|callback_balance_check');
			$this->form_validation->set_rules('payableamount', 'payableamount', 'trim|required|numeric|callback_balance_check');
			$this->form_validation->set_rules('description', 'description', 'trim|required');

			if ($this->form_validation->run() == TRUE) 
			{ 
				$date =date('y-m-d h:i:s');
				//redirect('user');
				$condition = "UserName='".$this->input->post('username')."'";
				$memberdetails =  $this->common_model->GetRow($condition,'arm_members');

				 $recmemberbal =  $this->common_model->Getcusomerbalance($memberdetails->MemberId);
				 $senmemberbal =  $this->common_model->Getcusomerbalance($this->session->MemberID);
				//print_r($memberdetails);
				 $tnxid ="MYW".rand(111111,999999);

				$rdata =array(
					'MemberId'=>$memberdetails->MemberId,
					'Credit'=>$this->input->post('transferamount'),
					'Balance'=>$recmemberbal+$this->input->post('transferamount'),
					'TypeId'=>15,
					'TransactionId'=>$tnxid,
					'Description'=>$this->input->post('description'),
					'DateAdded'=>$date
				);
				$rresult = $this->common_model->SaveRecords($rdata,'arm_history');
				$senmemberbal =  $this->common_model->Getcusomerbalance($this->session->MemberID);
				 

				$sdata =array(
					'MemberId'=>$this->session->MemberID,
					'Debit'=>$this->input->post('transferamount'),
					'Balance'=>$senmemberbal-$this->input->post('transferamount'),
					'TypeId'=>16,
					'TransactionId'=>$tnxid,
					'Description'=>$this->input->post('description'),
					'DateAdded'=>$date
				);
				
				$sresult = $this->common_model->SaveRecords($sdata,'arm_history');

				$recmemberbal =  $this->common_model->Getcusomerbalance($memberdetails->MemberId);
				$senmemberbal =  $this->common_model->Getcusomerbalance($this->session->MemberID);

				$adata =array(
					'TypeId'=>10,
					'TransactionId'=>$tnxid,
					'Description'=>ucwords($this->lang->line('adminfeedes')),
					'DateAdded'=>$date
				);

				$transferfeetype = $this->fund_model->Getdata('transferfeetype');

				if(strtolower($transferfeetype)=='receiver')
				{
					$adata['MemberId'] = $memberdetails->MemberId;
					$adata['Debit'] = $this->input->post('adminfee');
					$recmemberbal1 =  $this->common_model->Getcusomerbalance($memberdetails->MemberId);
					$adata['Balance']= $recmemberbal1-$this->input->post('adminfee');

				}
				else
				{
					$senmemberbal1=  $this->common_model->Getcusomerbalance($this->session->MemberID);
					$adata['MemberId'] = $this->session->MemberID;
					$adata['Debit'] = $this->input->post('adminfee');
					$adata['Balance']= $senmemberbal1-$this->input->post('adminfee');
				}
								
				$aresult = $this->common_model->SaveRecords($adata,'arm_history');

				if($rresult && $sresult && $aresult) {
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
				} else {
					$this->session->set_flashdata('error_message', $this->lang->line('errormessage'));
				}
			
				$this->load->view('user/fund');
			} 
			else 
			{
				$this->session->set_flashdata('error_message', $this->lang->line('errormessage'));
				$this->load->view('user/fund');
			}
		}
			else 
			{
				$this->session->set_flashdata('error_message', $this->lang->line('fundwarning'));
				$this->load->view('user/fund');
			}

			
		}
		else {
				
				$this->load->view('user/fund');	
				
		    }
			

		
	}

	public function checkmember($username)
	{

		echo $username = $this->common_model->getmembername($username);
			 
	}

	public function username_check()
	{
		$username = $this->common_model->getmembername($this->input->post('username'));
		if($this->input->post('username') == $username)
		{

		return true;

		}
		else
		{

			$this->form_validation->set_message('username_check',ucwords($this->lang->line('errorusername')));

			return false;
		}
		
	}

	public function balance_check($amount)
	{
		$balance 	= $this->common_model->Getcusomerbalance($this->session->MemberID);
		$adminfee 	= $this->fund_model->Getdata('adminfee');
		$minfund 	= $this->fund_model->Getdata('minfund');
		$maxfund	= $this->fund_model->Getdata('maxfund');
		$adminfeetype	= $this->fund_model->Getdata('adminfeetype');
		$transferfeetype	= $this->fund_model->Getdata('transferfeetype');

		if(strtolower($adminfeetype)=='flat')
		{
			$cadminfee = $adminfee;
		}
		else
		{
			$cadminfee =  $amount * $adminfee / 100 ;
		}

		if(strtolower($transferfeetype)=='receiver')
		{
			$camount= $amount;
		}
		else
		{
			$camount= $amount + $cadminfee;
		}

		
		if($camount <= $balance)
		{
			
			if($amount<$minfund || $amount>$maxfund)
			{
			
			$this->form_validation->set_message('balance_check',ucwords($this->lang->line('errorlimit')));
			return false;
			}
			else
			{
			return true;
			}
		}
		else
		{
			$this->form_validation->set_message('balance_check',ucwords($this->lang->line('errorbalance').' '.$balance));
			//echo"false";
			return false;
		}
	}
	
}
