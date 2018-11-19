<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mywithdraw extends CI_Controller {

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
		
		$this->load->model('user/mywithdraw_model');
		$this->lang->load('user/mywithdraw',$this->session->userdata('language'));
		$this->lang->load('user/common',$this->session->userdata('language'));
		}  else {
	    	redirect('login');
	    }
	}

	public function password_check()
	{
		$condition = "MemberId =" . "'" . $this->session->userdata('MemberID'). "' AND TransactionPassword =" . "'" . sha1(sha1($this->input->post('password'))). "' AND UserType='3'";

		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return true; 
		} else {
			$this->form_validation->set_message('password_check', '<p><em class="state-error1">'.ucwords($this->lang->line('errorpassword')).'</em></p>');
			return false;
		}

	}

	public function index()
	{
		
		if($this->input->post())
		{
			$withdrawstatus = $this->mywithdraw_model->Getdata('withdrawstatus');
			$withdrawdaylimit = $this->mywithdraw_model->Getdata('withdrawdaylimit');
			$condition ="MemberId='".$this->session->MemberID."' AND TypeId='7'";
			$wlimit = $this->common_model->getRowCount($condition,"arm_history");

			if($withdrawstatus==1)
			{
				if($wlimit < $withdrawdaylimit)
				{
									

					$this->form_validation->set_rules('withdrawamount', 'withdrawamount', 'trim|required|numeric|callback_balance_check|callback_userbankwire_check');
					$this->form_validation->set_rules('dedutedamount', 'dedutedamount', 'trim|required|numeric|callback_balance_check');
					$this->form_validation->set_rules('description', 'description', 'trim|required');
					$this->form_validation->set_rules('paythrough', 'paythrough', 'trim|required');
					$withstaus = $this->common_model->GetRow("Page='usersetting' AND KeyValue='withdrawpassordstatus'", "arm_setting");
					if($withstaus->ContentValue == 1) 
					$this->form_validation->set_rules('password', 'password', 'trim|required|callback_password_check');

					if ($this->form_validation->run() == TRUE) 
					{ 
						
						$date =date('y-m-d h:i:s');
						
						$senmemberbal 	= $this->common_model->Getcusomerbalance($this->session->MemberID);
						$memdetail = $this->common_model->GetRow("MemberId='".$this->session->MemberID."'","arm_members");
						$memdt 	= $this->common_model->GetRow("MemberId='".$this->session->MemberID."'","arm_members");
						$adminfee=$this->input->post('fee');
						$debit=$this->input->post('withdrawamount')+$adminfee;
				
						$cusdet = json_decode($memdt->CustomFields);
				
						$tnxid = "Bankwire : ".$cusdet->bankwirename."<br> Bankwire Ac no : ".$cusdet->bankwireacno;
				
						$Wtranid = "WTH".rand(111111,9999999);
						$Atranid = "ADM".rand(111111,9999999);
						$sdata =array(
							'MemberId'=>$this->session->MemberID,
							'Debit'=>$this->input->post('withdrawamount')+$adminfee,
							'Balance'=>$senmemberbal-$debit,
							'TypeId'=>7,
							// 'TransactionId'=>$tnxid,
							'Description'=>$this->input->post('description'),
							'DateAdded'=>$date,
							'paythrough'=>$this->input->post('paythrough'),
							'TransactionId'=>$Wtranid
						);
						
						$sresult = $this->common_model->SaveRecords($sdata,'arm_history');

						/*

						// after admin accept admin fee calculates in admin side not here 

						$adata =array(
							'TypeId'=>10,
							'Description'=>ucwords($this->lang->line('adminfeedes')),
							'DateAdded'=>$date,
							'TransactionId'=>$Atranid
							);

										
							$senmemberbal1		= $this->common_model->Getcusomerbalance($this->session->MemberID);
							$adata['MemberId'] 	= $this->session->MemberID;
							$adata['Debit'] 	= $this->input->post('adminfee');
							$adata['Balance']	= $senmemberbal1-$this->input->post('adminfee');
						


										
						$aresult = $this->common_model->SaveRecords($adata,'arm_history');

						*/

						if($sresult)// && $aresult
						{
							$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
						}	
						else
						{
							$this->session->set_flashdata('error_message', $this->lang->line('errormessage'));
						}
						$condition = "PaymentStatus='1'";
						$this->data['payments'] = $this->common_model->GetResults($condition,'arm_paymentsetting');
						$this->load->view('user/mywithdraw',$this->data);
					} 
					else 
					{
						$this->session->set_flashdata('error_message', $this->lang->line('errormessage'));
						$condition = "PaymentStatus='1'";
						$this->data['payments'] = $this->common_model->GetResults($condition,'arm_paymentsetting');
						$this->load->view('user/mywithdraw',$this->data);
					}

				} else {
					$this->session->set_flashdata('error_message', $this->lang->line('withdrawdaywarning'));
					$condition = "PaymentStatus='1'";
					$this->data['payments'] = $this->common_model->GetResults($condition,'arm_paymentsetting');
					$this->load->view('user/mywithdraw',$this->data);
				}

			} else {
				$this->session->set_flashdata('error_message', $this->lang->line('withdrawwarning'));
				$condition = "PaymentStatus='1'";
				$this->data['payments'] = $this->common_model->GetResults($condition,'arm_paymentsetting');
				$this->load->view('user/mywithdraw',$this->data);
			}
			
		} else {
			$condition = "PaymentStatus='1'";
			$this->data['payments'] = $this->common_model->GetResults($condition,'arm_paymentsetting');
			$this->load->view('user/mywithdraw',$this->data);	
				
		}
		
	}

	

	public function balance_check($amount)
	{
		$balance 	= $this->common_model->Getcusomerbalance($this->session->MemberID);
		$adminfee 	= $this->mywithdraw_model->Getdata('adminfee');
		$minfund 	= $this->mywithdraw_model->Getdata('minwithdraw');
		$maxfund	= $this->mywithdraw_model->Getdata('maxwithdraw');
		$adminfeetype	= $this->mywithdraw_model->Getdata('adminfeetype');
		
		if(strtolower($adminfeetype)=='flat')
		{
			$cadminfee = $adminfee;
		}
		else
		{
			$cadminfee =  $amount * $adminfee / 100 ;
		}

		
			$camount= $amount + $cadminfee;
		

		
		if($camount <= $balance)
		{
			
			if(floatval($camount) < floatval($minfund) || floatval($camount) > floatval($maxfund))
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
			return false;
		}
	}
	

public function userbankwire_check()
	{
		$memdt 	= $this->common_model->GetRow("MemberId='".$this->session->MemberID."'","arm_members");
		
		$cusdet = json_decode($memdt->CustomFields);
		
		if($cusdet->bankwireacno!='' & $cusdet->bankwirename!='')
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('userbankwire_check',ucwords($this->lang->line('errorbankwire').' '.$balance));
			return false;
		}
	}
	
}
