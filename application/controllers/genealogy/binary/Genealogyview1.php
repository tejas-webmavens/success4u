<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Genealogyview1 extends CI_Controller {


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
		/*if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {*/
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


		$this->lang->load('usergenealogy');
		
		/*}  else {
	    	redirect('login');
	    }*/
	}

	public function index()
	{
		$this->view();
	}
		
	public function view($id)
	{

		if($id!='') {
			$userid=$id;

		} elseif($this->session->MemberID!="") {
		 	$userid = $this->session->MemberID;

		} else {
			$userid = '1';
		}

		$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
	

		if($mlsetting->Id==1) {
			$table="arm_forcedmatrix";

		} else if($mlsetting->Id==2) {
			$table="arm_unilevelmatrix";

		} else if($mlsetting->Id==3) {
			$table	="arm_monolinematrix";

		} else if($mlsetting->Id==4) {
			$table= "arm_binarymatrix";
		}
		// echo" table=".$table;
		//$this->data['val'] = $this->user_ta($userid);
       	$condition="MemberId='".$userid."'";
		
		$this->data['val'] = $this->user_ta($userid,$table,$dowid_left,$dowid_right);
       
		$this->load->view('user/genealogyview1',$this->data);
		//$this->load->view('user/gen');

	}
	
 
	////new file start here/////
	function getname($id) {

		$member = $this->common_model->GetCustomer($id);

		return $member->UserName;
	}

	function getspname($id) {

		$member = $this->common_model->GetCustomer($id);
		$spmember = $this->common_model->GetCustomer($member->DirectId);

		return $spmember->UserName;
	}

	function getdate($id) {

		$member = $this->common_model->GetCustomer($id);
		$date=date_create($member->DateAdded);	
		return date_format($date,"d M Y");
	}

	function rankimage($id) {
		
		$img ='';

		$condition="MemberId='".$id."'";
		$SelectColumn='ProfileImage';

		$imgdetail = $this->common_model->GetRow($condition,'arm_members', $SelectColumn);
		
		if($imgdetail->ProfileImage!='')
		{
			
			$img = base_url().$imgdetail->ProfileImage;
		}
		else
		{
			
			$img = base_url().'assets/img/avatars/avatar.png';
			// $img = base_url().'assets/img/avatars/no-photo.jpg';
		}

		return $img;
	}


	function getlist_left($n,$count_left,$table)
	{
		
		$condition="DirectId='".$n."'";

		$exe=$this->common_model->GetRow($condition,$table);
		


		if($exe>0) 
		{
			$count_left=$num_rows+$count_left;
		}

		
		$condition="DirectId='".$n."'";
		$users = $this->common_model->GetResults($condition,$table);

		foreach ($users as $user) 
		{
			$id=$user->MemberId;
			if($id!='0')
			{
				$count_left =$this->getlist_left($id,$count_left,$table);  
			}
		}

		return $count_left;
						
	}


	function tooltips($getunames,$table)
	{

		$condition="UserName='".$getunames."'";
		$exe = $this->common_model->GetRow($condition,'arm_members');

		$member_id=$exe->MemberId;
		
		$direct_id=$exe->DirectId;

		$join_date=$exe->DateAdded;

		$pack=$exe->PackageId;

		$condition="MemberId='".$member_id."'";

		

		$exe1 = $this->common_model->GetRow($condition,$table);	
		$lef_id=$exe1->LeftId;
		$righ_id=$exe1->RightId;

		if($lef_id!=0)
			$count_left = $this->getlist_left($lef_id,1,$table);    
		else 
			$count_left = 0; 

		if($righ_id!=0)
			$count_right = $this->getlist_left($righ_id,1,$table);
		else 
			$count_right = 0;
			
		$condition="PackageId='".$pack."'";
		$exe2 = $this->common_model->GetRow($condition,'arm_pv');	
		
		// $data= '<div class="tip" style="background-color:#8e0000;color:#fff; width: 325px; -webkit-box-shadow: 0px 0px 19px  #2b2b2b;-moz-box-shadow: 0px 0px 19px #2b2b2b;box-shadow: 0px 0px 19px #2b2b2b; ">
		// 		<table width="100%" cellpadding="0" style="color:#fff;" cellspacing="0">
		// 		<tr><td nowrap="nowrap">Name</td><td> : </td><td width="40%">'.ucfirst($exe->UserName).'</td></tr>
		// 		<tr><td><bR></td></tr>
		// 		<tr><td nowrap="nowrap">Member package</td><td> : </td><td width="40%">'.$exe2->PackageName.'</td></tr>
		// 		<tr><td><bR></td></tr>
		// 		<tr><td nowrap="nowrap">Account status</td><td> : </td><td>'.ucfirst($exe->MemberStatus).'</td></tr>
		// 		<tr><td><bR></td></tr>
		// 		<tr><td nowrap="nowrap">Date of Join</td><td> : </td><td>'.ucfirst($exe->DateAdded).'</td></tr>
			
		// 		</table>
		// 		</div>';

		return $data;

	}

	function display($id,$pos,$table)
	{
		//var $tmp = array();
		if(!empty($id))
		{
			
			$condition="UserName='".$id."'";
			$exe2 = $this->common_model->GetRow($condition,'arm_members');
			//$sql_query_fetch=mysql_fetch_array(mysql_query("select * from members_table where username='$id'"));
			//$member_id=$sql_query_fetch['member_id'];
			$member_id=$exe2->MemberId;

			$condition="MemberId='".$member_id."'";

			$exe = $this->common_model->GetRow($condition,$table);
			
			//$sql=mysql_query("select * from downlines where member_id=$member_id");
			//$exe=mysql_fetch_array($sql);	
			if($pos=="left")
			{
				$id=$exe->LeftId;
			}
			else if($pos='right')
			{
				$id=$exe->RightId;
			}	
			$this->tmp = array_merge($this->tmp,array($id));
		}
			

		if($id > 0)
		{
			//echo "select * from members_table where member_id=$id";
			//$sql=mysql_query("select * from members_table where member_id=$id");
			//$fetch=mysql_fetch_array($sql);
			//$name=$fetch['username'];
			//echo $name;exit;
			$condition="MemberId='".$id."'";
			$exe3 = $this->common_model->GetRow($condition,'arm_members');
			$name=$exe3->UserName;
		return $name;
		}
		else
		{
			$dd="";
			return $dd; 
		}

	}

	public function user_ta($userid,$table,$dowid_left,$dowid_right)
	{

		$img1 = base_url().'assets/img/01-us.gif';
		$img2 = base_url().'assets/img/02-us.gif';
		$img3 = base_url().'assets/img/03-us.gif';

		$img4= base_url().'assets/img/register.png';

		$img5= base_url().'assets/img/blankuser.png';
		
		$gendata='';
		
		$mcondition = "MemberId='".$userid."'";
		$select_high = $this->common_model->GetRow($mcondition, $table);


		$gendata.='<table width="600" height="370" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
				<tr>
				  <td align="center"  colspan="2" class="style8">&nbsp;</td>
				</tr>';
			 	
				  
				$gendata.='<tr>
				  <td align="center" colspan="2" class="style8">&nbsp;</td>
					</tr>
					<tr>
				    <td colspan="2"><div align="center">
				      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-left:85px;">
				        <tr>
						 <td> 
				        <table width="750" height="43" border="0" align="center" cellpadding="0" cellspacing="0" >
					        <tr>
				          		<td align="center" class="tip_trigger"><img src="'.$this->rankimage($userid).'" alt="01" class="node" /><br />';
				          			$name=$this->getname($userid);
					      		 	$gendata.=$this->tooltips($name,$table);
					      		 	$url=base_url()."/genealogy/binary/genealogyview1/view/".$userid;
					   		 		$gendata.='
					   		 				<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'"  style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$name.'">'.$name.'</span>
				        			 			</a>
				        			 			<br/><span><h6 style="color:#000;">L:'.$select_high->leftdowncount.' R:'.$select_high->rightdowncount.'</h6></span>
				        			 		</div>
				          	</td>
				        	</tr>
				     	 	</table></td>
					  
				        </tr>
				      </table>
				    </div></td>
				  </tr>
				  <tr>
				    <td colspan="2" style="padding-left:55px;"><div align="center"><img src='.$img1.' alt="" /></div></td>
				  </tr>
				  <tr>
				    <td class="tip_trigger"><div align="center">';
						$L1=$this->display($name,'left',$table);

						$mcondition = "UserName='".$L1."'";
						$select_high = $this->common_model->GetRow($mcondition,'arm_members');
						$use_id=$select_high->MemberId;
						$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
						$url1=base_url()."/user/register/?ref=".$name."&P=L";


					   	$gendata.='<table width="260" height="43" style="padding-left:150px;" border="0" align="center" cellpadding="0" cellspacing="0" >
				        <tr>
				        <td class="geotxt"><div align="center">';
						 if($L1 == '') 
				         {
				          	$gendata.='<a href="'.$url1.'" target="_blank"><img src='.$img4.' /></a><div>register</div><br />';	
				         } 
				         else 
				         {
				        	$gendata.='<img src="'.$this->rankimage($use_id).'" alt="01" class="node" /><br />';
				         
				         }
				         if($L1 != '')
				         {
				         	$gendata.= $this->tooltips($L1,$table);
				         }
				         
				        /*$gendata.='<a href="'.$url.'" style="text-decoration:none" >
				        			<span class="geotxt" title="'.$L1.'">'.$L1.'</span></a></td>*/
				        			$gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'" style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$L1.'">'.$L1.'</span>
				        			 			</a>
				        			 		</div>
				        			 		</td>
				        </tr>
				      </table>
				    </div></td>
				    <td class="tip_trigger">';
						$R1=$this->display($name,'right',$table);

						$mcondition = "UserName='".$R1."'";
						$select_high = $this->common_model->GetRow($mcondition,'arm_members');
						$use_id=$select_high->MemberId;
						$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
						$url1=base_url()."/user/register/?ref=".$name."&P=R";

						if($R1 != '')
						{
							$gendata.= $this->tooltips($R1,$table);
						}
					
						$gendata.='<div align="center">
				      				<table width="370" height="43" border="0" align="center" style="padding-left:75px;" cellpadding="0" cellspacing="0">
				        			<tr>
				       				   <td class="geotxt">
				       				   <div align="center">';
										if($R1 == '') 
				       				  	{ 
				       				  		$gendata.='<a href="'.$url1.'" target="_blank"><img src="'.$img4.'"  /></a><div>register</div><br />	';
										} 
										else
									 	{
									 		$gendata.='<img src="'.$this->rankimage($use_id).'" class="node" /><br />';
				          				}
								         /*$gendata.='
								         <a href="'.$url.'" style="text-decoration:none" ><span class="geotxt" title="'.$R1.'">'.$R1.'</span></a></div></td>';*/
								        $gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'"  style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$R1.'">'.$R1.'</span>
				        			 			</a>
				        			 		</div>';
				        $gendata.='</td></tr>
				      	</table>
				    	</div>
				    </td>
				  </tr>
				  <tr>
				    <td colspan="2" style="padding-left:55px;"><div align="center"><img src="'.$img2.'" alt=""  /></div></td>
				  </tr>
				  <tr>
				    <td colspan="2"><table width="100%" style="padding-left:40px;" border="0" cellspacing="0" cellpadding="0">
				      <tr>
				        <td class="tip_trigger">';
						$L2=$this->display($L1,'left',$table);
						$mcondition = "UserName='".$L2."'";
						$select_high = $this->common_model->GetRow($mcondition,'arm_members');
						$use_id=$select_high->MemberId;
						$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
						$url1=base_url()."/user/register/?ref=".$L1."&P=L";
				 		if($L2 != '')
						{
							$gendata.=$this->tooltips($L2,$table);
						}	
						
						$gendata.='<div align="center">
						       <table width="160" height="44" border="0" cellpadding="0" cellspacing="0" >
				            <tr>
				               <td class="geotxt" align="center">'; 
				            if($L1 == '')
				            {
							  $gendata.='<img src="'.$img5.'" alt="01" /><div>Blank User</div><br />';	
				            }
							else if($L2 == '') 
							{ 
								$gendata.='<a href="'.$url1.'" target="_blank"> <img src="'.$img4.'""  /></a><div>register</div><br />';
							}
							else 
							{
							 	$gendata.='<img src="'.$this->rankimage($use_id).'" alt="01" class="node" /><br />';
				          	}
							/*$gendata.='<a href="'.$url.'" style="text-decoration:none" ><span class="geotxt" title="'.$L2.'">'.$L2.'</span></a></td>*/
							$gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'"  style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$L2.'">'.$L2.'</span>
				        			 			</a>
				        			 		</div>
				        			 		</td>
				            </tr>
				          </table>
				        </div></td>
				        
				        <td class="tip_trigger">';
				 			$L3=$this->display($L1,'right',$table);
							$mcondition = "UserName='".$L3."'";
							$select_high = $this->common_model->GetRow($mcondition,'arm_members');
							$use_id=$select_high->MemberId;
							$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
							$url1=base_url()."/user/register/?ref=".$L1."&P=R";
							$gendata.='<div align="center">';
							if($L3 != '')
							{
								$gendata.= $this->tooltips($L3,$table);
							}
							$gendata.='<table width="116" height="44" border="0" cellpadding="0" cellspacing="0" >
				            <tr>
				             <td align="center" class="geotxt">'; 
				             if($L1 == '')
				             { 
							  	$gendata.='<img src="'.$img5.'" alt="01" /><div>Blank User</div><br />';	
				             }
				             else if($L3 == '') 
				             {
								$gendata.='<a href="'.$url1.'" target="_blank"><img src="'.$img4.'" alt="01" /></a><div>register</div><br />';
							 } 
							 else
							 {
								$gendata.='<img src="'.$this->rankimage($use_id).'" alt="01" class="node" /><br />';
				          	 }
								/*$gendata.='<a href="'.$url.'" style="text-decoration:none" ><span class="geotxt" title="'.$L3.'">'.$L3.'</span></a></td>*/
								$gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'" style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$L3.'">'.$L3.'</span>
				        			 			</a>
				        			 		</div>
				        			 		</td>
				            </tr>
				          </table>
				        </div></td>
				    	 <td class="tip_trigger">';
							$R2=$this->display($R1,'left',$table);
				    		$mcondition = "UserName='".$R2."'";
							$select_high = $this->common_model->GetRow($mcondition,'arm_members');
							$use_id=$select_high->MemberId;
							$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
							$url1=base_url()."/user/register/?ref=".$R1."&P=L";
							if($R2 != '')
							{
								$gendata.= $this->tooltips($R2,$table);
							}
							$gendata.='<div align="center">
				          <table width="136" height="44" border="0" cellpadding="0" cellspacing="0">
				            <tr>
				            <td align="center" class="geotxt">  ';
				             if($R1 == '')
				             { 
								   $gendata.='<img src="'.$img5.'" alt="01" /><div>Blank User</div><br />';
				             }
				             else if($R2 == '')
				             {
				               
								$gendata.='<a href="'.$url1.'" target="_blank"> <img src="'.$img4.'" alt="01" /></a><div>register</div><br />';	
							 } 
							 else
							 {	 
							 
								 $gendata.='<img src="'.$this->rankimage($use_id).'" alt="01" class="node" /><br />';
				          	}
							
							/*$gendata.='<a href="'.$url.'" style="text-decoration:none" ><span class="geotxt" title="'.$R2.'">'.$R2.'</span></a></td>*/
							$gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'"  style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$R2.'">'.$R2.'</span>
				        			 			</a>
				        			 		</div>
				        			 		</td>
				            </tr>
				          </table>
				        </div></td>
				        
				        <td class="tip_trigger">';
						$R3=$this->display($R1,'right',$table);

				 		$mcondition = "UserName='".$R3."'";
						$select_high = $this->common_model->GetRow($mcondition,'arm_members');
						$use_id=$select_high->MemberId;
						$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
						$url1=base_url()."/user/register/?ref=".$R1."&P=R";


				 		if($R3 != '')
						{
							$gendata.= $this->tooltips($R3,$table);
						
						}



						$gendata.='<div align="center">
				          <table width="136" height="44" border="0" cellpadding="0" cellspacing="0" >
				            <tr>
				              <td align="center" class="geotxt">';
				               if($R1 == '')
				               { 
							  		$gendata.='<img src="'.$img5.'" alt="01" /><div>Blank User</div><br />';
				               }
				               else if($R3 == '') 
				               { 
				               		$gendata.='<a href="'.$url1.'" target="_blank"><img src="'.$img4.'" alt="01" /></a><div>register</div><br />	';
							   }
							   else
							   {
									$gendata.='<img src="'.$this->rankimage($use_id).'" alt="01" class="node" /><br />';
				          	   }
											 
				            //$gendata.='<a href="'.$url.'" style="text-decoration:none" ><span class="geotxt" title="'.$R3.'">'.$R3.'</span></a></td>
				          
				          	$gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'"  style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$R3.'">'.$R3.'</span>
				        			 			</a>
				        			 		</div>
				        			 		</td>
				            </tr>
				          </table>
				        </div></td>
				      </tr>
				    </table></td>
				  </tr>
				  <tr>
				    <td colspan="2"><span align="left" style="padding-left:100px;"><img src="'.$img3.'" alt=""  /></div>
				   
				    <span align="right" style="padding-left:96px;"><img src="'.$img3.'" alt=""  /></div></td>
				    </tr>

				  <tr>
				    <td colspan="2"><table width="70%" border="0" cellspacing="0" cellpadding="0">
				      <tr>
				        <td class="tip_trigger">';
						$L4=$this->display($L2,'left',$table);
						$mcondition = "UserName='".$L4."'";
						$select_high = $this->common_model->GetRow($mcondition,'arm_members');
						$use_id=$select_high->MemberId;
						$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
						$url1=base_url()."/user/register/?ref=".$L2."&P=L";
						if($L4 != '')
						{
							$gendata.= $this->tooltips($L4,$table);
						}
						$gendata.='<div align="center">
				         			<table width="142" height="31" border="0" cellpadding="0" cellspacing="0">
				            			<tr>
				            			<td align="center" style="padding-left:55px;" class="geotxt">';
				             			if($L2 == '')
				             			{ 
							  				$gendata.='<img src="'.$img5.'" alt="01" /><div>Blank User</div><br />';
				            			}
				               			else if($L4 == '')
				               			{
				               			
											$gendata.='<a href="'.$url1.'" target="_blank"><img src="'.$img4.'" alt="01" /></a><div>register</div><br />';	
										}
										else
										{
											$gendata.='<img src="'.$this->rankimage($use_id).'" class="node" /><br />';
				          				}
							/*$gendata.='
							
				             <a href="'.$url.'" style="text-decoration:none" ><span class="geotxt" title="'.$L4.'">'.$L4.'</span></a>*/
				             $gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'"  style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$L4.'">'.$L4.'</span>
				        			 			</a>
				        			 		</div>

				             </td>
				            </tr>
				          </table>
				        </div></td>
				        
				        <td class="tip_trigger">';
						$L5=$this->display($L2,'right',$table);
						$mcondition = "UserName='".$L5."'";
						$select_high = $this->common_model->GetRow($mcondition,'arm_members');
						$use_id=$select_high->MemberId;
						$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
						$url1=base_url()."/user/register/?ref=".$L2."&P=R";
				 		if($L5 != '')
						{
							$gendata.= $this->tooltips($L5,$table);
						}
						$gendata.='<div align="center">
				          			<table width="88" height="31" border="0" cellpadding="0" cellspacing="0">
				            		<tr>
				              		<td align="center"  class="geotxt">';
				             	 	if($L2 == '')
				             	 	{ 
							  			  $gendata.='<img src="'.$img5.'" alt="01" /><div>Blank User</div><br />';
				              		}
				               		else if($L5 == '') {
				               			$gendata.='<a href="'.$url1.'" target="_blank"><img src="'.$img4.'" alt="01" /></a><div>register</div><br />';	
									 } 
									else
									{
										 
										$gendata.='<img src="'.$this->rankimage($use_id).'" alt="01" class="node" /><br />';
				         			}
							/*$gendata.='<a href="'.$url.'" style="text-decoration:none" ><span class="geotxt" title="'.$L5.'">'.$L5.'</span></a></td>*/

							$gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'"  style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$L5.'">'.$L5.'</span>
				        			 			</a>
				        			 		</div>
				        			 		</td>
				            </tr>
				          </table>
				        </div></td>
				        <td class="tip_trigger">';
						$L6=$this->display($L3,'left',$table);
						$mcondition = "UserName='".$L6."'";
						$select_high = $this->common_model->GetRow($mcondition,'arm_members');
						$use_id=$select_high->MemberId;
						$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
						$url1=base_url()."/user/register/?ref=".$L3."&P=L";
						if($L6 != '')
						{
							$gendata.= $this->tooltips($L6, $table);
						}
						$gendata.='<div align="center">
				          <table width="120" height="31" border="0" cellpadding="0" cellspacing="0" >
				            <tr>
				              <td align="center" class="geotxt">';
				              if($L3 == '')
				              { 
								$gendata.=' <img src="'.$img5.'" alt="01" /><div>Blank User</div><br />';
				              
							  }
				              else if($L6 == '') 
				              {
				              
								$gendata.='<a href="'.$url1.'" target="_blank"><img src="'.$img4.'" alt="01" /></a><div>register</div><br />';	
							  } 
							 else 
							 {
								$gendata.='<img src="'.$this->rankimage($use_id).'" alt="01" class="node" /><br />';
				          	 }
										 
				           /*  $gendata.='<a href="'.$url.'" style="text-decoration:none" ><span class="geotxt" title="'.$L6.'">'.$L6.'</span></a></td>*/
				         	 $gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'"  style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$L6.'">'.$L6.'</span>
				        			 			</a>
				        			 		</div>
				        			 		</td>
				            </tr>
				          </table>
				        </div></td>
				        <td class="tip_trigger">';
				       		$L7=$this->display($L3,'right',$table);
							if($L7 != '')
							{
								$gendata.= $this->tooltips($L7, $table);
								$mcondition = "UserName='".$L7."'";
								$select_high = $this->common_model->GetRow($mcondition,'arm_members');
								$use_id=$select_high->MemberId;
								$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
								$url1=base_url()."/user/register/?ref=".$L3."&P=R";
							}
							$gendata.='<div align="center">
				 						<table width="88" height="31" border="0" cellpadding="0" cellspacing="0" >
				           				 <tr>
				              			<td align="center" class="geotxt">';
				              			if($L3 == '')
				              			{ 
							 				$gendata.='<img src="'.$img5.'" alt="01" /><div>Blank User</div><br />';
							 			}
				               			else if($L7 == '') 
				               			{
											$gendata.='<a href="'.$url1.'" target="_blank"><img src="'.$img4.'" alt="01" /></a><div>register</div>';
										}
										else
										{
											$gendata.='<img src="'.$this->rankimage($use_id).'" alt="01" class="node" /><br />';
				          				
				          				}
								/*$gendata.='<a href="'.$url.'" style="text-decoration:none" ><span class="geotxt" title="'.$L7.'">'.$L7.'</span></a></td>*/
								$gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'"  style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$L7.'">'.$L7.'</span>
				        			 			</a>
				        			 		</div>
				        			 		</td>
				            </tr>
				          </table>
				        </div></td>
				        <td class="tip_trigger">';
						 $R4=$this->display($R2,'left',$table);
						 $mcondition = "UserName='".$R4."'";
						$select_high = $this->common_model->GetRow($mcondition,'arm_members');
						$use_id=$select_high->MemberId;
						$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
						$url1=base_url()."/user/register/?ref=".$R2."&P=L";
				 		if($R4 != '')
						{
							$gendata.= $this->tooltips($R4,$table);
						}
						$gendata.='<div align="center">
				          <table width="88" height="31" border="0" cellpadding="0" cellspacing="0">
				            <tr>
				             <td align="center" class="geotxt">';
				              if($R2 == '')
				              { 
							  	$gendata.='<img src="'.$img5.'" alt="01" /><div>Blank User</div><br />';
				              }
				              else if($R4 == '') 
				              { 
				              	$gendata.='<a href="'.$url1.'" target="_blank"><img src="'.$img4.'" alt="01" /></a><div>register</div>';
							  }
							  else 
							  {
							 
								$gendata.='<img src="'.$this->rankimage($use_id).'" alt="01" class="node" /><br />';
				          	  
				          	  }
							/* $gendata.='<a href="'.$url.'" style="text-decoration:none" ><span class="geotxt" title="'.$R4.'">'.$R4.'</span></a></td>*/
								$gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'"  style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$R4.'">'.$R4.'</span>
				        			 			</a>
				        			 		</div></td>
				            </tr>
				          </table>
				        </div></td>
				        <td class="tip_trigger">';
						 $R5=$this->display($R2,'right',$table);
						$mcondition = "UserName='".$R5."'";
						$select_high = $this->common_model->GetRow($mcondition,'arm_members');
						$use_id=$select_high->MemberId;
						$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
						$url1=base_url()."/user/register/?ref=".$R2."&P=L";
						if($R5 != '')
						{
							$gendata.= $this->tooltips($R5,$table);
						}
						
						$gendata.='<div align="center">
				 					<table width="88"  height="31" border="0" cellpadding="0" cellspacing="0" >
				            		<tr>
				           			<td align="center" class="geotxt" >';
				              		if($R2 == '')
				              		{ 
							  			$gendata.='<img src="'.$img5.'" alt="01" /><div>Blank User</div><br />';
				              		}
				               		else if($R5 == '') 
				               		{
				               			//$gendata.='<a href="'.$url1.'" target="_blank"><img src="'.$img4.'" alt="01" /></a><div>register</div>';
				               			$gendata.='<a href="'.$url1.'" target="_blank"><img src="'.$img4.'" alt="01"  /></a><div>&nbsp;&nbsp;register</div>';		
								    } 
								    else
								    {
										$gendata.='<img src="'.$this->rankimage($use_id).'" alt="01" class="node" /><br />';
				          				
				          			}
							/*$gendata.='<a href="'.$url.'" style="text-decoration:none" ><span class="geotxt" title="'.$R5.'">'.$R5.'</span></a></td>*/
								$gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'"  style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$R5.'">'.$R5.'</span>
				        			 			</a>
				        			 		</div>
				        			 		</td>
				            </tr>
				          </table>
				        </div></td>
				        <td class="tip_trigger">';
						$R6=$this->display($R3,'left',$table);
						$mcondition = "UserName='".$R6."'";
						$select_high = $this->common_model->GetRow($mcondition,'arm_members');
						$use_id=$select_high->MemberId;
						$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
						$url1=base_url()."/user/register/?ref=".$R3."&P=L";
						if($R6 != '')
						{
							$gendata.= $this->tooltips($R6,$table);
						}
						
						$gendata.='<div align="center">
				 
				          <table width="88" style="margin-left:6px;"  height="31" border="0" cellpadding="0" cellspacing="0" >
				            <tr>
				             <td align="center" class="geotxt"> ';
				              if($R3 == '')
				              { 
							  	$gendata.='<img src="'.$img5.'" alt="01"  /><div>Blank User</div>';
				              }
				              else if($R6 == '') 
				              { 
				            	$gendata.='<a href="'.$url1.'" target="_blank"><img src="'.$img4.'" alt="01"  /></a><div>register</div>';	
							  }
							  else
							  {
								$gendata.='<img src="'.$this->rankimage($use_id).'" alt="01" class="node" /><br />';
				          		
				          	  }
					
				         /*  $gendata.='<a href="'.$url.'" style="text-decoration:none"><span class="geotxt" title="'.$R6.'">'.$R6.'</span></a></td>*/
				    	     $gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'"  style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$R6.'">'.$R6.'</span>
				        			 			</a>
				        			 		</div>
				        			 		</td>
				            </tr>
				          </table>
				        </div></td>
				<!--                <div align="center"><img src="images/03-us.gif" alt=""  /></div></td>
				-->
				        <td class="tip_trigger">';
						$R7=$this->display($R3,'right',$table);
						 $mcondition = "UserName='".$R7."'";
						$select_high = $this->common_model->GetRow($mcondition,'arm_members');
						$use_id=$select_high->MemberId;
						$url=base_url()."/genealogy/binary/genealogyview1/view/".$use_id;
						$url1=base_url()."/user/register/?ref=".$R3."&P=R";
						if($R7 != '')
						{
							$gendata.= $this->tooltips($R7,$table);
						}
						$gendata.='<div align="center">
				          <table width="88" height="31" style="margin-left:6px;" border="0" cellpadding="0" cellspacing="0">
				            <tr>
				            <td align="center" class="geotxt">';

								if($R3 == '')
								{ 
									//$gendata.='img src="'.$img5.'" alt="01" /><div>Blank User</div><br />';
									$gendata.='<img src="'.$img5.'" alt="01"  /><div>Blank User</div>';
				                }
				                else if($R7 == '') 
				                { 
				        			$gendata.='<a href="'.$url1.'" target="_blank"><img src="'.$img4.'" alt="01" /></a><div>register</div><br />';
						        } 
						        else
						        {
								  $gendata.='<img src="'.$this->rankimage($use_id).'" alt="01" class="node" /><br />';
				                }
								/*$gendata.='<a href="'.$url.'" style="text-decoration:none" ><span class="geotxt" title="'.$R7.'">'.$R7.'</span></a></td>*/
									$gendata.='<div class="geotxt" style="margin-top:40px;">
					   		 					<a href="'.$url.'"  style="text-decoration:none;" class="geotxt">
					   		 					<span class="geotxt" title="'.$R7.'">'.$R7.'</span>
				        			 			</a>
				        			 		</div>
				        			 		</td>
				            </tr>
				          </table>
				        </div></td>
				      </tr>
				      <tr>
				        </tr>
						 <tr>
				        <!--<td colspan="8" align="right" style="padding-right:100px"><a href="genealogy.php">Back</a></td>-->
				        </tr>
				         <tr>
				           <td colspan="8">&nbsp;</td>
				         </tr>
				         <tr>
				           <td colspan="8">
						   
						   </td>
				         </tr>
				         <tr>
				           <td colspan="8">&nbsp;</td>
				         </tr>
				         <tr>
				           <td colspan="8">&nbsp;</td>
				         </tr>
				        <tr>
				        <td colspan="8">&nbsp;</td>
				      </tr>
				    </table></td>
				  </tr></td>
		</table>';

				  
		
		return $gendata;
		
	}


	////new file end here/////


	//// old files start here/////


	//// old files end here/////
    
   
	
}
