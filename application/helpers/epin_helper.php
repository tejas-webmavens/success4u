<?php 

	function RandomEpins()
	{
		$characters = array("A","B","C","D","E","F","G","H","J","K","M","N","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9");
		//make an "empty container" or array for our keys
		$keys = array();
		//first count of $keys is empty so "1", remaining count is 1-6 = total 7 times
		while(count($keys) < 16)
		{
			//count($characters) = 33
			$x = mt_rand(0, count($characters)-1);
			if(!in_array($x, $keys)) {
			   $keys[] = $x;
			}
		}

		$random_chars='';
		foreach($keys as $key) {
		   $random_chars.= $characters[$key];
		}

		$pin = $random_chars;
		return $pin;
	}
