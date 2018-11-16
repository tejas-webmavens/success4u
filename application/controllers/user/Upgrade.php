<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upgrade extends CI_Controller {

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

		$this->lang->load('user/upgrade',$this->session->userdata('language'));
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
				$this->load->view('user/upgradepayment',$this->data);
			} 
			
		else 
			{	
				
				$this->session->set_flashdata('error_message', $this->lang->line('withdrawdaywarning'));
				$condition = "PaymentStatus='1'";
				$this->data['payments'] = $this->common_model->GetResults($condition,'arm_paymentsetting');
				$this->data['packages'] = $this->common_model->GetResults("Status='1' AND PackageId>'".$fmember->PackageId."'","arm_package");
				$this->data['bwcount'] = $this->common_model->GetRowCount("MemberId='".$this->session->MemberID."' AND AdminStatus='0' AND EntryFor='MTAU'","arm_memberpayment");
				
				$this->load->view('user/upgrade',$this->data);
			}
		}

			
		else {
		
				$condition = "PaymentStatus='1'";
				$this->data['payments'] = $this->common_model->GetResults($condition,'arm_paymentsetting');
				
						$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
					if($mlsetting->Id==4)
					{
						$ptableName ="arm_pv";
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
		
				$this->load->view('user/upgrade',$this->data);
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
				redirect("user/upgrade");
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
							'PaymentAmount'=>$this->input->post('paymentamount'),
							'MemberId'=>$this->input->post('memberid'),
							'APaymentAttachemt'=>$admin_img,
							'APaymentReference'=>$this->input->post('transactionid'),
							'DateAdded'=>date('y-m-d H:i:s')
					);

	                $mtmresult = $this->common_model->SaveRecords($data1,"arm_memberpayment");

				$this->session->set_flashdata('success_message',$this->lang->line('successmtaumsg'));

                    }

						// $amount = $pvlist[1];
				

					

					  
						// if(!$spilloverid)
						// {
						// 	$level++;
						// 	$memberid = $spilloverid;
						// }
					// }
					
				
				
				else{
					$data = array(
							'AdminStatus'=>'0',
							'MemberStatus'=>'1',
							'ReceiveBy'=>'1',
							'EntryFor'=>'MTAU',
							'PackageId'=>'1',
							'PaymentAmount'=>$this->input->post('paymentamount'),
							'MemberId'=>$this->input->post('memberid'),
							'APaymentAttachemt'=>$admin_img,
							'APaymentReference'=>$this->input->post('transactionid'),
							'DateAdded'=>date('y-m-d H:i:s'));

				$mtmresult = $this->common_model->SaveRecords($data,"arm_memberpayment");
				$this->session->set_flashdata('success_message',$this->lang->line('successmtaumsg'));
				
				}
			}
			else
			{
				$this->session->set_flashdata('error_message',$this->lang->line('errormtaumsg'));
			}
			
				
			redirect('user/upgrade');
			exit;
		}
			
			
			redirect('user/upgrade');

	}


	public function checkepin($id='')
	{

		if($this->input->post('check')=='check')
		{
			
			
		
			$mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');


			$pckdetails = $this->common_model->GetRow("EpinTransactionId='".$this->input->post('epincode')."' AND EpinStatus='1' AND ExpiryDay>='".date('Y-m-d')."'",'arm_epin');
			
			
			
			
			if($pckdetails)
			{
				
			

				if($this->input->post('package')==$pckdetails->EpinPackageId)
				{

					$date = date('y-m-d h:i:s');
					$Mdata = array('SubscriptionsStatus'=>'Active',
							'MemberStatus'=>'Active',
							'PackageId'=>$pckdetails->EpinPackageId,
							'ModifiedDate'=>$date);
					$result = $this->common_model->UpdateRecord($Mdata, "MemberId='".$id."'", 'arm_members');
				
					if($result)
					{
						$edata = array('UsedBy'=>$id,
										'EpinStatus'=>'2',
										'ModifiedDate'=>$date);
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
							'TypeId'=>"19");

					$result1 = $this->common_model->SaveRecords($data1,'arm_history');

					// echo $this->db->last_query();
					
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
			
			redirect('user/upgrade');
			exit;
		}
		
		$this->load->view('user/upgrade');
	}

	public function checkbalance($id='')
	{

		if($this->input->post('check')=='check')
		{
			
			$mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');

			$balance=$this->input->post('current');
			$packageamt=$this->input->post('paymentamount');
			$package=$this->input->post('package');
			// echo $package;
			// exit;

			if($balance)
			{
				$this->form_validation->set_rules('current','current','trim|required|callback_bal_check');
			}
			if($this->form_validation->run()==true)
			{
					$date = date('y-m-d h:i:s');
					$Mdata = array('SubscriptionsStatus'=>'Active',
							'MemberStatus'=>'Active',
							'PackageId'=>$package,
							'ModifiedDate'=>$date);
					$result = $this->common_model->UpdateRecord($Mdata, "MemberId='".$id."'", 'arm_members');

					if($result)
					{
							$debitbalnce=$balance-$packageamt;
							$txnid = "UPG".rand(1111111,9999999);
							$data1 = array('MemberId'=>$id,
							'TransactionId'=>$txnid,
							'DateAdded'=>$date,
							'Description'=> "Member Upgrade using Account Balance",
							'Credit'=>$packageamt,
							'Debit'=>$packageamt,
							'Balance'=>$debitbalnce,
							'TypeId'=>"19");

						$result1 = $this->common_model->SaveRecords($data1,'arm_history');
						if($result1)
						{

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
							

						$bb = $this->MemberCommission_model->process($MemberId,$table,$field);
					  $this->session->set_flashdata('success_message','Successfully Upgrade Your Package');
					  $this->load->view('user/upgrade');
	
								
						}
						else
							{
							$this->session->set_flashdata('error_message','Sorry Your package Not Uppgrade');
			            	$this->load->view('user/upgrade');
	
							}

			}


			}

			
		else
		{
		$this->session->set_flashdata('error_message','Sorry Your Are Not Upgrade Your package');
		 $this->load->view('user/upgrade');

				
		}
	
			
	}
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
							'TypeId'=>"19");

					$result1 = $this->common_model->SaveRecords($data1,'arm_history');
					
					$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
							$field = "MemberId";
							$MemberId = $memberdetails->MemberId;
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

	public function bal_check($str)
	{
	  $packageamount=$this->input->post('paymentamount');

	  if($str >= $packageamount)
	  {
	  	return true;
	  }
	  else
	  {
	  	$this->form_validation->set_message('balance_check','Sorry Your Balance is Low Please Upgrade Package Other Payment Way');
	  	return false;
	  }
	}

	
	
}
