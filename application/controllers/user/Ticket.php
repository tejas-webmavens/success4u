<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

	public function __construct() {

		parent::__construct();

		if($this->session->userdata('logged_in')) {
		
			// Load database
			
			
			$this->load->model('ticket_model');
			$this->load->model('product_model');

			$this->load->library('pagination');

			// load language
			$this->lang->load('user/ticket',$this->session->userdata('language'));
			$this->lang->load('user/common',$this->session->userdata('language'));
		} else {
			redirect('user');
		}		

	}

	
	
	public function index() {
		
		$MemberId = $this->session->userdata('MemberID');

		$config = array();
		$config['base_url'] = base_url().'user/ticket/ticket/';
		$config['total_rows'] = $this->ticket_model->GetfromTicketsCount($MemberId);
		$config['per_page'] = 10;
		$config['display_pages'] = FALSE;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data['page_title'] = 'inbox';
		$this->data['tickets'] = $this->ticket_model->GetfromTickets($MemberId, $config["per_page"], $page);
		// echo $this->db->last_query();
		$this->data['links'] = $this->pagination->create_links();
		
		$this->load->view('user/ticket/tickets',$this->data);
	}

	public function ticket() {
		
		$MemberId = $this->session->userdata('MemberID');

		$config = array();
		$config['base_url'] = base_url().'user/ticket/ticket/';
		$config['total_rows'] = $this->ticket_model->GetfromTicketsCount($MemberId);
		$config['per_page'] = 10;
		$config['display_pages'] = FALSE;

		$this->data['page_title'] = 'inbox';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$this->data['tickets'] = $this->ticket_model->GetfromTickets($MemberId, $config["per_page"], $page);
		// echo $this->db->last_query();
		$this->data['links'] = $this->pagination->create_links();
		
		$this->load->view('user/ticket/tickets',$this->data);
	}

	public function sent() {

		$MemberId = $this->session->userdata('MemberID');

		$config = array();
		$config['base_url'] = base_url().'user/ticket/sent/';
		$config['total_rows'] = $this->ticket_model->GetsentTicketsCount($MemberId);
		$config['per_page'] = 10;
		$config['display_pages'] = FALSE;
		$this->data['page_title'] = 'sent';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$this->data['tickets'] = $this->ticket_model->GetsentTickets($MemberId, $config["per_page"], $page);

		$this->data['links'] = $this->pagination->create_links();
		
		$this->load->view('user/ticket/tickets',$this->data);
	}

	public function reopen() {

		$MemberId = $this->session->userdata('MemberID');

		$config = array();
		$config['base_url'] = base_url().'user/ticket/reopen/';
		$config['total_rows'] = $this->ticket_model->GetsentTicketsCount($MemberId);
		$config['per_page'] = 10;
		$config['display_pages'] = FALSE;
		$this->data['page_title'] = 'Re open';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$this->data['tickets'] = $this->ticket_model->GetreopenTickets($MemberId, $config["per_page"], $page);

		$this->data['links'] = $this->pagination->create_links();
		
		$this->load->view('user/ticket/tickets',$this->data);
	}

	public function closed() {

		$MemberId = $this->session->userdata('MemberID');

		$config = array();
		$config['base_url'] = base_url().'user/ticket/closed/';
		$config['total_rows'] = $this->ticket_model->GetclosedTicketsCount($MemberId);
		$config['per_page'] = 10;
		$config['display_pages'] = FALSE;
		$this->data['page_title'] = 'closed';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$this->data['tickets'] = $this->ticket_model->GetclosedTickets($MemberId, $config["per_page"], $page);

		$this->data['links'] = $this->pagination->create_links();
		
		$this->load->view('user/ticket/tickets',$this->data);
	}

	public function create() {
		
		// $this->load->view('user/ticket/create');
		if($this->input->post()) {
				
			$this->form_validation->set_rules('ticket_subject', 'TicketSubject', 'trim|required|min_length[8]|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[15]|xss_clean');
			// $this->form_validation->set_rules('users', 'users', 'trim|required|xss_clean');
				
			if ($this->form_validation->run() == TRUE) {

				$field_name = "attachment"; 

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

				}
				 else {
						$upload_files ='';
					}
				// print_r($this->session->userdata('MemberID'));exit;
				$MemberId = $this->session->userdata('MemberID');
					
				// foreach($members as $member) {
				$ticketno = $MemberId.'1'.substr(time(), 0, 5);

				$data = array(
					'TransactionId' => 'TIC'.$ticketno,
					'Subject' => $this->input->post('ticket_subject'),
					'Priority' => '',
					'DateAdded' => date('Y-m-d h:i:s'),
					'Status' => '1'
				);

				$status = $this->common_model->SaveRecords($data, 'arm_ticket');
				$ticketid = $this->db->insert_id();
				$ticketdata = array(
					'TicketId' => $ticketid,
					'SenderId' => $MemberId,
					'MemberId' => '1',
					'Description' => $this->input->post('description'),
					'Attatchement' => ($upload_files) ? $upload_files : '',
					'DateAdded' => date('Y-m-d h:i:s')
				);
				

				$status = $this->common_model->SaveRecords($ticketdata, 'arm_ticket_list');

				if($status){
					$this->session->set_flashdata('success_message', 'Success! tickets Updated');
					redirect('user/ticket');
				} else {
					$this->session->set_flashdata('error_message', 'Failed! tickets not Updated');
					$this->load->view('user/ticket/create');
				}
				
			} else {
				$this->data['users'] = $this->common_model->GetAdmin();
				$this->load->view('user/ticket/create',$this->data);
			}
		}  else {
			$this->data['users'] = $this->common_model->GetAdmin();
			$this->load->view('user/ticket/create',$this->data);
		}
	}

	public function view($TicketId) {
		if($TicketId) {

			if($this->input->post()) {
				
				$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
				if ($this->form_validation->run() == TRUE) {

					$field_name = "attatchement"; 

					if($_FILES[$field_name]['name']) {
						
						$config['upload_path'] = './uploads/ticket/';
						$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xls|txt';
						
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
						'MemberId' => '1',
						'Description' => $this->input->post('description'),
						'DateAdded' => date('Y-m-d h:i:s')
					);
					//print_r($ticketdata);exit;
					$status = $this->common_model->SaveRecords($ticketdata, 'arm_ticket_list');

					if($status){
						$this->session->set_flashdata('success_message', 'Success! tickets Updated');
						redirect('user/ticket');
					} else {
						$this->session->set_flashdata('error_message', 'Failed! tickets not Updated');
						$this->load->view('user/ticket/view');
					}
				} else {
					$this->data['tickets'] = $this->ticket_model->GetTicketRows($TicketId);
					$this->load->view('user/ticket/view',$this->data);
				}
				
			} else {
				$this->data['tickets'] = $this->ticket_model->GetTicketRows($TicketId);
				$this->data['ticket_info'] = $this->ticket_model->GetTicketinfo($TicketId);
				if($this->data['tickets'])
					$this->load->view('user/ticket/view',$this->data);
				else
					redirect('user/ticket');		
			}
		} else {
	    	redirect('user/ticket');
	    }	
		
	}

	public function DeleteAll() {

		
		if($this->input->post('tickets')) {
					
			foreach ($this->input->post('tickets') as $key => $value) {
				$condition = "TicketId =" . "'" . $value . "'";
				$data = array(
					'isDelete' => '1'
				);

				$status = $this->common_model->UpdateRecord($data, $condition, 'arm_ticket');
			}
			if($status) {
				$this->session->set_flashdata('success_message', 'Success! Selected tickets removed');
				redirect('user/ticket');
			} else {
				$this->session->set_flashdata('error_message', 'Failed! Selected tickets not removed');
				redirect('user/ticket');
			}
		} else {
				
			redirect('user/ticket');
		}
	}

	

}
?>