<?php

Class Page_model extends CI_Model {

	public function GetPage($default_language) {

		$this->db->select('p.*, l.LanguageName');
		$this->db->from('arm_cms_page p');
		$this->db->join('arm_language l', 'l.LanguageId = p.LanguageId');
		$this->db->where('p.IsDelete','0');
		$this->db->where('l.LanguageName',$default_language);
		// echo $this->db->last_query();
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function GetpageContent($pageID, $default_language) {
		
		$this->db->select('*');
		$this->db->from('arm_cms_page p');
		$this->db->join('arm_language l', 'l.LanguageId = p.LanguageId');
		$this->db->where('p.IsDelete','0');
		$this->db->where('p.Status','1');
		$this->db->where('l.LanguageName',$default_language);
		$this->db->where('navTitle',$pageID);
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			$row = $query->row();
			return $row;
		} else {
			return false;
		}
	}

   public function GetFaqContent($default_language) {
		
		$this->db->select('*');
		$this->db->from('arm_faq p');
		$this->db->join('arm_language l', 'l.LanguageId = p.LanguageId');
		$this->db->where('p.IsDelete','0');
		$this->db->where('l.LanguageName',$default_language);
		$this->db->where('p.Status','1');
		
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			$row = $query->result();
			return $row;
		} else {
			return false;
		}
	}

	 public function GetNewsContent($default_language) {
		
		$this->db->select('*');
		$this->db->from('arm_news p');
		$this->db->join('arm_language l', 'l.LanguageId = p.LanguageId');
		$this->db->where('p.IsDelete','0');
		$this->db->where('l.LanguageName',$default_language);
		$this->db->where('p.Status','1');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			$row = $query->result();
			return $row;
		} else {
			return false;
		}
	}

}

?>