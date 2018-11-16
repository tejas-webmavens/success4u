<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		$this->lang->load('user/board',$this->session->userdata('language'));
	}


	public function index()
	{
		
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==5) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$this->data['board'] = '1';
		
		$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('board_mem_id'));
			
		if(strtolower($this->data['user']->SubscriptionsStatus)=='package'){
			$condition="PackageId='".$this->data['user']->PackageId."'";
			$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		}

		$this->data['PackageId'] = $this->data['packagedetails']->PackageId;
		$this->data['amount'] = $this->data['packagedetails']->PackageFee;
		$this->data['package'] = $this->data['packagedetails']->PackageName; 
		$this->data['MemberId'] = $this->data['user']->MemberId;
		
		if($this->input->post()) {

		}

		$this->load->view('user/board',$this->data);
		
	}

	public function process($id)
	{	
		
		if($this->input->post()) {
			// $this->form_validation->set_rules('epincode', 'epincode', 'trim|required');

			// if($this->form_validation->run() == TRUE) {

				$mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');
				$pckdetails = $this->common_model->GetRow("EpinTransactionId='".$this->input->post('epincode')."' AND EpinStatus='1' AND ExpiryDay>='".date('Y-m-d')."' ",'arm_epin');

				if($mdetails->SubscriptionsStatus=="package") {
					
					if($pckdetails) {

						if($mdetails->PackageId==$pckdetails->EpinPackageId) {
							
							$date = date('y-m-d h:i:s');
							$Mdata = array(
								'SubscriptionsStatus'	=>	'Active',
								'MemberStatus'	=>	'Active',
								'ModifiedDate'	=>	$date
							);

							$this->db->where('MemberId',$id);
							$result = $this->db->update('arm_members', $Mdata);

							if($result) {
				
								$edata = array(
									'UsedBy'	=>	$id,
									'EpinStatus'	=>	'2',
									'ModifiedDate'	=>	$date
								);
								$epresult = $this->common_model->UpdateRecord($edata, "EpinRecordId='".$pckdetails->EpinRecordId."'", 'arm_epin');
							
								// $aa = $this->Memberboardprocess_model->process($id);

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
								$this->boardCommission($MemberId);
								// $bb = $this->MemberCommission_model->process($MemberId,$table,$field);
							
								$this->session->set_flashdata('success_message', $this->lang->line('successmessage'));
								redirect('user/dashboard');
							}
							redirect('user/board');
							// exit;
						}

					} else {
						$this->session->set_flashdata('error_message', $this->lang->line('errormessageepin'));
					}
					
				} else {
					redirect('login');
				}

			// } else{
			// 	redirect('user/board');
			// }

			
			
			// redirect('user/register/checkepin/'.$id);
			// exit;
		} else  {
			redirect('login');
		}
	}


	public function checkbankwire($id='')
	{	
	
		if($this->input->post('checkwire')=='check')
		{
			
			$mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');
 			
 			if($mdetails->PackageId=='2'){
				$binary_plan_table = "arm_binary_plan1";
				$condition = "MemberId='".$id."'";
				$directid = $this->common_model->GetRow($condition,$binary_plan_table);
                
                $fetch_directid = "MemberId='".$directid->DirectId."'";
				$positionId = $this->common_model->GetRow($fetch_directid,$binary_plan_table);

				if($positionId->LeftId==$id){
					$pay_userid = '1';

				}
				else{
                   $pay_userid = $positionId->MemberId;
				}

			} else {
				$binary_plan_table = "arm_binary_plan2";
				
				$condition = "MemberId='".$id."'";
				$directid = $this->common_model->GetRow($condition,$binary_plan_table);
                
                $fetch_directid = "MemberId='".$directid->DirectId."'";
				$positionId = $this->common_model->GetRow($fetch_directid,$binary_plan_table);

				if($positionId->LeftId==$id){
					$pay_userid = '1';

				}
				else{
                   $pay_userid = $positionId->MemberId;
				}						
			}	

			$data = array(
				'AdminStatus'=>'0',
				'MemberStatus'=>'0',
				'ReceiveBy'=> $pay_userid,
				'PaymentAmount'=>$this->input->post('amt'),
				'PackageId'=>$mdetails->PackageId,
				'MemberId'=>$id,
				'APaymentReference'=>$this->input->post('epincode'),
				'DateAdded'=>date('y-m-d H:i:s')
			);
			$mtmresult = $this->common_model->SaveRecords($data,"arm_memberpayment1");

			$this->session->set_flashdata('success_message',$this->lang->line('successmtamsg'));
			redirect('login');
			exit();
			
			
		}
		
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==5) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$this->data['board'] = '1';
		
		$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('board_mem_id'));
			
		if(strtolower($this->data['user']->SubscriptionsStatus)=='package'){
			$condition="PackageId='".$this->data['user']->PackageId."'";
			$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		}

		$this->data['PackageId'] = $this->data['packagedetails']->PackageId;
		$this->data['amount'] = $this->data['packagedetails']->PackageFee;
		$this->data['package'] = $this->data['packagedetails']->PackageName; 
		$this->data['MemberId'] = $this->data['user']->MemberId;
			
			$this->load->view('user/board',$this->data);


	
	}

	function boardCommission($MemberId) {
		echo $MemberId;

	}
	
	

	
}
