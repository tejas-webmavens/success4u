<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtapay extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {

		//$this->load->helper('url');

		// Load form helper library
		//$this->load->helper('form');
		
		// Load database
		
		$this->load->model('Memberboardprocess_model');
		$this->load->model('MemberCommission_model');


		
		
		// change language
		//$this->config->set_item('language', 'spanish');

		// load language
		$this->lang->load('mtaadmin');
	}
	else
	{
		redirect('admin');
	}

	}

	public function index()
	{
	  
 		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
			
			// $condition = '';
			// $tableName = 'arm_history';
			
				$cdetail=$this->common_model->GetRow("Status='1'",'arm_currency');
			
				$this->data['members'] = $this->common_model->GetCustomers();
				$this->data['CurrencySymbol'] =$cdetail->CurrencySymbol;
				$this->data['transactions'] = $this->common_model->GetResults("EntryFor IN ('MTA','MTAU','MTAS','MTP','MTAD') AND AdminStatus='0'",'arm_memberpayment','*');
			    
			
			$this->load->view('admin/mtapay',$this->data);
	    } else {
	    	redirect('admin/login');

	    }	
	}

	public function search(){
		
		if($this->input->post()) 
		{
			//print_r($this->input->post());

			$condition = "Status= '0' AND AdminStatus= '0' AND  EntryFor IN ('MTA','MTAU','MTAS')";

			if($this->input->post('member'))
				$condition .= " AND MemberId =" . "'" . $this->input->post('member') . "' ";

			
			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(DateAdded) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";
			else if($this->input->post('datepicker1'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "'";
			else if($this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) <=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker2'))) . "'";

			$cdetail=$this->common_model->GetRow("Status='1'",'arm_currency');
			$this->data['members'] = $this->common_model->GetCustomers();	
			$this->data['CurrencySymbol'] =$cdetail->CurrencySymbol;
			$this->data['transactions'] = $this->common_model->GetResults($condition,'arm_memberpayment','*');

			// $this->data['transactions'] = $this->common_model->GetResults($condition, 'arm_history', '*');
			//print_r($this->data['transactions']);exit;
			$this->load->view('admin/mtapay', $this->data);
			
		} else {
			//$this->session->set_flashdata('error_message', 'Enter field value to search');
			redirect('admin/mtapay');
		}
	}

	
	
	public function delete($Id) {
		$condition = "Payid =" . "'" . $Id . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_memberpayment');

		if($status) {
			$this->session->set_flashdata('success_message',$this->lang->line('successmessagedel'));
			redirect('admin/mtapay');
		} else {
			$this->session->set_flashdata('error_message', $this->lang->line('errormessagedel'));
			redirect('admin/mtapay');
		}
		
	}

	public function accept($id='')
	{
		if($id!='')


		{
		    
			$mlmsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
            
			if($mlmsetting->Id==9)
			{
			$decdet = $this->common_model->GetRow("depositid='".$id."'","arm_memberpayment");


			}
			else
			{
			$decdet = $this->common_model->GetRow("Payid='".$id."'","arm_memberpayment");

			}
		
			if($decdet->AdminStatus=='0')
			{
				$bal = $this->common_model->Getcusomerbalance($decdet->MemberId);
				$txnid = "UPG".rand(1111111,9999999);
				$tx_id = $decdet->APaymentReference;
				$data1 = array(
					'MemberId'	=>	$decdet->MemberId,
					'DateAdded'	=>	date('Y-m-d H:i:s'),
					'PaymentReferenceId'	=>	$tx_id,
					'Credit'	=>	$decdet->PaymentAmount,
					'Debit'	=>	$decdet->PaymentAmount,
					'Balance'	=>	$bal,
					'TypeId'	=>	"19"
				);
				if($mlmsetting->Id==9)
				{
				$mladet	= $this->common_model->GetRow("depositid='".$id."'","arm_memberpayment");
				

				}
				else
				{
				$mladet	= $this->common_model->GetRow("Payid='".$id."'","arm_memberpayment");


				}
                	
				if($mladet->EntryFor=='MTA')
				{
				    

					$data1['Description'] = "Member Register using bankwire id ".$tx_id;
					$data1['TransactionId'] ='REG'.rand(1111111,9999999);
					$result1 = $this->common_model->SaveRecords($data1,'arm_history');
                    
					$subscriptiontype=$this->common_model->GetRow("KeyValue='subscriptiontype' AND Page='usersetting'","arm_setting");
					if($subscriptiontype->ContentValue=='monthly')
					{
						$nxtperiod=30;
					}
					else
					{
						$nxtperiod=365;
					}
				
					$date = date("Y-m-d H:i:s ");
					$nxtdat = strtotime("+".$nxtperiod." day", strtotime($date));
					$nxtdate=date('Y-m-d H:i:s ', $nxtdat);
					
					$umdata = array(
						'SubscriptionsStatus'=>'Active',
						'MemberStatus'=>'Active',
						'ModifiedDate'=>$date,
						'EndDate'=>$nxtdate
					);

					$umresult = $this->common_model->UpdateRecord($umdata,"MemberId='".$decdet->MemberId."'","arm_members");
				    
				$dd=$this->Memberboardprocess_model->process($mladet->MemberId);


                    

					$field = "MemberId";
					$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
					
					$field = "MemberId";
					$MemberId = $mladet->MemberId;
					
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
						$monomdet = $this->common_model->GetRow("MemberId='". $mladet->MemberId."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");

						$MemberId = $monomdet->MonoLineId;

					}
					else if($mlsetting->Id==4)
					{
						$table = "arm_binarymatrix";
						$this->Memberboardprocess_model->Totaldowncount($table);

					}
					else if($mlsetting->Id==5)
					{
					    
						$table = "arm_boardmatrix";
						$field = "MemberId";
						$brdmdet = $this->common_model->GetRow("MemberId='". $mladet->MemberId."' order by BoardMemberId ASC LIMIT 0,1","arm_boardmatrix");
					
						
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
						$this->Memberboardprocess_model->Totaldowncount($table);
						$this->Memberboardprocess_model->binaryhyip($MemberId,$table);

					}
					$bb = $this->MemberCommission_model->process($MemberId,$table,$field);
					// exit;
				
					$data = array(
						'AdminStatus'=>"1",
						'Status'=>'1'
					);
					$updates=$this->common_model->UpdateRecord($data,"Payid='".$id."'","arm_memberpayment");
					if($updates)
					{
						$this->session->set_flashdata('success_message',$this->lang->line('successmessageaccept'));
						redirect("admin/mtapay");

					}


				}
				if($mladet->EntryFor=='MTAD')
				{
						$mlmsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");

						if($mlmsetting->Id==9)
						{
					     $userid = $this->common_model->GetRow("depositid='".$id."'","arm_memberpayment"); 

						}
						else
						{
					   $userid = $this->common_model->GetRow("Payid='".$id."'","arm_memberpayment"); 

						}

						$data1['Description'] = "Member Deposit using bankwire";
						$deposit=$userid->depositid;
					    $amountuser=$this->common_model->GetRow("id='". $deposit."'","deposit");
						// $data1['Credit']=
						$amount= $amountuser->amount;
						$data1['depositid']=$deposit;
						$data1['Description'] = "Member Upgrade using bankwire id ".$tx_id;
						$data1['TransactionId'] ='UPG'.rand(1111111,9999999);
						$result1 = $this->common_model->SaveRecords($data1,'arm_history');
						$subscriptiontype=$this->common_model->GetRow("KeyValue='subscriptiontype' AND Page='usersetting'","arm_setting");
						if($subscriptiontype->ContentValue=='monthly')
						{
							$nxtperiod=30;
						}
						else
						{
							$nxtperiod=365;
						}
						$date = date("Y-m-d H:i:s ");
						$nxtdat = strtotime("+".$nxtperiod." day", strtotime($date));
						$nxtdate=date('Y-m-d H:i:s ', $nxtdat);
						$umdata = array("PackageId"=>$decdet->PackageId,
										"EndDate"=>$nxtdate);
						$umresult = $this->common_model->UpdateRecord($umdata,"MemberId='".$decdet->MemberId."'","arm_members");

						$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
						if($mlsetting->Id==8 && $mladet->EntryFor=='MTAD')
						{
							$data = array(
								"AdminStatus"=>"1",
								"Status"=>"1"
							);
							$update=$this->common_model->UpdateRecord($data,"Payid='".$id."'","arm_memberpayment");
							if($update)
							{
								$this->session->set_flashdata('success_message',$this->lang->line('successmessageuaccept'));
								redirect("admin/mtapay");


							}
	                       
			                             
						}
						else
						{
							$field = "MemberId";
							$MemberId = $mladet->MemberId;
							
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
								$monomdet = $this->common_model->GetRow("MemberId='". $mladet->MemberId."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");

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
								$brdmdet = $this->common_model->GetRow("MemberId='". $mladet->MemberId."' order by BoardMemberId ASC LIMIT 0,1","arm_monolinematrix");

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
							else if($mlsetting->Id==8)
							{
								$table = "arm_boardmatrix1";
							}
							else if($mlsetting->Id==9)
							{

								$table = "arm_binaryhyip";

								$amountuser=$this->common_model->GetRow("id='". $deposit."'","deposit");
								
							    $memberleft=$this->common_model->GetRow("LeftId='".$MemberId."'","arm_binaryhyip");
							    if($memberleft!="")
							    {
							    $amountleft=$memberleft->LeftCarryForward;
							    $totalleft=$amountleft+$amountuser->amount;
							    }
							    else
							    {
							     $amountleft=0;
							     $totalleft=$amountleft+$amountuser->amount;
							    }
							   
								$memberright=$this->common_model->GetRow("RightId='".$MemberId."'","arm_binaryhyip");
								if($memberright!="")
								{
									$amountright=$memberright->RightCarryForward;
							     $totalright=$amountright+$amountuser->amount;
								}
								else
								{
									$amountright=0;
									 $totalright=$amountright+$amountuser->amount;
								}
							    
								if($memberleft)
								{
								 $this->Memberboardprocess_model->binaryhyip($MemberId,$table);
								 $update=$this->db->query("update `arm_binaryhyip` set LeftCarryForward='".$totalleft."' where LeftId='".$MemberId."'");
								 $this->MemberCommission_model->paircommissionhyip();
								 $this->Memberboardprocess_model->Totaldowncount($table);
								}
								elseif($memberright)
								{
									 $this->Memberboardprocess_model->binaryhyip($MemberId,$table);
								 $update=$this->db->query("update `arm_binaryhyip` set RightCarryForward='".$totalright."' where RightId='".$MemberId."'");
								  $this->MemberCommission_model->paircommissionhyip();
								 $this->Memberboardprocess_model->Totaldowncount($table);
								}
								else
								{
								$this->Memberboardprocess_model->binaryhyip($MemberId,$table);
								 // $update=$this->db->query("update `arm_binaryhyip` set LeftcarryForward='".$amountuser->amount."'")
								 $this->Memberboardprocess_model->Totaldowncount($table);
								}
						}
					
						$bb = $this->MemberCommission_model->process($MemberId,$table,$field);
						// exit;
				
						$data = array(
							"AdminStatus"=>"1",
							"Status"=>"1"
						);
						if($mlsetting->Id==9)
						{
							$update1=$this->common_model->UpdateRecord($data,"depositid='".$id."'","arm_memberpayment");
							// echo $this->db->last_query();
							// exit;
							if($update1)
							{
								$this->session->set_flashdata('success_message',$this->lang->line('successmessageuaccept'));
								redirect("admin/mtapay");

							}

						}
						else
						{
						$this->common_model->UpdateRecord($data,"Payid='".$id."'","arm_memberpayment");

						}

					if($mlsetting->Id==9)

						{
						
						  $id = $this->common_model->GetRow("depositid='".$id."'","arm_memberpayment"); 
						  $deposit=$id->depositid;
						  $planid=$this->common_model->GetRow("id='". $deposit."'","deposit");
						  $packageplan=$planid->PackageId;
						  $packageduration=$this->common_model->GetRow("PackageId='".  $packageplan."'","arm_hyip"); 
						  $duration=$packageduration->duration;

						  $accept_date = date("Y-m-d H:i:s");
			    		  $date = $accept_date;
						  $date = strtotime($date);
						  $date = strtotime("+".$packageduration->duration. " day" , $date);
						  $mature_date = date('Y-m-d H:i:s', $date);

						  $date = strtotime($accept_date);
                          $date = strtotime("+ 1 day" , $date);
                          $next_run_date = date('Y-m-d H:i:s', $date);
                       
                        

							$data1=array('status'=>1,
								'DateAdded'=>$accept_date,
								'next_run_date'=> $next_run_date,
								'mechureddate'=>$mature_date,

								);
							$current_new_date=date("Y-m-d H:i:s");
							$this->common_model->UpdateRecord($data1,"id='".$id->depositid."'","deposit");
							
							$this->session->set_flashdata('success_message',$this->lang->line('successmessageuaccept'));
					
						}
						
						redirect("admin/mtapay");
						exit;

						}
                }

				if($mladet->EntryFor=='MTAU')
				{
					$mlmsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");

					if($mlmsetting->Id==9)
					{
				   $userid = $this->common_model->GetRow("depositid='".$id."'","arm_memberpayment"); 

					}
					else
					{
				   $userid = $this->common_model->GetRow("Payid='".$id."'","arm_memberpayment"); 

					}

					$data1['Description'] = "Member Deposit using bankwire";
					$deposit=$userid->depositid;
				    $amountuser=$this->common_model->GetRow("id='". $deposit."'","deposit");
					// $data1['Credit']=
					$amount= $amountuser->amount;
					$data1['depositid']=$deposit;
					$data1['Description'] = "Member Upgrade using bankwire id ".$tx_id;
					$data1['TransactionId'] ='UPG'.rand(1111111,9999999);
					$result1 = $this->common_model->SaveRecords($data1,'arm_history');
					$subscriptiontype=$this->common_model->GetRow("KeyValue='subscriptiontype' AND Page='usersetting'","arm_setting");
					if($subscriptiontype->ContentValue=='monthly')
					{
						$nxtperiod=30;
					}
					else
					{
						$nxtperiod=365;
					}
					$date = date("Y-m-d H:i:s ");
					$nxtdat = strtotime("+".$nxtperiod." day", strtotime($date));
					$nxtdate=date('Y-m-d H:i:s ', $nxtdat);
					$umdata = array("PackageId"=>$decdet->PackageId,
									"EndDate"=>$nxtdate);
					$umresult = $this->common_model->UpdateRecord($umdata,"MemberId='".$decdet->MemberId."'","arm_members");

					$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
					if($mlsetting->Id==8 && $mladet->EntryFor=='MTAU')
					{
						$this->session->set_flashdata('success_message',$this->lang->line('successmessageuaccept'));
					$data = array(
						"AdminStatus"=>"1",
						"Status"=>"1"
					);
					$this->common_model->UpdateRecord($data,"Payid='".$id."'","arm_memberpayment");
					redirect("admin/mtapay");
                       
		                             
					}else{
					$field = "MemberId";
					$MemberId = $mladet->MemberId;
					
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
						$monomdet = $this->common_model->GetRow("MemberId='". $mladet->MemberId."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");

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
						$brdmdet = $this->common_model->GetRow("MemberId='". $mladet->MemberId."' order by BoardMemberId ASC LIMIT 0,1","arm_monolinematrix");

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
					else if($mlsetting->Id==8)
					{
						$table = "arm_boardmatrix1";
					}
					else if($mlsetting->Id==9)
					{
						$table = "arm_binaryhyip";

						$amountuser=$this->common_model->GetRow("id='". $deposit."'","deposit");
						
					    $memberleft=$this->common_model->GetRow("LeftId='".$MemberId."'","arm_binaryhyip");
					    if($memberleft!="")
					    {
					    $amountleft=$memberleft->LeftCarryForward;
					    $totalleft=$amountleft+$amountuser->amount;
					    }
					    else
					    {
					     $amountleft=0;
					     $totalleft=$amountleft+$amountuser->amount;
					    }
					   
						$memberright=$this->common_model->GetRow("RightId='".$MemberId."'","arm_binaryhyip");
						if($memberright!="")
						{
							$amountright=$memberright->RightCarryForward;
					     $totalright=$amountright+$amountuser->amount;
						}
						else
						{
							$amountright=0;
							 $totalright=$amountright+$amountuser->amount;
						}
					    
						if($memberleft)
						{
						 $this->Memberboardprocess_model->binaryhyip($MemberId,$table);
						 $update=$this->db->query("update `arm_binaryhyip` set LeftCarryForward='".$totalleft."' where LeftId='".$MemberId."'");
						 $this->MemberCommission_model->paircommissionhyip();
						 $this->Memberboardprocess_model->Totaldowncount($table);
						}
						elseif($memberright)
						{
							 $this->Memberboardprocess_model->binaryhyip($MemberId,$table);
						 $update=$this->db->query("update `arm_binaryhyip` set RightCarryForward='".$totalright."' where RightId='".$MemberId."'");
						  $this->MemberCommission_model->paircommissionhyip();
						 $this->Memberboardprocess_model->Totaldowncount($table);
						}
						else
						{
						$this->Memberboardprocess_model->binaryhyip($MemberId,$table);
						 // $update=$this->db->query("update `arm_binaryhyip` set LeftcarryForward='".$amountuser->amount."'")
						 $this->Memberboardprocess_model->Totaldowncount($table);
						}
					}
					
					
						// echo "mmm =>".$mladet->MemberId." table =>".$table." field =>".$field; exit;
					$bb = $this->MemberCommission_model->process($MemberId,$table,$field);
			
					$this->session->set_flashdata('success_message',$this->lang->line('successmessageuaccept'));
					$data = array(
						"AdminStatus"=>"1",
						"Status"=>"1"
					);
					if($mlsetting->id==9)
					{
					$this->common_model->UpdateRecord($data,"depositid='".$id."'","arm_memberpayment");

					}
					else
					{
					$this->common_model->UpdateRecord($data,"Payid='".$id."'","arm_memberpayment");

					}

					if($mlsetting->Id==9)
					{
					// $record = $this->common_model->GetRow("MemberId='". $mladet->MemberId."'","deposit");
					// $planid=$record->id;
					// $depositid=$this->common_model->GetRow("id='".$planid."'","deposit");

						  $id = $this->common_model->GetRow("depositid='".$id."'","arm_memberpayment"); 
						  $deposit=$id->depositid;
						  $planid=$this->common_model->GetRow("id='". $deposit."'","deposit");
						  $packageplan=$planid->PackageId;
						  $packageduration=$this->common_model->GetRow("PackageId='".  $packageplan."'","arm_hyip"); 
						  $duration=$packageduration->duration;

						$accept_date = date("Y-m-d H:i:s");
			    		$date = $accept_date;
						$date = strtotime($date);
						$date = strtotime("+".$packageduration->duration. " day" , $date);
						$mature_date = date('Y-m-d H:i:s', $date);

						  $date = strtotime($accept_date);
                         $date = strtotime("+ 1 day" , $date);
                         $next_run_date = date('Y-m-d H:i:s', $date);
                       
                        

						$data1=array('status'=>1,
							'DateAdded'=>$accept_date,
							'next_run_date'=> $next_run_date,
							'mechureddate'=>$mature_date,

							);
						$current_new_date=date("Y-m-d H:i:s");
						$this->common_model->UpdateRecord($data1,"id='".$id->depositid."'","deposit");
						
						$this->session->set_flashdata('success_message',$this->lang->line('successmessageuaccept'));
				
					}
					
				
					redirect("admin/mtapay");
					exit;

					}
                }
				if($mladet->EntryFor=='MTAS')
				{
					$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");

					$data1['Description'] = "Member Subscription using bankwire id ".$tx_id;
					
					$data1['TransactionId'] ='SUB'.rand(1111111,9999999);
					$result1 = $this->common_model->SaveRecords($data1,'arm_history');
					
					$subscriptiontype=$this->common_model->GetRow("KeyValue='subscriptiontype' AND Page='usersetting'","arm_setting");
					if($subscriptiontype->ContentValue=='monthly')
					{
						$nxtperiod=30;
					}
					else
					{
						$nxtperiod=365;
					}
					$detmember=$this->common_model->GetRow("MemberId='".$decdet->MemberId."'","arm_members");
					
					// $curdate=date("Y-m-d H:i:s ");
					$nxtdat = strtotime("+".$nxtperiod." day", strtotime($detmember->EndDate));
					$nxtdate=date('Y-m-d H:i:s ', $nxtdat);

					$umdata = array('SubscriptionsStatus'=>'Active',
									'MemberStatus'=>'Active',
									'EndDate'=>$nxtdate
									);

					$umresult = $this->common_model->UpdateRecord($umdata,"MemberId='".$decdet->MemberId."'","arm_members");
					
					$mdata=array("Status"=>"1");
					$mresult = $this->common_model->UpdateRecord($mdata,"MemberId='".$decdet->MemberId."'",$mlsetting->TableName);


					
					$field = "MemberId";
					$MemberId = $mladet->MemberId;
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
						$monomdet = $this->common_model->GetRow("MemberId='". $mladet->MemberId."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");

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
						$brdmdet = $this->common_model->GetRow("MemberId='". $mladet->MemberId."' order by BoardMemberId ASC LIMIT 0,1","arm_monolinematrix");

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
					else if($mlsetting->Id==8)
					{
						$table = "arm_boardmatrix1";
					}
						// echo "mmm =>".$mladet->MemberId." table =>".$table." field =>".$field; exit;
						$this->Memberboardprocess_model->Totaldowncount();
					
					$bb = $this->MemberCommission_model->process($MemberId,$table,$field);
			
					$this->session->set_flashdata('success_message',$this->lang->line('successmessagesaccept'));
					$data = array(
						"AdminStatus"=>"1",
						"Status"=>"1"
					);
					$this->common_model->UpdateRecord($data,"Payid='".$id."'","arm_memberpayment");
				
					redirect("admin/mtapay");

				}
				if($mladet->EntryFor=='MTP')
				{
					$data1['Description'] = "Member Purchase using bankwire id ".$tx_id;
					$data1['TransactionId'] ='PAY'.rand(1111111,9999999);
					$result1 = $this->common_model->SaveRecords($data1,'arm_history');
					
			
					$this->session->set_flashdata('success_message',$this->lang->line('successmessagepaccept'));
					$data = array(
						"AdminStatus"=>"1",
						"Status"=>"1"
					);
					$this->common_model->UpdateRecord($data,"Payid='".$id."'","arm_memberpayment");
				
					redirect("admin/mtapay");

					}
                
				
			}
			
			
		}
		else
		{
			$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
			redirect("admin/mtapay");
			exit;
		}

	}


	public function decline($id='')
	{

		if($id!='')
		{

			$decdet = $this->common_model->GetRow("Payid='".$id."'","arm_memberpayment");
			
			if($decdet->AdminStatus	==0)
			{
				$data = array("AdminStatus"=>"2","Status"=>"1");
				$dd = $this->common_model->UpdateRecord($data,"Payid='".$id."'","arm_memberpayment");
				if($dd)
				$this->session->set_flashdata('success_message',$this->lang->line('successmessagedecline'));
			}
			
			redirect("admin/mtapay");
		}
		else
		{
			$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
			redirect("admin/mtapay");
			exit;
		}

	}


	public function matrix()
	{
			$getalluser=$this->common_model->allmember();
		
		// foreach ($getalluser as $row)
		//  {
		//  	echo "<br>".$row->MemberId;
		//  }
		//  exit;
		 	for ($i=0; $i < count($getalluser); $i++) 
			{ 
			
		    $memberid= $getalluser[$i]->MemberId;
		    $checkboard=$this->common_model->GetRowcount('MemberId='.$memberid.'',"arm_boardmatrix");
		    // echo $this->db->last_query();
		    // echo "<br>";

		    if($checkboard==0)
		    {
		    	$data=array('AdminStatus'=>1,
							'Status'=>1
		    		);
		    	$update=$this->common_model->UpdateRecord('MemberId='.$memberid.'',"arm_memberpayment");
		    	if($update)
		    	{
		    		$this->Memberboardprocess_model->process($memberid);

		    		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
					$field = "MemberId";
					$MemberId = $memberid;
					
					if($mlsetting->Id==5)
					{
						$table = "arm_boardmatrix";
						$field = "MemberId";
						$brdmdet = $this->common_model->GetRow("MemberId='". $memberid."' order by BoardMemberId ASC LIMIT 0,1","arm_boardmatrix");
						// echo $this->db->last_query();
					}
					
						
					$bb = $this->MemberCommission_model->process($MemberId,$table,$field);
		    	}

		    	
					
		    }

		 }

  }


}
