<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

	public function __construct() {
		parent::__construct();

		//$this->load->helper('url');

		// Load form helper library
		//$this->load->helper('form');
		
		// Load database
		
		
		// change language
		//$this->config->set_item('language', 'spanish');

		// load language
		$this->lang->load('customers');

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
	    		echo sizeof($columns);exit;
				if(sizeof($columns)>=1) {
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
	    		$this->load->view('export', $this->data);
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
	    		
				if(sizeof($columns)>=1) {
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
		        if($result) {
			        //echo $this->db->last_query();
			        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
			    	if($data)
			    		force_download($filename, $data);
			   	} else {
			   		redirect('admin');
			   	}
		        
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
				if($select_column=='*') {
					$papersize = 'A0';
				} else {
					$columns = explode(',', $select_column);
					$size = sizeof($columns);

					if($size>=1 && $size<=5){
						$papersize = 'A5';
					} else if($size>=6 && $size<=9) {
						$papersize = 'A4';
					} else if($size>=10 && $size<=15) {
						$papersize = 'A3';
					} else if($size>=15 && $size<=20) {
						$papersize = 'A2';
					} else if($size>=21 && $size<=26) {
						$papersize = 'A1';
					} else {
						$papersize = 'A0';
					}
				}
				
				$this->pdfexport($data,$tableName,$papersize);
		        
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

	function pdfexport($data,$tableName,$papersize) {
		// echo $papersize;
		// print_r($data);exit;
		// $names = str_replace('arm_', '', $tableName);
		$this->load->library("Pdf");

		// create new PDF document
	    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $papersize, true, 'UTF-8', false);    
	 
	    // set document information
	    $pdf->SetCreator(PDF_CREATOR);
	    $pdf->SetAuthor('ARM Infotech');
	    $pdf->SetTitle($tableName);
	    $pdf->SetSubject($tableName.'List');
	    // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');   
	 
	    // set default header data
	    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $tableName, 'Export results', array(0,64,255), array(0,64,128));
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
	    $pdf->SetFont('dejavusans', '', 12, '', true);   
	 
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
