<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlmsetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
			// Load database
			$this->load->model('admin/Mlmsetting_model');
			
			$this->lang->load('mlmsetting');
		
		}  else {
	    	redirect('admin/login');
	    }
	}

	public function index()
	{

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				print_r($this->input->post());
				exit;
			}
			else
			{
				$this->data['matrix'] = $this->common_model->GetResults("","arm_matrixsetting");
				$this->load->view('admin/martixsettinglist',$this->data);
			}

		}
		else
		{
			redirect('admin/login');
		}

	}

	public function enable($id)
	{
		$econdition = "Id =" . "'" . $id . "'";

		$edata = array(
			'MatrixStatus' => '1'
		);

		$dcondition = "Id !=" . "'" . $id . "'";

		$ddata = array(
			'MatrixStatus' => '0'
		);
		

		$defspnid = $this->common_model->GetRow("Page ='sitesetting' AND KeyValue='defaultsponsors'","arm_setting");
		if($id == '8'){
			$result1 = $this->db->query("DELETE FROM arm_members WHERE MemberId >'4' ");
		}
		else{
			$result1 = $this->db->query("DELETE FROM arm_members WHERE MemberId >'2' ");
		}

		$this->db->truncate('arm_history');
		$this->db->truncate('arm_epin');
		$this->db->truncate('arm_memberpayment');
		$this->db->truncate('arm_member_activity');
		$this->db->truncate('arm_order');
		$this->db->truncate('arm_order_product');
		$this->db->truncate('arm_order_total');

		$result4 = $this->db->query("DELETE FROM arm_binarymatrix WHERE MatrixId >'2'");
		$update4 = $this->db->query("UPDATE arm_binarymatrix SET MemberCount='0',LeftId='0',RightId='0',LeftPv='0',RightPv='0',LeftCount='0',LeftPairCount='0',RightCount='0',RightPairCount='0',MemberCount='0',leftdowncount='0',rightdowncount='0'  WHERE MemberId ='2'");

		$result13= $this->db->query("DELETE FROM arm_binaryhyip WHERE MatrixId >'2'");
		$update13 = $this->db->query("UPDATE arm_binaryhyip SET MemberCount='0',LeftId='0',RightId='0',LeftPv='0',RightPv='0',LeftCount='0',LeftPairCount='0',RightCount='0',RightPairCount='0',MemberCount='0',leftdowncount='0',rightdowncount='0',LeftCarryForward='0',RightCarryForward='0'  WHERE MemberId ='2'");

		$result5 = $this->db->query("DELETE FROM arm_boardmatrix WHERE BoardMemberId >'2'");
		$update5 = $this->db->query("UPDATE arm_boardmatrix SET MemberCount='0', ReentryStatus='0',BoardCommissionStatus='0',NextReentryStatus='0'  WHERE MemberId ='2'");

		$result6 = $this->db->query("DELETE FROM arm_forcedmatrix WHERE MatrixId >'2'");
		$update6 = $this->db->query("UPDATE arm_forcedmatrix SET MemberCount='0'  WHERE MemberId ='2'");

		$result7 = $this->db->query("DELETE FROM arm_monolinematrix WHERE MonoLineId >'2'");
		$update7 = $this->db->query("UPDATE arm_monolinematrix SET MemberCount='0'  WHERE MemberId ='2'");

		$result8 = $this->db->query("DELETE FROM arm_oddevenmatrix WHERE MatrixId >'2'");
		$update8 = $this->db->query("UPDATE arm_oddevenmatrix SET MemberCount='0',XupCount='0',PassedUpSend='',PassedUpReceive=''  WHERE MemberId ='2'");

		$result9 = $this->db->query("DELETE FROM arm_unilevelmatrix WHERE MatrixId >'2'");
		$update9 = $this->db->query("UPDATE arm_unilevelmatrix SET MemberCount='0' WHERE MemberId ='2'");

		$result10 = $this->db->query("DELETE FROM arm_xupmatrix WHERE MatrixId >'2'");
		
		$xupset = $this->common_model->GetRow("Id='6'","arm_matrixsetting");
		$update10 = $this->db->query("UPDATE arm_xupmatrix SET MemberCount='0',XupCount='".$xupset->Position."',PassedUpSend='',PassedUpReceive=''  WHERE MemberId ='2'");
		
		if($id == '8'){
			$update11 = $this->db->query("UPDATE arm_setting SET ContentValue ='4' WHERE Page = 'sitesetting'AND KeyValue ='defaultsponsors'");
                            
		}else{
			$update11 = $this->db->query("UPDATE arm_setting SET ContentValue ='2' WHERE Page = 'sitesetting'AND KeyValue ='defaultsponsors'");
		}
		$result12 = $this->db->query("DELETE FROM arm_boardmatrix1 WHERE BoardMemberId >'4'");
	    $update12 = $this->db->query("UPDATE arm_boardmatrix1 SET MemberCount='0', ReentryStatus='0',BoardCommissionStatus='0',NextReentryStatus='0'  WHERE MemberId ='4'");

		$status = $this->common_model->UpdateRecord($edata, $econdition, 'arm_matrixsetting');
		$status1 = $this->common_model->UpdateRecord($ddata, $dcondition, 'arm_matrixsetting');
		if($status) {
			redirect('admin/mlmsetting');
		}
	}

	public function editmlm($id)
	{
		
		$this->data['matrixdetails'] = $this->common_model->GetRow("Id='".$id."'","arm_matrixsetting");
		
		if($this->input->post())
		{

			foreach ($this->input->post() as $key=>$value) 
			{
			 	$this->form_validation->set_rules($key, ucwords($key), 'trim|required|numeric');
		 	}

			if($this->form_validation->run()== true)
 			{
 				$data = array(
 					'MatrixStatus'=>$this->input->post('matrixstatus'),
					'MatrixWidth'=>$this->input->post('matrixwidth'),
					'MatrixDepth'=>$this->input->post('matrixdepth'),
					'Position'=>$this->input->post('position'),
					'MTMPayStatus'=>$this->input->post('membertomemberpaystatus'),
					'BoardCommissionStatus'=>$this->input->post('boardcommissionstatus'),
					'BoardCommissionType'=>$this->input->post('boardcommissiontype'),
					'LevelCommissionStatus'=>$this->input->post('levelcommissionstatus'),
					'DirectCommissionStatus'=>$this->input->post('directcommissionstatus'),
					'OwnCommissionStatus'=>$this->input->post('owncommissionstatus'),
					'LevelCommissionType'=>$this->input->post('levelcommissiontype'),
					'DirectCommissionType'=>$this->input->post('directcommissiontype'),
					'OwnCommissionType'=>$this->input->post('owncommissiontype'),
					'ChangeDirect'=>$this->input->post('changedirect'),
					'FreeMember'=>$this->input->post('freemember'),
					'RankStatus'=>$this->input->post('rankstatus'),
					'MatrixCommission'=>$this->input->post('matrixcommission'),
					'RepeatCommissionStatus'=>$this->input->post('repeatcommissionstatus'),
					'EarnCommisionStatus'=>$this->input->post('earncommisionstatus'),
					'SpilloverSystem'=>$this->input->post('spilloversystem'),
					'RecycleStatus'=>$this->input->post('recyclestatus'),
					'RecycleCount'=>$this->input->post('recyclecount'),
					'RecycleCommission'=>$this->input->post('recyclecommission'),
					'RecycleCommissionType'=>$this->input->post('recycleCommissiontype'),
					'CarryForward'=>$this->input->post('carryforward'),
					'MatchingPair'=>$this->input->post('lpair').':'.$this->input->post('rpair'),
					'CommissionProcess'=>$this->input->post('commissionprocess'),
					'MatrixUpline'=>$this->input->post('MatrixUpline')
				);


				$result = $this->common_model->UpdateRecord($data,"Id='".$id."'", "arm_matrixsetting");
				if($this->input->post('matrixstatus')==1)
				{
					$data = array(
							'MatrixStatus'=>"0"
						);
					$result = $this->common_model->UpdateRecord($data,"Id!='".$id."'", "arm_matrixsetting");
					if($this->input->post('cleardb')==1)
					{
						$defspnid = $this->common_model->GetRow("Page ='sitesetting' AND KeyValue='defaultsponsors'","arm_setting");
						if($id == '8'){
							$result1 = $this->db->query("DELETE FROM arm_members WHERE MemberId >'4' ");
						    $alter1=$this->db->query("ALTER table `arm_members` auto_increment=3");

						}
						else{
							$result1 = $this->db->query("DELETE FROM arm_members WHERE MemberId >'2' ");
						    $alter1=$this->db->query("ALTER table `arm_members` auto_increment=3");

						}
						
						
						

						$this->db->truncate('arm_history');
						$this->db->truncate('arm_epin');
						$this->db->truncate('arm_memberpayment');
						$this->db->truncate('deposit');
						$this->db->truncate('arm_member_activity');
						$this->db->truncate('arm_order');
						$this->db->truncate('arm_order_product');
						$this->db->truncate('arm_order_total');
						
						
						$result4 = $this->db->query("DELETE FROM arm_binarymatrix WHERE MatrixId >'2'");
						$update4 = $this->db->query("UPDATE arm_binarymatrix SET MemberCount='0',LeftId='0',RightId='0',LeftPv='0',RightPv='0',LeftCount='0',LeftPairCount='0',RightCount='0',RightPairCount='0',MemberCount='0',leftdowncount='0',rightdowncount='0'  WHERE MemberId ='2'");
						$alter4=$this->db->query("ALTER table `arm_binarymatrix` auto_increment=3");

						$result13 = $this->db->query("DELETE FROM arm_binaryhyip WHERE MatrixId >'2'");
						$update13 = $this->db->query("UPDATE arm_binaryhyip SET MemberCount='0',LeftId='0',RightId='0',LeftPv='0',RightPv='0',LeftCount='0',LeftPairCount='0',RightCount='0',RightPairCount='0',MemberCount='0',leftdowncount='0',rightdowncount='0',LeftCarryForward='0',RightCarryForward='0'  WHERE MemberId ='2'");
						$alter13=$this->db->query("ALTER table `arm_binaryhyip` auto_increment=3");


						$result5 = $this->db->query("DELETE FROM arm_boardmatrix WHERE BoardMemberId >'2'");
						$update5 = $this->db->query("UPDATE arm_boardmatrix SET MemberCount='0', ReentryStatus='0',BoardCommissionStatus='0',NextReentryStatus='0'  WHERE MemberId ='2'");
						$alter5=$this->db->query("ALTER table `arm_boardmatrix` auto_increment=3");


						$result6 = $this->db->query("DELETE FROM arm_forcedmatrix WHERE MatrixId >'2'");
						$update6 = $this->db->query("UPDATE arm_forcedmatrix SET MemberCount='0',Totalmembers='0'  WHERE MemberId ='2'");
						$update61 = $this->db->query("UPDATE arm_forcedmatrix SET Totalmembers='1'  WHERE MemberId ='1'");

						$alter6=$this->db->query("ALTER table `arm_forcedmatrix` auto_increment=3");


						$result7 = $this->db->query("DELETE FROM arm_monolinematrix WHERE MonoLineId >'2'");
						$update7 = $this->db->query("UPDATE arm_monolinematrix SET MemberCount='0'  WHERE MemberId ='2'");

						$alter7=$this->db->query("ALTER table `arm_monolinematrix` auto_increment=3");


						$result8 = $this->db->query("DELETE FROM arm_oddevenmatrix WHERE MatrixId >'2'");
						$update8 = $this->db->query("UPDATE arm_oddevenmatrix SET MemberCount='0',XupCount='0',PassedUpSend='',PassedUpReceive='',XupStatus='1'  WHERE MemberId ='2'");
						$update81=$this->db->query("UPDATE arm_oddevenmatrix SET MemberCount='1',XupCount='0',PassedUpSend='',PassedUpReceive='',XupStatus='1'  WHERE MemberId ='1'");
						$alter8=$this->db->query("ALTER table `arm_oddevenmatrix` auto_increment=3");


						$result9 = $this->db->query("DELETE FROM arm_unilevelmatrix WHERE MatrixId >'2'");
						$update9 = $this->db->query("UPDATE arm_unilevelmatrix SET MemberCount='0' WHERE MemberId ='2'");
						$alter9=$this->db->query("ALTER table `arm_unilevelmatrix` auto_increment=3");


						$result10 = $this->db->query("DELETE FROM arm_xupmatrix WHERE MatrixId >'2'");
						$xupset = $this->common_model->GetRow("Id='6'","arm_matrixsetting");
						$update10 = $this->db->query("UPDATE arm_xupmatrix SET MemberCount='0',XupCount='0',PassedUpSend='',PassedUpReceive='' WHERE MemberId ='2'");
						$update101 = $this->db->query("UPDATE arm_xupmatrix SET MemberCount='1',XupCount='0',PassedUpSend='',PassedUpReceive='' WHERE MemberId ='1'");
						$alter10=$this->db->query("ALTER table `arm_xupmatrix` auto_increment=3");

	
						if($id == '8'){
						$update11 = $this->db->query("UPDATE arm_setting SET ContentValue ='4' WHERE Page = 'sitesetting'AND KeyValue ='defaultsponsors'");
                          
						}else{
						$update11 = $this->db->query("UPDATE arm_setting SET ContentValue ='2' WHERE Page = 'sitesetting'AND KeyValue ='defaultsponsors'");
						}
						$result12 = $this->db->query("DELETE FROM arm_boardmatrix1 WHERE BoardMemberId >'4'");
						$update12 = $this->db->query("UPDATE arm_boardmatrix1 SET MemberCount='0', ReentryStatus='0',BoardCommissionStatus='0',NextReentryStatus='0'  WHERE MemberId ='4'");

					}
				}
				$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
				redirect("admin/mlmsetting");
			}
			else
			{
				$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
				$this->data['matrixdetails'] = $this->common_model->GetRow("Id='".$id."'","arm_matrixsetting");
				$this->data['matrixid'] = $id;
				$this->load->view('admin/editmlm',$this->data);
			}
		}
		else
		{
			$this->data['matrixdetails'] = $this->common_model->GetRow("Id='".$id."'","arm_matrixsetting");
			$this->data['matrixid'] = $id;
			//print_r($this->data['matrixdetails']);
			$this->load->view('admin/editmlm',$this->data);
		}

	}

	public function mlmsetting()
	{
		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
					
				$this->form_validation->set_rules('matrixwidth', $this->lang->line('matrixwidth'), 'trim|required|numeric');
				$this->form_validation->set_rules('matrixdepth', $this->lang->line('matrixdepth'), 'trim|required|numeric');
				$this->form_validation->set_rules('levelcommissionstatus', $this->lang->line('levelcommissionstatus'), 'trim|required');
				$this->form_validation->set_rules('directcommissionstatus', $this->lang->line('directcommissionstatus'), 'trim|required');
				$this->form_validation->set_rules('owncommissionstatus', $this->lang->line('owncommissionstatus'), 'trim|required');
				$this->form_validation->set_rules('changedirect', $this->lang->line('changedirect'), 'trim|required');

 				if($this->form_validation->run()== true)
 				{

 					$data = array(
						'matrixwidth'=>$this->input->post('matrixwidth'),
						'matrixdepth'=>$this->input->post('matrixdepth'),
						'levelcommissionstatus'=>$this->input->post('levelcommissionstatus'),
						'directcommissionstatus'=>$this->input->post('directcommissionstatus'),
						'owncommissionstatus'=>$this->input->post('owncommissionstatus'),
						'levelcommissiontype'=>$this->input->post('levelcommissiontype'),
						'directcommissiontype'=>$this->input->post('directcommissiontype'),
						'owncommissiontype'=>$this->input->post('owncommissiontype'),
						'changedirect'=>$this->input->post('changedirect'),
						'freemember'=>$this->input->post('freemember'),
						'matrixcommission'=>$this->input->post('matrixcommission'),
						'repeatcommissionstatus'=>$this->input->post('repeatcommissionstatus'),
						'earncommisionstatus'=>$this->input->post('earncommisionstatus'),
						'spilloversystem'=>$this->input->post('spilloversystem'),
						'recyclestatus'=>$this->input->post('recyclestatus')
					);

					$result = $this->Mlmsetting_model->Update($data);
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
				}
				
				$this->data['matrixwidth']= $this->Mlmsetting_model->Getdata('matrixwidth');
				$this->data['matrixdepth']= $this->Mlmsetting_model->Getdata('matrixdepth');
				$this->data['levelcommissionstatus']= $this->Mlmsetting_model->Getdata('levelcommissionstatus');
				$this->data['levelcommissiontype']= $this->Mlmsetting_model->Getdata('levelcommissiontype');
				$this->data['directcommissionstatus']= $this->Mlmsetting_model->Getdata('directcommissionstatus');
				$this->data['directcommissiontype']= $this->Mlmsetting_model->Getdata('directcommissiontype');
				$this->data['owncommissionstatus']= $this->Mlmsetting_model->Getdata('owncommissionstatus');
				$this->data['owncommissiontype']= $this->Mlmsetting_model->Getdata('owncommissiontype');	
				$this->data['changedirect']= $this->Mlmsetting_model->Getdata('changedirect');
				$this->data['freemember']= $this->Mlmsetting_model->Getdata('freemember');
				$this->data['matrixcommission']= $this->Mlmsetting_model->Getdata('matrixcommission');
				$this->data['repeatcommissionstatus']= $this->Mlmsetting_model->Getdata('repeatcommissionstatus');
				$this->data['earncommisionstatus']= $this->Mlmsetting_model->Getdata('earncommisionstatus');
				$this->data['spilloversystem']= $this->Mlmsetting_model->Getdata('spilloversystem');
				$this->data['recyclestatus']= $this->Mlmsetting_model->Getdata('recyclestatus');
				
				$this->load->view('admin/mlmsetting',$this->data);
			}
			else
			{
				$this->data['matrixwidth']= $this->Mlmsetting_model->Getdata('matrixwidth');
				$this->data['matrixdepth']= $this->Mlmsetting_model->Getdata('matrixdepth');
				$this->data['levelcommissionstatus']= $this->Mlmsetting_model->Getdata('levelcommissionstatus');
				$this->data['levelcommissiontype']= $this->Mlmsetting_model->Getdata('levelcommissiontype');
				$this->data['directcommissionstatus']= $this->Mlmsetting_model->Getdata('directcommissionstatus');
				$this->data['directcommissiontype']= $this->Mlmsetting_model->Getdata('directcommissiontype');
				$this->data['owncommissionstatus']= $this->Mlmsetting_model->Getdata('owncommissionstatus');
				$this->data['owncommissiontype']= $this->Mlmsetting_model->Getdata('owncommissiontype');
				$this->data['changedirect']= $this->Mlmsetting_model->Getdata('changedirect');
				$this->data['freemember']= $this->Mlmsetting_model->Getdata('freemember');
				$this->data['matrixcommission']= $this->Mlmsetting_model->Getdata('matrixcommission');
				$this->data['repeatcommissionstatus']= $this->Mlmsetting_model->Getdata('repeatcommissionstatus');
				$this->data['earncommisionstatus']= $this->Mlmsetting_model->Getdata('earncommisionstatus');
				$this->data['spilloversystem']= $this->Mlmsetting_model->Getdata('spilloversystem');
				$this->data['recyclestatus']= $this->Mlmsetting_model->Getdata('recyclestatus');
				$this->load->view('admin/mlmsetting',$this->data);
			}
		}
		else
		{
			redirect('admin/login');
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

	}
	//function ends

	public function drtenable($id)
	{
		$econdition = "Id =" . "'" . $id . "'";

		$edata = array(
			'DirectCommissionStatus' => '1'
		);

		$status = $this->common_model->UpdateRecord($edata, $econdition, 'arm_matrixsetting');

		if($status) {
			redirect('admin/mlmsetting');
		}
	}

	public function lvlenable($id)
	{
		$econdition = "Id =" . "'" . $id . "'";

		$edata = array(
			'LevelCommissionStatus' => '1'
		);

		$status = $this->common_model->UpdateRecord($edata, $econdition, 'arm_matrixsetting');
	
		if($status) {
			redirect('admin/mlmsetting');
		}
	}

	public function drtdisable($id)
	{
		$econdition = "Id =" . "'" . $id . "'";

		$edata = array(
			'DirectCommissionStatus' => '0'
		);

		$status = $this->common_model->UpdateRecord($edata, $econdition, 'arm_matrixsetting');

		if($status) {
			redirect('admin/mlmsetting');
		}
	}

	public function lvldisable($id)
	{
		$econdition = "Id =" . "'" . $id . "'";

		$edata = array(
			'LevelCommissionStatus' => '0'
		);
		
		$status = $this->common_model->UpdateRecord($edata, $econdition, 'arm_matrixsetting');
	
		if($status) {
			redirect('admin/mlmsetting');
		}
	}

} 
//class ends


