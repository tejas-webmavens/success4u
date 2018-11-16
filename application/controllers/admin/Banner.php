<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {


	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		$this->load->model('admin/Generalsetting_model');
		// $this->lang->load('generalsetting');
		$this->lang->load('banner');

		
		}  else {
	    	redirect('admin/login');
	    }

	} //function ends

	public function index()
	{
			
				
				$condition = '';
				$tableName = 'arm_bannerimage';
				// $this->data['category'] = $this->product_model->GetCategory();
				$this->data['banner'] = $this->common_model->GetResults($condition,$tableName,'*');
				$this->load->view('admin/banner',$this->data);
 		

	}//function ends


	public function addbanner()
	{

		// $this->data['banners']=$this->common_model->GetResults()
		if($this->input->post())
		{
			
			$data = array(
				 'banner_name'=>$this->input->post('imgname'),

				'description'=>$this->input->post('sitemetadescription'),
				'status'=>$this->input->post('sitestatus'),

				
			);

			if(isset($_FILES['sitelogo']['name'])!='')
			{
				$config['upload_path'] = 'uploads/banner/';
				$config['allowed_types'] = '*';
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('sitelogo')) {
					
					$this->session->set_flashdata('error_message', $this->upload->display_errors());
				// $data['sitelogo']=$this->Generalsetting_model->Getsite('sitelogo');

					
				} else {
				
				$upload_files1 = $this->upload->data('file_name');
				$data['banner_image'] = 'uploads/banner/'.$upload_files1;

					
				}
		
			}
			$result=$this->common_model->SaveRecords($data,"arm_bannerimage");

				



			if($result)
			{
				$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
				redirect('admin/banner');

			}
			else
			{
				$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
				redirect('admin/banner');
			}
				
			
		}
		else
		{
			$this->load->view('admin/addbanner');
		}

	}

	public function edit($id='')
	{
		if($id)
		{
		    $condition = "banner_id =" . "'" . $id . "'";
			$this->data['product'] = $this->common_model->EditProduct($id);

			// print_r($this->data['product']);
			// exit;
			$this->load->view('admin/editbanner', $this->data);

			if($this->input->post())
			{
				// echo "jjj";
				// exit;
				$data = array(
					 'banner_name'=>$this->input->post('imgname'),

					'description'=>$this->input->post('sitemetadescription'),
					'status'=>$this->input->post('sitestatus')
	 
				);

				if(isset($_FILES['sitelogo']['name'])!='')
				{
					$config['upload_path'] = 'uploads/banner/';
					$config['allowed_types'] = '*';
					$config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('sitelogo')) {
						
						// $this->session->set_flashdata('error_message', $this->upload->display_errors());
					 $data['banner_image']=$this->data['product']->banner_image;

						
					} else {
					
					$upload_files1 = $this->upload->data('file_name');
					$data['banner_image'] = 'uploads/banner/'.$upload_files1;

						
					}
			
				}
				$cond="banner_id='".$id."'";
				$update=$this->common_model->UpdateRecord($data,$cond,"arm_bannerimage");
				if($update)
				{
					$this->session->set_flashdata('success_message',"Successfully Banner Image updated");
					redirect('admin/banner');

				}
				else
				{
				$this->session->set_flashdata('error_message',"Sorry banner not updated");
					redirect('admin/banner');
				

				}

			}

		}

	}

	public function delete($id)
   {
	$condition = "banner_id =" . "'" . $id . "'";
	$status = $this->common_model->DeleteRecord($condition, 'arm_bannerimage');

	if($status) {
		$this->session->set_flashdata('success_message', 'Success! Banner Removed');
		redirect('admin/banner');
	} else {
		$this->session->set_flashdata('error_message', 'Failed! banner Not Removed');
		redirect('admin/banner');
	}
	
}

} 
//class ends


