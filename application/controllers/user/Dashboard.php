<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

			// $this->load->helper('url');
			// // Load form helper library
			// $this->load->helper('form');

			// // Load form validation library
			// $this->load->library('form_validation');

			// // Load session library
			// $this->load->library('session');
			
				

			$this->load->helper('cookie');

			// Load database
			
			$this->load->model('ticket_model');
			$this->load->model('dashboard_model');
			$this->load->model('order_model');
			$this->load->model('admin/Leadcapture_model');
			//$this->load->model('user/fund_model');
			$this->lang->load('dashboard',$this->session->userdata('language'));
				
			$this->lang->load('user/common',$this->session->userdata('language'));

			

		}  else {
	    	redirect('login');
	    }
	}


	public function index()
	{
		

		if($this->session->userdata('logged_in')) 
		{
			$userid = $this->session->MemberID;
			$this->data['leadpage'] = $this->Leadcapture_model->Getfields();
			$this->data['member'] = $this->common_model->GetCustomer($userid);

			$condition1 = "MemberId='".$userid."' AND Status!='paid'";
			$this->data['latestorders'] = $this->dashboard_model->DashResults($condition1,'arm_order','7', '0');

			// $condition2 = "MemberId='".$this->session->MemberID."' AND Status='paid'";
			// $this->data['purchased'] = $this->common_model->GetResults($condition2,'arm_order','*');
			$condition2 = "o.MemberId =" . "'" . $userid . "' AND Status='paid'";
			$this->data['purchased'] = $this->order_model->GetOrders($condition2);
			// $this->data['purchased'] = $this->common_model->GetCustomer($this->session->MemberID);

			// list spilliover
			$ucondition = "SpilloverId = '".$userid."'";
			$membermatsts = $this->common_model->GetRow("MatrixStatus='1'", 'arm_matrixsetting');
			
			if($membermatsts->Id==2)
			{
				$table = "arm_unilevelmatrix";
				$ptableName ="arm_package";
			}
			else if($membermatsts->Id==3)
			{
				$table = "arm_monolinematrix";
				$mndet = $this->common_model->GetRow("MemberId='".$userid."' order by MonoLineId asc limit 0,1", 'arm_monolinematrix');
				$ucondition = "SpilloverId = '".$mndet->MonoLineId."'";
				$ptableName ="arm_package";
			
			}
			else if($membermatsts->Id==4)
			{
				$table = "arm_binarymatrix";
				$ptableName ="arm_pv"; 
			}

			else if($membermatsts->Id==5)
			{
				$ptableName ="arm_boardplan";
				$table = "arm_boardmatrix";
				$brddet = $this->common_model->GetRow("MemberId='".$userid."' order by BoardMemberId asc limit 0,1", 'arm_boardmatrix');
				$ucondition = "SpilloverId = '".$brddet->BoardMemberId."'";
			}
			else if($membermatsts->Id==6)
			{
				$table = "arm_xupmatrix";
				$ptableName ="arm_package";
			}
			else
			{	
				$ptableName ="arm_package";
				$table = "arm_forcedmatrix";
			}

			$this->data['package']=$this->common_model->GetRow("PackageId='".$this->data['member']->PackageId."'",$ptableName);
							
			$this->data['total_spillover'] = $this->common_model->GetRowCount($ucondition,$table);
			$this->data['spillovers'] = $this->dashboard_model->DashResults($ucondition,$table, '8', '0');
			
			$condition3 = "Status='2'";
			$this->data['news'] = $this->dashboard_model->DashResults($condition3,"arm_news", '5', '0');

			$this->data['tickets'] = $this->ticket_model->GetfromTickets($userid, '4', '0');
			
			$comm_condition = "MemberId='".$userid."' AND DATE(DateAdded)='".date('Y-m-d')."'";
			$this->data['comm'] = $this->dashboard_model->GetSums($comm_condition, 'arm_history','Debit');

			$order_condition = "isDelete='0' AND DATE(DateAdded)='".date('Y-m-d')."'";
			$this->data['orders'] = $this->dashboard_model->GetSums($order_condition, 'arm_order','OrderTotal');
			
			$member_condition = "isDelete =" . "'0' AND DATE(DateAdded)='".date('Y-m-d')."'";
			$this->data['newmember'] = $this->dashboard_model->GetNewMembersTotal($member_condition);

			$bal_condition = "MemberId='".$userid."'";
			$this->data['balance'] = $this->dashboard_model->GetBalance($bal_condition, 'arm_history','Balance');

			$income_query = $this->db->query("SELECT MONTH(DateAdded) as mon, sum(Credit) as credit FROM arm_history WHERE MemberId='".$userid."' AND TypeId IN('4','5','15','18') GROUP BY MONTH(DateAdded)");
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
			
			$outcome_query = $this->db->query("SELECT MONTH(DateAdded) as mon, sum(Debit) as debit FROM arm_history WHERE MemberId='".$userid."' AND TypeId NOT IN('4','5','15','18') GROUP BY MONTH(DateAdded)");
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

			$this->load->view('user/dashboard', $this->data);

		}
		else 
		{
			redirect('user/login');
		}
		
	}
	public function newsadd() {
		if($this->input->post()) {
				
			$this->form_validation->set_rules('subject', 'subject', 'trim|required|min_length[5]|xss_clean');
			$this->form_validation->set_rules('message', 'message', 'trim|required|min_length[15]|xss_clean');

			if ($this->form_validation->run() == TRUE) {

				$field_name = "image"; 

				if($_FILES[$field_name]['name']) {
					
					$config['upload_path'] = './uploads/news/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload($field_name)) {
						
						//$this->session->set_flashdata('error_message', $this->upload->display_errors());
						
					} else {
						$upload_files = $this->upload->data('file_name');
					}
				}

					$data = array(
						'MemberId' => $this->input->post('category_name'),
						'Image' => ($upload_files) ? $upload_files : '',
						'Subject' => $this->input->post('ParentId'),
						'Message' => $this->input->post('SortOrder'),
						'Status' => '0',
						'StartDate' =>  date('Y-m-d h:i:s')
					);
					$status = $this->common_model->SaveRecords($data, 'arm_news');
			} else {
				redirect('user/dashboard');
			}
		} else {
			redirect('user/dashboard');
		}
	}

	public function reports()
	{

		// echo "['income', 2150, 1180, 1190, 1000, 1070, 1800, 1150, 1180, 1190, 1000, 1070, 1800],
  //                   ['expenses', 910, 3020, 760, 1080, 850, 940, 910, 1020, 760, 1080, 850, 940]";
	      
		$userid = $this->session->MemberID;
		$in_condition = "MemberId='".$userid."' AND TypeId IN('4','5','15','18')";
		$this->data['income'] = $this->dashboard_model->DashResults($in_condition, 'arm_history','10', '0');
		// $this->data['income'] = $this->dashboard_model->GetSums($in_condition, 'arm_history','Debit');

		$out_condition = "MemberId='".$userid."' AND TypeId NOT IN('4','5','15','18')";
		$this->data['outgoes'] = $this->dashboard_model->DashResults($in_condition, 'arm_history','10', '0');
		// $this->data['outgoes'] = $this->dashboard_model->GetSums($out_condition, 'arm_history','Credit');
		$data1 = array();

		//{y: '2011 Q3', item1: 523.0000, item2: 54.0000},

		$i = 1;
		$income_total = 0;
		foreach ($this->data['income'] as $income) {
			$income_total = $income_total + $income->Credit;
			$years = date('Y',strtotime($income->DateAdded))." Q".$i++;
			$data1[] = "{y: '".$years."', item1: ".$income->Credit.", item2: ".$income->Debit."}";
			// $data1['Y'] = date('Y',strtotime($income->DateAdded))." Q".$i++;
			// $data1['item1'] = $income->Credit;
			// $data1['item2'] = $income->Debit;
			
		}

		// $i = 1;
		// $expens_total = 0;
		// foreach ($this->data['outgoes'] as $expens) {
		// 	$expens_total = $expens_total + $expens->Debit;
		// 	$data1['Y'] = date('Y',strtotime($expens->DateAdded))." Q".$i++;
		// 	$data1['item1'] = $expens->Credit;
		// 	$data1['item2'] = $expens->Debit;
			
		// }
		// $doun = '{label: "Income", value: '.$income_total.'},';
		// $doun .= '{label: "Expense", value: '.$expens_total.'}';
		// echo $doun;
		// echo json_encode($data1);
		echo $jsondata = str_replace('"','',json_encode($data1));

		// $item1 = $this->data['income']

	}
	

	
}
