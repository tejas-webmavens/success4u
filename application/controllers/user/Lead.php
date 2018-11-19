<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lead extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {

		parent::__construct();

		if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {

		// Load database
		
		$this->load->model('admin/Leadcapture_model');
	
		$this->lang->load('user/lead',$this->session->userdata('language'));
		$this->lang->load('user/common',$this->session->userdata('language'));
		
		}  else {
	    	redirect('login');
	    }
	}

	public function index() {

		$condition="RefId='".$this->session->MemberID."' Order by LeadId DESC";
		$this->data['leads'] = $this->common_model->GetResults($condition,'arm_lead_member');
		$this->load->view('user/leads',$this->data);

	}

	public function links() {

		$this->data['leadpage'] = $this->Leadcapture_model->Getfields();
		$this->data['member'] = $this->common_model->GetCustomer($this->session->MemberID);
		$this->load->view('user/leadlink', $this->data);
		
	}

	public function view($LeadId) {


		$condition = "LeadId=".$LeadId;
		$this->data['lead'] = $this->common_model->GetRow($condition,'arm_lead_member');
		$this->load->view('user/editlead',$this->data);

	}

	public function status() {
		if($this->input->post()) {

			$condition = "LeadId =" . "'" . $this->input->post('LeadId') . "'";

			$data = array(
				'Status' => $this->input->post('lead_status')
			);

			$status = $this->common_model->UpdateRecord($data, $condition, 'arm_lead_member');
			if($status) {
				redirect('user/lead');
			}
		} else {
			redirect('user/lead');
		}
	}


	
	
}
