<?php

Class Memberboardprocess_model extends CI_Model {


	public function process($memberid)
	{
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
	
		if($mlsetting->Id==1)
		{
			$this->setforcematrix($memberid);
		}
		else if($mlsetting->Id==2)
		{
			$this->setunilevelmatrix($memberid);
		}
		else if($mlsetting->Id==3)
		{
			$this->setmonolinematrix($memberid);
		}

		else if($mlsetting->Id==4)
		{
			$this->binarymatrix($memberid,"arm_binarymatrix");
		}
		else if($mlsetting->Id==5)
		{
			
			$this->setboardmatrix($memberid,"arm_boardmatrix");
		}
		else if($mlsetting->Id==6)
		{
			
			$this->setxupmatrix($memberid,"arm_xupmatrix");
		}
		else if($mlsetting->Id==7)
		{
			$this->setoddevenmatrix($memberid);
		}
		else if($mlsetting->Id==8)
		{
			$this->setboardmatrix1($memberid,"arm_boardmatrix1");
		}

		

		
	}

// unilevel start here
	public function setunilevelmatrix($memberid)
	{
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1' AND Id='2'","arm_matrixsetting");

		$mcondition = "MemberId='".$memberid."'";

		$mdetails = $this->common_model->GetRow($mcondition,'arm_members');
		$date = date('y-m-d h:i:s');
			$Mdata = array(
						'SpilloverId'=>$mdetails->DirectId,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$memberid,
						'Status'=>1,
						'DateAdded'=>$date
						);
			$Mresult = $this->common_model->SaveRecords($Mdata,"arm_unilevelmatrix");
			if($Mresult)
				{
				$dcondition = "MemberId='".$mdetails->DirectId."'";
				$ddetails = $this->common_model->GetRow($dcondition,'arm_unilevelmatrix');
				$dmcount =$ddetails->MemberCount;
				$Ddata=array('MemberCount'=>$dmcount+1);
				$Dresult = $this->common_model->UpdateRecord($Ddata,$dcondition,"arm_unilevelmatrix");
				}

	}


// unilevel end here
// xup start here
	public function setxupmatrix($memberid,$table)
	{
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1' AND Id='6'","arm_matrixsetting");

		$mdetails = $this->common_model->GetRow("MemberId='".$memberid."'",'arm_members');
		
		$xddetails = $this->common_model->GetRow("MemberId='".$mdetails->DirectId."'",'arm_xupmatrix');
			

       if($mlsetting->MTMPayStatus=='0'){
       	 if($xddetails->XupCount < $mlsetting->Position)
		{	


			$date = date('y-m-d h:i:s');
			$Mdata = array(
						'SpilloverId'=>$xddetails->DirectId,
						'DirectId'=>$xddetails->DirectId,
						'MemberId'=>$memberid,
						'DateAdded'=>$date
						);
			$Mresult = $this->common_model->SaveRecords($Mdata,"arm_xupmatrix");
			if($Mresult)
				{
				$dcondition = "MemberId='".$xddetails->DirectId."'";
				$ddetails = $this->common_model->GetRow($dcondition,'arm_xupmatrix');
				$dmcount =$ddetails->MemberCount;
				$drec =array();
				$passrec='';
				$drec = json_decode($ddetails->PassedUpReceive);
					if($drec)
					{
						array_push($drec, $memberid);
					}else{
						$drec =array($memberid);
					}
						$passrec = json_encode($drec);
					
				$Ddata=array('MemberCount'=>$dmcount+1,
							'PassedUpReceive'=>$passrec);
				$Dresult = $this->common_model->UpdateRecord($Ddata,$dcondition,"arm_xupmatrix");

				$xmcondition = "MemberId='".$mdetails->DirectId."'";
				$xmdetails = $this->common_model->GetRow($xmcondition,'arm_xupmatrix');
				$xmcount =$xmdetails->XupCount;
				$xmsend =array();
				$passsend='';
				$xmsend = json_decode($xmdetails->PassedUpSend);
					if($xmsend)
					{
						array_push($xmsend, $memberid);
					}else{
						$xmsend =array($memberid);
					}
						$passsend = json_encode($xmsend);
					
				$xmdata=array('XupCount'=>$xmcount+1,
							'PassedUpSend'=>$passsend);
				$xmresult = $this->common_model->UpdateRecord($xmdata,$xmcondition,"arm_xupmatrix");
				$xdata=array('SpilloverId'=>$xddetails->DirectId);
				$xmresult = $this->common_model->UpdateRecord($xdata,"MemberId='".$memberid."'","arm_members");
				}
		}
		else
		{
			$date = date('y-m-d h:i:s');
			$Mdata = array(
						'SpilloverId'=>$mdetails->DirectId,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$memberid,
						'DateAdded'=>$date
						);
			$Mresult = $this->common_model->SaveRecords($Mdata,"arm_xupmatrix");
			if($Mresult)
				{
				$dcondition = "MemberId='".$mdetails->DirectId."'";
				$ddetails = $this->common_model->GetRow($dcondition,'arm_xupmatrix');
				$dmcount =$ddetails->MemberCount;
				$Ddata=array('MemberCount'=>$dmcount+1);
				$Dresult = $this->common_model->UpdateRecord($Ddata,$dcondition,"arm_xupmatrix");
				}
		}
       }
		
		else
		{
			$date = date('y-m-d h:i:s');
			$Mdata = array(
						'SpilloverId'=>$mdetails->DirectId,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$memberid,
						'DateAdded'=>$date
						);
			$Mresult = $this->common_model->SaveRecords($Mdata,"arm_xupmatrix");
			if($Mresult)
				{
				$dcondition = "MemberId='".$mdetails->DirectId."'";
				$ddetails = $this->common_model->GetRow($dcondition,'arm_xupmatrix');
				$dmcount =$ddetails->MemberCount;
				$Ddata=array('MemberCount'=>$dmcount+1);
				$Dresult = $this->common_model->UpdateRecord($Ddata,$dcondition,"arm_xupmatrix");
				}
		}
		
	}


// xup end here
// odd / even  start here
	public function setoddevenmatrix($memberid)
	{
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1' AND Id='7'","arm_matrixsetting");

		$mdetails = $this->common_model->GetRow("MemberId='".$memberid."'",'arm_members');
		$xddetails = $this->common_model->GetRow("MemberId='".$mdetails->DirectId."'",'arm_oddevenmatrix');
	
		if($mlsetting->Position==1)
		{
			$psetvalue =1;
		}
		else
		{
			$psetvalue =0;
		}

			
		if($psetvalue == $xddetails->XupStatus)
		{	
			

			$date = date('y-m-d h:i:s');
			$Mdata = array(
						'SpilloverId'=>$xddetails->DirectId,
						'DirectId'=>$xddetails->DirectId,
						'MemberId'=>$memberid,
						'XupStatus'=>'0',
						'DateAdded'=>$date
						);
			$Mresult = $this->common_model->SaveRecords($Mdata,"arm_oddevenmatrix");
			if($Mresult)
				{
				$dcondition = "MemberId='".$xddetails->DirectId."'";
				$ddetails = $this->common_model->GetRow($dcondition,'arm_oddevenmatrix');
				$dmcount =$ddetails->MemberCount;
				$drec =array();
				$passrec='';
				$drec = json_decode($ddetails->PassedUpReceive);
					if($drec)
					{
						array_push($drec, $memberid);
					}else{
						$drec =array($memberid);
					}
						$passrec = json_encode($drec);
					if($ddetails->XupStatus==1)
					{					
					$dmsetval = 0;
					}
					else
					{
					$dmsetval = 1;
					}
				$Ddata=array('MemberCount'=>$dmcount+1,
							'PassedUpReceive'=>$passrec,
							'XupStatus'=>$dmsetval);
				$Dresult = $this->common_model->UpdateRecord($Ddata,$dcondition,"arm_oddevenmatrix");

				$xmcondition = "MemberId='".$mdetails->DirectId."'";
				$xmdetails = $this->common_model->GetRow($xmcondition,'arm_oddevenmatrix');
				$xmcount =$xmdetails->XupCount;
				$xmsend =array();
				$passsend='';
				$xmsend = json_decode($xmdetails->PassedUpSend);
					if($xmsend)
					{
						array_push($xmsend, $memberid);
					}else{
						$xmsend =array($memberid);
					}
						$passsend = json_encode($xmsend);
					if($xmdetails->XupStatus==1)
					{					
						$xmsetval = 0;
					}
					else
					{
						$xmsetval = 1;
					}

				$xmdata=array('XupCount'=>$xmcount+1,
							'PassedUpSend'=>$passsend,
							'XupStatus'=>$xmsetval);
				$xmresult = $this->common_model->UpdateRecord($xmdata,$xmcondition,"arm_oddevenmatrix");
				if($ddetails->XupStatus==1)
				{					
					$mmsetval = 0;
				}
				else
				{
					$mmsetval = 1;
				}
				
				$xdata=array('SpilloverId'=>$xddetails->DirectId);
				$xmresult = $this->common_model->UpdateRecord($xdata,"MemberId='".$memberid."'","arm_oddevenmatrix");
				}
		}
		else
		{
			$date = date('y-m-d h:i:s');
			$Mdata = array(
						'SpilloverId'=>$mdetails->DirectId,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$memberid,
						'XupStatus'=>'0',
						'DateAdded'=>$date
						);
			$Mresult = $this->common_model->SaveRecords($Mdata,"arm_oddevenmatrix");
			if($Mresult)
				{
				$dmcondition = "MemberId='".$mdetails->DirectId."'";
				$dmdetails = $this->common_model->GetRow($dmcondition,'arm_oddevenmatrix');
				$dmcount =$dmdetails->MemberCount;
				if($dmdetails->XupStatus==1)
				{					
					$mmsetval = 0;
				}
				else
				{
					$mmsetval = 1;
				}
				$Dmdata=array('MemberCount'=>$dmcount+1,
							'XupStatus'=>$mmsetval,);
				$Dresult = $this->common_model->UpdateRecord($Dmdata,$dmcondition,"arm_oddevenmatrix");
				}
		}
		
	}


// odd / even end here
// monoline start here
	public function setmonolinematrix($memberid)
	{
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1' AND Id='3'","arm_matrixsetting");
		$mcondition = "MemberId='".$memberid."'";

		$mdetails = $this->common_model->GetRow($mcondition,'arm_members');
		$date = date('y-m-d h:i:s');
		$sdetails = $this->db->query("SELECT * FROM arm_monolinematrix order by MonoLineId DESC LIMIT 0,1");
		// $ddetails = $this->db->query("SELECT * FROM arm_monolinematrix WHERE MemberId='".$mdetails->DirectId."'");
	
		$Mdata = array(
						'SpilloverId'=>$sdetails->row()->MonoLineId,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$memberid,
						'DateAdded'=>$date,
						'status'=>1,

						'Limits'=>$sdetails->row()->Limits+$mlsetting->RecycleCount );
		/*print_r($Mdata);*/
			$Mresult = $this->common_model->SaveRecords($Mdata,"arm_monolinematrix");
			if($Mresult)
			{
				$inmonoid= $this->db->insert_id();
				$Mresult = $this->db->query("UPDATE arm_monolinematrix SET MemberCount = MemberCount +1 WHERE MonoLineId!='".$inmonoid."' ");
			
			}
			/*print_r($mlsetting);*/
			if($mlsetting->RecycleStatus==1)
			{
				$rycpro = $this->monorecycle();
			}
			/*echo"<br> ends";
			exit;*/

	}

	public function monorecycle()
	{
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1' AND Id='3'","arm_matrixsetting");
		$rdetails = $this->common_model->GetResults("MemberCount=Limits","arm_monolinematrix");

		
		// echo "<br>rcont ".count($rdetails); print_r($rdetails);
		if($rdetails)
		{

		for ($i=0; $i < count($rdetails); $i++) 
		{ 
			$sdetails = $this->db->query("SELECT * FROM arm_monolinematrix order by MonoLineId DESC LIMIT 0,1");
			$mdetails = $this->common_model->GetRow("MemberId='".$rdetails[$i]->MemberId."'",'arm_members');
			$package = $this->common_model->GetRow("PackageId='".$mdetails->PackageId."'","arm_package");
			$date = date('y-m-d h:i:s');
			$rmdata = array(
						'SpilloverId'=>$sdetails->row()->MonoLineId,
						'DirectId'=>$rdetails[$i]->DirectId,
						'MemberId'=>$rdetails[$i]->MemberId,
						'DateAdded'=>$date,
						'Limits'=>$sdetails->row()->Limits + $mlsetting->RecycleCount);
			// print_r($rmdata);
			$Mresult = $this->common_model->SaveRecords($rmdata,"arm_monolinematrix");
			if($Mresult)
			{
				$inmonoid= $this->db->insert_id();
				$Mresult = $this->db->query("UPDATE arm_monolinematrix SET MemberCount = MemberCount +1 WHERE MonoLineId!='".$inmonoid."' ");
				
				$userbal = $this->common_model->Getcusomerbalance($rdetails[$i]->memberid);
				
				if($mlsetting->RecycleCommissionType==2)
				{
					$rcommission =$package->PackageFee * $mlsetting->RecycleCommission / 100;	
				}else
				{
					$rcommission =$mlsetting->RecycleCommission;
				}
				$trnid = 'RCOM'.rand(1111111,9999999);
				$date = date('y-m-d h:i:s');
				$data = array(
					'MemberId'=>$rdetails[$i]->MemberId,
					'Credit'=>$rcommission,
					'Balance'=>$userbal+$rcommission,
					'Description'=>'Recycle Commission for new member register payment',
					'TransactionId'=>$trnid,
					'TypeId'=>'4',
					'DateAdded'=>$date
						 );
		 // echo "<br>monorecycle commission works for ".$userid;
		

		$userdetails = $this->common_model->SaveRecords($data,'arm_history');


			}

		}	
		}

	}

// monoline end here
// force start here

	public function setforcematrix($id)
	{
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1' AND Id='1'","arm_matrixsetting");
				
		$width = $mlsetting->MatrixWidth;
		$mcondition = "MemberId='".$id."'";

		$mdetails = $this->common_model->GetRow($mcondition,'arm_members');

		$dcondition = "MemberId='".$mdetails->DirectId."'";
		$ddetails = $this->common_model->GetRow($dcondition,'arm_forcedmatrix');

		$dmcount =$ddetails->MemberCount;
		$date = date('y-m-d h:i:s');

		$mecondition = "MemberId='".$id."'";

		$mecount = $this->common_model->GetRowCount($mecondition,'arm_forcedmatrix');
		
		
		if(!empty($dmcount))
		{
			if($dmcount<$width)
			{
				$Mdata = array(
						'SpilloverId'=>$mdetails->DirectId,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$id,
						'Status'=>1,
						'DateAdded'=>$date
						);
				if(!$mecount)
				{
				$Mresult = $this->common_model->SaveRecords($Mdata,"arm_forcedmatrix");
				
				
				if($Mresult)
				{
				$Ddata=array('MemberCount'=>$dmcount+1);
				$Dresult = $this->common_model->UpdateRecord($Ddata,$dcondition,"arm_forcedmatrix");
				}
				}
			}
			else
			{

				$res = $this->common_model->GetResults("SpilloverId = '".$mdetails->DirectId."' ","arm_forcedmatrix");
				$Downids=array();
				for($i=0;$i<count($res); $i++)
				{
					$Downids[]=$res[$i]->MemberId;
				}
				
				$dowid = $this->GetSpillover($Downids,"arm_forcedmatrix");
				array_push($dowid,$mdetails->DirectId);
				$userids = implode(",", $dowid);


				// echo "<br>"."SELECT * FROM arm_forcedmatrix WHERE SpilloverId IN (".$userids.") AND MemberCount < '".$width."' order by MemberId asc limit 0,1 ";
				
				$query = $this->db->query("SELECT * FROM arm_forcedmatrix WHERE SpilloverId  IN (".$userids.") AND MemberCount < '".$width."' order by MemberId asc limit 0,1 ");
				$spillid = $query->row()->MemberId;

				
					$Mdata = array(
						'SpilloverId'=>$spillid,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$id,
						'Status'=>1,
						'DateAdded'=>$date
						);
					
				if(!$mecount)
				{
				$Mresult = $this->common_model->SaveRecords($Mdata,"arm_forcedmatrix");
					
				if($Mresult)
				{
					
					$spcondition = "MemberId='".$spillid."'";
					$spdetails = $this->common_model->GetRow($spcondition,'arm_forcedmatrix');
					$smcount =$spdetails->MemberCount;

					$Ddata=array('MemberCount'=>$smcount+1);
					$Scondition = "MemberId='".$spillid."'";
					$Dresult = $this->common_model->UpdateRecord($Ddata,$Scondition,"arm_forcedmatrix");
				

				}
				}

			}



		}
		else
		{
			$Mdata = array(
						'SpilloverId'=>$mdetails->DirectId,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$id,
						'Status'=>1,
						'DateAdded'=>$date
						);
			if(!$mecount)
				{
				$Mresult = $this->common_model->SaveRecords($Mdata,"arm_forcedmatrix");
				
			if($Mresult)
			{
				$Ddata=array('MemberCount'=>$dmcount+1);
				$Dresult = $this->common_model->UpdateRecord($Ddata,$dcondition,"arm_forcedmatrix");

			}
			}
		}

	}


// force end here

// binary start here  Spillovers 	

	public function levelDownlinesCount($spilloverid,$level,$table)
	{
		$lmdetails = $this->common_model->GetRow("MemberId='".$spilloverid."'",$table);

		if(count($lmdetails) > 0)
			{
				$lupdate = $this->common_model->UpdateRecord("TotalMemberCount = 'TotalMemberCount' + 1","MemberId='".$spilloverid."'",$table);
				
				
				$spilloverid = $lmdetails->SpilloverId;
				
				// if(!empty($spilloverid) && $level < 2 )
				if(!$spilloverid)
				{
					$level++;
					
					$this->levelDownlinesCount($spilloverid,$level,$table);
				}
			}
	}

	public function totaldownlinecount($memberid,$spilloverid,$table)
	{
		if($spilloverid > 1) {

			$dmdetails = $this->common_model->GetRow("MemberId='".$spilloverid."'",$table);
				
			if(count($dmdetails)> 0)
			{
				
				$leftid = $dmdetails->LeftId;
				
				$rightid = $dmdetails->RightId;
				
				if($leftid == $memberid)
				{
					
					$this->db->set('leftdowncount', 'leftdowncount + 1', FALSE);
					$this->db->where('MemberId', $spilloverid);
					$query  = $this->db->update('arm_binarymatrix');

					$memberid = $dmdetails->MemberId;
					$spilloverid = $dmdetails->SpilloverId;
					
					if($spilloverid)
					{
						$this->totaldownlinecount($memberid,$spilloverid,$table);
					}
				}
				else
				{

					$this->db->set('rightdowncount', 'rightdowncount + 1', FALSE);
					$this->db->where('MemberId', $spilloverid);
					$query  = $this->db->update('arm_binarymatrix');

					// $query = $this->db->query("UPDATE `arm_binarymatrix` SET rightdowncount = 'rightdowncount' + 1 WHERE `MemberId` = '".$spilloverid."'");
					

	                $memberid = $dmdetails->MemberId;
					$spilloverid = $dmdetails->SpilloverId;
					
					if($spilloverid)
					{
						$this->totaldownlinecount($memberid,$spilloverid,$table);
					}
				}
				 
			}
		}
	}
	
	public function downlinecount($memberid,$spilloverid,$memid,$table)
	{
		$dmdetails = $this->common_model->GetRow("MemberId='".$spilloverid."'",$table);
			
		if(count($dmdetails)> 0)
		{
			// $fetch = mysql_fetch_array($select);
			
			$leftid = $dmdetails->LeftId;
			
			$rightid = $dmdetails->RightId;
			
			if($leftid == $memberid)
			{

				$query = $this->db->query("UPDATE `arm_binarymatrix` SET LeftCount = 'LeftCount' + 1,  LeftPairCount = 'LeftPairCount' + 1 WHERE `MemberId` = '".$spilloverid."'");						
				$memberid = $dmdetails->MemberId;
				
				$spilloverid = $dmdetails->SpilloverId;
				
				if(!$spilloverid)
				{
					$this->downlinecount($memberid,$spilloverid,$memid,$table);
				}
			}
			else
			{

				$query = $this->db->query("UPDATE `arm_binarymatrix` SET RightCount = 'RightCount' + 1 , RightPairCount = 'RightPairCount' + 1 WHERE `MemberId` = '".$spilloverid."'");

                $member_id = $dmdetails->MemberId;
				$spilloverid = $dmdetails->SpilloverId;
				
				if(!$spilloverid)
				{
					$this->downlinecount($memberid,$spilloverid,$memid,$table);
				}
			}
			 
		}
	}
		
	public function updatePlacement($memberid,$spillid,$table)
	{
		$mddetail = $this->common_model->GetRow("MemberId='".$spillid."'",$table);
		
		// $leftid = $mddetail->LeftId;
		// $rightid = $mddetail->RightId;
		
		if($mddetail->LeftId=='0')
		{
			$array = array(
				'LeftId' => $memberid
			);

			$Mresult = $this->common_model->UpdateRecord($array,"MemberId='".$spillid."'",$table);
			
			// $mdupdate  = $this->common_model->UpdateRecord("LeftId='".$memberid."'","MemberId='".$spillid."'",$table);
			// $update = mysql_query("update $table set left_id='$member_id' where member_id = '$intro_id' and stage_id = '$stage_id'");
		}
		else
		{
			$array = array(
				'RightId' => $memberid
			);
			$Mresult = $this->common_model->UpdateRecord($array,"MemberId='".$spillid."'",$table);
			// $mdupdate  = $this->common_model->UpdateRecord("RightId='".$memberid."'","MemberId='".$spillid."'",$table);

			// $update = mysql_query("update $table set right_id='$member_id' where member_id = '$intro_id' and stage_id = '$stage_id'");
		}
		$this->db->set('MemberCount', '`MemberCount`+ 1', FALSE);
		$this->db->where('MemberId', $spillid);
		$update_total_members  = $this->db->update($table, $array);
		
		
		// $update_total_members = $this->common_model->UpdateRecord("MemberCount = 'MemberCount' + 1 ","MemberId='".$spillid."'",$table);
		
		$fetPlace = $this->common_model->GetRow("MemberId ='".$memberid."'",$table);
		
		$this->downlinecount($memberid,$fetPlace->SpilloverId,$memberid,$table);
		$this->totaldownlinecount($memberid,$fetPlace->SpilloverId,$table);
		
		$this->levelDownlinesCount($fetPlace->SpilloverId,1,$table);
	}

	
	public function GetSpillover($Downids,$table)
	{
		
		$array = $Downids;
		foreach ($Downids as $downid) {
			
			$this->db->where('SpilloverId', $downid);
			$spil_qry = $this->db->get($table);
			
			foreach ($spil_qry->result() as $spil) {
				array_push($array,$spil->MemberId);
			}
			
		}
		return array_unique($array);
	}

	public function binarymatrix($memberid,$table)
	{
		$date = date('y-m-d h:i:s');
		$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1' AND Id='4'","arm_matrixsetting");


		if($mlsetting->Position==1)
		{
			$mcondition = "MemberId='".$memberid."'";
			$mdetails 	= $this->common_model->GetRow($mcondition,'arm_members');
			$spilloverid = ($mdetails->SpilloverId) ? $mdetails->SpilloverId : $mdetails->DirectId;
			$Mdata = array(
				'SpilloverId' => $spilloverid,
				'DirectId' => $mdetails->DirectId,
				'MemberId' => $memberid,
				'Status' => '1',
				'DateAdded' => $date
			);
			
			$Mresult = $this->common_model->SaveRecords($Mdata,$table);
			// if($Mresult)
			// {
			// 	// echo "UPDATE ".$table." SET MemberCount = MemberCount+1 WHERE MemberId='".$mdetails->DirectId."'";
			// 	$Mresult = $this->db->query("UPDATE ".$table." SET MemberCount ='MemberCount'+1 WHERE MemberId='".$spilloverid."'");
			// }
			

			if($mdetails->Position=='Left')
			{
				$Mdata = array(
					'LeftId'=>$memberid
				);
				
				//$Mresult = $this->common_model->UpdateRecord($Mdata,"MemberId='".$spilloverid."'",$table);
				
			}
			else
			{
				$Mdata = array(
					'RightId'=>$memberid
				);
				
				//$Mresult = $this->common_model->UpdateRecord($Mdata,"MemberId='".$spilloverid."'",$table);

			}


			if($Mresult) {
				$this->db->where('MemberId', $spilloverid);
				$this->db->set('MemberCount', '`MemberCount` + 1', FALSE);
				$this->db->update($table, $Mdata);
			}

			// if($Mresult)
			// {
			// 	$Mresult = $this->db->query("UPDATE ".$table." SET MemberCount = MemberCount+1 WHERE MemberId='".$mdetails->DirectId."'");
				
			// }
			$mcdetails 	= $this->common_model->GetRow("MemberId='".$memberid."'",$table);

			$this->downlinecount($memberid,$mcdetails->SpilloverId,$memberid,$table);
			$this->totaldownlinecount($memberid,$mcdetails->SpilloverId,$table);
			
			$this->levelDownlinesCount($mcdetails->SpilloverId,1,$table);

		}
		else
		{
			$mcondition = "MemberId='".$memberid."'";
			$mdetails 	= $this->common_model->GetRow($mcondition,'arm_members');

			$dmemberdet	=  $this->common_model->GetResults("SpilloverId = '".$mdetails->DirectId."'",$table);
			$Rows	=  $this->common_model->GetRowCount("SpilloverId = '".$mdetails->DirectId."'",$table);
			
			
			// $Rows = count($dmemberdet);

			if($Rows < $mlsetting->MatrixWidth)
			{
				$Mdata = array(
					'SpilloverId'=>$mdetails->DirectId,
					'DirectId'=>$mdetails->DirectId,
					'MemberId'=>$memberid,
					'Status'=>'1',
					'DateAdded'=>$date
				);
				
				$Mresult = $this->common_model->SaveRecords($Mdata,$table);
				if($Mresult)
				{
					// echo "UPDATE ".$table." SET MemberCount = MemberCount+1 WHERE MemberId='".$mdetails->DirectId."'";
					$Mresult = $this->db->query("UPDATE ".$table." SET MemberCount = MemberCount+1 WHERE MemberId='".$mdetails->DirectId."'");
				}

				$dmdetails = $this->common_model->GetRow("MemberId='".$mdetails->DirectId."'",$table);

				$leftid = $dmdetails->LeftId;
				$rightid = $dmdetails->RightId;

				if($leftid == '0')
				{
					$query = $this->db->query("UPDATE `arm_binarymatrix` SET LeftCount = 'LeftCount' + 1,  LeftPairCount = 'LeftPairCount' + 1, LeftId = '".$memberid."' WHERE `MemberId` = '".$mdetails->DirectId."'");
				} else{
                    $query = $this->db->query("UPDATE `arm_binarymatrix` SET RightCount = 'RightCount' + 1 , RightPairCount = 'RightPairCount' + 1, RightId = '".$memberid."' WHERE `MemberId` = '".$mdetails->DirectId."'");
				}

			}
			else
			{
				$Downids = array($mdetails->DirectId);

				foreach ($dmemberdet as $row) {
					$Downids[] = $row->MemberId;
				}
				
				
				$Spills = $this->GetSpillover($Downids,$table);
			
				$userids = implode(",", $Spills);
				
				$query = $this->db->query("SELECT * FROM ".$table." WHERE SpilloverId  IN (".$userids.") AND MemberCount < '".$mlsetting->MatrixWidth."' order by MemberId asc limit 0,1 ");
				
				$spillid = $query->row()->MemberId;

				$Mdata = array(
					'SpilloverId'=>$spillid,
					'DirectId'=>$mdetails->DirectId,
					'MemberId'=>$memberid,
					'Status'=>'1',
					'DateAdded'=>$date
				);
				
				$Mresult = $this->common_model->SaveRecords($Mdata,$table);
				if($Mresult)
				{
					$placement = $this->updatePlacement($memberid,$spillid,$table);
				}

			}
		
		}

	}

	function Totaldowncount() 
	{
		// SELECT * FROM `arm_binarymatrix` WHERE `Status` = '1' ORDER BY `arm_binarymatrix`.`MatrixId` ASC 
		$condition = " Status = '1' ";
		$mtrix_table = $this->common_model->GetResults($condition, 'arm_binarymatrix');
		if($mtrix_table) {
			foreach ($mtrix_table as $row) {
				$left_data = $this->common_model->GetRow("MemberId = '".$row->MemberId."' ",'arm_binarymatrix');
				if($left_data->LeftId != '0')
				{
					$leftids=array('0' => $left_data->LeftId);
					$dowid_left = $this->GetSpillovercount($leftids,"arm_binarymatrix");
					$this->db->set('leftdowncount', $dowid_left, FALSE);
					$this->db->where('MemberId', $row->MemberId);
					$update_left_members  = $this->db->update('arm_binarymatrix');
				}
				if($left_data->RightId != '0')
				{
					$rightids=array('0' => $left_data->RightId);
				 	$dowid_right = $this->GetSpillovercount($rightids,"arm_binarymatrix");
					$this->db->set('rightdowncount', $dowid_right, FALSE);
					$this->db->where('MemberId', $row->MemberId);
					$update_right_members  = $this->db->update('arm_binarymatrix');
			    }
			}
		}
	}

	public function GetSpillovercount($Downids,$table)
	{
		$array = $Downids;
		$countl = 1;
		foreach ($Downids as $downid) {
        
	        if($downid != '0'){
	        	$spill_res = $this->common_model->GetResults("SpilloverId = '".$downid."' ","arm_binarymatrix");
				
				if($spill_res){
					foreach ($spill_res as $spil) {
						$countl = $countl+1;
					}
				}
	        }
		}
		return $countl;
	}
// binary matrix end here
// board start here

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


	public function setboardmatrix1($id,$table)
	{

		

	
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1' AND Id='8'","arm_matrixsetting");
		
		$mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');
		$bpdetails = $this->common_model->GetRow("PackageId='".$mdetails->PackageId."'",'arm_boardplan');

		$width = $bpdetails->BoardWidth;

		$dcondition = "MemberId='".$mdetails->DirectId."' AND BoardId='".$mdetails->PackageId."' order by BoardMemberId limit 0,1";
		$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');
		
		$dmcount =$ddetails->MemberCount;
		$date = date('y-m-d h:i:s');

		if($dmcount)
		{
			
			if($dmcount<$width)
			{
				
				$Mdata = array(
						'BoardId'=>$mdetails->PackageId,
						'SpilloverId'=>$ddetails->BoardMemberId,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$id,
						'DateAdded'=>$date
						);
				
				$Mresult = $this->common_model->SaveRecords($Mdata,"arm_boardmatrix1");
				if($Mresult)
				{
				$Ddata=array('MemberCount'=>$dmcount+1);
				$Dresult = $this->common_model->UpdateRecord($Ddata,"BoardMemberId='".$ddetails->BoardMemberId."'","arm_boardmatrix1");
				}
				
			}
			else
			{
				
				$res = $this->common_model->GetResults("SpilloverId = '".$ddetails->BoardMemberId."' AND BoardId='".$mdetails->PackageId."' ","arm_boardmatrix1");
				
				$Downids=array($ddetails->BoardMemberId);
				for($i=0;$i<count($res); $i++)
				{
					$Downids[].=$res[$i]->BoardMemberId;
				}
				
				$dowid = $this->GetBoardSpillover($Downids,$mdetails->PackageId,"arm_boardmatrix1");
				
				$userids = implode(",", $dowid);

				// echo "<br>"."SELECT * FROM arm_boardmatrix WHERE SpilloverId  IN (".$userids.") AND BoardId='".$mdetails->PackageId."' AND MemberCount < '".$width."' order by BoardMemberId asc limit 0,1 ";

				$query = $this->db->query("SELECT * FROM arm_boardmatrix1 WHERE SpilloverId  IN (".$userids.") AND BoardId='".$mdetails->PackageId."' AND MemberCount < '".$width."' order by BoardMemberId asc limit 0,1 ");
				$spillid = $query->row()->BoardMemberId;

				
					$Mdata = array(
						'BoardId'=>$mdetails->PackageId,
						'SpilloverId'=>$spillid,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$id,
						'DateAdded'=>$date);
					
				
				$Mresult = $this->common_model->SaveRecords($Mdata,"arm_boardmatrix1");
					
				if($Mresult)
				{
					
					$spcondition = "BoardMemberId='".$spillid."'";
					$spdetails = $this->common_model->GetRow($spcondition,'arm_boardmatrix1');
					$smcount =$spdetails->MemberCount;

					$Ddata=array('MemberCount'=>$smcount+1);
					$Scondition = "BoardMemberId='".$spillid."'";
					$Dresult = $this->common_model->UpdateRecord($Ddata,$Scondition,"arm_boardmatrix1");
				

				}
				

			}



		}
		else
		{
			
			$Mdata = array(
						'BoardId'=>$mdetails->PackageId,
						'SpilloverId'=>$ddetails->BoardMemberId,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$id,
						'DateAdded'=>$date
						);
			
				$Mresult = $this->common_model->SaveRecords($Mdata,"arm_boardmatrix1");
				
				
			if($Mresult)
			{
				$Ddata=array('MemberCount'=>$dmcount+1);
				$Dresult = $this->common_model->UpdateRecord($Ddata,"BoardMemberId='".$ddetails->BoardMemberId."'","arm_boardmatrix1");

			}
			
		}
		if($bpdetails->ReentryBoardStatus || $bpdetails->ReentryNextBoardStatus)
		$checkreentry = $this->Checkboardreentry1();

		


	}

	public function Checkboardreentry1()
	{
		$boarddet = $this->common_model->GetResults("ReentryStatus='0' AND MemberCount='2'","arm_boardmatrix1");
		
		if($boarddet){
		for ($i=0; $i < count($boarddet); $i++) 
		{ 
			$bpdet = $this->common_model->GetRow("PackageId='".$boarddet[$i]->BoardId."'",'arm_boardplan');
			// $boarddet = $this->common_model->GetResults("BoardId='".$boarddet[$i]->BoardId."'","arm_boardmatrix");
		
			$check = $this->checkboard1(array($boarddet[$i]->BoardMemberId),$boarddet[$i]->BoardId,1,$bpdet->BoardWidth,$bpdet->BoardDepth);
			if($check)
			{
				
				$date =date("y-m-d H:i:s");
				
				$sbdetails = $this->common_model->GetRow("PackageId='".$boarddet[$i]->BoardId."'",'arm_boardplan');
				if($sbdetails->ReentryBoardStatus)
				{
					$sbdet = $this->common_model->GetRow("BoardId='".$boarddet[$i]->BoardId."' AND MemberCount<'".$bpdet->BoardWidth."' order by BoardMemberId asc limit 0,1 ","arm_boardmatrix1");
				$Mdata = array(
						'BoardId'=>$boarddet[$i]->BoardId,
						'SpilloverId'=>$sbdet->BoardMemberId,
						'DirectId'=>$boarddet[$i]->DirectId,
						'MemberId'=>$boarddet[$i]->MemberId,
						'DateAdded'=>$date
						);

				
				$Mresult = $this->common_model->SaveRecords($Mdata,"arm_boardmatrix1");
				}
				if($sbdetails->ReentryNextBoardStatus)
				{
					$sbdet = $this->common_model->GetRow("BoardId='".$boarddet[$i]->BoardId."' AND MemberCount<'".$bpdet->BoardWidth."' order by BoardMemberId asc limit 0,1 ","arm_boardmatrix1");
					
					$nbdet = $this->common_model->GetRow("BoardId='".$sbdetails->ReentryNextBoard."' AND MemberCount<'".$bpdet->BoardWidth."' order by BoardMemberId asc limit 0,1 ","arm_boardmatrix1");
				if($nbdet) {
				$NMdata = array(
						'BoardId'=>$sbdetails->ReentryNextBoard,
						'SpilloverId'=>$nbdet->BoardMemberId,
						'DirectId'=>$boarddet[$i]->DirectId,
						'MemberId'=>$boarddet[$i]->MemberId,
						'DateAdded'=>$date
						);
				}else{
                       $NMdata = array(
						'BoardId'=>$sbdetails->ReentryNextBoard,
						'SpilloverId'=>$sbdet->BoardMemberId,
						'DirectId'=>$boarddet[$i]->DirectId,
						'MemberId'=>$boarddet[$i]->MemberId,
						'DateAdded'=>$date
						);
				}
				$Mresult = $this->common_model->SaveRecords($NMdata,"arm_boardmatrix1");
				}

			if($Mresult)
			{
				$smdetails = $this->common_model->GetRow("BoardMemberId='".$sbdet->BoardMemberId."'",'arm_boardmatrix1');
				$smcount=$smdetails->MemberCount;
				$Ddata=array('MemberCount'=>$smcount+1);
				$Dresult = $this->common_model->UpdateRecord($Ddata,"BoardMemberId='".$sbdet->BoardMemberId."'","arm_boardmatrix1");
				$edata=array('ReentryStatus'=>1);
				$eresult = $this->common_model->UpdateRecord($edata,"BoardMemberId='".$boarddet[$i]->BoardMemberId."' AND ReentryStatus='0'","arm_boardmatrix1");
			}
			
			}

		}
	}

	}

	public function checkboard1($users,$boardid,$status,$wcount,$level)
	{
		

		
		for($i=0;$i<$level;$i++)
		{
			
			$usids = implode(",", $users);
				//chkcount correct count
			 if($i){ $chkcount = count($users) * $wcount; }else{$chkcount=$wcount;}

			$cmdetails = $this->common_model->GetResults("BoardId='".$boardid."' AND SpilloverId IN (".$usids.")","arm_boardmatrix1");
			
			//chkcount current members spillover count
			$mcount = count($cmdetails);
			
			if($chkcount <=$mcount && $status==1)
			{
			for($ii=0;$ii<count($cmdetails);$ii++)
			{ 
				if(!in_array($cmdetails[$ii]->BoardMemberId, $users))
				{
					array_push($users, $cmdetails[$ii]->BoardMemberId);
				}
			}
			
			}
			else
			{
			$status=0;
			}
				
		}

	/*	echo"<br><pre>"; print_r($users); echo"</pre>";
		echo"<br>check res = ".$status;*/
		
		return $status;
	}
	



	public function setboardmatrix($id,$table)
	{

		

		$mlsetting = $this->common_model->GetRow("MatrixStatus='1' AND Id='5'","arm_matrixsetting");
		
		$mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');
	
		$bpdetails = $this->common_model->GetRow("PackageId='".$mdetails->PackageId."'",'arm_boardplan');
		
		$width = $bpdetails->BoardWidth;
	

		$dcondition = "MemberId='".$mdetails->DirectId."' AND BoardId='".$mdetails->PackageId."' order by BoardMemberId limit 0,1";
		$ddetails = $this->common_model->GetRow($dcondition,$table);
		 $dmcount =$ddetails->MemberCount;
		 echo "membercount:".$ddetails->MemberCount;
		
		// exit;
		$date = date('y-m-d h:i:s');

		if($dmcount)
		{
			
			if($dmcount<$width)
			{
			
				$Mdata = array(
						'BoardId'=>$mdetails->PackageId,
						'SpilloverId'=>$ddetails->BoardMemberId,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$id,
						'DateAdded'=>$date
						);
				
				$Mresult = $this->common_model->SaveRecords($Mdata,$table);
			
				if($Mresult)
				{
				$Ddata=array('MemberCount'=>$dmcount+1);
				$Dresult = $this->common_model->UpdateRecord($Ddata,"BoardMemberId='".$ddetails->BoardMemberId."'",$table);
				}
				
			}
			else
			{
				
				$res = $this->common_model->GetResults("SpilloverId = '".$ddetails->BoardMemberId."' AND BoardId='".$mdetails->PackageId."' ",$table);

			
				$Downids=array($ddetails->BoardMemberId);
				for($i=0;$i<count($res); $i++)
				{
					$Downids[].=$res[$i]->BoardMemberId;
				}
				
				$dowid = $this->GetBoardSpillover($Downids,$mdetails->PackageId,$table);
				
				
				$userids = implode(",", $dowid);

				// echo "<br>"."SELECT * FROM arm_boardmatrix WHERE SpilloverId  IN (".$userids.") AND BoardId='".$mdetails->PackageId."' AND MemberCount < '".$width."' order by BoardMemberId asc limit 0,1 ";

				$query = $this->db->query("SELECT * FROM arm_boardmatrix WHERE SpilloverId  IN (".$userids.") AND BoardId='".$mdetails->PackageId."' AND MemberCount < '".$width."' order by BoardMemberId asc limit 0,1 ");
				$spillid = $query->row()->BoardMemberId;

					$Mdata = array(
						'BoardId'=>$mdetails->PackageId,
						'SpilloverId'=>$spillid,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$id,
						'DateAdded'=>$date);
					
				
				$Mresult = $this->common_model->SaveRecords($Mdata,$table);

					
				if($Mresult)
				{
					
					$spcondition = "BoardMemberId='".$spillid."'";
					$spdetails = $this->common_model->GetRow($spcondition,$table);
					$smcount =$spdetails->MemberCount;

					$Ddata=array('MemberCount'=>$smcount+1);
					$Scondition = "BoardMemberId='".$spillid."'";
					$Dresult = $this->common_model->UpdateRecord($Ddata,$Scondition,$table);
				

				}
				

			}



		}
		else
		{
			
			$Mdata = array(
						'BoardId'=>$mdetails->PackageId,
						'SpilloverId'=>$ddetails->BoardMemberId,
						'DirectId'=>$mdetails->DirectId,
						'MemberId'=>$id,
						'DateAdded'=>$date
						);
			
				$Mresult = $this->common_model->SaveRecords($Mdata,$table);
				
				
			if($Mresult)
			{
				$Ddata=array('MemberCount'=>$dmcount+1);
				$Dresult = $this->common_model->UpdateRecord($Ddata,"BoardMemberId='".$ddetails->BoardMemberId."'",$table);

			}
			
		}
		if($bpdetails->ReentryBoardStatus || $bpdetails->ReentryNextBoardStatus)
		$checkreentry = $this->Checkboardreentry($width);

		


	}


		public function Checkboardreentry($width)
	{

		// $mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');
	
		
		$boarddet = $this->common_model->GetResults("ReentryStatus='0' AND MemberCount='".$width."'","arm_boardmatrix");
		if($boarddet){
		for ($i=0; $i < count($boarddet); $i++) 
		{ 

			$bpdet = $this->common_model->GetRow("PackageId='".$boarddet[$i]->BoardId."'",'arm_boardplan');
			$boarddet = $this->common_model->GetResults("BoardId='".$boarddet[$i]->BoardId."'","arm_boardmatrix");
		
			$check = $this->checkboard(array($boarddet[$i]->BoardMemberId),$boarddet[$i]->BoardId,1,$bpdet->BoardWidth,$bpdet->BoardDepth);
			if($check)
			{
				
				$date =date("y-m-d H:i:s");
				
				$sbdetails = $this->common_model->GetRow("PackageId='".$boarddet[$i]->BoardId."'",'arm_boardplan');
				if($sbdetails->ReentryBoardStatus)
				{
					$sbdet = $this->common_model->GetRow("BoardId='".$boarddet[$i]->BoardId."' AND MemberCount<'".$bpdet->BoardWidth."' order by BoardMemberId asc limit 0,1 ","arm_boardmatrix");

				$Mdata = array(
						'BoardId'=>$boarddet[$i]->BoardId,
						'SpilloverId'=>$sbdet->BoardMemberId,
						'DirectId'=>$boarddet[$i]->DirectId,
						'MemberId'=>$boarddet[$i]->MemberId,
						'DateAdded'=>$date
						);

				
				$Mresult = $this->common_model->SaveRecords($Mdata,"arm_boardmatrix");
				}

				if($sbdetails->ReentryNextBoardStatus)
				{
					$sbdet = $this->common_model->GetRow("BoardId='".$boarddet[$i]->BoardId."' AND MemberCount<'".$bpdet->BoardWidth."' order by BoardMemberId asc limit 0,1 ","arm_boardmatrix");
				

					$nbdet = $this->common_model->GetRow("BoardId='".$sbdetails->ReentryNextBoard."' AND MemberCount<'".$bpdet->BoardWidth."' order by BoardMemberId asc limit 0,1 ","arm_boardmatrix");
				

				if($nbdet) {

						$checkboard=$this->db->query("Select * From arm_boardmatrix where  MemberId='".$boarddet[$i]->MemberId."' and BoardId='".$sbdetails->ReentryNextBoard."'");
						$countcheck=$checkboard->num_rows();
							if($countcheck==0)
						{

				$NMdata = array(
						'BoardId'=>$sbdetails->ReentryNextBoard,
						'SpilloverId'=>$nbdet->BoardMemberId,
						'DirectId'=>$boarddet[$i]->DirectId,
						'MemberId'=>$boarddet[$i]->MemberId,
						'DateAdded'=>$date
						);
			
				if(isset($NMdata)!="")
				{
					 $Mresult = $this->common_model->SaveRecords($NMdata,"arm_boardmatrix");
				}
				
				}
			}
				else{

						$checkboard=$this->db->query("Select * From arm_boardmatrix where  MemberId='".$boarddet[$i]->MemberId."' and BoardId='".$sbdetails->ReentryNextBoard."'");
						$countcheck=$checkboard->num_rows();
							if($countcheck==0)
						{
                       $NMdata = array(
						'BoardId'=>$sbdetails->ReentryNextBoard,
						'SpilloverId'=>'1',
						'DirectId'=>$boarddet[$i]->DirectId,
						'MemberId'=>$boarddet[$i]->MemberId,
						'DateAdded'=>$date
						);
                 if(isset($NMdata)!="")
				{
					 $Mresult = $this->common_model->SaveRecords($NMdata,"arm_boardmatrix");
				}
				}
				}
		
				
			
				
				}
			if(isset($NMdata)!="")
				{


			if(isset($Mresult)!="")
			{

				$smdetails = $this->common_model->GetRow("BoardMemberId='".$sbdet->BoardMemberId."'",'arm_boardmatrix');
				$smcount=$smdetails->MemberCount;
				 $Ddata=array('MemberCount'=>$smcount+1);
				$Dresult = $this->common_model->UpdateRecord($Ddata,"BoardMemberId='".$sbdet->BoardMemberId."'","arm_boardmatrix");
				$edata=array('ReentryStatus'=>1,'NextReentryStatus'=>1);
				$eresult = $this->common_model->UpdateRecord($edata,"BoardMemberId='".$boarddet[$i]->BoardMemberId."' AND ReentryStatus='0'","arm_boardmatrix");
			}

				}

			
			}

		}
	}
	 // exit;

	}


	public function checkboard($users,$boardid,$status,$wcount,$level)
	{
		

		for($i=0;$i<$level;$i++)
		{
			
			$usids = implode(",", $users);

				//chkcount correct count
			 if($i){ $chkcount = count($users) * $wcount; }else{$chkcount=$wcount;}

			$cmdetails = $this->common_model->GetResults("BoardId='".$boardid."' AND SpilloverId IN (".$usids.")","arm_boardmatrix");
			
			//chkcount current members spillover count
			$mcount = count($cmdetails);
			
			if($chkcount <=$mcount && $status==1)
			{
			for($ii=0;$ii<count($cmdetails);$ii++)
			{ 
				if(!in_array($cmdetails[$ii]->BoardMemberId, $users))
				{
					array_push($users, $cmdetails[$ii]->BoardMemberId);
				}
			}
			
			}
			else
			{
			$status=0;
			}
				
		}

	/*	echo"<br><pre>"; print_r($users); echo"</pre>";
		echo"<br>check res = ".$status;*/
		
		return $status;
	}
	
// 	

// board end here


}

?>