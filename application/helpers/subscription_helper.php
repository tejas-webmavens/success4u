<?php

	/*
	* Requirements: your PHP installation needs cUrl support, which not all PHP installations
	* include by default.
	*
	* Simply substitute your own username, password and phone number
	* below, and run the test code:
	*/

	function checkmembersubscription($memberid)
	{
		$CI =& get_instance();
		$curdate=date("Y-m-d H:i:s ");
		$members=$CI->db->query("SELECT * FROM arm_members WHERE MemberId='".$memberid."' ");

		if($members->result_array()[0]['EndDate'] < $curdate) {
			$pay=1;
		} else {
			$pay=0;
		}

		return $pay;
	}

	function checksubscription()
	{
		$CI =& get_instance();

		$subscriptiontype=$CI->db->query("SELECT * FROM arm_setting WHERE KeyValue='subscriptiontype' AND Page='usersetting'");
		$subperiod=$CI->db->query("SELECT * FROM arm_setting WHERE KeyValue='subscriptiongraceperiod' AND Page='usersetting'");
		$dftsponsor=$CI->db->query("SELECT * FROM arm_setting WHERE KeyValue='defaultsponsors' AND Page='sitesetting'");
		$matrixset=$CI->db->query("SELECT * FROM arm_matrixsetting WHERE MatrixStatus='1'");

		if($subscriptiontype->result_array()[0]['ContentValue']=='monthly')
		{
			$period = $subperiod->result_array()[0]['ContentValue'];
			$nxtperiod=30;
		}
		else
		{
			$period = $subperiod->result_array()[0]['ContentValue'];
			$nxtperiod=365;
		}

		if($matrixset->result_array()[0]['Id']==4) {
			$ptable = "arm_pv";
		} else if($matrixset->result_array()[0]['Id']==5) {
			$ptable = "arm_boardplan";
		} else{
			$ptable='arm_package';
		}

		$curdate=date("Y-m-d H:i:s ");
		$backups = strtotime("-".$period." day", strtotime($curdate));
		$backupe = strtotime("+".$period." day", strtotime($curdate));

		$checksdate=date('Y-m-d H:i:s ', $backups);
		$checkedate=date('Y-m-d H:i:s ', $backupe);

		$members=$CI->db->query("SELECT * FROM arm_members WHERE MemberId NOT IN('1','".$dftsponsor->result_array()[0]['ContentValue']."') AND UserType = '3' AND EndDate <= '".date($checkedate)."'");
	  
		foreach($members->result_array() as $row)
		{
			$userbal = $CI->common_model->Getcusomerbalance($row['MemberId']);

			if($row['PackageId']!=0)
			{

				$pack_condition = "PackageId='".$row['PackageId']."'";
				$packagedet=$CI->common_model->GetRow($pack_condition,$ptable);

				if(isset($packagedet->PackageFee)) 
				{
		       
			       	if($packagedet->PackageFee){
			       		$debitval = $packagedet->PackageFee;
			       	} else{
			       		$debitval = '0';
			       	}

					if($packagedet->PackageFee<=$userbal)
					{
					 	
					 	$trnid = 'SUB'.rand(1111111,9999999);
						$date = date('y-m-d h:i:s');
						$data = array(
							'MemberId'=>$row['MemberId'],
							'Debit'=>$debitval,
							'Balance'=>$userbal-$debitval,
							'Description'=>'Amount detected for Subcription on '.$date,
							'TransactionId'=>$trnid,
							'TypeId'=>'2',
							'DateAdded'=>$date
						);
						$nxtexp= strtotime("+".$nxtperiod." day", strtotime($row['EndDate']));
						$nxtdate=date('Y-m-d H:i:s ', $nxtexp);
						
						$userhistory = $CI->common_model->SaveRecords($data,'arm_history');
						if($userhistory)
						{
						 	$updatemember=$CI->db->query("UPDATE arm_members SET EndDate='".date($nxtdate)."', SubscriptionsStatus='Active', MemberStatus='Active' WHERE MemberId='".$row['MemberId']."' ");
						 	$updatematrix=$CI->db->query("UPDATE ".$matrixset->result_array()[0]['TableName']." SET Status='1' WHERE MemberId='".$row['MemberId']."' ");
						}
						
					} 
					else 
					{

					 	if($row['EndDate'] < $checksdate)
						{
							$updatemember=$CI->db->query("UPDATE arm_members SET SubscriptionsStatus='Inactive', MemberStatus='Inactive' WHERE MemberId='".$row['MemberId']."' ");
					 		$updatematrix=$CI->db->query("UPDATE ".$matrixset->result_array()[0]['TableName']." SET Status='0' WHERE MemberId='".$row['MemberId']."' ");
						}
					}
			}
		}

	}
}

?>