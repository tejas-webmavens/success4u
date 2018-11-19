<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function index() {
		$this->load->model('common_model');
		
		$siteset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitestatus'", "arm_setting");

		if($siteset->ContentValue=="Off") {
			redirect("offsite"); exit;
		}

		//set referral details
		if($this->input->get('ref'))
		{
			$membercheckdet = $this->common_model->GetRow("ReferralName='".$this->input->get('ref')."'","arm_members");
			if($membercheckdet)
			{
				$this->session->unset_userdata('referral_name');
				$this->session->unset_userdata('referral_id');
				$this->session->set_userdata("referral_name",$this->input->get('ref'));
				$this->session->set_userdata("referral_id",$membercheckdet->MemberId);
			}	
		}
		$this->data['pagename'] = 'home';
		$this->load->view('custom/index', $this->data);

	}
	
}
