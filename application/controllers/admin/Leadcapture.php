<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leadcapture extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/Leadcapture_model');
		$this->lang->load('leadcapture');
		
		}  else {
	    	redirect('admin/login');
	    }
	} //function ends

	public function index()
	{
		
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
					redirect('admin/leadcapturelist');
				}
			}
		} else {
			$this->data['field'] = $this->Leadcapture_model->Getfields();
			$this->load->view('admin/leadcapturelist', $this->data['field']);
		}
	    
 		
	}

	public function addleadpage()
	{
			
		if($this->input->post())
		{
			
			$this->form_validation->set_rules('pagename', 'pagename', 'trim|required');
			$this->form_validation->set_rules('metakey', 'metakey', 'trim|required');
			$this->form_validation->set_rules('metacontent', 'metacontent', 'trim|required');
			$this->form_validation->set_rules('pagestatus', 'pagestatus', 'trim|required');
			
			$this->form_validation->set_rules($_FILES['sourcefile'], 'sourcefile', 'trim|required');

			
			if($this->form_validation->run() == true ) {
				$splash = time();
				mkdir('landingpage/'.$splash.'', 0777, true);
				$config['upload_path'] = '../landingpage/'.$splash;
    			$config['allowed_types'] = 'zip';
    			$config['max_size']    = '';
    			$this->load->library('upload', $config);

    			$pagename='index.php';
				
				$upload_dir = 'landingpage/'.$splash;
				$csspath = 'landingpage/'.$splash.'/css';
				$jspath = 'landingpage/'.$splash.'/js';
				$imagespath = 'landingpage/'.$splash.'/images';

				$zip_filename = $_FILES['sourcefile']['name'];
				$zip_tmp= $_FILES['sourcefile']['tmp_name'];	
				$zippath="landingpage/".$splash."/".$zip_filename;

				if(move_uploaded_file($zip_tmp,$zippath))
				{
					
					$zip = new ZipArchive;
					$zipfilename = $zippath;	
			 
					if ($zip->open($zipfilename) === TRUE)
					{
						$unzippath='landingpage/'.$splash;	
									
						$zip->extractTo($unzippath);				
						CHMOD($unzippath,0777);
						$zip->close();	
						
						$dp="landingpage/".$splash;
						if(is_dir($dp))
						{
							unlink($zippath);
						}
						
					}		
					CHMOD($unzippath,0755);
					
				}
				$zipfilename = str_replace(".zip", "", $zipfilename);
				$filepath=$zipfilename."/index.php";

				$current = file_get_contents($filepath);

				// preg_match('/^.*?<form.*?<\/form>.*$/smi', $current)
				// $current = str_replace(, replace, subject);
				
				file_put_contents($filepath, $current);

				// $filepath="landingpage/".$splash."/".$pagename;

				$data = array(
					'PageName'=>$this->input->post('pagename'),
					'MetaKey'=>$this->input->post('metakey'),
					'MetaContent'=>$this->input->post('metacontent'),
					'PageUrl'=>$filepath,
					'Status'=>$this->input->post('pagestatus'),
					'PageContent'=>mysql_real_escape_string(htmlentities($this->input->post('pagecontent')))
				);

				
				$result = $this->common_model->SaveRecords($data,'arm_leadpage');
				if($result) {
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/leadcapture');
 				}

				else
				{

					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));	
					$this->load->view('admin/addleadpage');
				}
			
			
			} else {
				$this->load->view('admin/addleadpage');
			}
		} else {
			$this->load->view('admin/addleadpage');
		}

	}

	
	public function editautorespond($id)
	{
		
		
		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				//print_r($this->input->post());
				

				$this->form_validation->set_rules('subject', 'subject', 'trim|required');
				$this->form_validation->set_rules('message', 'message', 'trim|required');
				$this->form_validation->set_rules('duration', 'duration', 'trim|required|numeric');
				$this->form_validation->set_rules('limitation', 'limitation', 'trim|required|numeric');
				$this->form_validation->set_rules('content', 'content', 'trim|required');

 				if($this->form_validation->run() == true)
 				{

					$data = array(
						'Subject'=>$this->input->post('subject'),
						'Message'=>mysql_real_escape_string($this->input->post('message')),
						'Duration'=>$this->input->post('duration'),
						'Limitation'=>$this->input->post('limitation'),
						'ContentsHtml'=>htmlspecialchars($this->input->post('content'))
					);
				
					$condition= "AutoRespondId='".$id."'";
					$result = $this->common_model->UpdateRecord($data,$condition,'arm_leadpage');
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/leadcapture');
 				
				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					
					$this->data['fielddata']= $this->Leadcapture_model->Getfielddata($id);

					$this->load->view('admin/editautorespond',$this->data);
				}

				
				
			}
			elseif($id!='')
			{
				
				$this->data['fielddata']= $this->Leadcapture_model->Getfielddata($id);
				
				$this->load->view('admin/editautorespond',$this->data);
				// $this->load->view('admin/packagesetting');
			}
			else
			{
				
				redirect('admin/leadcapture');
			}

		} 
		else
		{
			redirect('admin/login');

					
		}


	}




	public function delete($id) 
	{
		$condition = "LeadPageId =" . "'" . $id . "'";
		$record = $this->common_model->GetResults($condition, 'arm_leadpage');

		/*print_r($record);
		echo $ulinkpath = base_url().str_replace('/index.php', '', $record[0]->PageUrl);
		CHMOD($ulinkpath,777);
		unlink($ulinkpath);
		exit;*/
		//ulink()
		$status = $this->common_model->DeleteRecord($condition, 'arm_leadpage');
		if($status) {
			redirect('admin/leadcapture');
		}
			
	}



	public function enable($LeadPageId) {
		$condition = "LeadPageId =" . "'" . $LeadPageId . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_leadpage');
		if($status) {
			redirect('admin/leadcapture');
		}
	}

	public function disable($LeadPageId) {
		$condition = "LeadPageId =" . "'" . $LeadPageId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_leadpage');
		if($status) {
			redirect('admin/leadcapture');
		}
	}


} //class ends


