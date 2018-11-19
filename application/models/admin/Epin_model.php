<?php

class Epin_model extends CI_Model {



	public function Getpackagedetail() {

		$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			if($mlsetting->Id==4)
			{
				$table ="arm_pv";
			}
			elseif($mlsetting->Id==5)
			{
				$table ="arm_boardplan";
			}
			else
			{				
				$table ="arm_package";
			}

		$condition = "Status ='1'";
		//if($KeyValue) $condition.=" AND KeyValue='".$KeyValue."'";
		$this->db->select('*');

		

		$this->db->from($table);
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		
		if ($query->num_rows()>0) {
			return $query->result();
			
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

	public function Getpackageid($packagename) {

		$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			if($mlsetting->Id==4)
			{
				$table ="arm_pv";
			}
			elseif($mlsetting->Id==5)
			{
				$table ="arm_boardplan";
			}
			else
			{				
				$table ="arm_package";
			}
		$condition = "PackageName ='".$packagename."'";
		//if($KeyValue) $condition.=" AND KeyValue='".$KeyValue."'";
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		
		if ($query->num_rows()>0) {
			return $query->result();
			
		} else {
			return false;
		}
	}


	public function getregister() {

		//$condition = "Page =" . "'registersetting'";
		//if($KeyValue) $condition.=" AND KeyValue='".$KeyValue."'";
		$this->db->select('MemberId,FirstName,
			MiddleName,LastName,
			Email,UserName,MemberStatus,
			Password,Gender,BirthDate,
			Phone,Fax,SubscriptionsStatus,
			DirectId,SpilloverId,Address,
			City,State,Country,Zip,EnrollerId');
		$this->db->from('arm_members');
		//$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		
		if ($query->num_rows()>0) {
			
			return $query->row();
		} else {
			return false;
		}
	}

	public function Getlimitfields($limit='',$page='') {

		//$condition = "ExpiryDay >=" . "'" . date("Y-m-d") . "'";
		//if($limit!=''&& $page!='')
		$this->db->limit($limit,$page);
		$this->db->select('*');
		$this->db->from('arm_epin');
		
		$this->db->order_by("EpinRecordId","desc");



		// $this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function Getfields() {

		//$condition = "ExpiryDay >=" . "'" . date("Y-m-d") . "'";
		
		$this->db->select('*');
		$this->db->from('arm_epin');
		
		$this->db->order_by("EpinRecordId","desc");



		// $this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}


	public function GetepinCount() {

		//$condition = "ExpiryDay >=" . "'" . date("Y-m-d") . "'";
		$this->db->select('*');
		$this->db->from('arm_epin');
		
		$this->db->order_by("EpinRecordId","desc");



		// $this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}
	}

	

	public function Getexpiryepinfields() {

		$condition = "ExpiryDay <" . "'" . date("Y-m-d") . "' AND EpinStatus IN('0','1')";
		$this->db->select('*');
		$this->db->from('arm_epin');
		$this->db->where($condition);
		$this->db->order_by("EpinRecordId","desc");



		// $this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}


	public function Getrequestlist() 
	{
		$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			
		// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
		$this->db->select('*');
		$this->db->from('arm_requestepin a');
		$this->db->join('arm_members b', 'b.MemberId=a.UserId', 'left');
		if($mlsetting->Id==4)
			{
				$this->db->join('arm_pv c', 'c.PackageId=a.PackageId', 'left');
			}
			elseif($mlsetting->Id==5)
			{
				$this->db->join('arm_boardplan c', 'c.PackageId=a.PackageId', 'left');
			}
			else
			{				
				$this->db->join('arm_package c', 'c.PackageId=a.PackageId', 'left');
			}
		
		$this->db->where('a.RequestStatus','0');

		//	$this->db->query("SELECT * FROM arm_requestepin a , arm_members b WHERE b.MemberId = a.UserId AND a.Status=0 ");
		// $this->db->where($condition);0
		// $this->db->limit(1);
		$query = $this->db->get();



		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function Getcancelrequestlist() 
	{
		$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
		// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
		$this->db->select('*');
		$this->db->from('arm_requestepin a');
		$this->db->join('arm_members b', 'b.MemberId=a.UserId', 'left');
		if($mlsetting->Id==4)
			{
				$this->db->join('arm_pv c', 'c.PackageId=a.PackageId', 'left');
			}
			elseif($mlsetting->Id==5)
			{
				$this->db->join('arm_boardplan c', 'c.PackageId=a.PackageId', 'left');
			}
			else
			{				
				$this->db->join('arm_package c', 'c.PackageId=a.PackageId', 'left');
			}
		$this->db->where('a.RequestStatus','2');

		//	$this->db->query("SELECT * FROM arm_requestepin a , arm_members b WHERE b.MemberId = a.UserId AND a.Status=0 ");
		// $this->db->where($condition);0
		// $this->db->limit(1);
		$query = $this->db->get();



		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function Getrequestsearchlist($condition) {
		$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
		// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
		$this->db->select('*');
		$this->db->from('arm_requestepin a');
		$this->db->join('arm_members b', 'b.MemberId=a.UserId', 'left');
		if($mlsetting->Id==4)
			{
				$this->db->join('arm_pv c', 'c.PackageId=a.PackageId', 'left');
			}
			elseif($mlsetting->Id==5)
			{
				$this->db->join('arm_boardplan c', 'c.PackageId=a.PackageId', 'left');
			}
			else
			{				
				$this->db->join('arm_package c', 'c.PackageId=a.PackageId', 'left');
			}
		
		//	$this->db->query("SELECT * FROM arm_requestepin a , arm_members b WHERE b.MemberId = a.UserId AND a.Status=0 ");
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}


	public function Checkepin($condition='', $tableName, $SelectColumn='') {
		
		if($SelectColumn)
			$this->db->select($SelectColumn);
		else 
			$this->db->select('*');

		$this->db->from($tableName);
		$this->db->order_by("EpinRecordId","asc");

		// $this->db->limit(1,2);

		if($condition)
			$this->db->where($condition);

		$query = $this->db->get();
		// $this->db->last_query();
		

		if ($query->num_rows()>0) {
			$row = $query->result();
			// print_r($row);
			// exit;
			return $row;
		} else {
			return false;
		}
	}

	public function Getfielddata($id) {

		$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			if($mlsetting->Id==4)
			{
				$table ="arm_pv";
			}
			elseif($mlsetting->Id==5)
			{
				$table ="arm_boardplan";
			}
			else
			{				
				$table ="arm_package";
			}

		$condition = "PackageId =" . "'" . $id. "'";
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return "No package";
		}
	}


}
?>