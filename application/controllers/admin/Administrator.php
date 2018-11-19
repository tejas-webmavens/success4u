<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		// if($this->session->userdata('logged_in')) {
		

			$this->load->helper('url');
			// Load form helper library
			$this->load->helper('form');

			// Load form validation library
			//$this->load->library('form_validation');

			// Load session library
			//$this->load->library('session');

			// Load database
			
			$this->load->model('dashboard_model');
			// $this->config->load('config', FALSE, TRUE);
			// $this->config->set_item('language', 'english');
			// Load language
			$this->lang->load('common');
		} else {
			redirect('admin/login');
		}
		
	}

	

	public function index()
	{
		if($this->session->userdata('logged_in')) {

			$cdetail=$this->common_model->GetRow("Status='1'",'arm_currency');
			$this->data['CurrencySymbol'] =$cdetail->CurrencySymbol;
			$econdition=''; 
			$etableName='arm_product'; 
			$this->data['todayearning'] = $this->common_model->GetRow($econdition, $etableName);

			$this->data['members'] = $this->toprecruiters();

			$comm_condition = "MemberId='1' AND DATE(DateAdded)='".date('Y-m-d')."'";
			$this->data['comm'] = $this->dashboard_model->GetSums($comm_condition, 'arm_history','Debit');

			$order_condition = "isDelete='0' AND DATE(DateAdded)='".date('Y-m-d')."'";
			$this->data['orders'] = $this->dashboard_model->GetSums($order_condition, 'arm_order','OrderTotal');
			
			$member_condition = "isDelete =" . "'0' AND DATE(DateAdded)='".date('Y-m-d')."'";
			$this->data['newmember'] = $this->dashboard_model->GetNewMembersTotal($member_condition);

			$bal_condition = "MemberId='1'";
			$this->data['balance'] = $this->dashboard_model->GetBalance($bal_condition, 'arm_history','Balance');
			$this->data['matrixsetting']=$this->common_model->GetRow('MatrixStatus=1',"arm_matrixsetting");



			// print_r($this->data['comm']);

			// $recruiter_condi='';
			// $this->data['recruiters'] = $this->dashboard_model->DashResults($recruiter_condi, 'arm_members', '10', '0');

			// $earner_condi='';
			// $this->data['earners'] = $this->dashboard_model->DashResults($recruiter_condi, 'arm_members', '10', '0');

			// $puchase_condi='DISTINCT(MemberId), OrderTotal';
			$query = $this->db->query("SELECT DISTINCT(MemberId), OrderTotal FROM arm_order ORDER BY OrderTotal  DESC LIMIT 0, 5", FALSE);
			// $query = $this->db->get('arm_order');
			$this->data['purchased'] = $query->result();
			
			$query = $this->db->query("SELECT MemberId, sum(Credit) as earns FROM arm_history WHERE TypeId IN(4,5) GROUP BY MemberId ORDER BY MemberId DESC LIMIT 0, 10", FALSE);
			$this->data['earners'] = $query->result();

			$income_query = $this->db->query("SELECT MONTH(DateAdded) as mon, sum(Credit) as credit FROM arm_history WHERE MemberId='1' GROUP BY MONTH(DateAdded)");
			$this->data['income_data'] = $income_query->result();
			
			for($i=1;$i<=12;$i++) {
				$dummy_data[$i] = "0.00";
			}
			
			$credit_data = '';
			foreach ($this->data['income_data'] as $row) {

				if($row->mon) {
					$credit_data = ($row->credit) ? $row->credit : "0.00";
					$ins_data[$row->mon] = $credit_data;
				}
				
			}
			if(isset($ins_data)) {
				$ins_data1 = array_replace($dummy_data, $ins_data);
				$this->data['income_chart_data'] = implode(',', $ins_data1);
			} else {
				$this->data['income_chart_data'] = implode(',', $dummy_data);
			}

			$outcome_query = $this->db->query("SELECT MONTH(DateAdded) as mon, sum(Debit) as debit FROM arm_history WHERE MemberId='1' GROUP BY MONTH(DateAdded)");
			$this->data['outcome_data'] = $outcome_query->result();
			
			$debit_data = '';
			foreach ($this->data['outcome_data'] as $row) {

				if($row->mon) {
					$debit_data = ($row->debit) ? $row->debit : "0.00";
					$out_data[$row->mon] = $debit_data;
				}
			}
			if(isset($out_data)) {
				$out_data1 = array_replace($dummy_data, $out_data);
				$this->data['outcome_chart_data'] = implode(',', $out_data1);
			} else {
				$this->data['outcome_chart_data'] = implode(',', $dummy_data);
			}

			$this->load->view('admin/dashboard', $this->data);
	    
	    } else {
	    	redirect('admin/login');
	    }
 		
	}
	public function toprecruiters() {
		$members = $this->dashboard_model->GetActiveMember();
		foreach ($members as $member) {
			$recruiter_condi="DirectId='".$member->MemberId."' AND MemberStatus='Active'";
            $total_recur = $this->dashboard_model->DashCount($recruiter_condi, 'arm_members');
            // if($total_recur)
            	$data[$member->MemberId] = $total_recur;
        }
        return $data;
	}
	// public function chenagelang() {
	// 	$langID = $this->uri->segment(4);
		
	// 	$this->session->set_userdata('language', $langID);
	// 	// $this->session->set_userdata('currency_code', strtoupper($currency));
	// }
	
}
