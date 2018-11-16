<?php

Class Common_model extends CI_Model {

	public function GetResults($condition='', $tableName, $SelectColumn='') {
		
		if($SelectColumn)
			$this->db->select($SelectColumn);
		else 
			$this->db->select('*');

		$this->db->from($tableName);

		if($condition)
			$this->db->where($condition);

		$query = $this->db->get();
		 // echo $this->db->last_query();
		
		if ($query->num_rows()>0) {
			$row = $query->result();
			return $row;
		} else {
			return false;
		}
	}

	public function GetRow($condition='', $tableName, $SelectColumn='') {
		
		if($tableName) {
			if($SelectColumn)
				$this->db->select($SelectColumn);
			else 
				$this->db->select('*');

			$this->db->from($tableName);

			if($condition)
				$this->db->where($condition);

			$query = $this->db->get();
			
			if ($query->num_rows()>0) {
				$row = $query->row();
				return $row;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	

	public function GetRows($condition='', $tableName, $SelectColumn='') {
		
		if($tableName) {
			if($SelectColumn)
				$this->db->select($SelectColumn);
			else 
				$this->db->select('*');

			$this->db->from($tableName);
			$limit=1;
			if($condition)
				$this->db->where($condition ." ". "ORDER BY"." " . "`payid` DESC LIMIT 1" );
			

			$query = $this->db->get();
			
			if ($query->num_rows()>0) {
				$row = $query->row();
				return $row;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	public function GetRowdeposit($condition='', $tableName, $SelectColumn='') {
		
		if($tableName) {
			if($SelectColumn)
				$this->db->select($SelectColumn);
			else 
				$this->db->select('*');

			$this->db->from($tableName);
			$limit=1;
			if($condition)
				$this->db->where($condition ." ". "ORDER BY"." " . "`id` DESC LIMIT 1" );
			

			$query = $this->db->get();
			
			if ($query->num_rows()>0) {
				$row = $query->row();
				return $row;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	

	public function GetRowss($condition='', $tableName, $SelectColumn='') {
		
		if($tableName) {
			if($SelectColumn)
				$this->db->select($SelectColumn);
			else 
				$this->db->select('*');

			$this->db->from($tableName);
			$limit=1;
			if($condition)
				$this->db->where($condition ." ". "ORDER BY"." " . "`MemberId` DESC LIMIT 1" );
			

			$query = $this->db->get();
			
			if ($query->num_rows()>0) {
				$row = $query->row();
				return $row;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function GetRowCount($condition='', $tableName, $SelectColumn='') {
		
		if($SelectColumn)
			$this->db->select($SelectColumn);
		else 
			$this->db->select('*');

		$this->db->from($tableName);

		if($condition)
			$this->db->where($condition);

		$query = $this->db->get();

		
		if ($query->num_rows()>0) {
			$row = $query->num_rows();
			
			return $row;
		} else {
			return 0;
		}
	}


	// Login function 
	public function login($data) {

		
		if(valid_email($data['username']))
			$condition = "Email =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . $data['password'] . "' AND MemberStatus ='Active'";
		else
			$condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . $data['password'] . "' AND MemberStatus ='Active'";


		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			$row = $query->row();
			return $row;
		} else {
			return false;
		}
	}

	// get tables
	public function GetCustomers() {

		// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
		$condition = "isDelete='0' AND UserType IN('3','4')";
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	Public function getmembername($username){

		$condition = "UserName =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {

			return $query->row()->UserName;
		} else {
			return "no matches";
		}	
	}


	public function GetCountry() {

		$this->db->select('*');
		$this->db->from('arm_country');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function GetCountryName($country_id) {

		$this->db->select('name');
		$this->db->from('arm_country');
		$this->db->where('country_id',$country_id);
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function GetSponsor($sponserid,$condition){
		
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			// print_r($query->row());
			return $query->row();
		} else {
			return false;
		}
	}

	public function Ticketcount(){
		
		$this->db->select('*');
		$this->db->from('arm_ticket');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			// print_r($query->row());
			return $query->num_rows();
		} else {
			return 0;
		}
	}


	//save records
	public  function SaveRecords($data, $tableName)
	{
		$this->db->set($data);
	    $this->db->insert($tableName);
	     // echo"<br> Insert Query === ". $this->db->last_query();
	    return $this->db->insert_id();
	}


	Public function GetCustomer($MemberId){
		$condition = "MemberId =" . "'" . $MemberId . "'";
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}	
	}

	public function UpdateRecord($data, $condition, $tableName) {
		$this->db->where($condition);
		// $this->db->where('MemberId', $MemberId);
		$res = $this->db->update($tableName,$data);
		 // echo"<br> Update Query === ". $this->db->last_query();
		if($res){
			return true;
		}
		else
			return false;
	}

	public function DeleteCustomer($MemberId) {
		$this->db->where('MemberId', $MemberId);
      	$selete_status = $this->db->delete('arm_members'); 
      	if($selete_status)
      		return true;
      	else
      		return false;
	}

	public function DeleteRecord($condition, $tableName) {
		$this->db->where($condition);
		
      	$delete_status = $this->db->delete($tableName); 
      	if($delete_status)
      		return true;
      	else
      		return false;
	}
	Public function GetNewOrders(){
		$condition = "isDelete =" . "'0'";
		$this->db->select('*');
		$this->db->from('arm_order');
		$this->db->where($condition);
		// $this->db->where('DateAdded', 'MONTH(DateAdded)' , FALSE);
		$query = $this->db->get();


		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}	
	}
	Public function GetNewProducts(){
		$condition = "isDelete =" . "'0'";
		$this->db->select('*');
		$this->db->from('arm_product');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}	
	}
	Public function GetNewMembers($MemberId){
		$condition = "isDelete =" . "'0' AND DirectId='".$MemberId."'";
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}	
	}

	Public function GetAllMembers(){
		$condition = "isDelete =" . "'0'";
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}	
	}

	Public function Getepincount($MemberId){
		$condition = "AllocatedBy =" . "'" . $MemberId . "' AND EpinStatus='1'";
		$this->db->select('*');
		$this->db->from('arm_epin');
		$this->db->where($condition);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}	
	}

	Public function Getcusomerbalance($MemberId){
		$condition = "MemberId =" . "'" . $MemberId . "'";
		$this->db->select('*');
		$this->db->from('arm_history');
		$this->db->order_by('HistoryId', 'DESC');
		
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			return $query->row()->Balance;
		} else {
			return 0.00;
		}	
	}

	Public function getreferralname($referralname)
	{

		$condition = "UserName =" . "'" . $referralname . "'";
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {

			return $query->row()->MemberId;
		} else {
			return false;
		}	
	}

	public function GetAdmin() {

		// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
		$condition = "isDelete='0' AND UserType='1'";
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}
	}


	public function CheckIP(){
		$condition = "Ip =" . "'" . $this->input->ip_address() . "' AND Status='1'";
		$this->db->select('*');
		$this->db->from('arm_banned');
		$this->db->where($condition);
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			return true;
		} else {
			return false;
		}	
	}

	Public function GetNewOrdersTotal($UserId){
		$condition = "isDelete ='0' AND DATE(DateAdded)='".date('Y-m-d')."' AND MemberId='".$UserId."'";
		// $this->db->select('*');
		$this->db->select_sum('OrderTotal');
		$this->db->from('arm_order');
		$this->db->where($condition);
		
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			$order = $query->row();
			return $order->OrderTotal;
		} else {
			return 0;
		}	
	}

	Public function Getcusomercommission($MemberId){
		
		$query = $this->db->query("SELECT sum(Credit) as commission FROM arm_history WHERE MemberId =" . "'" . $MemberId . "' AND TypeId='4'");
	
		if ($query->row()->commission>0) {
			return $query->row()->commission;
		} else {
			return 0.00;
		}	
	}

	// list subadmin
	public function Getsubadmin() {

		// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
		$condition = "isDelete='0' AND UserType='2'";
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	// get subadmin access list
	public function Subadminaccess($userid,$userlevel) {
		
		$condition = "UserId='".$userid."' AND UserLevel='".$userlevel."'";
		$this->db->select('access_list');
		$this->db->from('arm_user_permission');
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			// print_r($query->row());exit;
			return $query->row();
		} else {
			return false;
		}
	}

	Public function GetTodayComm(){
		
		$query = $this->db->query("SELECT sum(Credit) as commission FROM arm_history WHERE TypeId='4' AND date(DateAdded)='".date('Y-m-d')."'");


		if ($query->row()->commission>0) {
			return $query->row()->commission;
		} else {
			return 0.00;
		}	
	}

	Public function GetTodayorder(){
		
		$query = $this->db->query("SELECT sum(OrderTotal) as totalorder FROM arm_order WHERE isDelete = '0' AND date(DateAdded)='".date('Y-m-d')."'");
        

		if ($query->row()->totalorder>0) {
			return $query->row()->totalorder;
		} else {
			return 0.00;
		}	
	}

	public function getBinaryPlace($table, $width) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where("MemberCount < '".$width."'");
		$this->db->limit('1');
		$this->db->order_by('MemberId','ASC');
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function getBinarylevel($id, $table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where("MemberId",$id);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function GetSiteSettings($Page) {

		$this->db->where('Page',$Page);
		$this->db->select('KeyValue, ContentValue');
		$this->db->from('arm_setting');
		
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function Upgradeplans($memberid) {
		$this->db->select('pv.*, mp.MemberId');
		$this->db->from('arm_pv pv');
		$this->db->join('arm_memberpayment1 mp', 'mp.PackageId != pv.PackageId');
		$this->db->where('mp.MemberId',$memberid);
		$this->db->where('mp.status != "1"');
		$this->db->where('pv.PackageId != "1"');
		$this->db->group_by('pv.PackageId');
		$query = $this->db->get();
		// echo $this->db->last_query();
		if ($query->num_rows()>0) {
			// $this->data['packages'] = $query->result();
			return $query->result();
		} else {
			return false;
		} 	
	}

	public function DepositData() {

		$this->db->select('deposit.*, arm_hyip.*');
		$this->db->where('deposit.status','1');
		$this->db->from('deposit');
		$this->db->join('arm_hyip', 'deposit.packageid = arm_hyip.packageid', 'left');
		 $condition = "deposit.next_run_date < '".date('Y-m-d H:i:s')."'";
		 $this->db->where($condition);
		 $this->db->limit('5');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
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
			$amount=$this->common_model->GetRowdeposit("MemberId='".$leftid."'","deposit");
		 // echo $this->db->last_query();
		if($amount->amount)
	    {
	    	
	    $total+=$amount->amount;
	
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
			$amount=$this->common_model->GetRowdeposit("MemberId='".$rightid."'","deposit");
		  // echo $this->db->last_query();
		if($amount->amount)
	    {
	    	
	    $total+=$amount->amount;
	
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

	public function allmember()
	{
	 $this->db->select('*');
	 $this->db->from("arm_memberpayment");
	 $query=$this->db->get();
	 if ($query->num_rows()>0) {
			// $this->data['packages'] = $query->result();
			return $query->result();
		} else {
			return false;
		}
	}

	public function EditProduct($ProductId)
	{
		$this->db->select('*');
		$this->db->from('arm_bannerimage');
		// $this->db->join('arm_productimage', 'arm_productimage.ProductId = arm_product.ProductId');
		$this->db->where('banner_id',$ProductId);
		// $this->db->where('Price > 0.0000');
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}	
		
	}

	

}

?>