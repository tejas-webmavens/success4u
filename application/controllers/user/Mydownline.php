<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mydownline extends CI_Controller {

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
		
		//$this->load->model('user/fund_model');
		$this->lang->load('mydownline',$this->session->userdata('language'));
		$this->lang->load('user/common',$this->session->userdata('language'));
		}  else {
	    	redirect('login');
	    }
		
	}


	public function index()
	{
		error_reporting(0);
		
		if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) 
		{
			$memberpaysts = $this->common_model->GetRow("MatrixStatus='1'", 'arm_matrixsetting');
				if($memberpaysts->Id==3) 	
					{
						$table = "arm_monolinematrix";
						$field = "MonoLineId";
						$monodet = $this->common_model->GetRow("MemberId='".$this->session->MemberID."' order by MonoLineId asc limit 0,1 ","arm_monolinematrix");
				 		$userid = $monodet->MonoLineId;
				 		$this->data['mydowns'] = $this->monodownlines($userid,0);
				 	}
				elseif($memberpaysts->Id==5) 	
					{
						$table = "arm_boardmatrix"; 
						$field = "BoardMemberId";	
						$monodet = $this->common_model->GetRow("MemberId='".$this->session->MemberID."' order by BoardMemberId asc limit 0,1 ","arm_boardmatrix");
				 		$userid = $monodet->BoardMemberId;
				 		$boardid=$monodet->BoardId;
				 		$checkboard=$this->common_model->GetResults('MemberId='.$this->session->MemberID.'',"arm_boardmatrix","BoardId");
				 		$checkboardcount=$this->common_model->GetRowcount('MemberId='.$this->session->MemberID.'',"arm_boardmatrix");
				 		if($checkboardcount>1)
				 		{
				 		$bid1=$checkboard[0]->BoardId;
				 		$bid2=$checkboard[1]->BoardId;
				 		}
				 		else
				 		{
				 			$bid1=$checkboard[0]->BoardId;
				 		}
				 		
				 		

				 		$this->data['mydowns'] = $this->boarddownlines($userid,0,$bid1,$bid2);

				 		// exit;
					} 
					else
					{ 
						if($memberpaysts->Id==2) 		{$table = "arm_unilevelmatrix"; } 
						else if($memberpaysts->Id==4) 	{$table = "arm_binarymatrix"; 	} 
						elseif($memberpaysts->Id==6) 	{$table = "arm_xupmatrix"; 		}
						elseif($memberpaysts->Id==7) 	{$table = "arm_oddevenmatrix"; 	}
						elseif($memberpaysts->Id==9) 	{$table = "arm_binaryhtip"; 	}
						else{$table = "arm_forcedmatrix"; }

						$this->data['table'] = $table;
						
						$this->data['mydowns'] = $this->downlines($this->session->MemberID,0);
					}


					// print_r($this->data); exit;
					$this->data['controller']=$this; 
		             	$this->load->view('user/mydownline',$this->data);	  


		}
		else 
		{
		redirect('login');
		}
		
	}



	public function downlines($userid,$level)
	{
		static $array = array();

		$ucondition = "SpilloverId = '".$userid."'";
		$memberpaysts = $this->common_model->GetRow("MatrixStatus='1'", 'arm_matrixsetting');
			if($memberpaysts->Id==2) 		{$table = "arm_unilevelmatrix"; } 
			else if($memberpaysts->Id==4) 	{$table = "arm_binarymatrix"; 	} 
			elseif($memberpaysts->Id==6) 	{$table = "arm_xupmatrix"; 		}
			elseif($memberpaysts->Id==7) 	{$table = "arm_oddevenmatrix"; 	}
			// elseif($memberpaysts->Id==5) 	{$table = "arm_boardmatrix"; 	}

			else{$table = "arm_forcedmatrix"; }
		
		$select_count = $this->common_model->GetRowCount($ucondition,$table);
		$select = $this->common_model->GetResults($ucondition,$table);

		//mysql_query("select * from $table where spillover_id = '".$userid."'");
		
		if($select_count > 0)
		{
			$level++;
			
			for($i=0; $i<$select_count; $i++)
			{
				$userid = $select[$i]->MemberId;
				$array[$level].= $userid.',';
				 
				$this->downlines($userid,$level);
			}
		}
		
		return $array;
	}


	public function monodownlines($userid,$level)
	{
		static $array = array();

		$ucondition = "SpilloverId = '".$userid."'";
		
		$select_count = $this->common_model->GetRowCount($ucondition,"arm_monolinematrix");
		$select = $this->common_model->GetResults($ucondition,"arm_monolinematrix");

		//mysql_query("select * from $table where spillover_id = '".$userid."'");
		
		if($select_count > 0)
		{
			$level++;
			
			for($i=0; $i<$select_count; $i++)
			{
				$userid = $select[$i]->MonoLineId;
				$array[$level].= $userid.',';
				$this->monodownlines($userid,$level);
			}
		}
		
		return $array;
	}

	public function boarddownlines($userid,$level,$bid)
	{
		static $array = array();
		$checkboard= $this->common_model->GetRow('BoardMemberId='.$userid.'',"arm_boardmatrix");
		$member=$checkboard->MemberId;
		$checkmember=$this->common_model->GetResults('MemberId='.$member.'',"arm_boardmatrix");
		
	 // echo $this->db->last_query();

		$ucondition = "SpilloverId = '".$userid."' AND BoardId='".$bid."'";
		
		$select_count = $this->common_model->GetRowCount($ucondition,"arm_boardmatrix");
		$select = $this->common_model->GetResults($ucondition,"arm_boardmatrix");

		//mysql_query("select * from $table where spillover_id = '".$userid."'");
		
		if($select_count > 0)
		{
			$level++;
			
			for($i=0; $i<$select_count; $i++)
			{
				$userid = $select[$i]->BoardMemberId;
				$array[$level].= $userid.',';
				$this->boarddownlines($userid,$level,$bid);
			}
		}
		
		return $array;

	}



	public function child($userid)
	{

		$childs='';
		$matrixid = $this->common_model->GetRow("MatrixStatus='1'", 'arm_matrixsetting');
		if($matrixid->Id==2) 		{$table = "arm_unilevelmatrix"; 
		$ucondition = "SpilloverId = '".$userid."'";

			$select_count = $this->common_model->GetRowCount($ucondition,$table);
		$select = $this->common_model->GetResults($ucondition,$table);

	} 
			else if($matrixid->Id==4) 	{$table = "arm_binarymatrix"; 
			$ucondition = "SpilloverId = '".$userid."'";

			$select_count = $this->common_model->GetRowCount($ucondition,$table);
		$select = $this->common_model->GetResults($ucondition,$table);


				} 
			elseif($matrixid->Id==6) 	{$table = "arm_xupmatrix"; 	
			$ucondition = "SpilloverId = '".$userid."'";

			$select_count = $this->common_model->GetRowCount($ucondition,$table);
		$select = $this->common_model->GetResults($ucondition,$table);


				}
			elseif($matrixid->Id==5)    {$table="arm_boardmatrix";
		$ucondition = "SpilloverId = '".$userid."'";

			$select_count = $this->common_model->GetRowCount($ucondition,$table);
		$select = $this->common_model->GetResults($ucondition,$table);


		}
			elseif($matrixid->Id==7) 	{$table = "arm_oddevenmatrix"; 
		$ucondition = "SpilloverId = '".$userid."'";

			$select_count = $this->common_model->GetRowCount($ucondition,$table);
		$select = $this->common_model->GetResults($ucondition,$table);

				}
			// elseif($memberpaysts->Id==5) 	{$table = "arm_boardmatrix"; 	}

			else{$table = "arm_forcedmatrix"; 
		$ucondition = "SpilloverId = '".$userid."'";


			$select_count = $this->common_model->GetRowCount($ucondition,"arm_forcedmatrix");
		$select = $this->common_model->GetResults($ucondition,"arm_forcedmatrix");
			}

		

		//$select = mysql_query("select * from stages where spillover_id = '".$userid."' ");
		
		if($select_count > 0)
		{
			$childs='';
			
			for($i=0; $i<$select_count; $i++)
			{
				$uncondition = "MemberId = '".$select[$i]->MemberId."'";
				//$GetUser = mysql_fetch_array(mysql_query("select * from wwwusers where userid = '".$fetch['member_id']."' "));
				$GetUser = $this->common_model->GetRow($uncondition,"arm_members");

				//$GetPack = mysql_fetch_array(mysql_query("select a.package,b.name from wwwusers a,matrix b where b.id = '".$GetUser['package']."' and a.package = b.id"));
				
				//$name = $GetUser['username'].' - '.$GetUser['date'].' - '.$GetPack['name'];
				
				$name = '<font style=color:#ED8A03;font-style:italic;>'.$GetUser->UserName.'</font> - <font style=color:#0094FF;font-style:italic;>'.$GetUser->DateAdded.'</font>';
				
				$childs.= "{ id: 'dir-1',name: '".$name."',type: 'sub-dir'}".',';
			}
		}
		else
		{
			//$childs.= "{ id: 'dir-1',name: 'No downlines',type: 'sub-dir'}".',';
		}
		
		return trim($childs,',');
		
	}
	
}


