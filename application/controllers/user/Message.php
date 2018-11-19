<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct() {

		parent::__construct();

		if($this->session->userdata('logged_in')) {
		
			// Load database
			
			
			$this->load->model('message_model');


			$this->load->library('pagination');

			// load language
			$this->lang->load('user/message',$this->session->userdata('language'));
			$this->lang->load('user/common',$this->session->userdata('language'));
		} else {
			redirect('user');
		}		

	}

	
	public function index() {

		$MemberId = $this->session->userdata('MemberID');

		$config = array();
		$config['base_url'] = base_url().'user/message/message';
		$config['total_rows'] = $this->message_model->GetfromMessagesCount($MemberId);
		$config['per_page'] = 10;
		$config['display_pages'] = FALSE;

		$this->data['page_title'] = 'inbox';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$this->data['messages'] = $this->message_model->GetfromMessages($MemberId, $config["per_page"], $page);

		$this->data['links'] = $this->pagination->create_links();
		
		$this->load->view('user/message/messages',$this->data);
	}

	public function message() {

		$MemberId = $this->session->userdata('MemberID');

		$config = array();
		$config['base_url'] = base_url().'user/message/';
		$config['total_rows'] = $this->message_model->GetfromMessagesCount($MemberId);
		$config['per_page'] = 10;
		$config['display_pages'] = FALSE;

		$this->data['page_title'] = 'inbox';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$this->data['messages'] = $this->message_model->GetfromMessages($MemberId, $config["per_page"], $page);

		$this->data['links'] = $this->pagination->create_links();
		
		$this->load->view('user/message/messages',$this->data);
	}

	public function sent() {

		$MemberId = $this->session->userdata('MemberID');

		$config = array();
		$config['base_url'] = base_url().'user/message/sent';
		$config['total_rows'] = $this->message_model->GetsentMessagesCount($MemberId);
		$config['per_page'] = 10;
		$config['display_pages'] = FALSE;
		$this->data['page_title'] = 'sent';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$this->data['messages'] = $this->message_model->GetsentMessages($MemberId, $config["per_page"], $page);

		$this->data['links'] = $this->pagination->create_links();
		
		$this->load->view('user/message/messages',$this->data);
	}

	public function trash() {

		$MemberId = $this->session->userdata('MemberID');

		$config = array();
		$config['base_url'] = base_url().'user/message/trash';
		$config['total_rows'] = $this->message_model->GettrashMessagesCount($MemberId);
		$config['per_page'] = 10;
		$config['display_pages'] = FALSE;
		$this->data['page_title'] = 'trash';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$this->data['messages'] = $this->message_model->GettrashMessages($MemberId, $config["per_page"], $page);

		$this->data['links'] = $this->pagination->create_links();
		
		$this->load->view('user/message/messages',$this->data);
	}
	

	public function create() {
		
		// $this->load->view('user/message/create');
		if($this->input->post()) {
				
			$this->form_validation->set_rules('message_subject', 'messageSubject', 'trim|required|min_length[5]|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[15]|xss_clean');
			$this->form_validation->set_rules('users', 'users', 'trim|required|xss_clean');
				
			if ($this->form_validation->run() == TRUE) {

				if($this->input->post('users')) {
					$member = $this->input->post('users');

					$field_name = "attachment"; 

					if($_FILES[$field_name]['name']) {
						
						$config['upload_path'] = './uploads/message/';
						$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|txt';
						$config['encrypt_name'] = TRUE;
						

						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload($field_name)) {
							
							$this->session->set_flashdata('error_message', $this->upload->display_errors());
							
						} else {
							$upload_files = $this->upload->data('file_name');
						}
					} else {
						$upload_files = '';
					}
					
					$MemberId = $this->session->userdata('MemberID');

					$data = array(
						'SenderId' => $MemberId,
						'MemberId' => $member,
						'Subject' => $this->input->post('message_subject'),
						'Message' => $this->input->post('description'),
						'Attatchement' => ($upload_files) ? $upload_files : '',
						'DateAdded' => date('Y-m-d h:i:s'),
						'Status' => '1'
					);

					$status = $this->common_model->SaveRecords($data, 'arm_mailbox');
						
				}

				if($status){
					$this->session->set_flashdata('success_message', 'Success! messages Updated');
					redirect('user/message');
				} else {
					$this->session->set_flashdata('error_message', 'Failed! messages not Updated');
					$this->load->view('user/message/create');
				}
				
			} else {
				$this->data['users'] = $this->common_model->GetCustomers();
				$this->load->view('user/message/create',$this->data);
			}
		}  else {
			$this->data['users'] = $this->common_model->GetCustomers();
			$this->load->view('user/message/create',$this->data);
		}
	}

	public function read($messageId) {
		if($messageId) {

			if($this->input->post()) {
				
				$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
				if ($this->form_validation->run() == TRUE) {

					$field_name = "attatchement"; 

					if($_FILES[$field_name]['name']) {
						
						$config['upload_path'] = './uploads/message/';
						$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xls|txt';
						
						$config['encrypt_name'] = TRUE;
						

						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload($field_name)) {
							
							//$this->session->set_flashdata('error_message', $this->upload->display_errors());
							
						} else {
							$upload_files = $this->upload->data('file_name');
						}
					}

					$messagedata = array(
						'messageId' => $messageId,
						'SenderId' => $this->session->userdata('MemberID'),
						'Attatchement' => ($upload_files) ? $upload_files : '',
						'MemberId' => $this->input->post('SenderId'),
						'Description' => $this->input->post('description'),
						'DateAdded' => date('Y-m-d h:i:s')
					);
					//print_r($messagedata);exit;
					$status = $this->common_model->SaveRecords($messagedata, 'arm_mailbox');

					if($status){
						$this->session->set_flashdata('success_message', 'Success! messages Updated');
						redirect('user/message');
					} else {
						$this->session->set_flashdata('error_message', 'Failed! messages not Updated');
						$this->load->view('user/message/create');
					}
				} else {
					$this->data['messages'] = $this->message_model->GetmessageRows($messageId);
					$this->load->view('user/message/view',$this->data);
				}
				
			} else {
				$this->data['messages'] = $this->message_model->GetMessageRows($messageId);
				if($this->data['messages'])
					$this->load->view('user/message/read',$this->data);
				else
					redirect('user/message');		
			}
		} else {
	    	redirect('user/message');
	    }	
		
	}

	public function DeleteAll() {
		if($this->input->post('message')) {
			foreach ($this->input->post('message') as $key => $value) {
				$condition = "MailId =" . "'" . $value . "'";
				$data = array(
					'isDelete' => '1'
				);

				$status = $this->common_model->UpdateRecord($data, $condition, 'arm_mailbox');
			}
			
			if($status) {
				$this->session->set_flashdata('success_message', 'Success! Selected message removed');
				redirect('user/message');
			} else {
				$this->session->set_flashdata('error_message', 'Failed! Selected message not removed');
				redirect('user/message');
			}
		} else {
			redirect('user/message');
		}
	}

	

}
?>