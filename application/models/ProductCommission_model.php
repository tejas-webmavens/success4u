<?php

Class ProductCommission_model extends CI_Model {

	public function check($memberid,$orderid)
	{
		$memberdet = $this->common_model->GetRow("MemberId='".$memberid."'","arm_members");
		// echo "<br>"; $memberid;
		// echo "<bR>"; $orderid;

		
		if($memberdet->DirectId!=0 && $memberdet->MemberStatus=='Active')
		{
			$ss = $this->process($memberid,$orderid);
			return true;
		}
		elseif($memberdet->MemberStatus=='guest' && $memberdet->DirectId!=0)
		{
			 // echo "guest";
			$cc=$this->refguest($memberid,$orderid);
			return true;
		}
		else
		{
			return false;
		}
		
	} //function

	public function process($memberid,$orderid)
	{
			//get member detail
			$userdetail = $this->common_model->GetRow("MemberId='".$memberid."'","arm_members");

			// check matrix type for product commissions 
			$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
							
			$field = "MemberId";
			$ptable='arm_package';
			$MemberId = $memberid;
			$dMemberId = $userdetail->DirectId;
			if($mlsetting->Id==1){$table = "arm_forcedmatrix"; }
			else if($mlsetting->Id==2) {$table = "arm_unilevelmatrix"; }
			else if($mlsetting->Id==3) {
				$table = "arm_monolinematrix";
				$field = "MonoLineId";
				//check member in matrix
				$monomdet = $this->common_model->GetRow("MemberId='". $memberid."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");
				$MemberId = $monomdet->MonoLineId;

				//check referral member in matrix
				$monodmdet = $this->common_model->GetRow("MemberId='". $userdetail->DirectId."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");
				$dMemberId = $monodmdet->MonoLineId;

			}
			else if($mlsetting->Id==4) {$table = "arm_binarymatrix"; $ptable = "arm_pv";}
			else if($mlsetting->Id==9) {$table = "arm_binaryhyip"; $ptable = "arm_hyip";}

			else if($mlsetting->Id==5) {
				$table = "arm_boardmatrix";
				$field = "BoardMemberId";
				$ptable = "arm_boardplan";
				//check member in matrix
				$brdmdet = $this->common_model->GetRow("MemberId='". $memberid."' order by BoardMemberId ASC LIMIT 0,1","arm_boardmatrix");
				$MemberId = $brdmdet->BoardMemberId;
				//check referral member in matrix
				$brddmdet = $this->common_model->GetRow("MemberId='". $userdetail->DirectId."' order by BoardMemberId ASC LIMIT 0,1","arm_boardmatrix");
				$dMemberId = $brddmdet->BoardMemberId;
			}
			else if($mlsetting->Id==6) {$table = "arm_xupmatrix"; }
			else if($mlsetting->Id==7) {$table = "arm_oddevenmatrix"; }
			
			// get product purchase ammount 
			$ordertotal = $this->common_model->GetRow("order_id='".$orderid."' AND code='sub_total'","arm_order_total");
			$subtotal = $ordertotal->value;	

			//check member is active or Guest 
			if($userdetail->MemberStatus=='Active' && $userdetail->PackageId!=0)
			{
				$usermlmdetail = $this->common_model->GetRow($field."='".$MemberId."'",$table);

				$currentpckid = $userdetail->PackageId;
				$package = $this->common_model->GetRow("PackageId='".$currentpckid."'",$ptable);
				//own commission
				if($mlsetting->OwnCommissionStatus)
				{
				
				$ortype = $this->common_model->GetRow("Page='mlmsetting' AND KeyValue='owncommissiontype'","arm_setting");
				
					if($mlsetting->OwnCommissionType==2)
					{
						$ocommission = $subtotal * $package->OwnCommission / 100;
						
					}else
					{
						$ocommission =$package->OwnCommission;
					}
					//check member active or not in matrix 
					$ocheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->MemberId."' AND Status='1'",$mlsetting->TableName);
					if($ocheckmatmem)
					{
					$oresult = $this->owncommission($usermlmdetail->MemberId,$ocommission);
					}
					
				}



			}
			else
			{
				$usermlmdetail = $this->common_model->GetRow($field."='".$dMemberId."'",$table);
				$duserdetail = $this->common_model->GetRow("MemberId='".$userdetail->DirectId."'","arm_members");
				$currentpckid = $duserdetail->PackageId;

			}
		

		$package = $this->common_model->GetRow("PackageId='".$currentpckid."'",$ptable);
		$levelvalue = explode(",",$package->ProductLevelCommissions);
		
		if($mlsetting->DirectCommissionStatus && $usermlmdetail)
		{
			
			if($mlsetting->DirectCommissionType==2)
				{
					$commission = $package->PackageFee * $levelvalue[0] / 100;
					
				}else
				{
					$commission =$levelvalue[0];
				}

				//check member active or not in matrix 
				$dcheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."' AND Status='1'",$mlsetting->TableName);
				if($dcheckmatmem)
				
				$dresult = $this->directcommission($usermlmdetail->DirectId,$commission);
		}

		if($mlsetting->LevelCommissionStatus && $usermlmdetail)
		{
			$lvlmemdet = $this->common_model->GetRow($field."='".$usermlmdetail->SpilloverId."'",$table);
			$userid=$usermlmdetail->SpilloverId;
			$spid =$lvlmemdet->MemberId;

			for($i=0;$i<count($levelvalue);$i++)
			{
				
				$commission=0;
				if($mlsetting->LevelCommissionType==2)
				{
					$commission = $package->PackageFee * $levelvalue[$i] / 100;
					
				}else
				{
					$commission =$levelvalue[$i];
				}
				
					$level=$i+1;
				
					if($mlsetting->RepeatCommissionStatus)
					{
						if($commission > 0 && $usermlmdetail->DirectId!=$spid && $userid!='0' && $spid!='0')
							{
							//check member active or not in matrix 
							$lcheckmatmem = $this->common_model->GetRow("MemberId='".$spid."' AND Status='1'",$mlsetting->TableName);
							if($lcheckmatmem)
							$dresult = $this->levelcommission($spid,$commission,$level);
							}
					}
					else
					{
						if($commission > 0 && $userid!='0' && $spid!='0')
							{
							//check member active or not in matrix 
							$lcheckmatmem = $this->common_model->GetRow("MemberId='".$spid."' AND Status='1'",$mlsetting->TableName);
							if($lcheckmatmem)
							$dresult = $this->levelcommission($spid,$commission,$level);
							}

					}
				$memberdetail = $this->common_model->GetRow("".$field."='".$userid."'",$table);
				
				if($memberdetail)
				{
					$userid = $memberdetail->SpilloverId;
					$spid = $memberdetail->MemberId;
				}
				else
				{$userid='0';
				$spid ='0';
				}
					
					

			}
		}

		// exit;
	} //function


	public function refguest($memberid,$orderid)
	{
	    //get member detail
	    $userdetail = $this->common_model->GetRow("MemberId='".$memberid."'","arm_members");
	    // echo $this->db->last_query();
	    $directid=$userdetail->DirectId;
	    $userdetails = $this->common_model->GetRow("MemberId='".$directid."'","arm_members");
	    // echo $this->db->last_query();



	    $mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
	    // echo $this->db->last_query();
							
			$field = "MemberId";
			$ptable='arm_package';
			$MemberId = $memberid;
			$dMemberId = $userdetail->DirectId;
			if($mlsetting->Id==1){$table = "arm_forcedmatrix"; }
			else if($mlsetting->Id==2) {$table = "arm_unilevelmatrix"; }
			else if($mlsetting->Id==3) {
				$table = "arm_monolinematrix";
				$field = "MonoLineId";
				//check member in matrix
				$monomdet = $this->common_model->GetRow("MemberId='". $directid."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");
				if($monomdet!="")
				{
				// $MemberId = $monomdet->MonoLineId;

				//check referral member in matrix
				$monodmdet = $this->common_model->GetRow("MemberId='". $userdetail->DirectId."' order by MonoLineId ASC LIMIT 0,1","arm_monolinematrix");
				$dMemberId = $monodmdet->MonoLineId;

				}


			}
			else if($mlsetting->Id==4) {$table = "arm_binarymatrix"; $ptable = "arm_pv";}
			else if($mlsetting->Id==9) {$table = "arm_binaryhyip"; $ptable = "arm_hyip";}

			else if($mlsetting->Id==5) {
				$table = "arm_boardmatrix";
				$field = "BoardMemberId";
				$ptable = "arm_boardplan";
				//check member in matrix
				$brdmdet = $this->common_model->GetRow("MemberId='". $directid."' order by BoardMemberId ASC LIMIT 0,1","arm_boardmatrix");
				if($brdmdet!="")
				{
				 	// $MemberId = $brdmdet->BoardMemberId;
				//check referral member in matrix
					$brddmdet = $this->common_model->GetRow("MemberId='". $directid."' order by BoardMemberId ASC LIMIT 0,1","arm_boardmatrix");
					$dMemberId = $brddmdet->BoardMemberId;
				}

			}
			else if($mlsetting->Id==6) {$table = "arm_xupmatrix"; }
			else if($mlsetting->Id==7) {$table = "arm_oddevenmatrix"; }
			
			// get product purchase ammount 
			$ordertotal = $this->common_model->GetRow("order_id='".$orderid."' AND code='sub_total'","arm_order_total");
			// echo $this->db->last_query();
			$subtotal = $ordertotal->value;	

			//check member is active or Guest 
			if($userdetails->MemberStatus=='Active' && $userdetails->PackageId!=0)
			{
				 // echo "active";

				  // echo $userdetails->MemberId;


				$usermlmdetail = $this->common_model->GetRow($field."='".$userdetails->MemberId."'",$table);
				// echo $this->db->last_query();

				$currentpckid = $userdetails->PackageId;
				$package = $this->common_model->GetRow("PackageId='".$currentpckid."'",$ptable);
				//own commission
				if($mlsetting->OwnCommissionStatus)
				{
				
				$ortype = $this->common_model->GetRow("Page='mlmsetting' AND KeyValue='owncommissiontype'","arm_setting");
				
					if($mlsetting->OwnCommissionType==2)
					{
						$ocommission = $subtotal * $package->OwnCommission / 100;
						
					}else
					{
						$ocommission =$package->OwnCommission;
					}
					//check member active or not in matrix 
					$ocheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->MemberId."' AND Status='1'",$mlsetting->TableName);
					if($ocheckmatmem)
					{
					$oresult = $this->owncommission($usermlmdetail->MemberId,$ocommission);
					}
					
				}



			}
			else
			{
				$usermlmdetail = $this->common_model->GetRow($field."='".$dMemberId."'",$table);
				$duserdetail = $this->common_model->GetRow("MemberId='".$userdetails->DirectId."'","arm_members");
				$currentpckid = $duserdetail->PackageId;

			}
		

		$package = $this->common_model->GetRow("PackageId='".$currentpckid."'",$ptable);
		$levelvalue = explode(",",$package->ProductLevelCommissions);
		
		if($mlsetting->DirectCommissionStatus && $usermlmdetail)
		{
			
			if($mlsetting->DirectCommissionType==2)
				{
					$commission = $package->OwnCommission / 100;
					
				}else
				{
					$commission =$package->OwnCommission;
				}

				//check member active or not in matrix 
				$dcheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."' AND Status='1'",$mlsetting->TableName);
				if($dcheckmatmem)
				
				$dresult = $this->directcommission($usermlmdetail->MemberId,$commission);
		}

		if($mlsetting->LevelCommissionStatus && $usermlmdetail)
		{
			$lvlmemdet = $this->common_model->GetRow($field."='".$usermlmdetail->SpilloverId."'",$table);
			$userid=$usermlmdetail->SpilloverId;
			// $spid=$userid;
			$spid =$lvlmemdet->MemberId;

			for($i=0;$i<count($levelvalue);$i++)
			{

				
				$commission=0;
				if($mlsetting->LevelCommissionType==2)
				{
					$commission = $package->PackageFee * $levelvalue[$i] / 100;
					
				}else
				{
					$commission =$levelvalue[$i];
					// echo $commission;
				}
				
					$level=$i+1;
					// echo "level:".$level;
				
					if($mlsetting->RepeatCommissionStatus)
					{
						if($commission > 0 && $usermlmdetail->DirectId!=$spid && $userid!='0' && $spid!='0')
							{
							//check member active or not in matrix 
							$lcheckmatmem = $this->common_model->GetRow("MemberId='".$spid."' AND Status='1'",$mlsetting->TableName);
							if($lcheckmatmem)
							$dresult = $this->levelcommission($spid,$commission,$level);
							// $dresult = $this->levelcommission($userid,$commission,$level);

							}
					}
					else
					{
						if($commission > 0 && $userid!='0' && $spid!='0')
							{
							//check member active or not in matrix 
							$lcheckmatmem = $this->common_model->GetRow("MemberId='".$spid."' AND Status='1'",$mlsetting->TableName);
							if($lcheckmatmem)
							$dresult = $this->levelcommission($spid,$commission,$level);
							 // $result = $this->levelcommission($userid,$commission,$level);

							}

					}
				$memberdetail = $this->common_model->GetRow("".$field."='".$userid."'",$table);
				
				if($memberdetail)
				{
					$userid = $memberdetail->SpilloverId;
					$spid = $memberdetail->MemberId;


				}
				else
				{$userid='0';
				$spid ='0';
				}
					
					

			}
		}


	} //function

	

	
	// Member own commission process here


	public function owncommission($userid,$commission)
	{
		$userbal = $this->common_model->Getcusomerbalance($userid);
		$trnid = 'OCOM'.rand(1111111,9999999);
		$date = date('y-m-d h:i:s');
		$data = array(
					'MemberId'=>$userid,
					'Credit'=>$commission,
					'Balance'=>$userbal+$commission,
					'Description'=>'Own Commission for product purchase',
					'TransactionId'=>$trnid,
					'paythrough'=>'Ewallet',
					'TypeId'=>'4',
					'DateAdded'=>$date
						 );
		

		$userdetailss = $this->common_model->SaveRecords($data,'arm_history');
		// echo $this->db->last_query();
		
	} //function

	// Member direct commission process here


	public function directcommission($userid,$commission)
	{
		$userbal = $this->common_model->Getcusomerbalance($userid);
		$trnid = 'DCOM'.rand(1111111,9999999);
		$date = date('y-m-d h:i:s');
		$data = array(
					'MemberId'=>$userid,
					'Credit'=>$commission,
					'Balance'=>$userbal+$commission,
					'Description'=>'Direct Commission for product purchase',
					'TransactionId'=>$trnid,
					'paythrough'=>'Ewallet',
					'TypeId'=>'4',
					'DateAdded'=>$date
						 );
		

		$userdetailss = $this->common_model->SaveRecords($data,'arm_history');
		 // echo $this->db->last_query();
		
	} //function
	
	// Member level commission process here

	public function levelcommission($userid,$commission,$level)
	{
		$userbal = $this->common_model->Getcusomerbalance($userid);
		$trnid = 'LCOM'.rand(1111111,9999999);
		$date = date('y-m-d h:i:s');
		$data = array(
					'MemberId'=>$userid,
					'Credit'=>$commission,
					'Balance'=>$userbal+$commission,
					'Description'=>'Level'.$level.' Commission for product purchase',
					'TransactionId'=>$trnid,
					'paythrough'=>'Ewallet',
					'TypeId'=>'4',
					'DateAdded'=>$date
						 );
		
		$userdetailss = $this->common_model->SaveRecords($data,'arm_history');
		// echo $this->db->last_query();

	} //function


}

?>