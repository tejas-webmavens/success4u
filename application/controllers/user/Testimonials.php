<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
			// Load database
			
			$this->load->model('admin/testimonial_model');
			

			$this->load->library('pagination');

			// load language
			$this->lang->load('user/testimonial',$this->session->userdata('language'));
        	$this->lang->load('user/common',$this->session->userdata('language'));

	}

	public function index() {
		if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {
			$MemberId = $this->session->userdata('MemberID');

			$config = array();
			$config['base_url'] = base_url().'user/testimonials/';
			$config['total_rows'] = $this->testimonial_model->TestimonialCount($MemberId);
			$config['per_page'] = 10;
			$config['display_pages'] = FALSE;

			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

			$this->data['testimonial'] = $this->testimonial_model->GetTestimonial($MemberId, $config["per_page"], $page);

			$this->data['links'] = $this->pagination->create_links();
			
			$this->load->view('user/testimonials/testimonials',$this->data);
		} else {
			redirect('user');
		}

	}

	public function create($TestimonialId='') {
		if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {
			if($this->input->post())
			{
			
				$this->form_validation->set_rules('subject', 'subject', 'trim|required');
				$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[50]');

				if ($this->form_validation->run() == TRUE) {

					$field_name = "image_file"; 

					if($_FILES[$field_name]['name']) {
						
						$config['upload_path'] = './uploads/testimonial/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						// $config['max_size']	= '2';
						$config['encrypt_name'] = TRUE;

						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload($field_name)) {
							
							// $this->session->set_flashdata('error_message', $this->upload->display_errors());
							
						} else {
							$upload_files = $this->upload->data('file_name');
						}
					}

					if($this->input->post('TestimonialId')) {
						
						$data = array(
							'Subject'	=>	$this->input->post('subject'),
							'Message'	=>	urlencode($this->input->post('description'))
						);

						if(isset($upload_files))
							$data['UserLogo'] = $upload_files;

						$condition = "TestimonialId =" . "'" . $this->input->post('TestimonialId') . "'";
						
						$status = $this->common_model->UpdateRecord($data, $condition, 'arm_testimonial');
						
						// echo $this->db->last_query();exit;
					}  else {
						
						$data = array(
							'MemberId'	=>	$this->session->userdata('MemberID'),
							'Subject'	=>	$this->input->post('subject'),
							'Message'	=>	urlencode($this->input->post('description')),
							'Status'	=>	'3',
							'DateAdded'	=>	date('Y-m-d H:i:s')
						);

						if(isset($upload_files))
							$data['UserLogo'] = $upload_files;
				
						$status = $this->common_model->SaveRecords($data,'arm_testimonial');
					}

					if($status){
						$this->session->set_flashdata('success_message', 'Success! Testimonials Updated');
						redirect('user/testimonials');
					} else {
						$this->session->set_flashdata('error_message', 'Failed! Testimonials not Updated'.$this->upload->display_errors());
						redirect('user/testimonials');		
					}

				}  else {
					// $this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->load->view('user/testimonials/create');
				}
			}
			else
			{
				if($TestimonialId) {
					$condition = "TestimonialId =" . "'" . $TestimonialId . "'";
					$this->data['testimonial'] = $this->common_model->GetRow($condition, 'arm_testimonial');
					$this->load->view('user/testimonials/create', $this->data);
				} else {
					$this->load->view('user/testimonials/create');
				}
			} 
		} else {
			redirect('user');
		}
	}

	public function delete($TestimonialId) {
		if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) { 
			$condition = "TestimonialId =" . "'" . $TestimonialId . "'";
			$status = $this->common_model->DeleteRecord($condition, 'arm_testimonial');
			if($status) {
				$this->session->set_flashdata('success_message',$this->lang->line('successmessagedel'));
				redirect('user/testimonials');
			}
		} else {
			redirect('user');
		}
	}

	public function view(){
		$this->load->model('admin/testimonial_model');
		$this->data['testimonial'] = $this->testimonial_model->GetTestimonialall();
		$this->load->view('user/viewtestimonial',$this->data);
	}


}


?>