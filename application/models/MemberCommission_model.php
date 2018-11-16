<?php
error_reporting(0);
ini_set('max_execution_time', 300);
Class MemberCommission_model extends CI_Model {

	public function process($memberid,$table,$field)
	{
		    
		
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");

		$usermlmdetail = $this->common_model->GetRow("".$field."='".$memberid."'",$table);
		

		$userdetail = $this->common_model->GetRow("MemberId='".$usermlmdetail->MemberId."'","arm_members");
		// echo $this->db->last_query();
		$user=$this->common_model->GetRow("MemberId='".$usermlmdetail->MemberId."'","arm_memberpayment");

		if($mlsetting->Id=='5')
		{
			$boardpackage = $this->common_model->GetRow("PackageId='".$userdetail->PackageId."'","arm_boardplan");
		}
		elseif ($mlsetting->Id=='4') 
		{
			$binarypackage = $this->common_model->GetRow("PackageId='".$userdetail->PackageId."'","arm_pv");
		}
		elseif ($mlsetting->Id=='9') 
		{
			$binarypackage = $this->common_model->GetRow("PackageId='".$user->PackageId."'","arm_hyip");
		}
		else
		{
			$package = $this->common_model->GetRow("PackageId='".$userdetail->PackageId."'","arm_package");
			$levelvalue = explode(",",$package->LevelCommissions);

		}

		$dcheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."' AND Status='1'",$mlsetting->TableName);
			
		//check xup direct commission status
		
		if($mlsetting->DirectCommissionStatus==1 && $mlsetting->Id==6 && $mlsetting->MTMPayStatus=='0')
		{
			if($mlsetting->DirectCommissionType==2)
				{
					$dcommission = $package->PackageFee * $levelvalue[0] / 100;	
				}else
				{
					$dcommission =$levelvalue[0];
				}

				//check member active or not in matrix 
				$dcheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."' AND Status='1'",$mlsetting->TableName);

				if($dcheckmatmem)
				$dresult = $this->directcommission($usermlmdetail->DirectId,$dcommission,$memberid);
		}

		//check xup level commission status
		
		if($mlsetting->LevelCommissionStatus==1 && $mlsetting->Id==6 && $mlsetting->MTMPayStatus=='0')
		{
			

			$userid =$usermlmdetail->SpilloverId;

			for($i=0;$i<count($levelvalue);$i++)
			{	
				$g=$i+1;
				$commission=0;
				if($mlsetting->LevelCommissionType==2)
				{
					$lcommission = $package->PackageFee * $levelvalue[$i] / 100;	
				}else
				{
					$lcommission =$levelvalue[$i];
				}
				

					if($mlsetting->RepeatCommissionStatus)
					{
						// echo"<br>". $commission .'> 0 && '.$usermlmdetail->DirectId.'!='.$userid.' && '.$userid.'!='.'0';
						if($lcommission > 0 && $usermlmdetail->DirectId!=$userid && $userid!='0')
						{
						// echo"<br>". $lcommission .'> 0 && '.$usermlmdetail->DirectId.'!='.$userid.' && '.$userid.'!='.'0';
							//check member active or not in matrix 
							
							$lcheckmatmem = $this->common_model->GetRow("MemberId='".$userid."' AND Status='1'",$mlsetting->TableName);
							if($lcheckmatmem)
							$dresult = $this->levelcommission($userid,$lcommission,$g);
						}
					}
					else
					{
						if($lcommission > 0 && $userid!='0')
						{	
							//check member active or not in matrix 
							$lcheckmatmem = $this->common_model->GetRow("MemberId='".$userid."' AND Status='1'",$mlsetting->TableName);
							if($lcheckmatmem)
							$dresult = $this->levelcommission($userid,$lcommission,$g);
						}
					}
					
				//change SpilloverId 
				$memberdetail = $this->common_model->GetRow("".$field."='".$userid."'",$table);
				
				if($memberdetail)
				{
					$userid = $memberdetail->SpilloverId;
				}
				else
				{
					$userid='0';
				}
					
			}
		}
				
		//Check board matrix direct commission
		
		if($mlsetting->DirectCommissionStatus==1 && $mlsetting->Id==5)
		{
			if($mlsetting->DirectCommissionType==2)
			{
				$dcommission = $boardpackage->PackageFee * $boardpackage->DirectCommission / 100;	
			}
			else
			{
				$dcommission =$boardpackage->DirectCommission;
			}
			//check member active or not in matrix 
			$dcheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."' AND Status='1'",$mlsetting->TableName);
			if($dcheckmatmem)
				$dresult = $this->directcommission($usermlmdetail->DirectId,$dcommission,$memberid);
		}
		
		//Check board matrix level commission
		if($mlsetting->LevelCommissionStatus==1 && $mlsetting->Id==5)

		{

			$blevelvalue = explode(",",$boardpackage->LevelCommission);
			$userid =$usermlmdetail->SpilloverId;

			for($i=0;$i<count($blevelvalue);$i++)
			{	
				$g=$i+1;
				$commission=0;
				if($mlsetting->LevelCommissionType==2)
				{
					$lcommission = $boardpackage->PackageFee * $blevelvalue[$i] / 100;	
				}
				else
				{
					$lcommission =$blevelvalue[$i];
				}
				

				if($mlsetting->RepeatCommissionStatus)
				{
					// echo"<br>". $commission .'> 0 && '.$usermlmdetail->DirectId.'!='.$userid.' && '.$userid.'!='.'0';
					if($lcommission > 0 && $usermlmdetail->DirectId!=$userid && $userid!='0')
					{
						// echo"<br>". $lcommission .'> 0 && '.$usermlmdetail->DirectId.'!='.$userid.' && '.$userid.'!='.'0';
						//check member active or not in matrix 
						$lcheckmatmem = $this->common_model->GetRow("MemberId='".$userid."' AND Status='1'",$mlsetting->TableName);
						if($lcheckmatmem)
						$dresult = $this->levelcommission($userid,$lcommission,$g);
					}
				}
				else
				{

					if($lcommission > 0 && $userid!='0')

					{	
						//check member active or not in matrix 
						$lcheckmatmem = $this->common_model->GetRow("MemberId='".$userid."' AND Status='1'",$mlsetting->TableName);
						if($lcheckmatmem)
						$dresult = $this->levelcommission($userid,$lcommission,$g);
					}
				}
					
				//change SpilloverId 
				$memberdetail = $this->common_model->GetRow("BoardMemberId='".$userid."'",$table);
				
				if($memberdetail)
				{
					$userid = $memberdetail->SpilloverId;
				}
				else
				{
					$userid='0';
				}
					
			}

		}

		//Check board matrix board commission
		if($mlsetting->BoardCommissionStatus==1 && $mlsetting->Id==5)
		{

			if($mlsetting->BoardCommissionType==2)
			{
				$bcommission = $boardpackage->PackageFee * $boardpackage->BoardCommission / 100;	
			}
			else
			{
				$bcommission = $boardpackage->BoardCommission;
			}


			$boarddet = $this->common_model->GetResults("BoardCommissionStatus='0' AND MemberCount='2'","arm_boardmatrix");
			for ($i=0; $i < count($boarddet) ; $i++) 
			{
				$bpdet = $this->common_model->GetRow("PackageId='".$boarddet[$i]->BoardId."'",'arm_boardplan');
		
				$check = $this->checkboard(array($boarddet[$i]->BoardMemberId),$boarddet[$i]->BoardId,1,$bpdet->BoardWidth,$bpdet->BoardDepth);
				if($check)
				{
					//check member active or not in matrix 
					$bcheckmatmem = $this->common_model->GetRow("MemberId='".$boarddet[$i]->MemberId."' AND Status='1'",$mlsetting->TableName);
					if($bcheckmatmem)
					{
						$bresult = $this->boardcommission($boarddet[$i]->MemberId,$bcommission,$bpdet->PackageName);
						$ubresult = $this->db->query("UPDATE arm_boardmatrix SET BoardCommissionStatus='1' WHERE BoardMemberId='".$boarddet[$i]->BoardMemberId."'");
					}
				}

			}

		}
		
		//Check Binary matrix direct commission

		if($mlsetting->DirectCommissionStatus==1 && $mlsetting->Id==4)
		{

			if($mlsetting->DirectCommissionType==2)
			{
				$dcommission = $binarypackage->PackageFee * $binarypackage->DirectCommission / 100;	
			}
			else
			{
				$dcommission =$binarypackage->DirectCommission;
			}

			//check member active or not in matrix 
			$dcheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."'",$mlsetting->TableName);
			
			if($dcheckmatmem)
				$dresult = $this->directcommission($usermlmdetail->DirectId,$dcommission,$memberid);

		}

		// binary pair commission 

		if($mlsetting->PvStatus==1 && $mlsetting->Id==4)
		{
		
			if($binarypackage->PairCommissionType==2)
			{
				$pvcommission = $binarypackage->PackageFee * $binarypackage->PairCommission / 100;	
			}
			else
			{
				$pvcommission =$binarypackage->PairCommission;
			}
			//check member active or not in matrix
     
			$pcheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."'",$mlsetting->TableName);
			
			if($pcheckmatmem)
			{
				// $pcset = $this->pointvalue($usermlmdetail->DirectId,"arm_binarymatrix",1,$pvcommission);
				$pcset = $this->pointvalue1($usermlmdetail->DirectId,"arm_binarymatrix",1,$binarypackage);
				$dresult = $this->paircommission();
			}
		}


				//Check Binaryhyip matrix direct commission

		if($mlsetting->DirectCommissionStatus==1 && $mlsetting->Id==9)
		{

			if($mlsetting->DirectCommissionType==2)

			{
			
				$user=$this->common_model->GetRows("MemberId='".$memberid."'","arm_memberpayment");
				
				$deposit=$user->depositid;
			
				$amount=$this->common_model->GetRow("id='".$deposit."'","deposit");
				
				
				$dcommission = $amount->amount * $binarypackage->DirectCommission / 100;
		
				// echo $dcommission;
				
			}
			else
			{
				$dcommission =$binarypackage->DirectCommission;
				// echo $dcommission;
				
			}

			//check member active or not in matrix 
			$dcheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."'",$mlsetting->TableName);
			// print_r($dcheckmatmem);
			if($dcheckmatmem)
				if($dcommission!=0)
				{
					$dresult = $this->directcommission($usermlmdetail->DirectId,$dcommission,$memberid);
				}
				
		 // exit;

		}

		// binaryhyip pair commission 

		if($mlsetting->PvStatus==1 && $mlsetting->Id==9)
		{
			
			if($binarypackage->PairCommissionType==2)

			{
				
				$user=$this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."'",'arm_binaryhyip');
				// $depositleftid
				$depositleftid=$user->LeftId;

				// echo $depositleftid;
				if($user->RightId)
				{
					$depositrightid=$user->RightId;
				}

				$amount1=$this->common_model->GetRowdeposit("MemberId='".$depositleftid."'","deposit");
				$amountuser1=$amount1->amount;
				// echo $amountuser1;
				if($depositrightid=$user->RightId)
				{
					$amount2=$this->common_model->GetRowdeposit("MemberId='".$depositrightid."'","deposit");
				$amountuser2=$amount2->amount;
				}
				else
				{
					$amountuser2=0;
				}
				
			
				$totalamount=$amountuser1+$amountuser2;
		

				$pvcommission = $totalamount * $binarypackage->PairCommission / 100;		

			}

			else
			{
				$pvcommission =$binarypackage->PairCommission;				
			}
			//check member active or not in matrix
			if($usermlmdetail->DirectId)
			{
					$pcheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."'",$mlsetting->TableName);

			
			if($pcheckmatmem)
			{
				if($binarypackage->hyip!=0)
				{
					$pcset = $this->pointvaluehyip1($usermlmdetail->DirectId,"arm_binaryhyip",1,$binarypackage);
				}

				
				$dresult = $this->paircommissionhyip();
			}
			
			}
      // exit;
		
		}

		// if($mlsetting->CommissionProcess==0 && $mlsetting->Id==4 && $mlsetting->Id!=5 && $mlsetting->Id!=6 )
		// {
			
		// 	$dresult = $this->paircommission();
		// }

		

		//check direct commission status for Force,UniLevel,MonoLine,oddeven Matrix  
		
		if($mlsetting->DirectCommissionStatus==1 && $mlsetting->Id!=4 && $mlsetting->Id!=5 && $mlsetting->Id!=6&& $mlsetting->Id!=9)
		{
			if($mlsetting->DirectCommissionType==2)
			{
				$dcommission = $package->PackageFee * $package->OwnCommission[0] / 100;	
			}
			else
			{
				$dcommission =$package->OwnCommission;
			}
			//check member active or not in matrix 
			$dcheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."' AND Status='1'",$mlsetting->TableName);
			// echo $this->db->last_query()."<br>";
			if($dcheckmatmem)
				$dresult = $this->directcommission($usermlmdetail->DirectId,$dcommission,$memberid);
		}



		//check level commission status for Force,UniLevel,MonoLine,oddeven Matrix

	
		
		if($mlsetting->LevelCommissionStatus==1 && $mlsetting->Id!=4 && $mlsetting->Id!=5 && $mlsetting->Id!=6 &&  $mlsetting->Id!=9)
		{
			 
			$userid =$usermlmdetail->SpilloverId;
		

			for($i=0;$i<count($levelvalue);$i++)
			{	
				

				$g=$i+1;
				
				$commission=0;
				if($mlsetting->LevelCommissionType==2)
				{
					$lcommission = $package->PackageFee * $levelvalue[$i] / 100;
					

				}
				else
				{
					$lcommission =$levelvalue[$i];
					
				}
			
				

			if($mlsetting->RepeatCommissionStatus)
			{

					
						if($lcommission > 0 && $usermlmdetail->DirectId!=$userid && $userid!='0')
						{

							    // echo"<br>". $lcommission .'> 0 && '.$usermlmdetail->DirectId.'!='.$userid.' && '.$userid.'!='.'0';
							//check member active or not in matrix 
							$lcheckmatmem = $this->common_model->GetRow("MemberId='".$userid."' AND Status='1'",$mlsetting->TableName);
							 

							if($lcheckmatmem)
							$dresult = $this->levelcommission($userid,$lcommission,$g);
						}


				}
				
				else
				{
					
					if($lcommission > 0 && $userid!='0')
					{	
						
						//check member active or not in matrix 
						$lcheckmatmem = $this->common_model->GetRow("MemberId='".$userid."' AND Status='1'",$mlsetting->TableName);
						
						if($lcheckmatmem)
						$dresult = $this->levelcommission($userid,$lcommission,$g);
					
					}
				}
					
				//change SpilloverId 
				$memberdetail = $this->common_model->GetRow("".$field."='".$userid."'",$table);
				
				if($memberdetail)
				{
					$userid = $memberdetail->SpilloverId;
				}
				else
				{
					$userid='0';
				}
					
			}
		}
	 // exit;

		//check level complete commission status
		
		if($mlsetting->MatrixCommission==1 && $mlsetting->Id!=4 && $mlsetting->Id!=5 && $mlsetting->Id!=9)
		{	
			
			$lccount = $this->common_model->GetRowCount("SpilloverId='".$usermlmdetail->DirectId."'",$table);
			// echo "levelcount:".$lccount;
			// exit;
			if($mlsetting->MatrixWidth<=$lccount)
			{	
				//check member active or not in matrix 
				$lcheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."' AND Status='1'",$mlsetting->TableName);

				if($lcheckmatmem)
				{
					$historymatmem=$this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."' AND TypeId='4' AND Description='Level Completed Commission for package payment' AND Status='0'" ,'arm_history');
					
					if(!$historymatmem)
					{
						$this->matrixlevelcommission($usermlmdetail->DirectId,$package->LevelCompletedCommission);
					}
					

				}	

				
			}


		}
		

		//check matrix complete commission status

		if($mlsetting->MatrixCommission==2 && $mlsetting->Id!=4 && $mlsetting->Id!=5 && $mlsetting->Id!=9)
		{	
			
			$lccount = $this->common_model->GetRowCount("SpilloverId='".$usermlmdetail->DirectId."'",$table);
			if($mlsetting->MatrixWidth<=$lccount)
			{	
				$users =array($usermlmdetail->DirectId);
				$matrixstatus = $this->checkmatrix($users,1,$mlsetting->MatrixWidth,$mlsetting->ContentValue);
				
				if($matrixstatus)
				{
					//check member active or not in matrix 
					$lcheckmatmem = $this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."' AND Status='1'",$mlsetting->TableName);
					if($lcheckmatmem)

						$historymatmem=$this->common_model->GetRow("MemberId='".$usermlmdetail->DirectId."' AND TypeId='4' AND Description='Matrix Completed Commission for package payment' AND Status='0'" ,'arm_history');
					
					if(!$historymatmem)
					{
						$this->matrixlevelcommission($usermlmdetail->DirectId,$package->LevelCompletedCommission);
					}
						// $this->matrixcommission($usermlmdetail->DirectId,$package->MatrixCompletionCommission);
				}
			}

		}



	} //function


	public function checkmatrix($users,$status,$wcount,$level)
	{

		for($i=0;$i<$level;$i++)
		{
			$usids = implode(",", $users);
			//chkcount correct count
			if($i){ $chkcount = count($users) * $wcount; }else{$chkcount=$wcount;}

			$cmdetails = $this->common_model->GetResults("SpilloverId IN (".$usids.")",$table);
			//chkcount current members spillover count
			$mcount = count($cmdetails)-1;
			
			if($chkcount <=$mcount && $status==1)
			{
				for($ii=0;$ii<count($cmdetails);$ii++)
				{ 
					if(!in_array($cmdetails[$ii]->MemberId, $users))
					{
						array_push($users, $cmdetails[$ii]->MemberId);
					}
				}
			}
			else
			{
				$status=0;
			}
				
		}
		return $status;

	} //function

	
	// Member direct commission process here


	public function directcommission($userid,$commission,$memberid)

	{
		
	   $userbal = $this->common_model->Getcusomerbalance($userid);
	   $user=$this->common_model->GetRow("MemberId='".$memberid."'",'arm_members');

		$username=$user->UserName;
		$trnid = 'DCOM'.rand(1111111,9999999);
		$date = date('y-m-d h:i:s');
		$data = array(
			'MemberId'=>$userid,
			// 'depositid'=>$deposit,
			'Credit'=>$commission,
			'Balance'=>$userbal+$commission,
			'Description'=>"Direct Commission From ".$username." ",
			'TransactionId'=>$trnid,
			'TypeId'=>'4',
			'DateAdded'=>$date
		);
		
		$userdetails = $this->common_model->SaveRecords($data,'arm_history');

		if($userdetails)
		{
			$checkmembersbal=$this->common_model->Getcusomerbalance($userid);
			// echo $this->db->last_query();
			$memberbal=number_format($checkmembersbal);   
			 
			// echo $checkmembersbal;
			$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			$checkrank=$checkmatrix->RankStatus;
			
			if($checkrank==1)
			{
				$cond="balanceAmount='".$memberbal."' AND Status='1'";
				$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
				
				$balancerank=$checkbalrank->balanceAmount;
				
				$rank=$checkbalrank->Rank;
				if($balancerank!="")
				{
					 

					if($memberbal==$balancerank)
					{
						$user=$userid;
						$trnid = 'RAN'.rand(1111111,9999999);
						$date = date('y-m-d h:i:s');
						$data = array(
							'MemberId'=>$user,						
							'Balance'=>$checkmembersbal,
							'Description'=>"Prmoted to achieve for target balance".' '.$rank,
							'TransactionId'=>$trnid,
							'TypeId'=>'23',
							'DateAdded'=>$date
						);
					
						$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
							
					}
				}
			}
		}
		
		$message = "Direct Commission Earned ".$commission;
		$smsres = $this->sendbulksms($userid,$message);


	} //function
	
	// Member level commission process here

	public function levelcommission($userid,$commission,$lvl)
	{
		$userbal = $this->common_model->Getcusomerbalance($userid);
		$trnid = 'LCOM'.rand(1111111,9999999);
		$date = date('y-m-d h:i:s');
		$data = array(
			'MemberId'=>$userid,
			'Credit'=>$commission,
			'Balance'=>$userbal+$commission,
			'Description'=>'Level'.$lvl.' Commission for package payment',
			'TransactionId'=>$trnid,
			'TypeId'=>'4',
			'DateAdded'=>$date
		);
	
		$userdetails = $this->common_model->SaveRecords($data,'arm_history');


		if($userdetails)
		{
			$checkmembersbal=$this->common_model->Getcusomerbalance($userid);
			$memberbal=number_format($checkmembersbal);   

			$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			$checkrank=$checkmatrix->RankStatus;
			if($checkrank==1)
			{
				$cond="balanceAmount='".$memberbal."' AND Status='1'";
				$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
				$balancerank=$checkbalrank->balanceAmount;
				$rank=$checkbalrank->Rank;
				if($balancerank!="")
				{
					if($checkmembersbal==$balancerank)
					{
						$trnid = 'RAN'.rand(1111111,9999999);
						$date = date('y-m-d h:i:s');
						$data = array(
							'MemberId'=>$userid,						
							'Balance'=>$checkmembersbal,
							'Description'=>"Prmoted to achieve for target balance".' '.$rank,
							'TransactionId'=>$trnid,
							'TypeId'=>'23',
							'DateAdded'=>$date
						);
						
						$con="MemberId='".$userid."' and Balance='".$userbal."'";
						$checkrank=$this->common_model->GetRowCount($con,"arm_history");
						// if($checkrank==0)
						// {
							$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
							
						// }

					}
				}
			}
		}

		$message = "Level".$lvl." Commission Earned ".$commission;
		$smsres = $this->sendbulksms($userid,$message);

	} //function


	// Member level completed commission process here

	public function matrixlevelcommission($userid,$commission)
	{
		$userbal = $this->common_model->Getcusomerbalance($userid);
		$trnid = 'MLCOM'.rand(1111111,9999999);
		$date = date('y-m-d h:i:s');
		$data = array(
			'MemberId'=>$userid,
			'Credit'=>$commission,
			'Balance'=>$userbal+$commission,
			'Description'=>'Level completed Commission for package payment',
			'TransactionId'=>$trnid,
			'TypeId'=>'4',
			'DateAdded'=>$date
		);
	
		$userdetails = $this->common_model->SaveRecords($data,'arm_history');
		if($userdetails)
		{
			$checkmembersbal=$this->common_model->Getcusomerbalance($userid);
			$memberbal=number_format($checkmembersbal);   

			$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			$checkrank=$checkmatrix->RankStatus;
			if($checkrank==1)
			{
				$cond="balanceAmount='".$memberbal."' AND Status='1'";
				$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
				$balancerank=$checkbalrank->balanceAmount;
				$rank=$checkbalrank->Rank;
				if($balancerank!="")
				{
					if($checkmembersbal==$balancerank)
					{
						$trnid = 'RAN'.rand(1111111,9999999);
						$date = date('y-m-d h:i:s');
						$data = array(
							'MemberId'=>$userid,						
							'Balance'=>$checkmembersbal,
							'Description'=>"Prmoted to achieve for target balance".' '.$rank,
							'TransactionId'=>$trnid,
							'TypeId'=>'23',
							'DateAdded'=>$date
						);
						$con="MemberId='".$userid."' and Balance='".$userbal."'";
						$checkrank=$this->common_model->GetRowCount($con,"arm_history");
						// if($checkrank==0)
						// {
							$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
							
						// }
						
					
					}
				}
			}
		}

		$message = "Level completed Commission Earned ".$commission;
		$smsres = $this->sendbulksms($userid,$message);


	} //function


	// Member level completed commission process here

	public function matrixcommission($userid,$commission)
	{
		$userbal = $this->common_model->Getcusomerbalance($userid);
		$trnid = 'MCCOM'.rand(1111111,9999999);
		$date = date('y-m-d h:i:s');
		$data = array(
			'MemberId'=>$userid,
			'Credit'=>$commission,
			'Balance'=>$userbal+$commission,
			'Description'=>'matrix completed Commission for package payment',
			'TransactionId'=>$trnid,
			'TypeId'=>'4',
			'DateAdded'=>$date
		);
		// echo "<br>matrix Commission works for ".$userid;
		
		$userdetails = $this->common_model->SaveRecords($data,'arm_history');
		if($userdetails)
		{
			$checkmembersbal=$this->common_model->Getcusomerbalance($memberid);
			$memberbal=number_format($checkmembersbal);   

			$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			$checkrank=$checkmatrix->RankStatus;
			if($checkrank==1)
			{
				$cond="balanceAmount='".$memberbal."' AND Status='1'";
				$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
				$balancerank=$checkbalrank->balanceAmount;
				$rank=$checkbalrank->Rank;
				if($balancerank!="")
				{
					if($checkmembersbal==$balancerank)
					{
						$trnid = 'RAN'.rand(1111111,9999999);
						$date = date('y-m-d h:i:s');
						$data = array(
							'MemberId'=>$userid,						
							'Balance'=>$checkmembersbal,
							'Description'=>"Prmoted to achieve for target balance".' '.$rank,
							'TransactionId'=>$trnid,
							'TypeId'=>'23',
							'DateAdded'=>$date
						);
						
						$con="MemberId='".$userid."' and Balance='".$userbal."'";
						$checkrank=$this->common_model->GetRowCount($con,"arm_history");
						// if($checkrank==0)
						// {
							$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
							
						// }
					}
				}
			}
		}

		$message = "matrix completed Commission Earned ".$commission;
		$smsres = $this->sendbulksms($userid,$message);

	} //function

	// binary Pv 

	public function pointvalue($memberid,$table,$level,$amount)
	{
		
		$udetail = $this->common_model->GetRow("MemberId='".$memberid."'",$table);

		if(count($udetail) > 0)
		{
			$spilloverid = $udetail->SpilloverId;
			$sdetail = $this->common_model->GetRow("MemberId='".$spilloverid."'",$table);
			
			$leftid = $sdetail->LeftId;
			$rightid = $sdetail->RightId;			
			
			if($memberid == $leftid)
			{
				$supdate = $this->common_model->UpdateRecord("LeftPv=LeftPv+'".$amount."'","MemberId='".$spilloverid."'",$table);
			}
			else
			{
				$supdate = $this->common_model->UpdateRecord("RightPv=RightPv+'".$amount."'","MemberId='".$spilloverid."'",$table);
			}
			
			// commission details
			
			$desc  = 'PV Earnings for Level '.$level;
			$date = date('Y-m-d H:i:s');
			$txnid = 'PVE'.rand(100000,1000000);
			$userbal = $this->common_model->Getcusomerbalance($spilloverid);
			$data = array(
				'MemberId'=>$spilloverid,
				'TypeId'=>'4',
				'Credit'=>$amount,
				'Balance'=>$userbal+$amount,
				'Description'=>$desc,
				'TransactionId'=>$txnid,
				'DateAdded'=>$date
			);
			$pvresult = $this->common_model->SaveRecords($data,"arm_history");
			if($pvresult)
			{
				$checkmembersbal=$this->common_model->Getcusomerbalance($memberid);
				$memberbal=number_format($checkmembersbal);   

				$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
				$checkrank=$checkmatrix->RankStatus;
				if($checkrank==1)
				{
					$cond="balanceAmount='".$memberbal."' AND Status='1'";
					$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
					$balancerank=$checkbalrank->balanceAmount;
					$rank=$checkbalrank->Rank;
					if($balancerank!="")
					{
						if($checkmembersbal==$balancerank)
						{
							$trnid = 'RAN'.rand(1111111,9999999);
							$date = date('y-m-d h:i:s');
							$data = array(
								'MemberId'=>$userid,						
								'Balance'=>$checkmembersbal,
								'Description'=>"Prmoted to achieve for target balance".' '.$rank,
								'TransactionId'=>$trnid,
								'TypeId'=>'23',
								'DateAdded'=>$date
							);
							
							$con="MemberId='".$userid."' and Balance='".$userbal."'";
							$checkrank=$this->common_model->GetRowCount($con,"arm_history");
							// if($checkrank==0)
							// {
								$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
								
							// }
						}
					}
				}
			}

			$message = $desc." Earned ".$amount;
			$smsres = $this->sendbulksms($spilloverid,$message);

			if(!$spilloverid)
			{
				$level++;
				$this->pointvalue($spilloverid,$table,$level,$amount);
			}
		}
	}

	// level pv value depend for separate package
	public function pointvalue1($memberid,$table,$level,$binarypackage)
	{
		$pvlist = explode(",", $binarypackage->pv);
		
		foreach ($pvlist as $key => $value) {

			$amount = $value;
			$udetail = $this->common_model->GetRow("MemberId='".$memberid."'",$table);

			$spilloverid = $udetail->SpilloverId;
			$sdetail = $this->common_model->GetRow("MemberId='".$spilloverid."'",$table);
			if($sdetail)
			{
				$leftid = $sdetail->LeftId;
				$rightid = $sdetail->RightId;
			}
			
						
			
			if($memberid == $leftid)
			{
				$supdate = $this->common_model->UpdateRecord("LeftPv=LeftPv+'".$amount."'","MemberId='".$spilloverid."'",$table);
			}
			else
			{
				$supdate = $this->common_model->UpdateRecord("RightPv=RightPv+'".$amount."'","MemberId='".$spilloverid."'",$table);
			}
			
			// commission details
			$desc  = 'PV Earnings for Level '.$level;
			$date = date('Y-m-d H:i:s');
			$txnid = 'PVE'.rand(100000,1000000);
			$userbal = $this->common_model->Getcusomerbalance($spilloverid);
			$data = array(
				'MemberId' => $spilloverid,
				'TypeId' => '4',
				'Credit' => $amount,
				'Balance' => $userbal+$amount,
				'Description' => $desc,
				'TransactionId' => $txnid,
				'DateAdded' => $date
			);
			if($spilloverid!=0)
			{
				$pvresult = $this->common_model->SaveRecords($data,"arm_history");
				if($pvresult)
				{
					$checkmembersbal=$this->common_model->Getcusomerbalance($spilloverid);
					$memberbal=number_format($checkmembersbal);   

					$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
					$checkrank=$checkmatrix->RankStatus;
					if($checkrank==1)
					{
						$cond="balanceAmount='".$memberbal."' AND Status='1'";
						$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
						$balancerank=$checkbalrank->balanceAmount;
						$rank=$checkbalrank->Rank;
						if($balancerank!="")
						{
							if($checkmembersbal==$balancerank)
							{
								$trnid = 'RAN'.rand(1111111,9999999);
								$date = date('y-m-d h:i:s');
								$data = array(
									'MemberId'=>$spilloverid,						
									'Balance'=>$checkmembersbal,
									'Description'=>"Prmoted to achieve for target balance".' '.$rank,
									'TransactionId'=>$trnid,
									'TypeId'=>'23',
									'DateAdded'=>$date
								);
								
								$con="MemberId='".$spilloverid."' and Balance='".$checkmembersbal."'";
								$checkrank=$this->common_model->GetRowCount($con,"arm_history");
								// if($checkrank==0)
								// {
									$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
									
								// }
							}
						}
					}
				}

				$message = $desc." Earned ".$amount;
				$smsres = $this->sendbulksms($spilloverid,$message);
           }

			if($spilloverid!=0)
			{
				$level++;
				$memberid = $spilloverid;
			}
		}
		
	}


	// level pv value depend for separate package
	public function pointvaluehyip1($memberid,$table,$level,$binarypackage)
	{

		$pvlist = explode(",", $binarypackage->hyip);
	

			foreach ($pvlist as $key => $value) {

				$amount = $value;
				$udetail = $this->common_model->GetRow("MemberId='".$memberid."'",$table);

				$spilloverid = $udetail->SpilloverId;
				$sdetail = $this->common_model->GetRow("MemberId='".$spilloverid."'",$table);
				
				$leftid = $sdetail->LeftId;
				$rightid = $sdetail->RightId;			
				
				if($memberid == $leftid)
				{
					$supdate = $this->common_model->UpdateRecord("LeftPv=LeftPv+'".$amount."'","MemberId='".$spilloverid."'",$table);
				}
				else
				{
					$supdate = $this->common_model->UpdateRecord("RightPv=RightPv+'".$amount."'","MemberId='".$spilloverid."'",$table);
				}
				
				// commission details
				$desc  = 'PV Earnings for Level '.$level;
				$date = date('Y-m-d H:i:s');
				$txnid = 'PVE'.rand(100000,1000000);
				$userbal = $this->common_model->Getcusomerbalance($spilloverid);
				$data = array(
					'MemberId' => $spilloverid,
					// 'depositid'=>$deposit,
					'TypeId' => '4',

					'Credit' => $amount,
					'Balance' => $userbal+$amount,
					'Description' => $desc,
					'TransactionId' => $txnid,
					'DateAdded' => $date
				);
				$pvresult = $this->common_model->SaveRecords($data,"arm_history");
				if($pvresult)
				{
					$checkmembersbal=$this->common_model->Getcusomerbalance($memberid);
			        $memberbal=number_format($checkmembersbal);   

					$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
					$checkrank=$checkmatrix->RankStatus;
					if($checkrank==1)
					{
						$cond="balanceAmount='".$memberbal."' AND Status='1'";
						$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
						$balancerank=$checkbalrank->balanceAmount;
						$rank=$checkbalrank->Rank;
						if($balancerank!="")
						{
							if($checkmembersbal==$balancerank)
							{
								$trnid = 'RAN'.rand(1111111,9999999);
								$date = date('y-m-d h:i:s');
								$data = array(
									'MemberId'=>$userid,						
									'Balance'=>$checkmembersbal,
									'Description'=>"Prmoted to achieve for target balance".' '.$rank,
									'TransactionId'=>$trnid,
									'TypeId'=>'23',
									'DateAdded'=>$date
								);
								
								$con="MemberId='".$userid."' and Balance='".$userbal."'";
								$checkrank=$this->common_model->GetRowCount($con,"arm_history");
								// if($checkrank==0)
								// {
									$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
									
								// }
							}
						}
					}				
				}

				$message = $desc." Earned ".$amount;
				$smsres = $this->sendbulksms($spilloverid,$message);

				if(!$spilloverid)
				{
					$level++;
					$memberid = $spilloverid;
				}
			}
		
	
		
	}

	public function paircommission()
	{
		
		$mmset = $this->common_model->GetRow("Id='4' AND MatrixStatus='1'","arm_matrixsetting");
		$pair = explode(':',$mmset->MatchingPair);
		


		$pairdetails = $this->common_model->GetResults("leftdowncount>='".$pair[0]."'AND rightdowncount>='".$pair[1]."' ","arm_binarymatrix");
		
		if($pairdetails)
		{
			foreach ($pairdetails as $pairs) {
				
				$leftpv = $pairs->LeftPv;
				$rightpv = $pairs->RightPv;
				
				$userid = $pairs->MemberId;
				$mmdet = $this->common_model->GetRow("MemberId='".$pairs->MemberId."'","arm_members");
				$pcdet = $this->common_model->GetRow("PackageId='".$mmdet->PackageId."'","arm_pv");

				
				$hsp = $this->common_model->GetRowCount("TypeId='4' AND MemberId='".$pairs->MemberId."' AND Description like '%Pairing Commission%' AND DATE(DateAdded) = '".date('Y-m-d')."' ",'arm_history');
				
				if($hsp < $pcdet->DailyMaximumPairs)
				{
		

					$pvarray = array('left'=> $leftpv,'right'=> $rightpv);
					$minvalue = min($pvarray);
					$maxvalue = max($pvarray);
					$minarray = array_keys($pvarray,$minvalue, true);
					
					$maxarray = array_keys($pvarray,$maxvalue, true);

					$pair_count = $this->common_model->GetRowCount("TypeId='4' AND MemberId='".$pairs->MemberId."' AND Description like '%Pairing Commission%' ",'arm_history');
						
					if($pairs->leftdowncount < $pairs->rightdowncount) {
	                	// $count = $pairs->leftdowncount - $pairs->rightdowncount;
	                	$count1 = $pairs->leftdowncount;
	                } else {
	                	// $count = $pairs->rightdowncount - $pairs->leftdowncount;
	                	$count1 = $pairs->rightdowncount;
	                }
					
					
					if($minarray[0] == 'left')
					{
						$value=0;
						if($mmset->CarryForward==1)
						$value = $rightpv - $leftpv;
						
						if($pcdet->PairCommissionType == 1)
						{
							$commission =$pcdet->PairCommission;
						}
						else
						{
							$commission = $pcdet->PackageFee*($pcdet->PairCommission / 100);
						}
		                
						if($pair_count < $count1){
							
							$userbal = $this->common_model->Getcusomerbalance($pairs->MemberId);	
							$desc  = 'Pairing Commission';
							$date = date('Y-m-d H:i:s');
							$txnid = 'PVE'.rand(100000,1000000);
							$data = array(
								'MemberId'=>$pairs->MemberId,
								'TypeId'=>'4',
								'Credit'=>$commission,
								'Balance'=>$userbal+$commission,
								'Description'=>$desc,
								'TransactionId'=>$txnid,
								'DateAdded'=>$date
							);
							$pcresult = $this->common_model->SaveRecords($data,"arm_history");
							if($pcresult)
							{
								$checkmembersbal=$this->common_model->Getcusomerbalance($pairs->MemberId);
								$memberbal=number_format($checkmembersbal);   

								$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
								$checkrank=$checkmatrix->RankStatus;
								if($checkrank==1)
								{
									$cond="balanceAmount='".$memberbal."' AND Status='1'";
									$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
									$balancerank=$checkbalrank->balanceAmount;
									$rank=$checkbalrank->Rank;
									if($balancerank!="")
									{
										if($checkmembersbal==$balancerank)
										{
											$trnid = 'RAN'.rand(1111111,9999999);
											$date = date('y-m-d h:i:s');
											$data = array(
												'MemberId'=>$pairs->MemberId,						
												'Balance'=>$checkmembersbal,
												'Description'=>"Prmoted to achieve for target balance".' '.$rank,
												'TransactionId'=>$trnid,
												'TypeId'=>'23',
												'DateAdded'=>$date
											);
											
											$con="MemberId='".$pairs->MemberId."' and Balance='".$checkmembersbal."'";
											$checkrank=$this->common_model->GetRowCount($con,"arm_history");
											// if($checkrank==0)
											// {
												$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
												
											// }
										}
									}
								}
							}
							// echo $this->db->last_query();
						
							$message = $desc." Earned ".$commission;
							$smsres = $this->sendbulksms($userid,$message);
								
							if($pcresult)
							{
								$update = $this->common_model->UpdateRecord("RightPv = '".$value."' AND LeftPv = 0","MemberId = '".$pairs->MemberId."' ","arm_binarymatrix");
							}

							$userid = $pairs->MemberId;
						    $this->matchingbonus($userid,$commission,1);
						}
						
					}
					else
					{
						$value=0;
						if($mmset->CarryForward==1)
						$value = $leftpv - $rightpv;
						
						if($pcdet->PairCommissionType == 1)
						{
							$commission = $pcdet->PairCommission;
						}
						else
						{
							$commission = $pcdet->PackageFee*($pcdet->PairCommission / 100);
						}
		                
		                if($pair_count < $count1)
		                {
						
							$userbal = $this->common_model->Getcusomerbalance($pairs->MemberId);	
							$desc  = 'Pairing Commission';
							$date = date('Y-m-d H:i:s');
							$txnid = 'PVE'.rand(100000,1000000);
							$data = array(
								'MemberId'=>$pairs->MemberId,
								'TypeId'=>'4',
								'Credit'=>$commission,
								'Balance'=>$userbal+$commission,
								'Description'=>$desc,
								'TransactionId'=>$txnid,
								'DateAdded'=>$date
							);
							
							$pcresult = $this->common_model->SaveRecords($data,"arm_history");
							// $this->db->last_query();
								
							// 		 exit;
							if($pcresult)
							{
								$update = $this->common_model->UpdateRecord("LeftPv = '".$value."' AND  RightPv= 0","MemberId = '".$pairs->MemberId."' ","arm_binarymatrix");
								$checkmembersbal=$this->common_model->Getcusomerbalance($pairs->MemberId);
								$memberbal=number_format($checkmembersbal);   

								$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
								$checkrank=$checkmatrix->RankStatus;
								if($checkrank==1)
								{
									$cond="balanceAmount='".$memberbal."' AND Status='1'";
									$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
									$balancerank=$checkbalrank->balanceAmount;
									$rank=$checkbalrank->Rank;
									if($balancerank!="")
									{
										if($checkmembersbal==$balancerank)
										{
											$trnid = 'RAN'.rand(1111111,9999999);
											$date = date('y-m-d h:i:s');
											$data = array(
												'MemberId'=>$pairs->MemberId,						
												'Balance'=>$checkmembersbal,
												'Description'=>"Prmoted to achieve for target balance".' '.$rank,
												'TransactionId'=>$trnid,
												'TypeId'=>'23',
												'DateAdded'=>$date
											);
											
											$con="MemberId='".$pairs->MemberId."' and Balance='".$checkmembersbal."'";
											$checkrank=$this->common_model->GetRowCount($con,"arm_history");
											// if($checkrank==0)
											// {
												$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
												
											// }
										}
									}
								}
							}

							$userid = $pairs->MemberId;
				    		$this->matchingbonus($userid,$commission,1);
						
						}

					}

				}
            }
			

		}
	}



	public function paircommissionhyip()
	{

		
		$mmset = $this->common_model->GetRow("Id='9' AND MatrixStatus='1'","arm_matrixsetting");
		
		$pair = explode(':',$mmset->MatchingPair);
		// $pairdetails = $this->common_model->GetResults("LeftPairCount='".$pair[0]."'AND RightPairCount='".$pair[1]."' ","arm_binaryhyip");

		 $pairdetails = $this->common_model->GetResults("leftdowncount>='".$pair[0]."'AND rightdowncount>='".$pair[1]."' ","arm_binaryhyip");
		
		// $userdeposit = $this->common_model->GetRow("MemberId='".$pairs->MemberId."'","deposit");
		// $deposit=$userdeposit->id;

		
		
		if($pairdetails)
		{
			foreach ($pairdetails as $pairs) {
				
					$leftpv = $pairs->LeftPv;
					
					$rightpv = $pairs->RightPv;
				
					$userid = $pairs->MemberId;
				
					$mmdet = $this->common_model->GetRow("MemberId='".$pairs->MemberId."'","arm_members");
					
					$pcdet = $this->common_model->GetRow("PackageId='".$mmdet->PackageId."'","arm_hyip");

				 if($pcdet->PairCommissionType==2)
				 	{
				 		
							//user give the amount 
				 
							 $depositleftid=$pairs->LeftCarryForward;
						
						if($pairs->RightId)  
						   {
							 	 
							 	 $depositrightid=$pairs->RightCarryForward;
						   }
							
							 $amountuser1=$this->common_model->GetRow("LeftId='". $depositleftid."'","arm_binaryhyip");
						 if($amountuser1!="")
							{

							 $amount1=$amountuser1->LeftCarryForward;
							}
							 else
							 {

							$amount1=$pairs->LeftCarryForward;
						  		}

							
							 $amountuser2=$this->common_model->GetRow("RightId='".$depositrightid."'","arm_binaryhyip");
							 if($amountuser2!="")
							 {
							  $amount2=$amountuser2->RightCarryForward;
							 }
							 else
							 {
							 	$amount2=$pairs->RightCarryForward;
							 }
	
							
							 if($amount1>$amount2)
							 {
							 	
							 	$totalamount=$amount1-$amount2;

							 	$leftcarryforward=$totalamount;
							 	// echo $leftcarryforward;
							 	$pairamount=$amount2;
							 	// echo $totalamount;
							 }
							 elseif($amount2>$amount1)
							 {
							 
							 	$totalamount=$amount2-$amount1;
							 	$rightcarryforward=$totalamount;
							 	
							 	$pairamount=$amount1;
							 }
							 else
							 {
							 	
							 	$totalamount=$amount1;
							 	$leftcarryforward=0;
							 	$rightcarryforward=0;
							 	$pairamount=$amount1;
							 }							
							
							$hsp = $this->common_model->GetRowCount("TypeId='4' AND MemberId='".$pairs->MemberId."' AND Description like '%Pairing Commission%' AND DATE(DateAdded) = '".date('Y-m-d')."' ",'arm_history');
						
							
							if($hsp < $pcdet->DailyMaximumPairs)
							{
							
								
								$pvarray = array('left'=> $leftpv,'right'=> $rightpv);
								
							
								$minvalue = min($pvarray);
								
								$maxvalue = max($pvarray);
							
								$minarray = array_keys($pvarray,$minvalue, true);
								
								
								$maxarray = array_keys($pvarray,$maxvalue, true);
							

								$pair_count = $this->common_model->GetRowCount("TypeId='4' AND MemberId='".$pairs->MemberId."' AND Description like '%Pairing Commission%' ",'arm_history');
							
									
								if($pairs->leftdowncount < $pairs->rightdowncount) {
				                	// $count = $pairs->leftdowncount - $pairs->rightdowncount;
				                	  $count1 = $pairs->leftdowncount;
				                	 // $count1=$pairs->LeftPairCount;
				                	
				                } else {
				                	// $count = $pairs->rightdowncount - $pairs->leftdowncount;
				                	  $count1 = $pairs->rightdowncount;
				                	  // $count1=$pairs->RightPairCount;
				                	
				                }
								
								
								if($minarray[0] == 'left')
								{
									
									$value=0;
									if($mmset->CarryForward==1)
									$value = $rightpv - $leftpv;

									
									if($pcdet->PairCommissionType == 1)
									{
										$commission =$pcdet->PairCommission;
										
									}
									else
									{

										$commission =  $pairamount*($pcdet->PairCommission / 100);
										
									}
					                
									// if($pair_count < $count1){
										
											$userbal = $this->common_model->Getcusomerbalance($pairs->MemberId);	
										// $username=$this->common_model->GetRow("MemberId='".$pairs->MemberId."'","arm_members");
										// $name=$username->UserName;
										$desc  = "Pairing Commission";
										if($commission!=0)
										{
										$date = date('Y-m-d H:i:s');
										$txnid = 'PVE'.rand(100000,1000000);
										$data = array(
											'MemberId'=>$pairs->MemberId,
											// 'depositid'=>$deposit,
											'TypeId'=>'4',
											'Credit'=>$commission,
											'Balance'=>$userbal+$commission,
											'Description'=>$desc,
											'TransactionId'=>$txnid,
											'DateAdded'=>$date
										);
										$pcresult = $this->common_model->SaveRecords($data,"arm_history");
									
										
										
								
										
										// $update1=$this->db->query("UPDATE `arm_binaryhyip` set LeftCarryForward='0' , RightCarryForward=".$rightcarryforward." WHERE MemberId='".$pairs->MemberId."'");

										if($amount1>$amount2)
										{
											$update1=$this->db->query("UPDATE `arm_binaryhyip` set LeftCarryForward='".$leftcarryforward."' , RightCarryForward=0 WHERE MemberId='".$pairs->MemberId."'");
										}
										else
										{
											$update1=$this->db->query("UPDATE `arm_binaryhyip` set LeftCarryForward='0' , RightCarryForward=".$rightcarryforward." WHERE MemberId='".$pairs->MemberId."'");
										}


										// $update1 = $this->common_model->UpdateRecord("LeftCarryForward =0 ,RightCarryForward = '".$rightcarryforward."'","MemberId = '".$pairs->MemberId."'","arm_binaryhyip");
											
										$message = $desc." Earned ".$commission;
										$smsres = $this->sendbulksms($userid,$message);
											
										if($pcresult)
										{
											$update = $this->common_model->UpdateRecord("RightPv = '".$value."' AND LeftPv = 0","MemberId = '".$pairs->MemberId."' ","arm_binaryhyip");
											$checkmembersbal=$this->common_model->Getcusomerbalance($pairs->MemberId);
											$memberbal=number_format($checkmembersbal);   

											$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											$checkrank=$checkmatrix->RankStatus;
											if($checkrank==1)
											{
												$cond="balanceAmount='".$memberbal."' AND Status='1'";
												$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
												$balancerank=$checkbalrank->balanceAmount;
												$rank=$checkbalrank->Rank;
												if($balancerank!="")
												{
													if($checkmembersbal==$balancerank)
													{
														$trnid = 'RAN'.rand(1111111,9999999);
														$date = date('y-m-d h:i:s');
														$data = array(
															'MemberId'=>$pairs->MemberId,						
															'Balance'=>$checkmembersbal,
															'Description'=>"Prmoted for achieve to target balance".' '.$rank,
															'TransactionId'=>$trnid,
															'TypeId'=>'23',
															'DateAdded'=>$date
														);
														
														$con="MemberId='".$pairs->MemberId."' and Balance='".$checkmembersbal."'";
														$checkrank=$this->common_model->GetRowCount($con,"arm_history");
														// if($checkrank==0)
														// {
															$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
															
														// }
													}
												}
											}										
												
										}

				                    }
										
										if($commission!=0)
										{
										$userid = $pairs->MemberId;
									    $this->matchingbonushyip($userid,$commission,1);

										}
							// }
							
					}
					else
					{
							
							$value=0;
							if($mmset->CarryForward==1)
							$value = $leftpv - $rightpv;

							
							if($pcdet->PairCommissionType == 1)
							{
								$commission = $pcdet->PairCommission;
								
								
							}
							else
							{
								$commission =  $pairamount*($pcdet->PairCommission / 100);
							
								
							
							}
			                
			                // if($pair_count < $count1)
			                // {
								
								$userbal = $this->common_model->Getcusomerbalance($pairs->MemberId);	
								// $username=$this->common_model->GetRow("MemberId='".$pairs->MemberId."'","arm_members");
								// $name=$username->UserName;
								if($commission!=0)
								{
									$desc  = "Pairing Commission";
								$date = date('Y-m-d H:i:s');
								$txnid = 'PVE'.rand(100000,1000000);
								$data = array(
									'MemberId'=>$pairs->MemberId,
									// 'depositid'=>$deposit,
									'TypeId'=>'4',
									'Credit'=>$commission,
									'Balance'=>$userbal+$commission,
									'Description'=>$desc,
									'TransactionId'=>$txnid,
									'DateAdded'=>$date
								);
								
								$pcresult = $this->common_model->SaveRecords($data,"arm_history");
								
								
								 if($amount1>$amount2)
								{
									$update1=$this->db->query("UPDATE `arm_binaryhyip` set LeftCarryForward='".$leftcarryforward."' , RightCarryForward=0 WHERE MemberId='".$pairs->MemberId."'");
								}
								else
								{
									$update1=$this->db->query("UPDATE `arm_binaryhyip` set LeftCarryForward='0' , RightCarryForward=".$rightcarryforward." WHERE MemberId='".$pairs->MemberId."'");
								}
								 // $update1=$this->db->query("UPDATE `arm_binaryhyip` set RightCarryForward='0' , LeftCarryForward=".$leftcarryforward." WHERE MemberId='".$pairs->MemberId."'");
								 	// $update1 = $this->common_model->UpdateRecord("LeftCarryForward = '".$leftcarryforward."', RightCarryForward = 0","MemberId ='".$pairs->MemberId."'","arm_binaryhyip");
									
										
								if($pcresult)
								{
									$update = $this->common_model->UpdateRecord("LeftPv = '".$value."' AND  RightPv= 0","MemberId = '".$pairs->MemberId."' ","arm_binaryhyip");
									$checkmembersbal=$this->common_model->Getcusomerbalance($pairs->MemberId);
								    $memberbal=number_format($checkmembersbal);   

									$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
									$checkrank=$checkmatrix->RankStatus;
									if($checkrank==1)
									{
										$cond="balanceAmount='".$memberbal."' AND Status='1'";
										$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
										$balancerank=$checkbalrank->balanceAmount;
										$rank=$checkbalrank->Rank;
										if($balancerank!="")
										{
											if($checkmembersbal==$balancerank)
											{
												$trnid = 'RAN'.rand(1111111,9999999);
												$date = date('y-m-d h:i:s');
												$data = array(
													'MemberId'=>$pairs->MemberId,						
													'Balance'=>$checkmembersbal,
													'Description'=>"Prmoted for achieve to target balance".' '.$rank,
													'TransactionId'=>$trnid,
													'TypeId'=>'23',
													'DateAdded'=>$date
												);
												
												$con="MemberId='".$pairs->MemberId."' and Balance='".$checkmembersbal."'";
												$checkrank=$this->common_model->GetRowCount($con,"arm_history");
												// if($checkrank==0)
												// {
													$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
													
												// }
											}
										}
									}
								
								
								}
								}
								
								if($commission!=0)
								{
									$userid = $pairs->MemberId;
					    		$this->matchingbonushyip($userid,$commission,1);
								}
							
								
							
							// }

					}

				}
				  
			}
				
				else
				{
						//user give the amount 

				 $depositleftid=$pairs->LeftCarryForward;
			
				 if($pairs->RightId)
				 {
				 	 $depositrightid=$pairs->RightCarryForward;
				 }
			
				
				
			
				 $amountuser1=$this->common_model->GetRow("LeftId='". $depositleftid."'","arm_binaryhyip");
				 if($amountuser1!="")
				 {

				 $amount1=$amountuser1->LeftCarryForward;
				 }
				 else
				 {
				 	$amount1=$pairs->LeftCarryForward;
				 }

				
				 $amountuser2=$this->common_model->GetRow("RightId='".$depositrightid."'","arm_binaryhyip");
				 if($amountuser2!="")
				 {
				  $amount2=$amountuser2->RightCarryForward;
				 }
				 else
				 {
				 	$amount2=$pairs->RightCarryForward;
				 }
		
			

			

				
				 if($amount1>$amount2)
				 {
				 	
				 	$totalamount=$amount1-$amount2;

				 	$leftcarryforward=$totalamount;
				 	// echo $leftcarryforward;
				 	$pairamount=$amount2;
				 	// echo $totalamount;
				 }
				 elseif($amount2>$amount1)
				 {
				 
				 	$totalamount=$amount2-$amount1;
				 	$rightcarryforward=$totalamount;
				 	
				 	$pairamount=$amount1;
				 }
				 else
				 {
				 	
				 	$totalamount=$amount1;
				 	$leftcarryforward=0;
				 	$rightcarryforward=0;
				 	$pairamount=$amount1;
				 }

				
				$hsp = $this->common_model->GetRowCount("TypeId='4' AND MemberId='".$pairs->MemberId."' AND Description like '%Pairing Commission%' AND DATE(DateAdded) = '".date('Y-m-d')."' ",'arm_history');
				
				if($hsp < $pcdet->DailyMaximumPairs)
				{
		

					$pvarray = array('left'=> $leftpv,'right'=> $rightpv);
					$minvalue = min($pvarray);
					$maxvalue = max($pvarray);
					$minarray = array_keys($pvarray,$minvalue, true);
					
					$maxarray = array_keys($pvarray,$maxvalue, true);

					$pair_count = $this->common_model->GetRowCount("TypeId='4' AND MemberId='".$pairs->MemberId."' AND Description like '%Pairing Commission%' ",'arm_history');
						
					if($pairs->leftdowncount < $pairs->rightdowncount) {
	                	// $count = $pairs->leftdowncount - $pairs->rightdowncount;
	                	$count1 = $pairs->LeftPairCount;
	                } else {
	                	// $count = $pairs->rightdowncount - $pairs->leftdowncount;
	                	$count1 = $pairs->RightPairCount;
	                }
					
					
					if($minarray[0] == 'left')
					{
						$value=0;
						if($mmset->CarryForward==1)
						$value = $rightpv - $leftpv;
						
						if($pcdet->PairCommissionType == 1)
						{
							$commission =$pcdet->PairCommission;
							
						}
						else
						{

							$commission =  $pairamount*($pcdet->PairCommission / 100);
							
						}
		                
					// 	if($pair_count < $count1)
					// {
							
							$userbal = $this->common_model->Getcusomerbalance($pairs->MemberId);
							// $username=$this->common_model->GetRow("MemberId='".$pairs->MemberId."'","arm_members");
							// $name=$username->UserName;	
							if($commission!=0)
							{
								$desc  = "Pairing Commission";
							$date = date('Y-m-d H:i:s');
							$txnid = 'PVE'.rand(100000,1000000);
							$data = array(
								'MemberId'=>$pairs->MemberId,
								// 'depositid'=>$deposit,
								'TypeId'=>'4',
								'Credit'=>$commission,
								'Balance'=>$userbal+$commission,
								'Description'=>$desc,
								'TransactionId'=>$txnid,
								'DateAdded'=>$date
							);
							$pcresult = $this->common_model->SaveRecords($data,"arm_history");
						
							// $update1 = $this->common_model->UpdateRecord("RightCarryForward = '".$totalamount."' AND LeftCarryForward = 0","MemberId = '".$pairs->MemberId."' ","arm_binaryhyip");
							if($amount1>$amount2)
							{
								$update1=$this->db->query("UPDATE `arm_binaryhyip` set LeftCarryForward='".$leftcarryforward."' , RightCarryForward=0 WHERE MemberId='".$pairs->MemberId."'");
							}
							else
							{
								$update1=$this->db->query("UPDATE `arm_binaryhyip` set LeftCarryForward='0' , RightCarryForward=".$rightcarryforward." WHERE MemberId='".$pairs->MemberId."'");
							}	// 	if($pair_count < $count1)
					// {
						
							
						

							$message = $desc." Earned ".$commission;
							$smsres = $this->sendbulksms($userid,$message);
								
							if($pcresult)
							{
								$update = $this->common_model->UpdateRecord("RightPv = '".$value."' AND LeftPv = 0","MemberId = '".$pairs->MemberId."' ","arm_binaryhyip");
								$checkmembersbal=$this->common_model->Getcusomerbalance($pairs->MemberId);
								$memberbal=number_format($checkmembersbal);   

								$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
								$checkrank=$checkmatrix->RankStatus;
								if($checkrank==1)
								{
									$cond="balanceAmount='".$memberbal."' AND Status='1'";
									$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
									$balancerank=$checkbalrank->balanceAmount;
									$rank=$checkbalrank->Rank;
									if($balancerank!="")
									{
										if($checkmembersbal==$balancerank)
										{
											$trnid = 'RAN'.rand(1111111,9999999);
											$date = date('y-m-d h:i:s');
											$data = array(
												'MemberId'=>$pairs->MemberId,						
												'Balance'=>$checkmembersbal,
												'Description'=>"Prmoted For achieve to target balance".' '.$rank,
												'TransactionId'=>$trnid,
												'TypeId'=>'23',
												'DateAdded'=>$date
											);
											
											$con="MemberId='".$pairs->MemberId."' and Balance='".$checkmembersbal."'";
											$checkrank=$this->common_model->GetRowCount($con,"arm_history");
											// if($checkrank==0)
											// {
												$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
												
											// }
										}
									}
								}
								
							}
						}
							if($commission!=0)
							{
								$userid = $pairs->MemberId;
						    $this->matchingbonushyip($userid,$commission,1);
							}

						// }	
						
						
					}
					else
					{
						$value=0;
						if($mmset->CarryForward==1)
						$value = $leftpv - $rightpv;
						
						if($pcdet->PairCommissionType == 1)
						{
							$commission = $pcdet->PairCommission;
							
						}
						else
						{
							$commission =  $pairamount*($pcdet->PairCommission / 100);
						
						}
		                
		                // if($pair_count < $count1)
		                // {
						
							$userbal = $this->common_model->Getcusomerbalance($pairs->MemberId);	
							// $username=$this->common_model->GetRow("MemberId='".$pairs->MemberId."'","arm_members");
							// $name=$username->UserName;	
							if($commission!=0)
							{
								$desc  = "Pairing Commission";
							$date = date('Y-m-d H:i:s');
							$txnid = 'PVE'.rand(100000,1000000);
							$data = array(
								'MemberId'=>$pairs->MemberId,
								// 'depositid'=>$deposit,
								'TypeId'=>'4',
								'Credit'=>$commission,
								'Balance'=>$userbal+$commission,
								'Description'=>$desc,
								'TransactionId'=>$txnid,
								'DateAdded'=>$date
							);
							
							$pcresult = $this->common_model->SaveRecords($data,"arm_history");
							
							
							 // $this->db->last_query();
							 // $update1 = $this->common_model->UpdateRecord("LeftCarryForward = '".$totalamount."' AND  RightCarryForward= 0","MemberId = '".$pairs->MemberId."' ","arm_binaryhyip");
							 if($amount1>$amount2)
							{
								$update1=$this->db->query("UPDATE `arm_binaryhyip` set LeftCarryForward='".$leftcarryforward."' , RightCarryForward=0 WHERE MemberId='".$pairs->MemberId."'");
							}
							else
							{
								$update1=$this->db->query("UPDATE `arm_binaryhyip` set LeftCarryForward='0' , RightCarryForward=".$rightcarryforward." WHERE MemberId='".$pairs->MemberId."'");
							}
								 // $update1=$this->db->query("UPDATE `arm_binaryhyip` set RightCarryForward='0' , LeftCarryForward=".$leftcarryforward." WHERE MemberId='".$pairs->MemberId."'");
									
							if($pcresult)
							{
								$update = $this->common_model->UpdateRecord("LeftPv = '".$value."' AND  RightPv= 0","MemberId = '".$pairs->MemberId."' ","arm_binaryhyip");
								$checkmembersbal=$this->common_model->Getcusomerbalance($pairs->MemberId);
								$memberbal=number_format($checkmembersbal);   

								$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
								$checkrank=$checkmatrix->RankStatus;
								if($checkrank==1)
								{
									$cond="balanceAmount='".$memberbal."' AND Status='1'";
									$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
									$balancerank=$checkbalrank->balanceAmount;
									$rank=$checkbalrank->Rank;
									if($balancerank!="")
									{
										if($checkmembersbal==$balancerank)
										{
											$trnid = 'RAN'.rand(1111111,9999999);
											$date = date('y-m-d h:i:s');
											$data = array(
												'MemberId'=>$pairs->MemberId,						
												'Balance'=>$checkmembersbal,
												'Description'=>"Prmoted for achieve to target balance".' '.$rank,
												'TransactionId'=>$trnid,
												'TypeId'=>'23',
												'DateAdded'=>$date
											);
											
											$con="MemberId='".$pairs->MemberId."' and Balance='".$checkmembersbal."'";
											$checkrank=$this->common_model->GetRowCount($con,"arm_history");
											// if($checkrank==0)
											// {
												$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
												
											// }
										}
									}
								}
													
							}
						}
							if($commission!=0)
							{
								$userid = $pairs->MemberId;
				    		$this->matchingbonushyip($userid,$commission,1);
							}

							
						
						// }

					}

				}

				}
            }
			

		}
		
	}


	public function leftcount1($MemberId,$array,$total)
	{
		
		$leftid=$this->common_model->GetRow("MemberId='".$MemberId."'","arm_binaryhyip");
		if($leftid!="")
		{
			$leftcountids=array($leftid->LeftId);
		
		array_push($array,$leftid->LeftId);
		foreach ($leftcountids as $downid) {
			
			$this->db->where('SpilloverId', $downid);
			$spil_qry = $this->db->get("arm_binaryhyip");
			// echo $this->db->last_query();
			// echo "<br>";
			foreach ($spil_qry->result() as $spil) {
				array_push($array,$spil->MemberId);

			}
			
		}
		
	
		$ar=array_unique($array);
		// pr($ar);
		$leftids=implode(",",$ar);
		// echo $leftids;

		foreach ($ar as $key) {
			 // pr($key);
			if($key!=0)
			{
		$query = $this->db->query("SELECT * FROM arm_binaryhyip WHERE MemberId =".$key."");
		// echo $this->db->last_query();
		// echo "<br>";		
		$leftid = $query->row()->LeftId;
			}
	
		// echo $leftid;

		if($leftid!=0)
		{
			$amount=$this->common_model->GetRow("MemberId='".$leftid."'","arm_binaryhyip");
		 // echo $this->db->last_query();
		if($amount->LeftCarryForward)
	    {
	    	
	    $total+=$amount->LeftCarryForward;
	
	    }
		

		}

		}
		
	
	    return $total;

		}
	
		
		
	}

	public function leftcount($MemberId)
	{
		$array = array($MemberId);
		 $total="";
		// print_r($array);
		$totalleftamount=$this->leftcount1($MemberId,$array,$total);
	
				return $totalleftamount;

	
		

		
	}

	public function test($MemberId)
	{
		return $MemberId;
		 
	
	}

	public function rightcount1($MemberId,$array,$total)
	{
		
		$rightid=$this->common_model->GetRow("MemberId='".$MemberId."'","arm_binaryhyip");
		if($rightid!="")
		{
				$rightcountids=array($rightid->RightId);
		
		array_push($array,$rightid->RightId);
		foreach ($rightcountids as $downid) {
			
			$this->db->where('SpilloverId', $downid);
			$spil_qry = $this->db->get("arm_binaryhyip");
			// echo $this->db->last_query();
			// echo "<br>";
			foreach ($spil_qry->result() as $spil) {
				array_push($array,$spil->MemberId);

			}
			
		}
		
	
		$ar=array_unique($array);
		 // pr($ar);
		$rightids=implode(",",$ar);
		// echo $leftids;
		foreach ($ar as $key) {
			 // pr($key);
			if($key!=0)
			{
				$query = $this->db->query("SELECT * FROM arm_binaryhyip WHERE MemberId =".$key."");
		// echo $this->db->last_query();
		// echo "<br>";
				
		$rightid = $query->row()->RightId;
			}
		
		// echo $leftid;

		if($rightid!=0)
		{
			$amount=$this->common_model->GetRowdeposit("MemberId='".$rightid."'","arm_binaryhyip");
		  // echo $this->db->last_query();
		if($amount->RightCarryForward)
	    {
	    	
	    $total+=$amount->RightCarryForward;
	
	    }
		

		}

		}
		
	
	    return $total;

		}
	
	
		
	}

	public function rightcount($MemberId)
	{
		$array = array($MemberId);
		 $total="";
		// print_r($array);
		$totalrightamount=$this->rightcount1($MemberId,$array,$total);
			return $totalrightamount;
	
	

		
	}

	


		public function matchingbonushyip($userid,$commission,$level)
		{

		$mmdet = $this->common_model->GetRow("MemberId='".$userid."'","arm_members");
		// $pcdet = $this->common_model->GetRow("PackageId='".$mmdet->PackageId."'","arm_pv");
		// $userdeposit = $this->common_model->GetRow("MemberId='".$userid."'","deposit");
		// $deposit=$userdeposit->id;
		$this->db->where('PackageId',$mmdet->PackageId);
		$this->db->select('MatchingBonus as bonus');
		$query1 = $this->db->get('arm_hyip');
		$dataval = $query1->row();
		// $edd = mysql_escape_string();

		// $bonus_match = str_replace(',', '/', $dataval->bonus);
		if($dataval)
		{
			$mbonus = explode(",",$dataval->bonus);
			$spdet = $this->common_model->GetRow("MemberId='".$userid."'","arm_binaryhyip");

			if(count($spdet) > 0)
			{
				$spilloverid = $spdet->SpilloverId;
				
				if($spilloverid)
				{
					$j= $level-1;
				
	                if(count($mbonus) > 1)
	                {
						$amount = $commission * $mbonus[$j] / 100;
						$userbal = $this->common_model->Getcusomerbalance($spilloverid);

						$desc  = 'Matching Bonus Earnings for level '.$level;
						$date = date('Y-m-d H:i:s');
						$txnid = 'MBE'.rand(100000,1000000);
						$data = array(
							'MemberId'=>$spilloverid,
							// 'depositid'=>$deposit,
							'TypeId'=>'4',
							'Credit'=>$amount,
							'Balance'=>$userbal+$amount,
							'Description'=>$desc,
							'TransactionId'=>$txnid,
							'DateAdded'=>$date
						);
						$pcresult = $this->common_model->SaveRecords($data,"arm_history");
						if($pcresult)
						{
							$checkmembersbal=$this->common_model->Getcusomerbalance($spilloverid);
							$memberbal=number_format($checkmembersbal);   

							$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
							$checkrank=$checkmatrix->RankStatus;
							if($checkrank==1)
							{
								$cond="balanceAmount='".$memberbal."' AND Status='1'";
								$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
								$balancerank=$checkbalrank->balanceAmount;
								$rank=$checkbalrank->Rank;
								if($balancerank!="")
								{
									if($checkmembersbal==$balancerank)
									{
										$trnid = 'RAN'.rand(1111111,9999999);
										$date = date('y-m-d h:i:s');
										$data = array(
											'MemberId'=>$spilloverid,						
											'Balance'=>$checkmembersbal,
											'Description'=>"Prmoted To achieve For target account balance".' '.$rank,
											'TransactionId'=>$trnid,
											'TypeId'=>'23',
											'DateAdded'=>$date
										);
										
										$con="MemberId='".$spilloverid."' and Balance='".$checkmembersbal."'";
										$checkrank=$this->common_model->GetRowCount($con,"arm_history");
										// if($checkrank==0)
										// {
											$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
											
										// }
									}
								}
							}
						}

						// send sms 
						$message = "Matching Bonus for level".$level." Earned ".$commission;
						$smsres = $this->sendbulksms($spilloverid,$message);

						$level++;
						$this->matchingbonushyip($spilloverid,$commission,$level);
					}
					else
					{

						$amount = $commission * $mbonus[0] / 100;
						$userbal = $this->common_model->Getcusomerbalance($spilloverid);

						$desc  = 'Matching Bonus Earnings for level '.$level;
						$date = date('Y-m-d H:i:s');
						$txnid = 'MBE'.rand(100000,1000000);
						$data = array(
							'MemberId'=>$spilloverid,
							'TypeId'=>'4',
							'Credit'=>$amount,
							'Balance'=>$userbal+$amount,
							'Description'=>$desc,
							'TransactionId'=>$txnid,
							'DateAdded'=>$date
						);

						$pcresult = $this->common_model->SaveRecords($data,"arm_history");
						if($pcresult)
						{
							$checkmembersbal=$this->common_model->Getcusomerbalance($spilloverid);
							$memberbal=number_format($checkmembersbal);   


							$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
							$checkrank=$checkmatrix->RankStatus;
							if($checkrank==1)
							{
								$cond="balanceAmount='".$memberbal."' AND Status='1'";
								$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
								$balancerank=$checkbalrank->balanceAmount;
								$rank=$checkbalrank->Rank;
								if($balancerank!="")
								{
									if($checkmembersbal==$balancerank)
									{
										$trnid = 'RAN'.rand(1111111,9999999);
										$date = date('y-m-d h:i:s');
										$data = array(
											'MemberId'=>$spilloverid,						
											'Balance'=>$checkmembersbal,
											'Description'=>"Prmoted".' '.$rank,
											'TransactionId'=>$trnid,
											'TypeId'=>'23',
											'DateAdded'=>$date
										);
										
										$con="MemberId='".$spilloverid."' and Balance='".$checkmembersbal."'";
										$checkrank=$this->common_model->GetRowCount($con,"arm_history");
										// if($checkrank==0)
										// {
											$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
											// echo $this->db->last_query();
											
										// }
									}
								}
							}
						}
						// send sms 
						$message = "Matching Bonus for level".$level." Earned ".$commission;
						$smsres = $this->sendbulksms($spilloverid,$message);

						$level++;
					
						$this->matchingbonushyip($spilloverid,$commission,$level);

					}
			
				}
				
			}

		}
		
	}

	// from paircommission base matching bonus by level 

	public function matchingbonus($userid,$commission,$level)
	{

		$mmdet = $this->common_model->GetRow("MemberId='".$userid."'","arm_members");

		// $pcdet = $this->common_model->GetRow("PackageId='".$mmdet->PackageId."'","arm_pv");
		$this->db->where('PackageId',$mmdet->PackageId);
		$this->db->select('MatchingBonus as bonus');
		$query1 = $this->db->get('arm_pv');
		$dataval = $query1->row();
		// $edd = mysql_escape_string();

		// $bonus_match = str_replace(',', '/', $dataval->bonus);
		if($dataval)
		{
			$mbonus = explode(",",$dataval->bonus);
			$spdet = $this->common_model->GetRow("MemberId='".$userid."'","arm_binarymatrix");

			if(count($spdet) > 0)
			{
				$spilloverid = $spdet->SpilloverId;
				
				if($spilloverid)
				{
					$j= $level-1;
				
	                if(count($mbonus) > 1)
	                {
						$amount = $commission * $mbonus[$j] / 100;
						$userbal = $this->common_model->Getcusomerbalance($spilloverid);

						$desc  = 'Matching Bonus Earnings for level '.$level;
						$date = date('Y-m-d H:i:s');
						$txnid = 'MBE'.rand(100000,1000000);
						$data = array(
							'MemberId'=>$spilloverid,
							'TypeId'=>'4',
							'Credit'=>$amount,
							'Balance'=>$userbal+$amount,
							'Description'=>$desc,
							'TransactionId'=>$txnid,
							'DateAdded'=>$date
						);
						$pcresult = $this->common_model->SaveRecords($data,"arm_history");
						if($pcresult)
						{
							$checkmembersbal=$this->common_model->Getcusomerbalance($spilloverid);
							$memberbal=number_format($checkmembersbal);   

							$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
							$checkrank=$checkmatrix->RankStatus;
							if($checkrank==1)
							{
								$cond="balanceAmount='".$memberbal."' AND Status='1'";
								$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
								$balancerank=$checkbalrank->balanceAmount;
								$rank=$checkbalrank->Rank;
								if($balancerank!="")
								{
									if($checkmembersbal==$balancerank)
									{
										$trnid = 'RAN'.rand(1111111,9999999);
										$date = date('y-m-d h:i:s');
										$data = array(
											'MemberId'=>$spilloverid,						
											'Balance'=>$checkmembersbal,
											'Description'=>"Prmoted to achieve for target balance".' '.$rank,
											'TransactionId'=>$trnid,
											'TypeId'=>'23',
											'DateAdded'=>$date
										);
										
										$con="MemberId='".$spilloverid."' and Balance='".$checkmembersbal."'";
										$checkrank=$this->common_model->GetRowCount($con,"arm_history");
										// if($checkrank==0)
										// {
											$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
											
										// }
									}
								}
							}
						}

						// send sms 
						$message = "Matching Bonus for level".$level." Earned ".$commission;
						$smsres = $this->sendbulksms($spilloverid,$message);

						$level++;
						$this->matchingbonus($spilloverid,$commission,$level);
					}
					else
					{

						$amount = $commission * $mbonus[0] / 100;
						$userbal = $this->common_model->Getcusomerbalance($spilloverid);

						$desc  = 'Matching Bonus Earnings for level '.$level;
						$date = date('Y-m-d H:i:s');
						$txnid = 'MBE'.rand(100000,1000000);
						$data = array(
							'MemberId'=>$spilloverid,
							'TypeId'=>'4',
							'Credit'=>$amount,
							'Balance'=>$userbal+$amount,
							'Description'=>$desc,
							'TransactionId'=>$txnid,
							'DateAdded'=>$date
						);

						$pcresult = $this->common_model->SaveRecords($data,"arm_history");
						if($pcresult)
						{
							$checkmembersbal=$this->common_model->Getcusomerbalance($spilloverid);
							$memberbal=number_format($checkmembersbal);   

							$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
							$checkrank=$checkmatrix->RankStatus;
							if($checkrank==1)
							{
								$cond="balanceAmount='".$memberbal."' AND Status='1'";
								$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
								$balancerank=$checkbalrank->balanceAmount;
								$rank=$checkbalrank->Rank;
								if($balancerank!="")
								{
									if($checkmembersbal==$balancerank)
									{
										$trnid = 'RAN'.rand(1111111,9999999);
										$date = date('y-m-d h:i:s');
										$data = array(
											'MemberId'=>$spilloverid,						
											'Balance'=>$checkmembersbal,
											'Description'=>"Prmoted to achieve for target balance".' '.$rank,
											'TransactionId'=>$trnid,
											'TypeId'=>'23',
											'DateAdded'=>$date
										);
										
										$con="MemberId='".$spilloverid."' and Balance='".$checkmembersbal."'";
										$checkrank=$this->common_model->GetRowCount($con,"arm_history");
										// if($checkrank==0)
										// {
											$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
											
										// }
									}
								}
							}
						}
						// send sms 
						$message = "Matching Bonus for level".$level." Earned ".$commission;
						$smsres = $this->sendbulksms($spilloverid,$message);

						$level++;
					
						$this->matchingbonus($spilloverid,$commission,$level);

					}
			
				}
				
			}

		}
		
	}

	// check board complete or not in board matrix here 

	public function checkboard($users,$boardid,$status,$wcount,$level)
	{

		for($i=0;$i<$level;$i++)
		{
			
			$usids = implode(",", $users);
				//chkcount correct count
			if($i){ $chkcount = count($users) * $wcount; } else { $chkcount=$wcount; }

			$cmdetails = $this->common_model->GetResults("BoardId='".$boardid."' AND SpilloverId IN (".$usids.")","arm_boardmatrix");
			// echo"<pre>"; print_r($cmdetails); echo"</pre>";
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
		return $status;
	}
	
	
	// calculates board complete commission here

	public function boardcommission($userid,$commission,$bdname)
	{
		$userbal = $this->common_model->Getcusomerbalance($userid);
		$trnid = 'BCOM'.rand(1111111,9999999);
		$date = date('y-m-d h:i:s');
		$data = array(
			'MemberId'=>$userid,
			'Credit'=>$commission,
			'Balance'=>$userbal+$commission,
			'Description'=>'Board Commission for '.$bdname.' Board Completed',
			'TransactionId'=>$trnid,
			'TypeId'=>'4',
			'DateAdded'=>$date
		);

		$userdetails = $this->common_model->SaveRecords($data,'arm_history');
		if($userdetails)
		{
			$checkmembersbal=$this->common_model->Getcusomerbalance($userid);
			$memberbal=number_format($checkmembersbal);   

			$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			$checkrank=$checkmatrix->RankStatus;
			if($checkrank==1)
			{
				$cond="balanceAmount='".$memberbal."' AND Status='1'";
				$checkbalrank=$this->common_model->GetRow($cond,"arm_ranksetting");
				$balancerank=$checkbalrank->balanceAmount;
				$rank=$checkbalrank->Rank;
				if($balancerank!="")
				{
					if($checkmembersbal==$balancerank)
					{
						$trnid = 'RAN'.rand(1111111,9999999);
						$date = date('y-m-d h:i:s');
						$data = array(
							'MemberId'=>$userid,						
							'Balance'=>$checkmembersbal,
							'Description'=>"Prmoted to achieve for target balance".' '.$rank,
							'TransactionId'=>$trnid,
							'TypeId'=>'23',
							'DateAdded'=>$date
						);
						
						$rankdetails = $this->common_model->SaveRecords($data,'arm_history');
					}
				}
			}
		}

		// send sms 
		$message = "Board Commission for ".$bdname." Earned ".$commission;
		$smsres = $this->sendbulksms($SpilloverId,$message);
	}

	function sendbulksms($mno,$message)
	{
		$sms_details = $this->db->query("SELECT KeyValue, ContentValue FROM arm_setting WHERE Page='smssetting'");

		$this->db->where('Page','smssetting');
		$this->db->select('KeyValue, ContentValue');
		$sms_details = $this->db->get('arm_setting');
		
		foreach ($sms_details->result() as $row) {
			$sms[$row->KeyValue] = $row->ContentValue;
		}

		$username = $sms['smsauthuser'];
		$password = $sms['smsauthpassword'];

		/*
		* Your phone number, including country code, i.e. +44123123123 in this case:
		*/
		$msisdn = $sms['senderno'];

		/*
		* Please see the FAQ regarding HTTPS (port 443) and HTTP (port 80/5567)
		*/
		// $url = 'https://bulksms.vsms.net/eapi/submission/send_sms/2/2.0';
		$url = $sms['smsauthurl'];
		$port = 443;


		$post_body = $this->unicode_sms($username, $password, $message, $msisdn);
		$result='';
		$result =  $this->send_message($post_body, $url, $port);
		return true;
	}

	function unicode_sms ( $username, $password, $message, $msisdn ) {
		$post_fields = array (
			'username' => $username,
			'password' => $password,
			'message'  => $this->string_to_utf16_hex( $message ),
			'msisdn'   => $msisdn,
			'dca'      => '16bit'
		);

		return $this->make_post_body($post_fields);
	}

	function string_to_utf16_hex( $string ) {
		return bin2hex(mb_convert_encoding($string, "UTF-16", "UTF-8"));
	}

	function make_post_body($post_fields) {
		$stop_dup_id = $this->make_stop_dup_id();
		if ($stop_dup_id > 0) {
			$post_fields['stop_dup_id'] = $this->make_stop_dup_id();
		}
		$post_body = '';
		foreach( $post_fields as $key => $value ) {
			$post_body .= urlencode( $key ).'='.urlencode( $value ).'&';
		}
		$post_body = rtrim( $post_body,'&' );

		return $post_body;
	}
	function make_stop_dup_id() {
		return 0;
	}
	function send_message($post_body, $url, $port ) {
		/*
		* Do not supply $post_fields directly as an argument to CURLOPT_POSTFIELDS,
		* despite what the PHP documentation suggests: cUrl will turn it into in a
		* multipart formpost, which is not supported:
		*/

		$ch = curl_init( );
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_PORT, $port );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_body );
		// Allowing cUrl funtions 20 second to execute
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
		// Waiting 20 seconds while trying to connect
		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );

		$response_string = curl_exec( $ch );
		$curl_info = curl_getinfo( $ch );

		$sms_result = array();
		$sms_result['success'] = 0;
		$sms_result['details'] = '';
		$sms_result['transient_error'] = 0;
		$sms_result['http_status_code'] = $curl_info['http_code'];
		$sms_result['api_status_code'] = '';
		$sms_result['api_message'] = '';
		$sms_result['api_batch_id'] = '';

		if ( $response_string == FALSE ) {
			$sms_result['details'] .= "cURL error: " . curl_error( $ch ) . "\n";
		} elseif ( $curl_info[ 'http_code' ] != 200 ) {
			$sms_result['transient_error'] = 1;
			$sms_result['details'] .= "Error: non-200 HTTP status code: " . $curl_info[ 'http_code' ] . "\n";
		}
		else {
			$sms_result['details'] .= "Response from server: $response_string\n";
			$api_result = explode( '|', $response_string );
			$status_code = $api_result[0];
			$sms_result['api_status_code'] = $status_code;
			$sms_result['api_message'] = $api_result[1];
			if ( count( $api_result ) != 3 ) {
			  $sms_result['details'] .= "Error: could not parse valid return data from server.\n" . count( $api_result );
			} else {
				if ($status_code == '0') {
					$sms_result['success'] = 1;
					$sms_result['api_batch_id'] = $api_result[2];
					$sms_result['details'] .= "Message sent - batch ID $api_result[2]\n";
				}
				else if ($status_code == '1') {
					# Success: scheduled for later sending.
					$sms_result['success'] = 1;
					$sms_result['api_batch_id'] = $api_result[2];
				}
				else {
					$sms_result['details'] .= "Error sending: status code [$api_result[0]] description [$api_result[1]]\n";
				}
			}
		}
		curl_close( $ch );
		return $sms_result;
	}




}

?>