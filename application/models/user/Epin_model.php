<?php
error_reporting(E_ALL);

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

	public function Getrequestlist($id) 
	{
		$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			
		$condition = "a.RequestStatus!='1' AND b.MemberId=" . "'" . $id . "'";
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
		$this->db->where($condition);

		//	$this->db->query("SELECT * FROM arm_requestepin a , arm_members b WHERE b.MemberId = a.UserId AND a.Status=0 ");
		// $this->db->where($condition);0
		// $this->db->limit(1);
		$query = $this->db->get();
		// echo "<br>". $this->db->last_query();


		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function Getfields($id) {

		$condition = "AllocatedBy =" . "'" . $id . "'";
		
		$this->db->select('*');
		$this->db->from('arm_epin');
		
		$this->db->order_by("EpinRecordId","desc");

		$this->db->where($condition);

		// $this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
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