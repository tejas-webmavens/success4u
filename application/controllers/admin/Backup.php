<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);

		if($this->session->userdata('admin_login')) {
		
			// Load database
			$seconddb=$this->load->database('second',true);
			
			// change language
			//$this->config->set_item('language', 'spanish');

			// load language
			$this->lang->load('customers');
			$this->IsAdmin();

		}  else {
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
		// echo $this->uri->segment(3);
		if(!$this->session->userdata('logged_in')) {
			redirect('admin/login');
	    } else {
	    	if($this->input->post()) {
	    		//print_r($this->input->post());
	    		$columns = $this->input->post('exportedfields');
	    		
				if(sizeof($columns)>1) {
					$select_column = '';
					foreach($columns as $column){
						$select_column .= "`".$column."`, ";
					}
					$select_column =trim($select_column,", ");
					// echo $select_column;exit;
				} else {
					$select_column='*';
				}
	    		
	    		$this->exportdoc($this->input->post('table'), $select_column, $this->input->post('format'));
	    		
	    	} else {
	    		
	    			$tables = $this->db->list_tables();
	    		
	    		//$tables = $this->db->list_tables();
				$this->data['tables'] = $tables;
	    		$this->load->view('admin/backup', $this->data);
	    	}
	    }
 		
	}

	public function archive($tablename='')
	{
		
		if(!$this->session->userdata('logged_in')) {
			redirect('admin/login');
	    } else {
	    	if($this->input->post()) {
	    		//print_r($this->input->post());
	    		$columns = $this->input->post('exportedfields');
	    		
				if(sizeof($columns)>1) {
					$select_column = '';
					foreach($columns as $column){
						$select_column .= "`".$column."`, ";
					}
					$select_column =trim($select_column,", ");
					// echo $select_column;exit;
				} else {
					$select_column='*';
				}
	    		
	    		$this->exportdoc($this->input->post('table'), $select_column, $this->input->post('format'));
	    		
	    	} else {
	    		
	    			if($tablename!='')
	    		{
	    			$tables = $tablename;
	    		}
	    		else
	    		{
	    			$tables = $this->db->list_tables();
	    		}
	    			    		
				$this->data['tables'] = $tables;
	    		$this->load->view('export', $this->data);
	    	}
	    }
 		
	}
	public function export() {

           $seconddb=$this->load->database('second',true);

		// Load the DB utility class
		$this->load->dbutil($seconddb);

		// Backup your entire database and assign it to a variable
		// $backup =& $this->dbutil->backup(); 

		// // Load the file helper and write the file to your server
		// $backup_file  = time().'mybackup.sql';
		
		$this->load->helper('file');
		// // echo base_url().'database/'.$backup_file;exit;
		// write_file(base_url().'database/'.$backup_file, $backup); 

		// // Load the download helper and send the file to your desktop
		$this->load->helper('download');
		// force_download($backup_file, $backup);


		$prefs = array(
                'tables'      => array(),  // Array of tables to backup.
                'ignore'      => array(),  // List of tables to omit from the backup
                'format'      => 'txt',             // gzip, zip, txt
                'filename'    => time().'mybackup.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );

		$backup = $this->dbutil->backup($prefs);
		// $backup1=$seconddb->$backup;

		force_download($prefs['filename'], $backup);
	}
	public function import() 
	{
		// $this->form_validation->set_rules('importdb', 'importdb', 'trim|required');

		// if ($this->form_validation->run() == TRUE) {
		$field_name = "importdb";
		if(isset($_FILES[$field_name])) {
			// $tables = $this->db->list_tables();
			// foreach ($tables as $key => $value) {

			// 	if($value!='arm_members') {
			// 		if ($this->dbforge->drop_database($value)) {
	    				
			// 		}
			// 		//echo "<br/>".$value;
			// 	}
			// }

			$allowed =  array('sql');
			$filename = $_FILES[$field_name]['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(!in_array($ext,$allowed) ) {
			    $this->session->set_flashdata('error_message', 'Failed! File type Invalid.');
				redirect('admin/backup');
			} else {
				$MyFile = file_get_contents($_FILES[$field_name]['tmp_name']);

				$templine = '';
				// Read in entire file
				$lines = file($_FILES[$field_name]['tmp_name']);
				// Loop through each line
				foreach ($lines as $line)
				{
				    // Skip it if it's a comment
				    if (substr($line, 0, 2) == '--' || $line == '')
				        continue;

				    // Add this line to the current segment
				    $templine .= $line;
				    // If it has a semicolon at the end, it's the end of the query
				    if (substr(trim($line), -1, 1) == ';')
				    {
				        // Perform the query
				    	$import_status = $this->db->query($templine) or  $this->db->error();
				        // Reset temp variable to empty
				        $templine = '';
				    }
				}


				if($import_status) {
					$this->session->set_flashdata('success_message', 'Success! Database Restored');
					redirect('admin/backup');
				} else {
					$this->session->set_flashdata('error_message', 'Failed! Database not restored check file type.');
					redirect('admin/backup');
				}
			}
		} else {
			//echo "validation failed";exit;
			$this->load->view('admin/backup');
			
		}
		
			
			//print_r($_FILES);exit;
			
			// $config['upload_path'] = './uploads/admin/database/';
			// $config['allowed_types'] = 'zip|sql';
			// // $config['encrypt_name'] = TRUE;

			// $this->load->library('upload', $config);

			
			// //$this->upload->do_upload($field_name);

			// if ( ! $this->upload->do_upload($field_name)) {
				
			// 	$this->session->set_flashdata('error_message', $this->upload->display_errors());
				
			// } else {
			// 	$upload_files = $this->upload->data('file_name');

			// 	// $MyFile = file_get_contents(base_url().'/uploads/admin/database/members_table.sql');
			// 	$MyFile = file_get_contents(base_url().'/uploads/admin/database/'.$upload_files);
			// 	foreach (explode(";\n", $MyFile) as $MyFile) {
			// 		$MyFile = trim($MyFile);

			// 		if ($MyFile) {
			// 			$import_status = $this->db->query($MyFile);
			// 		}
			// 	}
				
			// 	if($import_status) {
			// 		echo "success";
			// 	}
			// 	else {
			// 		echo "fail";	
			// 	}
			// }
		

		
	}

	public function getTables(){
		// $this->
		$tables = $this->db->list_tables();
		$this->data['tables'] = "epin";
		$this->load->view('export', $this->data['tables']);
	}

	public function getColumns($tableName){
		$tableName = "arm_".$tableName;
		$fields = $this->db->list_fields($tableName);
		// $this->data['field'] = $tables;

		header('Content-Type: application/x-json; charset=utf-8');
 		echo(json_encode($fields));

		//$this->load->view('export', $this->data['field']);
	}
	function exportdoc($tableName, $select_column, $format)
	{
		switch ($format) {
			case 'csv':
				$this->load->dbutil();
		        $delimiter = ",";
		        $newline = "\r\n";
		        $filename = $tableName.'.csv';
		        $query = "SELECT ".$select_column." FROM arm_".$tableName;
		        $result = $this->db->query($query);
		        echo $this->db->last_query();
		        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
		        force_download($filename, $data);
				break;
			case 'xml':
				$this->load->dbutil();
		        $config = array (
					'root'    => 'root',
					'element' => 'element', 
					'newline' => "\n", 
					'tab'    => "\t"
		        );
		        $filename = $tableName.'.xml';
		        $query = "SELECT ".$select_column." FROM arm_".$tableName;
		        $result = $this->db->query($query);
		        $data = $this->dbutil->xml_from_result($result, $config);
        		force_download($filename, $data);
				break;
			case 'pdf':
				$this->load->dbutil();
		        $delimiter = ",";
		        $newline = "\r\n";
		        $filename = $tableName.'.pdf';
		        $query = "SELECT ".$select_column." FROM arm_".$tableName; 
		        $result = $this->db->query($query);
		        $data1 = $this->dbutil->csv_from_result($result, $delimiter, $newline);
				$data = $this->csvToTable($data1);
				$this->pdfexport($data,$tableName);
		        
				break;
			
		}
	}

	function CSV()
	{
        $this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "customers.csv";
        $query = "SELECT * FROM arm_members";
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
	}
	function XML()
	{
        $this->load->dbutil();
        $config = array (
			'root'    => 'root',
			'element' => 'element', 
			'newline' => "\n", 
			'tab'    => "\t"
        );
        $filename = "customers.xml";
        $query = "SELECT * FROM arm_members";
        $result = $this->db->query($query);
        $data = $this->dbutil->xml_from_result($result, $config);
        force_download($filename, $data);
	}

	function pdfexport($data,$tableName) {

		// $names = str_replace('arm_', '', $tableName);
		$this->load->library("Pdf");

		// create new PDF document
	    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A0', true, 'UTF-8', false);    
	 
	    // set document information
	    $pdf->SetCreator(PDF_CREATOR);
	    $pdf->SetAuthor('ARM Infotech');
	    $pdf->SetTitle($tableName);
	    $pdf->SetSubject($tableName.'List');
	    // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');   
	 
	    // set default header data
	    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $tableName, 'testing', array(0,64,255), array(0,64,128));
	    $pdf->setFooterData(array(0,64,0), array(0,64,128)); 
	 
	    // set header and footer fonts
	    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
	 
	    // set default monospaced font
	    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
	 
	    // set margins
	    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    
	 
	    // set auto page breaks
	    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
	 
	    // set image scale factor
	    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	     
	 
	    // set default font subsetting mode
	    $pdf->setFontSubsetting(true);   
	 
	    // Set font
	    // dejavusans is a UTF-8 Unicode font, if you only need to
	    // print standard ASCII chars, you can use core fonts like
	    // helvetica or times to reduce file size.
	    $pdf->SetFont('dejavusans', '', 14, '', true);   
	 
	    // Add a page
	    // This method has several options, check the source code documentation for more information.
	    $pdf->AddPage(); 
	 
	    // set text shadow effect
	    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
	    
	    //$this->data['customers'] = $this->common_model->GetCustomers();
        // print_r($this->data['customers']);

        
       
	   	// Print text using writeHTMLCell()
    	$pdf->writeHTMLCell(0, 0, '', '', $data, 0, 1, 0, true, '', true);   

    	// download file
    	$pdf->Output($tableName.'.pdf', 'D');

    	//view pdf file
    	//$pdf->Output('customers.pdf', 'I');
    	
		
	}

	function csvToTable($csv_content){
	  $table = "<table>";
	  $rows = str_getcsv($csv_content, "\n");
	  foreach($rows as &$row){
	    $table .= "<tr>";
	    $cells = str_getcsv($row);
	    foreach($cells as &$cell){
	      $table .= "<td>$cell</td>";
	    }
	    $table .= "</tr>";
	  }
	  $table .= "</table>";
	  return $table;
	}

}
