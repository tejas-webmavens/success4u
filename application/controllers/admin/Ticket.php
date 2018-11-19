<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if($this->session->userdata('admin_login')) {
		
			// Load database
			
			$this->load->model('ticket_model');
			
			$this->load->library('pagination');
			// change language
			//$this->config->set_item('language', 'spanish');

			// load language
			$this->lang->load('ticket');
			$this->IsAdmin();
		
		} else {
			redirect('admin/login');
		}

	}

	protected function IsAdmin() {
		
		$userid = $this->session->userdata('MemberID');
		$userlevel = $this->session->userdata('UserLevel');
		if($userlevel==2) {
			$controller = $this->router->fetch_class();
			$access_list_data = $this->common_model->Subadminaccess($userid,$userlevel);
			
			$pages = json_decode($access_list_data->access_list);
			
			if(!in_array(ucfirst($controller), $pages)) {
				redirect('admin');		
			} 
		}
	}
	
	public function index()
	{
 		
		$MemberId = $this->session->userdata('MemberID');

		$config = array();
		$config['base_url'] = base_url().'admin/ticket/ticket/';
		$config['total_rows'] = $this->ticket_model->GetTicketsCount($MemberId);
		$config['per_page'] = 10;
		$config['display_pages'] = FALSE;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$this->data['tickets'] = $this->ticket_model->GetTickets($MemberId, $config["per_page"], $page);

		$this->data['links'] = $this->pagination->create_links();
		// echo $this->db->last_query();
		
		$this->load->view('admin/ticket/ticket',$this->data);
	    
	}
	
	public function ticket()
	{
 		
		$MemberId = $this->session->userdata('MemberID');

		$config = array();
		$config['base_url'] = base_url().'admin/ticket/ticket/';
		$config['total_rows'] = $this->ticket_model->GetTicketsCount($MemberId);
		$config['per_page'] = 10;
		$config['display_pages'] = FALSE;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$this->data['tickets'] = $this->ticket_model->GetTickets($MemberId, $config["per_page"], $page);

		$this->data['links'] = $this->pagination->create_links();
		// echo $this->db->last_query();
		
		$this->load->view('admin/ticket/ticket',$this->data);
	    
	}
	public function view($TicketId='') {
		
		if($TicketId) {

			if($this->input->post()) {
				
				$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
				if ($this->form_validation->run() == TRUE) {

					$field_name = "attatchement"; 

					if($_FILES[$field_name]['name']) {
						
						$config['upload_path'] = './uploads/ticket/';
						$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xls|txt';
						// $config['max_size']	= '100';
						// $config['max_width']  = '1024';
						// $config['max_height']  = '768';
						$config['encrypt_name'] = TRUE;
						

						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload($field_name)) {
							
							//$this->session->set_flashdata('error_message', $this->upload->display_errors());
							
						} else {
							$upload_files = $this->upload->data('file_name');
						}
					} else {
						$upload_files = "";
					}

					$ticketdata = array(
						'TicketId' => $TicketId,
						'SenderId' => $this->session->userdata('MemberID'),
						'Attatchement' => ($upload_files) ? $upload_files : '',
						'MemberId' => $this->input->post('SenderId'),
						'Description' => $this->input->post('description'),
						'DateAdded' => date('Y-m-d h:i:s')
					);
					//print_r($ticketdata);exit;
					$status = $this->common_model->SaveRecords($ticketdata, 'arm_ticket_list');

					if($status){
						$this->session->set_flashdata('success_message', 'Success! tickets Updated');
						redirect('admin/ticket');
					} else {
						$this->session->set_flashdata('error_message', 'Failed! tickets not Updated');
						$this->load->view('admin/ticket/addticket');
					}
				} else {
					$this->data['tickets'] = $this->ticket_model->GetTicketRows($TicketId);
					$this->data['ticket_info'] = $this->ticket_model->GetTicketinfo($TicketId);
					$this->load->view('admin/ticket/view',$this->data);
				}
				
			} else {
				$this->data['tickets'] = $this->ticket_model->GetTicketRows($TicketId);
				$this->data['ticket_info'] = $this->ticket_model->GetTicketinfo($TicketId);
				if($this->data['tickets'])
					$this->load->view('admin/ticket/view',$this->data);
				else
					redirect('admin/ticket');		
			}
		} else {
	    	redirect('admin/ticket');
	    }	
	}

	public function search(){
		
		if($this->input->post()) 
		{
			//print_r($this->input->post());

			$condition = "isDelete= '0'";

			if($this->input->post('ticketname'))
				//$url .= '&FirstName=' . $this->input->post('firstname');
				$condition .= " AND ticketName LIKE" . "'%" . $this->input->post('ticketname') . "%'";

			if($this->input->post('ticket_type'))
				//$url .= '&UserName=' . $this->input->post('username');
				 $condition .= " AND ticketType =" . "'" . $this->input->post('ticket_type') . "'";

			if($this->input->post('ticket_category'))
				$condition .= " AND CatId =" . "'" . $this->input->post('ticket_category') . "'";

			if($this->input->post('status'))
				$condition .= " AND Status =" . "'" . $this->input->post('status') . "'";

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(DateAdded) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";
			
			$this->data['category'] = $this->ticket_model->GetCategory();
			$this->data['product'] = $this->product_model->GetProducts();
			$this->data['tickets'] = $this->common_model->GetResults($condition, 'arm_ticket', '*');
			
			$this->load->view('admin/products/tickets', $this->data);
			
		} else {
			//$this->session->set_flashdata('error_message', 'Enter field value to search');
			redirect('admin/ticket');
		}
	}

	public function add(){

		if($this->input->post()) {
				
			$this->form_validation->set_rules('ticketsubject', 'Ticketsubject', 'trim|required|min_length[8]|xss_clean');
			$this->form_validation->set_rules('ticketpriority', 'Ticketpriority', 'trim|required|xss_clean');
			$this->form_validation->set_rules('ticketdesc', 'Ticket Description', 'trim|required|xss_clean');
			$this->form_validation->set_rules('users[]', 'users', 'trim|required|xss_clean');
				
			if ($this->form_validation->run() == TRUE) {

				if($this->input->post('users')) {
					$members = $this->input->post('users');

					foreach($members as $member) {
						$ticketno = $this->session->userdata('MemberID').''.$member.''.substr(time(), 0, 5);

						$data = array(
							'TransactionId' => 'TIC'.$ticketno,
							'Subject' => $this->input->post('ticketsubject'),
							'Priority' => $this->input->post('ticketpriority'),
							'Status' => $this->input->post('per_user'),
							'DateAdded' => date('Y-m-d h:i:s'),
							'Status' => '1'
						);
						
						$status = $this->common_model->SaveRecords($data, 'arm_ticket');
						$ticketid = $this->db->insert_id();
						$ticketdata = array(
							'TicketId' => $ticketid,
							'SenderId' => $this->session->userdata('MemberID'),
							'MemberId' => $member,
							'Description' => $this->input->post('ticketdesc'),
							'DateAdded' => date('Y-m-d h:i:s')
						);
						$status = $this->common_model->SaveRecords($ticketdata, 'arm_ticket_list');
					}
				}

				if($status){
					$this->session->set_flashdata('success_message', 'Success! tickets Updated');
					redirect('admin/ticket');
				} else {
					$this->session->set_flashdata('error_message', 'Failed! tickets not Updated');
					$this->load->view('admin/ticket/addticket');
				}
				
			} else {
				$this->data['users'] = $this->common_model->GetCustomers();
				$this->load->view('admin/ticket/addticket',$this->data);
			}
		}  else {
			$this->data['users'] = $this->common_model->GetCustomers();
			$this->load->view('admin/ticket/addticket',$this->data);
		}
	}
	
	public function delete($ticketId) {
		$condition = "ticketId =" . "'" . $ticketId . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_ticket');
		$status = $this->common_model->DeleteRecord($condition, 'arm_ticket_list');

		if($status) {
			$this->session->set_flashdata('success_message', 'Success! ticket Removed');
			redirect('admin/ticket');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! ticket Not Removed');
			redirect('admin/ticket');
		}
		
	}

	public function open($TicketId) {
		$condition = "TicketId =" . "'" . $TicketId . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_ticket');
		if($status) {
			redirect('admin/ticket');
		}
	}

	public function close($TicketId) {
		$condition = "TicketId =" . "'" . $TicketId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_ticket');
		if($status) {
			redirect('admin/ticket');
		}
	}

	public function progress($TicketId) {
		$condition = "TicketId =" . "'" . $TicketId . "'";

		$data = array(
			'Status' => '2'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_ticket');
		if($status) {
			redirect('admin/ticket');
		}
	}

	public function closeall() {

		if($this->input->post('tickets')) {
			foreach ($this->input->post('tickets') as $key => $value) {
				$condition = "TicketId =" . "'" . $value . "'";
				$data = array(
					'Status' => '0'
				);

				$status = $this->common_model->UpdateRecord($data, $condition, 'arm_ticket');
			}
			
			if($status) 
				redirect('admin/ticket');
		} else {
			redirect('admin/ticket');
		}
	}

}
