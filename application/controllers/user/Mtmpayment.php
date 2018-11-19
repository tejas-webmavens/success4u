<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtmpayment extends CI_Controller {

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
		// $this->load->model('Memberboardprocess_model');

		// Load database
		$this->load->model('MemberCommission_model');
		
		$this->load->model('Memberboardprocess_model');
	
		$this->load->helper('cookie');

		// Load database
		
	
		$this->lang->load('user/mtmpayment',$this->session->userdata('language'));
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
			$condition="ReceiveBy='".$this->session->MemberID."' AND MemberStatus='0' Order by Payid DESC";
			$this->data['transaction'] = $this->common_model->GetResults($condition,'arm_memberpayment');
			$this->load->view('user/mtmpaymentdetails',$this->data);
			   
		}
		else 
		{
			$this->load->view('login');
		}
		
	}

	public function accept($id='')
	{
		if($id!='')
		{
			$decdet = $this->common_model->GetRow("Payid='".$id."'","arm_memberpayment");
		
			if($decdet->MemberStatus=='0' && $decdet->AdminStatus=='0')
			{
				
                $userdetail = $this->common_model->GetRow("MemberId='".$decdet->MemberId."'","arm_members");
				$binarypackage = $this->common_model->GetRow("PackageId='".$userdetail->PackageId."'","arm_pv");

				$memberid = $decdet->MemberId;
				$commission = $binarypackage->PackageFee * (100 / 100);

				$userbal = $this->common_model->Getcusomerbalance($decdet->ReceiveBy);
				$trnid = 'PCOM'.rand(1111111,9999999);

				$data = array(
					'MemberId'	=>	$decdet->ReceiveBy,
					'Credit'	=>	$commission,
					'Balance'	=>	$userbal+$commission,
					'Description'	=>	'Fund for package payment',
					'TransactionId'	=>	$trnid,
					'TypeId'	=>	'15',
					'DateAdded'	=>	date('y-m-d h:i:s')
				);
				
				$userdetails = $this->common_model->SaveRecords($data,'arm_history');

				$this->session->set_flashdata('success_message',$this->lang->line('successmessageaccept'));
				$data = array("MemberStatus"=>"1","AdminStatus"=>"1");
				$data1 = array("SubscriptionsStatus"=>"Active");
				$this->common_model->UpdateRecord($data1,"MemberId='".$decdet->MemberId."'","arm_members");
				$this->common_model->UpdateRecord($data,"Payid='".$id."'","arm_memberpayment");

				$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
				if($mlsetting->Id==8 && $decdet->EntryFor=='MTAU')
				{
	
	            	                 
				}else{
							$field = "MemberId";
							$memberid = $decdet->MemberId;
											if($mlsetting->Id==1)
							{
								$table = "arm_forcedmatrix";
								$this->Memberboardprocess_model->setforcematrix($memberid,$table);
							}
							else if($mlsetting->Id==2)
							{
								$table = "arm_unilevelmatrix";
								$this->Memberboardprocess_model->setunilevelmatrix($memberid,$table);
							}
							else if($mlsetting->Id==3)
							{
								$table = "arm_monolinematrix";
								$field = "MonoLineId";
								$this->Memberboardprocess_model->setmonolinematrix($memberid,$table);
							}
							else if($mlsetting->Id==4)
							{
								$table = "arm_binarymatrix";
								$this->Memberboardprocess_model->binarymatrix($memberid,$table);
							}
							else if($mlsetting->Id==5)
							{
								$table = "arm_boardmatrix";
								$this->Memberboardprocess_model->setboardmatrix($memberid,$table);
							}
							else if($mlsetting->Id==6)
							{
								$table = "arm_xupmatrix";
								$this->Memberboardprocess_model->setxupmatrix($memberid,$table);
							}
							else if($mlsetting->Id==7)
							{
								$table = "arm_oddevenmatrix";
								$this->Memberboardprocess_model->setoddevenmatrix($memberid,$table);
							}
							else if($mlsetting->Id==8)
							{
								$table = "arm_boardmatrix1";
								$this->Memberboardprocess_model->setboardmatrix1($memberid,$table);
							}
						$this->Memberboardprocess_model->Totaldowncount();
                            
							// $this->Memberboardprocess_model->process($memberid);
							$this->MemberCommission_model->process($memberid,$table,$field);
				
			}
		 }
			redirect("user/mtmpayment");
		}
		else
		{
			$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
			redirect("user/mtmpayment");
			exit;
		}

	}

	public function decline($id='')
	{
		if($id!='')
		{

			$decdet = $this->common_model->GetRow("Payid='".$id."'","arm_memberpayment");
			
			if($decdet->MemberStatus==0)
			{
				$data = array("MemberStatus"=>"2","AdminStatus"=>"2");
				$dd = $this->common_model->UpdateRecord($data,"Payid='".$id."'","arm_memberpayment");
				if($dd)
				$this->session->set_flashdata('success_message',$this->lang->line('successmessagedecline'));
			}
			
			redirect("user/mtmpayment");
		}
		else
		{
			$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
			redirect("user/mtmpayment");
			exit;
		}

	}

	
}
