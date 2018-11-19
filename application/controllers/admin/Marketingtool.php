<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketingtool extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/Marketingtool_model');
		$this->lang->load('marketingtool');
		
		}  else {
	    	redirect('admin/login');
	    }
		
	} //function ends

	

	public function index()
	{
		

		if($this->session->userdata('logged_in')) {
			if($this->input->post('inputname')) {
				if($this->input->post('active'))
				{
					print_r($this->input->post());
					exit;
				} else {
					foreach ($this->input->post('inputname') as $customer_id) {
						print_r($this->input->post());
						//$status = $this->Packagesetting_model->DeletePackage($package_id);
					}
					
					if($status) {
						redirect('admin/marketinglist');
					}
				}
			} else {
				$this->data['field'] = $this->Marketingtool_model->Getfields();
				$this->load->view('admin/marketinglist', $this->data['field']);
			}
	    } else {
	    	redirect('admin/login');
	    	// $this->load->view('admin/login');
	    }
 		
	}
	public function search()
	{
		

		if($this->session->userdata('logged_in')) {
			
			if($this->input->post('marketingtype')) {
				
				$this->data['marketingtype'] = $this->input->post('marketingtype');
				$this->data['field'] = $this->Marketingtool_model->Getsearchfields($this->input->post('marketingtype'));
				$this->load->view('admin/marketinglist', $this->data);
			} else {
				$this->data['field'] = $this->Marketingtool_model->Getfields();

				$this->load->view('admin/marketinglist', $this->data['field']);
			}
	    } else {
	    	redirect('admin/login');
	    	// $this->load->view('admin/login');
	    }
 		
	}
	


	public function addmarketingtool($id='')
	{
		

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
						 
				$this->form_validation->set_rules('marketingtitle', 'marketingtitle', 'trim|required');
				$this->form_validation->set_rules('marketingtype', 'marketingtype', 'trim|required|alpha');
				$this->form_validation->set_rules('marketingstatus', 'marketingstatus', 'trim|required');

				if($this->input->post('marketingtype')=='text')
				{

					$this->form_validation->set_rules('marketingtext', 'marketingtext', 'trim|required');
				}

				if($this->input->post('marketingtype')=='image'){
					
					$this->form_validation->set_rules('marketingimage', 'marketingimage', 'trim|callback_validate_image');
				}

				if($this->input->post('marketingtype')=='document'){
					
					$this->form_validation->set_rules($_FILES['marketingdocument'], 'marketingdocument', 'trim|required');
				}

				if($this->input->post('marketingtype')=='video')
				{
					
					$this->form_validation->set_rules('marketingvideolink', 'marketingvideolink', 'trim|required|prep_url');
				}
				

 				if($this->form_validation->run() == true )
 				{
 					
					$data = array(
						'MarketingTitle'=>$this->input->post('marketingtitle'),
						'MarketingType'=>$this->input->post('marketingtype'),
						'Status'=>$this->input->post('marketingstatus')
					);

					$marketlastid = $this->Marketingtool_model->getlastid();

					// $imgname = "mtimg".$marketlastid+=1;	
					
					//$marketing_img = 'uploads/MarketingImage/'.$imgname.'.png';
					// echo $marketing_img = 'uploads/MarketingImage/'.$this->upload->data('file_name');
					if($_FILES['marketingimage']['tmp_name']!='')
					{
						$marketing_img = 'uploads/MarketingImage/'.$this->upload->data('file_name');
						// if (file_exists($marketing_img)) 
						// unlink($marketing_img);
					
						// move_uploaded_file($_FILES['marketingimage']['tmp_name'], $marketing_img);
						
						
					}
					
					if($_FILES['marketingdocument']['tmp_name']!='')
					{
						$doxtry = explode(".", $_FILES['marketingdocument']['name']);
						$docname ="mtdoc".$marketlastid+=1;
						$marketing_doc = 'uploads/MarketingDoc/'.date('ymdh').$docname.'.'.$doxtry[1];

						if (file_exists($marketing_doc)) 
						unlink($marketing_doc);
					
						move_uploaded_file($_FILES['marketingdocument']['tmp_name'], $marketing_doc);
						
					}

					if($this->input->post('marketingtype')=='image')
					{
						
						$data['MarketingImage']=$marketing_img;
						//array_push($data, array('MarketingImage' => $marketing_img));
					}
					if($this->input->post('marketingtype')=='text')
					{
						
						$data['MarketingText']=$this->input->post('marketingtext');
						//array_push($data, array('MarketingImage' => $this->input->post('marketingtext')));
					}
					if($this->input->post('marketingtype')=='video')
					{
						
						$data['MarketingVideoLink']=$this->input->post('marketingvideolink');
						//array_push($data, array('MarketingImage' => $this->input->post('marketingtext')));
					}
					if($this->input->post('marketingtype')=='document')
					{
						
						$data['MarketingDocument']=$marketing_doc;
						//array_push($data, array('MarketingImage' => $this->input->post('marketingtext')));
					}

					if($id=='')
					{
						$result = $this->common_model->SaveRecords($data,'arm_marketingtool');
					}
					else
					{
						$condition= "MarketingId='".$id."'";
						$result = $this->common_model->UpdateRecord($data,$condition,'arm_marketingtool');
						
					}
								
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/marketingtool');
 				}

				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					

				$this->data['field']= $this->Marketingtool_model->Getfielddata($id);
				if($this->data['field']!='')
				{
				$this->data['MarketingId'] 		=$this->data['field']->MarketingId;
				$this->data['MarketingType'] 	=$this->data['field']->MarketingType;
				$this->data['MarketingText'] 	=$this->data['field']->MarketingText;
				$this->data['MarketingTitle'] 	=$this->data['field']->MarketingTitle;
				$this->data['MarketingImage'] 	=$this->data['field']->MarketingImage;
				$this->data['MarketingDocument'] 	=$this->data['field']->MarketingDocument;
				$this->data['MarketingVideoLink'] 	=$this->data['field']->MarketingVideoLink;
				$this->data['Status'] =$this->data['field']->Status;
				}
					$this->load->view('admin/addmarketingtool');
				}

				
			}
			else
			{
				$this->data['field']= $this->Marketingtool_model->Getfielddata($id);
				if($this->data['field']!='')
				{
				$this->data['MarketingId'] 		=$this->data['field']->MarketingId;
				$this->data['MarketingType'] 	=$this->data['field']->MarketingType;
				$this->data['MarketingTitle'] 	=$this->data['field']->MarketingTitle;
				$this->data['MarketingText'] 	=$this->data['field']->MarketingText;
				$this->data['MarketingImage'] 	=$this->data['field']->MarketingImage;
				$this->data['MarketingDocument'] 	=$this->data['field']->MarketingDocument;
				$this->data['MarketingVideoLink'] 	=$this->data['field']->MarketingVideoLink;
				$this->data['Status'] =$this->data['field']->Status;
				}

				$this->load->view('admin/addmarketingtool',$this->data);
				// $this->load->view('admin/generalsetting');
			} 
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}


	public function updatemarketingtool($id='')
	{
		

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
						 
				
				$this->form_validation->set_rules('marketingtitle', 'marketingtitle', 'trim|required');
				$this->form_validation->set_rules('marketingtype', 'marketingtype', 'trim|required|alpha');
				$this->form_validation->set_rules('marketingstatus', 'marketingstatus', 'trim|required');

				if($this->input->post('marketingtype')=='text')
				{

					$this->form_validation->set_rules('marketingtext', 'marketingtext', 'trim|required');
				}

				if($this->input->post('marketingtype')=='image'){
					
					$this->form_validation->set_rules($_FILES['marketingimage'], 'marketingimage', 'trim|required');
				}
				if($this->input->post('marketingtype')=='document'){
					
					$this->form_validation->set_rules($_FILES['marketingdocument'], 'marketingdocument', 'trim|required');
				}

				if($this->input->post('marketingtype')=='video')
				{
					
					$this->form_validation->set_rules('marketingvideolink', 'marketingvideolink', 'trim|required|prep_url');
				}

					
				

 				if($this->form_validation->run() == true )
 				{
 					
				$data = array(
					'MarketingTitle'=>$this->input->post('marketingtitle'),
					'MarketingType'=>$this->input->post('marketingtype'),
					'Status'=>$this->input->post('marketingstatus'));

				
				$imgname = "mtimg".$id;	

				$marketing_img = 'uploads/MarketingImage/'.$imgname.'.png';
				if($_FILES['marketingimage']['tmp_name']!='')
				{
					
					unlink($marketing_img);
					move_uploaded_file($_FILES['marketingimage']['tmp_name'], $marketing_img);
					
				}
				$this->data['fieldet']= $this->Marketingtool_model->Getfielddata($id);
				$extsdoc =$this->data['fieldet']->MarketingDocument;
				if($_FILES['marketingdocument']['tmp_name']!='')
				{
					$doxtry = explode(".", $_FILES['marketingdocument']['name']);
					$docname ="mtdoc".$id;
					$marketing_doc = 'uploads/MarketingDoc/'.date('ymdh').$docname.'.'.$doxtry[1];
				
					if (file_exists($marketing_doc)) 
					unlink($marketing_doc);

					if (file_exists($extsdoc)) 
					unlink($extsdoc);
					
				
					move_uploaded_file($_FILES['marketingdocument']['tmp_name'], $marketing_doc);
					
				}

				if($this->input->post('marketingtype')=='image')
				{
					
					$data['MarketingImage']=$marketing_img;
					//array_push($data, array('MarketingImage' => $marketing_img));
				}
				if($this->input->post('marketingtype')=='text')
				{
					
					$data['MarketingText']=$this->input->post('marketingtext');
					//array_push($data, array('MarketingImage' => $this->input->post('marketingtext')));
				}
				if($this->input->post('marketingtype')=='video')
				{
					
					$data['MarketingVideoLink']=$this->input->post('marketingvideolink');
					//array_push($data, array('MarketingImage' => $this->input->post('marketingtext')));
				}
				if($this->input->post('marketingtype')=='document')
				{
					
					$data['MarketingDocument']=$marketing_doc;
					//array_push($data, array('MarketingImage' => $this->input->post('marketingtext')));
				}
				
					



					if($id=='')
					{
						$result = $this->common_model->SaveRecords($data,'arm_marketingtool');
					}
					else
					{
						$condition= "MarketingId='".$id."'";
						$result = $this->common_model->UpdateRecord($data,$condition,'arm_marketingtool');
						
					}
				

				
				
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/marketingtool');
 				}

				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					

				$this->data['field']= $this->Marketingtool_model->Getfielddata($id);
				if($this->data['field']!='')
				{
				$this->data['MarketingId'] 		=$this->data['field']->MarketingId;
				$this->data['MarketingType'] 	=$this->data['field']->MarketingType;
				$this->data['MarketingText'] 	=$this->data['field']->MarketingText;
				$this->data['MarketingTitle'] 	=$this->data['field']->MarketingTitle;
				$this->data['MarketingImage'] 	=$this->data['field']->MarketingImage;
				$this->data['MarketingDocument'] 	=$this->data['field']->MarketingDocument;
				$this->data['MarketingVideoLink'] 	=$this->data['field']->MarketingVideoLink;
				$this->data['Status'] =$this->data['field']->Status;
				}
					$this->load->view('admin/updatemarketingtool');
				}

				
			}
			else
			{
				$this->data['field']= $this->Marketingtool_model->Getfielddata($id);
				if($this->data['field']!='')
				{
				$this->data['MarketingId'] 		=$this->data['field']->MarketingId;
				$this->data['MarketingType'] 	=$this->data['field']->MarketingType;
				$this->data['MarketingTitle'] 	=$this->data['field']->MarketingTitle;
				$this->data['MarketingText'] 	=$this->data['field']->MarketingText;
				$this->data['MarketingImage'] 	=$this->data['field']->MarketingImage;
				$this->data['MarketingDocument'] 	=$this->data['field']->MarketingDocument;
				$this->data['MarketingVideoLink'] 	=$this->data['field']->MarketingVideoLink;
				$this->data['Status'] =$this->data['field']->Status;
				}

				$this->load->view('admin/updatemarketingtool',$this->data);
				// $this->load->view('admin/generalsetting');
			} 
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}//function ends



public function delete($id) 
{
		$condition = "MarketingId =" . "'" . $id . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_marketingtool');
		if($status) {
			$this->session->set_flashdata('success_message',$this->lang->line('successmessagedel'));
		}
		else
		{
			$this->session->set_flashdata('error_message',$this->lang->line('errormessagedel'));
		}

		redirect('admin/marketingtool');
}




public function enable($MarketingId) {
	
		$condition1 = "MarketingId =" . "'" . $MarketingId . "'";

		$data1 = array(
			'Status' => '1'
		);


		$status = $this->common_model->UpdateRecord($data1, $condition1, 'arm_marketingtool');
		
		if($status) {
			redirect('admin/marketingtool');
		}
	}

	public function disable($MarketingId) {
		
		$condition = "MarketingId =" . "'" . $MarketingId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_marketingtool');
		if($status) {
			redirect('admin/marketingtool');
		}
	}


	public function currencyname_check($str,$id)
	{
		
		$condition = "CurrencyName =" . "'" . $str . "' AND CurrencyId !=" . "'" . $id . "'";
		
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_currency');
		$this->db->where($condition);
		
		$query = $this->db->get();
		if (!$query->num_rows()>0) 
			{
				return true; 
				}
		else{
			
			$this->form_validation->set_message('currencyname_check', '<p><em class="state-error1">'.ucwords($this->lang->line('currencyunavaiable')).'</em></p>');
			return false;
		}
		
	}

	public function currencyname_check1($str)
	{
		
		$condition = "CurrencyName =" . "'" . $str . "'";
		
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_currency');
		$this->db->where($condition);
		
		$query = $this->db->get();
		if (!$query->num_rows()>0) 
			{
				return true; 
				}
		else{
			
			$this->form_validation->set_message('currencyname_check1', '<p><em class="state-error1">'.ucwords($this->lang->line('currencyunavaiable')).'</em></p>');
			return false;
			}
		
	}

	public function validate_image($str)
	{	
		if(!$str){
			$config['upload_path'] = './uploads/MarketingImage/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('marketingimage')) {
				$this->form_validation->set_message('validate_image', '<p><em class="state-error1">'.$this->upload->display_errors().'</em></p>');
				return false;
			} else {
				return true;
			}
		} else {
			$this->form_validation->set_message('validate_image', '<p><em class="state-error1">Error! Marketing image missing</em></p>');
			return false;
		}
	}


} //class ends


