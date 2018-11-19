<?php 

	 
	function DailyReward()
	{
		$CI =& get_instance();
		$dailystatus=$CI->db->query("SELECT * FROM arm_setting WHERE KeyValue='dailyrewardstatus' AND Page='rewardsetting'");
	 	
	 	if($dailystatus->result_array()[0]['ContentValue']==1) //Sun OR Sat
	 	{

			$ydate = date("y-m-d", mktime(0, 0, 0, date("m")  , date("d")-7, date("Y")));
			
		 	$dquery=$CI->db->query('SELECT * FROM arm_members');
			
			$daily=$CI->db->query("SELECT * FROM arm_setting WHERE KeyValue='dailyReferral' AND Page='rewardsetting'");
			$daily->result_array()[0]['ContentValue'];

			$dailyrset1 = explode(",", $daily->result_array()[0]['ContentValue']);
			$dayset =array();

			foreach($dailyrset1 as $dset)
			{		
				$use=explode("-", $dset); 
				$dayset[ $use[0]]=$use[1];
			}
			krsort($dayset);
			
			foreach($dquery->result_array() as $cmem):
				$CI->db->where("date(DateAdded)",$ydate);
				$CI->db->where("DirectId",$cmem['MemberId']);
				$memdet = $CI->db->get('arm_members');
			
				$flag =1;
				foreach ($dayset as $daykey => $dayvalue) 
				{
					
					if($daykey <= $memdet->num_rows() && $flag ==1 )
					{
						$flag =0;
						$memhisdet=$CI->db->query("SELECT * FROM arm_history WHERE MemberId='".$cmem['MemberId']."' order by HistoryId DESC LIMIT 0,1");
						$memhisbal = $memhisdet->result_array()[0]['Balance'];
						$dcurbal =$memhisbal+$dayvalue;
						$dtrnid = 'DRCOM'.rand(1111111,9999999);
						$curdate = date('y-m-d h:i:s');
						$ddesp = "DailyReward commission earned on ". date("d M Y",strtotime($ydate));
						$memhisresult = $CI->db->query("INSERT INTO arm_history SET MemberId='".$cmem['MemberId']."',Credit='".$dayvalue."', Balance='".$dcurbal."', Description='".$ddesp."', TypeId='4', DateAdded='".$curdate."', TransactionId='".$dtrnid."'");
						
					}
				}
			endforeach;
		}
	}

 	function WeeklyReward()
 	{
	 	$checkwdate = date("D");
		$CI =& get_instance();
		$weeklystatus=$CI->db->query("SELECT * FROM arm_setting WHERE KeyValue='weeklyrewardstatus' AND Page='rewardsetting'");
	 	
	 	if($checkwdate =="Sat" && $weeklystatus->result_array()[0]['ContentValue']==1) //Sun OR Sat
	 	{
	 		$wsdate = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")-7, date("Y")));
	 		$wedate = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")));

			$wquery=$CI->db->query('SELECT * FROM arm_members');
		
			$weekly=$CI->db->query("SELECT * FROM arm_setting WHERE KeyValue='weeklyReferral' AND Page='rewardsetting'");
			$weekly->result_array()[0]['ContentValue'];

			$weeklyrset1 = explode(",", $weekly->result_array()[0]['ContentValue']);
			$weekset =array();

			foreach($weeklyrset1 as $wset)
			{		
				$wuse=explode("-", $wset); 
			 	$weekset[ $wuse[0]]=$wuse[1];
			}
			krsort($weekset);
		
				foreach($wquery->result_array() as $wcmem):
			
					$wmemdet = $CI->db->query("SELECT * FROM arm_members WHERE date(DateAdded)>='".$wsdate."' AND date(DateAdded)<='".$wedate."' AND DirectId='".$wcmem['MemberId']."' ");
					$wflag =1;
						foreach ($weekset as $weekkey => $weekvalue) 
						{
							
							if($weekkey <= $wmemdet->num_rows() && $wflag ==1 )
							{
								$wflag =0;
								$wmemhisdet=$CI->db->query("SELECT * FROM arm_history WHERE MemberId='".$wcmem['MemberId']."' order by HistoryId DESC LIMIT 0,1");
								$wmemhisbal = $wmemhisdet->result_array()[0]['Balance'];
								$wcurbal =$wmemhisbal+$weekvalue;
								$wtrnid = 'WRCOM'.rand(1111111,9999999);
								$curdate = date('y-m-d h:i:s');
								$wdesp = "WeeklyReward commission earned on ". date("d M Y");
								$wmemhisresult = $CI->db->query("INSERT INTO arm_history SET MemberId='".$wcmem['MemberId']."',Credit='".$weekvalue."', Balance='".$wcurbal."', Description='".$wdesp."', TypeId='4', DateAdded='".$curdate."', TransactionId='".$wtrnid."'");
								
							}
						}
				endforeach;
		}
	}
	 
	function MonthlyReward()
	{
	 	
	 	$checkmdate = date("d");
		$CI =& get_instance();
	 	$monthlystatus=$CI->db->query("SELECT * FROM arm_setting WHERE KeyValue='monthlyrewardstatus' AND Page='rewardsetting'");
		
	 	if($checkmdate =="07" && $monthlystatus->result_array()[0]['ContentValue']==1) //01 OR 07
	 	{
	 		$msdate = date("Y-m-d", mktime(0, 0, 0, date("m")-1  , date("d"), date("Y")));
	 		$medate = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")));
	 		
			$mquery=$CI->db->query('SELECT * FROM arm_members');
	
			$monthly=$CI->db->query("SELECT * FROM arm_setting WHERE KeyValue='monthlyReferral' AND Page='rewardsetting'");
			$monthly->result_array()[0]['ContentValue'];

			$monthlyrset1 = explode(",", $monthly->result_array()[0]['ContentValue']);
			$monthset =array();

			foreach($monthlyrset1 as $mset)
			{		
				$muse=explode("-", $mset); 
				$monthset[ $muse[0]]=$muse[1];
			}
			krsort($monthset);


				foreach($mquery->result_array() as $mcmem):
			
					$mmemdet = $CI->db->query("SELECT * FROM arm_members WHERE date(DateAdded)>='".$msdate."' AND date(DateAdded)<='".$medate."' AND DirectId='".$mcmem['MemberId']."' ");
					$wflag =1;
					foreach ($monthset as $monthkey => $monthvalue) 
					{
					
						if($monthkey <= $mmemdet->num_rows() && $wflag ==1 )
						{
							$wflag =0;
							$mmemhisdet=$CI->db->query("SELECT * FROM arm_history WHERE MemberId='".$mcmem['MemberId']."' order by HistoryId DESC LIMIT 0,1");
							$mmemhisbal = $mmemhisdet->result_array()[0]['Balance'];
							$mcurbal =$mmemhisbal+$monthvalue;
							$mtrnid = 'MRCOM'.rand(1111111,9999999);
							$curdate = date('y-m-d h:i:s');
							$mdesp = "Monthly Reward commission earned on ". date("d M Y");
							$wmemhisresult = $CI->db->query("INSERT INTO arm_history SET MemberId='".$mcmem['MemberId']."',Credit='".$monthvalue."', Balance='".$mcurbal."', Description='".$mdesp."', TypeId='4', DateAdded='".$curdate."', TransactionId='".$mtrnid."'");
							
								 

						}
					}
				endforeach;
		}

	}

	