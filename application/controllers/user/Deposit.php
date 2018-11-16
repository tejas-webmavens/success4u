<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller {

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
		$this->load->model('common_model');
		$this->load->model('MemberCommission_model');
		$this->load->model('admin/paymentsetting_model');
		$this->lang->load('user/deposit',$this->session->userdata('language'));
		$this->lang->load('user/common',$this->session->userdata('language'));
		
		}  else {
	    	redirect('login');
	    }
	}

	public function index()
	{
		$fmember = $this->common_model->getRow("MemberId='".$this->session->MemberID."'","arm_members");

		if($this->input->post())
		{
			//print_r($this->input->post());
			
			$this->form_validation->set_rules('paythrough', 'pay through', 'trim|required');
			$this->form_validation->set_rules('package', 'select package', 'trim|required');
			
			if ($this->form_validation->run() == TRUE) 
			{
				
				$condition = "PaymentId='".$this->input->post('paythrough')."'";
				$this->data['paymentdetails'] = $this->common_model->GetRow($condition,'arm_paymentsetting');
				$this->data['packages'] = $this->common_model->GetRow("Status='1' AND PackageId='".$this->input->post('package')."'","arm_package");
				
				$this->data['userdetails'] = $this->common_model->getRow("MemberId='".$this->session->MemberID."'","arm_members");
				//echo"<pre>";print_r($this->data); exit;
				$this->load->view('user/depositmoney',$this->data);
			} 
			else {
				
				$this->session->set_flashdata('error_message', $this->lang->line('withdrawdaywarning'));
				$condition = "PaymentStatus='1'";
				$this->data['payments'] = $this->common_model->GetResults($condition,'arm_paymentsetting');
				$this->data['packages'] = $this->common_model->GetResults("Status='1' AND PackageId>'".$fmember->PackageId."'","arm_package");
				$this->data['bwcount'] = $this->common_model->GetRowCount("MemberId='".$this->session->MemberID."' AND AdminStatus='0' AND EntryFor='MTAU'","arm_memberpayment");
				
				$this->load->view('user/deposit',$this->data);
			}
		}

			
		else 
		{
		
			$condition = "PaymentStatus='1'";
			$this->data['payments'] = $this->common_model->GetResults($condition,'arm_paymentsetting');
			
			$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			if($mlsetting->Id==4)
			{
				$ptableName ="arm_pv";
			}
				elseif($mlsetting->Id==9)
			{
				$ptableName ="arm_hyip";
			}
			elseif($mlsetting->Id==5 || $mlsetting->Id==8)
			{
				$ptableName ="arm_boardplan";
			}
			else
			{				
				$ptableName ="arm_package";
			}
			$this->data['packages'] = $this->common_model->GetResults("Status='1'","$ptableName");
			$this->data['bwcount'] = $this->common_model->GetRowCount("MemberId='".$this->session->MemberID."' AND AdminStatus='0' AND EntryFor='MTAU'","arm_memberpayment");
	
			$this->load->view('user/deposit',$this->data);
		}
	}


	public function viewdeposit()
	{
		if($this->session->userdata('logged_in')) 
		{
				$ccondition="Status='1'";
				$cdetail=$this->common_model->GetRow($ccondition,'arm_currency');
				$this->data['CurrencySymbol'] =$cdetail->CurrencySymbol;
				$condition="MemberId='".$this->session->MemberID."' And status='1'";
				$this->data['transaction'] = $this->common_model->GetResults($condition,'deposit');
				$this->load->view('user/viewdeposit',$this->data);
			   
		}
		else 
		{
		$this->load->view('login');
		}
	}
	
	public function checkbankwire($id='')
	{

		if($this->input->post('checkwire')=='check')
		{
			
			$mdetails = $this->common_model->GetRow("MemberId='".$this->input->post('memberid')."'",'arm_members');
			$this->form_validation->set_rules('memberid', 'memberid', 'trim|required|callback_mtau_check');
		
			$this->form_validation->set_rules($_FILES['referfile'],'referfile', 'trim|required|callback_ext_check');
				
			$admin_img = 'uploads/mtmpay/no-photo.jpg';
			if($_FILES['referfile']['tmp_name']!='')
			{
				if($_FILES['referfile']['type']=='image/jpg' || $_FILES['referfile']['type']=='image/jpeg' || $_FILES['referfile']['type']=='image/png'|| $_FILES['referfile']['type']=='image/gif')
				{
					$ext = explode(".", $_FILES['referfile']['name']);
					$admin_img = "uploads/mtmpay/".$this->input->post('memberid')."-admin.".$ext[1];
					move_uploaded_file($_FILES['referfile']['tmp_name'], $admin_img);
					$fileflag=1;
				}
				else
				{
					$fileflag=0;
					$this->session->set_flashdata('error_message',$this->lang->line('errormtaufile'));
					redirect("user/deposit");
				}

			}
			else
			{
				$fileflag=1;
			}
		

			if($this->form_validation->run() == true && $fileflag==1)	
 			{


				$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");

				if($mlsetting->Id==8)
				{
					$paydet = $this->common_model->GetRow("UserName='".$this->input->post('payto')."'",'arm_members');

                    $data1 = array(
						'AdminStatus'=>'0',
						'MemberStatus'=>'0',
						'ReceiveBy'=>$paydet->MemberId,
						'MPaymentReference'=>$this->input->post('transactionid'),
						'EntryFor'=>'MTAU',
						'PackageId'=>$id,
						'PaymentAmount'=>$this->input->post('transactionamount'),
						'MemberId'=>$this->input->post('memberid'),
						'APaymentAttachemt'=>$admin_img,
						'APaymentReference'=>$this->input->post('transactionid'),
						'DateAdded'=>date('y-m-d H:i:s')
					);

	                $mtmresult = $this->common_model->SaveRecords($data1,"arm_memberpayment");
	            }
	            


			
				if($mlsetting->Id==9)
				{
					if($id)
	 				{
	 					$max=$this->common_model->GetRow('PackageId='.$id.'',"arm_hyip");
	 					$maxamt=$max->max_amount;
	 					$minamt=$max->min_amount;
	 			    if($this->input->post('transactionamount') >= $minamt && $this->input->post('transactionamount') <= $maxamt)
	 				{
	 					$transactionamount=$this->input->post('transactionamount');
		 				$data1 = array(

						// 'OrderNumber' => "OD".random_string('numeric', 10),
						'MemberId' =>$this->input->post('memberid'),
						'PackageId'=>$id,
						'amount'=>$transactionamount,
						'Description'=>"Member Deposit using bankwire",
						'PaymentMethod'=>1,
						'DateAdded'=>date('y-m-d H:i:s'),
						'status'=>0	
						);
					
						$mtm = $this->common_model->SaveRecords($data1,"deposit");
						$depositid=$this->db->insert_id();
						if($depositid)
						{
							$data = array(
							'AdminStatus'=>'0',
							'MemberStatus'=>'1',
							'ReceiveBy'=>'1',
							'EntryFor'=>'MTAD',
							'PackageId'=>$id,
							'PaymentAmount'=>$this->input->post('transactionamount'),
							'MemberId'=>$this->input->post('memberid'),
							'APaymentAttachemt'=>$admin_img,
							'APaymentReference'=>$this->input->post('transactionid'),
							'DateAdded'=>date('y-m-d H:i:s'),
							'depositid'=>$depositid
						);

						$mtmresult = $this->common_model->SaveRecords($data,"arm_memberpayment");
					}

					$this->session->set_flashdata('success_message',$this->lang->line('successmtaumsg'));
	 					redirect('user/deposit');
					
	 				// $this->load->view('user/deposit');

	 				}
	 				else
	 				{
	 					$this->session->set_flashdata('error_message',"Sorry Your Transaction amount in Sufficient For Choose Your Plan Enter Correct Amount For This Plan");
	 					// $this->load->view('user/deposit');
	 					redirect('user/deposit');
	 				}

	 				}



				}
				else
				{
						$data = array(
						'AdminStatus'=>'0',
						'MemberStatus'=>'1',
						'ReceiveBy'=>'1',
						'EntryFor'=>'MTAU',
						'PackageId'=>$id,
						'PaymentAmount'=>$this->input->post('transactionamount'),
						'MemberId'=>$this->input->post('memberid'),
						'APaymentAttachemt'=>$admin_img,
						'APaymentReference'=>$this->input->post('transactionid'),
						'DateAdded'=>date('y-m-d H:i:s')
					);

					$mtmresult = $this->common_model->SaveRecords($data,"arm_memberpayment");
					$this->session->set_flashdata('success_message',$this->lang->line('successmtaumsg'));
					$this->load->view('user/deposit');

				}

					// $this->session->set_flashdata('success_message',$this->lang->line('successmtaumsg'));

                }
			
			}
			else
			{
				$this->session->set_flashdata('error_message',$this->lang->line('errormtaumsg'));
				$this->load->view('user/deposit');

			}
			// redirect('user/deposit');
			// exit;
		}



	public function depositaccount($id='')
	{
		
		if($this->input->post('checkaccount')=='check')
		{
			$amount=$this->input->post('transactionamount');
			
			$mdetails = $this->common_model->GetRow("MemberId='".$this->input->post('memberid')."'",'arm_members');
			$this->form_validation->set_rules('memberid', 'memberid', 'trim|required|callback_mtau_check');

				$accountbalance=$this->common_model->Getcusomerbalance($this->input->post('memberid'));

				if($amount>$accountbalance)
				{
					$this->session->set_flashdata('error_message',$this->lang->line('error_message'));
				}
				else
				{
					
			if($this->form_validation->run() == true)	
 			{

				$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");


				if($mlsetting->Id==9)
				{

					$package 	= $this->common_model->GetRow("PackageId='".$id."'","arm_hyip");
					$duration=$package->duration;
					$packagename=$package->PackageName;


						$accept_date = date("Y-m-d H:i:s");
			    		$date = $accept_date;
						$date = strtotime($date);
						$date = strtotime("+".$duration. " day" , $date);
						$mature_date = date('Y-m-d H:i:s', $date);

						  $date = strtotime($accept_date);
                         $date = strtotime("+ 1 day" , $date);
                         $next_run_date = date('Y-m-d H:i:s', $date);
                         // $data1['Description']="Member Deposit ".$packagename." using Account Balance";

					$data1 = array(

				// 'OrderNumber' => "OD".random_string('numeric', 10),
				'MemberId' =>$this->input->post('memberid'),
				'PackageId'=>$id,
				'amount'=>$amount,
				 'Description'=>"Member Deposit ".$packagename."  using Account Balance",
				'PaymentMethod'=>"Deposit account Balance",
				'DateAdded'=>date('y-m-d H:i:s'),
				'next_run_date'=>$next_run_date,
				'mechureddate' =>$mature_date,
				'status'=>1	);
				
				$mtm = $this->common_model->SaveRecords($data1,"deposit");
				$depositid=$this->db->insert_id();

					$data = array(
						'AdminStatus'=>'1',
						'MemberStatus'=>'1',
						'ReceiveBy'=>'1',
						'EntryFor'=>'UAB',
						'PackageId'=>$id,
						'PaymentAmount'=>$amount,
						'MemberId'=>$this->input->post('memberid'),
						'Status'=>'1',
						'DateAdded'=>date('y-m-d H:i:s'),
						'depositid'=>$depositid
					);

					$mtmresult = $this->common_model->SaveRecords($data,"arm_memberpayment");


				
					if($mtmresult)
					{


					
						$trnid = 'UAB'.rand(1111111,9999999);
						$date = date('y-m-d h:i:s');
						  // $data['Description']="Member Deposit ".$packagename." using Account Balance";
							$data1= array(
							'MemberId'=>$this->input->post('memberid'),
							'Credit'=>$amount,
							
							 'Description'=>"Member Deposit  ".$packagename." using Account Balance",
							'TransactionId'=>$trnid,
							'TypeId'=>'25',
							'DateAdded'=>$date
						);

					$userdetails = $this->common_model->SaveRecords($data1,'arm_history');
					$his_id=$this->db->insert_id();

					}
				$debitbal=$accountbalance-$amount;
					// echo $debitbal;
					// exit;

					$trnid = 'UABD'.rand(1111111,9999999);
					$date = date('y-m-d h:i:s');
					$data = array(
						'MemberId'=>$this->input->post('memberid'),
						'Debit'=>$amount,
						
						'Description'=>'Debited From User Account',
						'TransactionId'=>$trnid,
						'TypeId'=>'26',
						'Balance'=>$debitbal,
						'DateAdded'=>$date
					);

				$userhis = $this->common_model->SaveRecords($data,'arm_history');
				
					$this->session->set_flashdata('success_message',$this->lang->line('successdeposit'));
				}
				else
				{
						$data = array(
						'AdminStatus'=>'1',
						'MemberStatus'=>'1',
						'ReceiveBy'=>'1',
						'EntryFor'=>'UAB',
						'PackageId'=>'1',
						'Status'=>'1',
						'PaymentAmount'=>$this->input->post('transactionamount'),
						'MemberId'=>$this->input->post('memberid'),
						
						'DateAdded'=>date('y-m-d H:i:s')
					);

					$mtmresult = $this->common_model->SaveRecords($data,"arm_memberpayment");
					$this->session->set_flashdata('success_message',$this->lang->line('successdeposit'));
				}

					$this->session->set_flashdata('success_message',$this->lang->line('successdeposit'));

                }
			
				}
			

				
			redirect('user/deposit');
			exit;
		}
			
		redirect('user/deposit');
	}

	public function checkbitcoin($id='')
	{

		
		if($this->input->post('checkwire')=='check')
		{
			
			$mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');
			$this->form_validation->set_rules('memberid', 'memberid', 'trim|required|callback_mta_check');
		
			$this->form_validation->set_rules($_FILES['referfile'],'referfile', 'trim|required|callback_ext_check');
			
			$admin_img = '';
			if($_FILES['referfile']['tmp_name']!='')
			{
				if($_FILES['referfile']['type']=='image/jpg' || $_FILES['referfile']['type']=='image/jpeg' || $_FILES['referfile']['type']=='image/png'|| $_FILES['referfile']['type']=='image/gif')
				{
					$ext = explode(".", $_FILES['referfile']['name']);
					$admin_img = "uploads/mtmpay/".$this->input->post('memberid')."-admin.".$ext[1];
					move_uploaded_file($_FILES['referfile']['tmp_name'], $admin_img);
					$fileflag=1;
				}
				else
				{
					$fileflag=0;
					$this->session->set_flashdata('error_message',$this->lang->line('errormtafile'));
					redirect("user/register/checkbitcoin/".$id);
				}
			}
			else
			{
				$fileflag=1;
			}

			if($this->form_validation->run() == true && $fileflag==1)	
 			{
 				
				$mempack = $this->common_model->GetRow("MemberId='".$this->input->post('memberid')."'","arm_members");

				$data = array(
					'AdminStatus'=>'0',
					'MemberStatus'=>'1',
					'ReceiveBy'=>'1',
					'EntryFor'=>'MTA',
					'PaymentAmount'=>$this->input->post('amount'),
					'PackageId'=>$mempack->PackageId,
					'MemberId'=>$this->input->post('memberid'),
					'APaymentAttachemt'=>$admin_img,
					'APaymentReference'=>$this->input->post('transactionid'),
					'DateAdded'=>date('y-m-d H:i:s')
				);
				// print_r($data);
				$mtmresult = $this->common_model->SaveRecords($data,"arm_memberpayment");
				// echo $this->db->last_query();
				$this->session->set_flashdata('success_message',$this->lang->line('successmsg'));
				$this->data['message'] = 'This is your bitcoin address to final step for payment.';
	            $this->data['bitcoin'] = $this->paymentsetting_model->Getfielddata(5);
				$guid =	$this->data['bitcoin']->PaymentMerchantId;
				$address = $guid;
				
				$this->session->set_flashdata('success_message','Your Bitcoin Details updated Successfully');
				redirect('user/dashboard');
				exit;
			}
			else
			{
				
				$this->session->set_flashdata('error_message',$this->lang->line('errormsg'));
			}
				
			$this->data['id'] = $id;
			$this->load->view('user/payment_confirm',$this->data);
			exit;
		}
		
		$this->data['id'] = $id;
		$this->data['amount'] = $this->input->post('amount');
		$this->data['action'] = base_url().'user/upgrade/checkbitcoin/'.$id;
		$this->load->view('user/checkbitcoin',$this->data);
	
	}



	public function checkepin($id='')
	{

		if($this->input->post('check')=='check')
		{
		
			$mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');
			$pckdetails = $this->common_model->GetRow("EpinTransactionId='".$this->input->post('epincode')."' AND EpinStatus='1' AND ExpiryDay>='".date('Y-m-d')."'",'arm_epin');
			
			if($pckdetails)
			{

				if($mdetails->PackageId<$pckdetails->EpinPackageId && $this->input->post('package')==$pckdetails->EpinPackageId)
				{
					
					$date = date('y-m-d h:i:s');
					$Mdata = array(
						'SubscriptionsStatus'=>'Active',
						'MemberStatus'=>'Active',
						'PackageId'=>$pckdetails->EpinPackageId,
						'ModifiedDate'=>$date
					);
					$result = $this->common_model->UpdateRecord($Mdata, "MemberId='".$id."'", 'arm_members');
					if($result)
					{
						$edata = array(
							'UsedBy'=>$id,
							'EpinStatus'=>'2',
							'ModifiedDate'=>$date
						);
						$epresult = $this->common_model->UpdateRecord($edata, "EpinRecordId='".$pckdetails->EpinRecordId."'", 'arm_epin');
						$txnid = "UPG".rand(1111111,9999999);
					
						$bal = $this->common_model->Getcusomerbalance($id);

						$data1 = array('MemberId'=>$id,
							'TransactionId'=>$txnid,
							'DateAdded'=>$date,
							'PaymentReferenceId'=>$this->input->post('epincode'),
							'Description'=> "Member Upgrade using epin id ".$this->input->post('epincode'),
							'Credit'=>$pckdetails->EpinAmount,
							'Debit'=>$pckdetails->EpinAmount,
							'Balance'=>$bal,
							'TypeId'=>"19"
						);

						$result1 = $this->common_model->SaveRecords($data1,'arm_history');
						$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
						$field = "MemberId";
						$MemberId = $id;
						if($mlsetting->Id==1)
						{
							$table = "arm_forcedmatrix";
						}
						else if($mlsetting->Id==2)
						{
							$table = "arm_unilevelmatrix";
						}
						else if($mlsetting->Id==3)
						{
							$table = "arm_monolinematrix";
							$field = "MonoLineId";
							$monomdet = $this->common_model->GetRow("MemberId='". $id."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");

							$MemberId = $monomdet->MonoLineId;
						}

						else if($mlsetting->Id==4)
						{
							$table = "arm_binarymatrix";
						}
						else if($mlsetting->Id==5)
						{
							$table = "arm_boardmatrix";
							$field = "BoardMemberId";
							$brdmdet = $this->common_model->GetRow("MemberId='". $id."' order by BoardMemberId ASC LIMIT 0,1","arm_monolinematrix");

							$MemberId = $brdmdet->MemberId;
						}
						else if($mlsetting->Id==6)
						{
							$table = "arm_xupmatrix";
						}
						else if($mlsetting->Id==7)
						{
							$table = "arm_oddevenmatrix";
						}
						else if($mlsetting->Id==9)
						{
							$table = "arm_binaryhyip";
						}
						$bb = $this->MemberCommission_model->process($MemberId,$table,$field);
					}
					
					$this->session->set_flashdata('success_message', $this->lang->line('successmessage'));
				}
				else
				{
				 $this->session->set_flashdata('error_message', $this->lang->line('errormessageepinmiss'));

				}
			}
			else
			{
				$this->session->set_flashdata('error_message', $this->lang->line('errormessageepinavail'));
			}
			
			redirect('user/deposit');
			exit;
		}
		
		$this->load->view('user/deposit');
	}

	public function paymentsuccess()
	{
		
		if($this->input->post())
		{
			
			$checkdata = explode(",",$this->input->post('custom'));
			$memberdetails = $this->common_model->GetCustomer($checkdata[2]);

			$condition = "PackageId='".$this->input->post('item_number')."'";
			$packagedetails = $this->common_model->GetRow($condition,'arm_package');
			
			if(strtolower($checkdata[0])=='upgrade' && strtolower($checkdata[1])== 'paypal' && strtolower($checkdata[2])!='' )
			{

				if($this->input->post('mc_gross')>= $packagedetails->PackageFee)
				{
					$date = date('y-m-d h:i:s');
					$data = array('SubscriptionsStatus'=>'Active','MemberStatus'=>'Active','ModifiedDate'=>$date,'PackageId'=>$this->input->post('item_number'));
					$condition = "MemberId='".$checkdata[2]."'";
					$result = $this->common_model->UpdateRecord($data,$condition,'arm_members');
					if($result)
					{
						$bal = $this->common_model->Getcusomerbalance($checkdata[2]);
						$txnid = "UPG".rand(1111111,9999999);
						
						$data1 = array('MemberId'=>$checkdata[2],
							'TransactionId'=>$txnid,
							'DateAdded'=>$date,
							'PaymentReferenceId'=>$this->input->post('txn_id'),
							'Description'=> "Member Upgrade using paypal id ".$this->input->post('txn_id'),
							'Credit'=>$packagedetails->PackageFee,
							'Debit'=>$packagedetails->PackageFee,
							'Balance'=>$bal,
							'TypeId'=>"19"
						);

						$result1 = $this->common_model->SaveRecords($data1,'arm_history');
					
						$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
						$field = "MemberId";
						$MemberId = $memberdetails->MemberId;
						if($mlsetting->Id==4)
						{
							$table = "arm_forcedmatrix";
						}
						else if($mlsetting->Id==2)
						{
							$table = "arm_unilevelmatrix";
						}
						else if($mlsetting->Id==3)
						{
							$table = "arm_monolinematrix";
							$field = "MonoLineId";
							$monomdet = $this->common_model->GetRow("MemberId='". $memberdetails->MemberId."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");

							$MemberId = $monomdet->MonoLineId;
						}

						else if($mlsetting->Id==4)
						{
							$table = "arm_binarymatrix";
						}
						else if($mlsetting->Id==5)
						{
							$table = "arm_boardmatrix";
							$field = "BoardMemberId";
							$brdmdet = $this->common_model->GetRow("MemberId='". $memberdetails->MemberId."' order by BoardMemberId ASC LIMIT 0,1","arm_monolinematrix");

							$MemberId = $brdmdet->MemberId;
						}
						else if($mlsetting->Id==6)
						{
							$table = "arm_xupmatrix";
						}
						else if($mlsetting->Id==7)
						{
							$table = "arm_oddevenmatrix";
						}
						else if($mlsetting->Id==9)
						{
							$table = "arm_binaryhyip";
						}
						$bb = $this->MemberCommission_model->process($MemberId,$table,$field);

					}
					
					$this->session->set_flashdata('success_message', $this->lang->line('successmessage'));
				}
				else
				{
					$this->session->set_flashdata('error_message', $this->lang->line('errormessagepayment'));
				}
			}

			if(strtolower($checkdata[0])=='upgrade' && strtolower($checkdata[1])== 'bitcoin' && strtolower($checkdata[2])!='' )
			{
				echo "add soon ";
			}

		}
		
		redirect('user/upgrade');
	}

	public function GetBoardSpillover($Downids,$boardid,$table)
	{
		$array = $Downids;
		$Count = count($array)-1;
		
		for($i=0;$i<$Count;$i++) 
		{
			$downid = $array[$i];
			
			$spids = $this->common_model->GetResults("SpilloverId = '".$downid."' AND BoardId='".$boardid."'",$table);
			// print_r($spids);
			$Rows = $this->common_model->GetRowCount("SpilloverId = '".$downid."'AND BoardId='".$boardid."'",$table);
			
			if($Rows > 0)
			{
				for($j=0; $j<$Rows; $j++) 
				{
					if(!in_array($spids[$j]->BoardMemberId,$array))
					{
						$Count+=1; 
						array_push($array,$spids[$j]->BoardMemberId);
					}
				}
			}
		}
		
		return $array;
	}

	public function closedeposit($depositid)
	{
		

		 $id=$this->session->MemberID;
		
		$condition="MemberId='".$this->session->MemberID."' And id='".$depositid."'";
		$data1=array('status'=>3);
		
		$update=$this->common_model->UpdateRecord($data1,$condition,"deposit");
		$current_new_date=date('y-m-d h:i:s');
		$condition="MemberId='".$this->session->MemberID."' And DateAdded='".$current_new_date."'";
		$amount = $this->common_model->GetRow("id='".$depositid."'","deposit"); 
		// $cuntuser=count($amount);
		
		$amountuser=$amount->amount;
		
		
	
		if($update)
		{
		$userbal = $this->common_model->Getcusomerbalance($userid);
		$trnid = 'CD'.rand(1111111,9999999);
		$date = date('y-m-d h:i:s');
		$data = array(
			'MemberId'=>$id,
			'Credit'=>$amountuser,
			'Balance'=>$userbal+$amountuser,
			'Description'=>'Member Closed deposit',
			'TransactionId'=>$trnid,
			'TypeId'=>'23',
			'DateAdded'=>$date
		);

		$userdetails = $this->common_model->SaveRecords($data,'arm_history');
		
			$this->session->set_flashdata('success_message',$this->lang->line('success_message'));
			
		}
			
		 redirect("user/deposit/viewdeposit");
		
		 
	}

	public function mtau_check()
	{
		$ckip = $this->common_model->GetRowCount("MemberId='".$this->input->post('memberid')."' AND AdminStatus='0' AND EntryFor='MTAU'","arm_memberpayment");
		
		if($ckip>0)
		{
			$this->form_validation->set_message('mtau_check',ucwords($this->lang->line('errormtaumsg')));
			return false;
		}
		else
		{
			return true;
		}
		exit;
	}

	public function mta_check()
	{
		$ckip = $this->common_model->GetRowCount("MemberId='".$this->input->post('memberid')."' AND AdminStatus NOT IN ('2','1') AND EntryFor='MTA'","arm_memberpayment");
		
		if($ckip>0)
		{
			$this->form_validation->set_message('mta_check',ucwords($this->lang->line('errormta')));
			return false;
		}
		else
		{
			return true;
		}
		exit;
	}

	public function ext_check()
	{
		
		if($_FILES['referfile']=='gif' || $_FILES['referfile']=='png' || $_FILES['referfile']=='jpg' || $_FILES['referfile']=='jpeg')
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('ext_check',ucwords($this->lang->line('errorextension')));
			return false;
		}
		exit;
	}
	
}
