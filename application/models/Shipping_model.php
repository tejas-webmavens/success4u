<?php

Class Shipping_model extends CI_Model {

	public function DeleteShipping() {
		$this->db->where('Status', '0');
      	$delete_status = $this->db->delete('arm_shipping'); 
      	if($delete_status)
      		return true;
      	else
      		return false;
	}

	public function SaveSettings($data, $code) {
		$this->db->where('Page', 'easypost');
		$delete_status = $this->db->delete('arm_setting');
		if($delete_status) {
			foreach ($data as $key => $value) {
				//echo "<br/> value:".$value.',  key:'.$key;
				$status = $this->db->query("INSERT INTO arm_setting SET `Page` = '" . $code . "', `KeyValue` = '" . $key . "', `ContentValue` = '" . $value . "', DateAdded='". date("Y-m-d H:i:s") ."'");
			}

			if($status)
				return 1;
			else
				return 0;
		}
	}

	public function GetSettings($KeyValue='') {

		$condition = "Page =" . "'easypost'";
		if($KeyValue) $condition.=" AND KeyValue='".$KeyValue."'";
		$this->db->select('ContentValue');
		$this->db->from('arm_setting');
		$this->db->where($condition);
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			$st = $query->row();
			return $st->ContentValue;
		} else {
			return false;
		}
	}

}

?>