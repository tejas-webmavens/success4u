?><?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Genealogymview extends CI_Controller {


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
		
		//$this->load->model('user/fund_model');
		$this->lang->load('usergenealogy');
		
		}  else {
	    	redirect('login');
	    }
	}

public function index($id='')
{
$this->view($id);
}
	
public function view($id='')
{

if($id!="")
 {
 	$userid = $id;

 }
 else
 {
$userid = '1';
 }
	

	//echo "<pre>";
//$this->data['val'] = $this->user_ta($userid);

$this->data['val'] = $this->user_ta($userid);
//echo $this->data['val'];

 $this->load->view('user/genealogyview',$this->data);
//$this->load->view('user/gen');

}
 
////new file start here/////
function getname($id)
{
	$member = $this->common_model->GetCustomer($id);

	return $member->UserName;
}
function rankimage($id)
{
	
	$img ='';

	$condition="MemberId='".$id."'";
	$SelectColumn='ProfileImage';

	$imgdetail = $this->common_model->GetRow($condition,'arm_members', $SelectColumn);
	
		if($imgdetail->ProfileImage!='')
		{
			
			$img = base_url().$imgdetail->ProfileImage;
		}
		else
		{
			
			// $img = base_url().'assets/img/avatars/avatar.png';
			$img = base_url().'assets/img/avatars/no-photo.jpg';
		}

return $img;
}

public function user_ta($userid)
{
	
	$gendata='';
	 $mcondition = "MemberId='".$userid."'";

	$select_high = $this->common_model->GetRow($mcondition, 'arm_members');
	//print_r($select_high);

	 $gendata.= '<ul id="org" >
	<li id="beer" class="node expanded collapse" style="cursor: s-resize;"><div class="node"><img src='.$this->rankimage($select_high->MemberId).' style=margin-bottom:-42px; />
      <h1>'.ucwords($this->getname($select_high->MemberId)).' ('.$this->count_downlines($select_high->MemberId,0).') </h1></div>';

    $ncondition = "SpilloverId='".$userid."'";

    $mcount = $this->common_model->GetRowCount($ncondition, 'arm_members');

    $select_member = $this->common_model->GetResults($ncondition, 'arm_members');
    	
    	if($mcount>0)
    	{ 
    		$gendata.='<ul class="collapse">';

    	    	for($i=0; $i<$mcount; $i++)
    	    	{
    	
    	    		 	$incondition = "SpilloverId='".$select_member[$i]->MemberId."'";
    	   			 	$inner_fata_count = $this->common_model->GetRowCount($incondition, 'arm_members');
    	    			$inner_fata = $this->common_model->GetRow($incondition, 'arm_members');
    				
    					
    					
    	    			if($inner_fata_count>0)
						{
							
						  $gendata.= $this->call_from($select_member[$i]->MemberId);
						}
						else
						{
						  $gendata.='<li id="beer" class="expanded collapse" style="cursor: s-resize;"><div class="node"><img src='.$this->rankimage($select_member[$i]->MemberId).' style=margin-bottom:-42px; />
			      <h1>'.ucwords($this->getname($select_member[$i]->MemberId)).' ('.$this->count_downlines($select_member[$i]->MemberId,'').')</h1>
			    </div></li>'; 
						}
    	    		
    	    	}

    	    $gendata.='</ul>';

    	}
	$gendata.='</li></ul>';
	
	return $gendata;
	
}


public function count_downlines($userid,$count)
{
  //static $count;
  

  $mmcondition = "SpilloverId= '".$userid."'";
  $check_rows = $this->common_model->GetRowCount($mmcondition,"arm_members");
  $fet = $this->common_model->GetResults($mmcondition,"arm_members");
  
 
  if($check_rows)
  {
    for($i=0; $i<$check_rows; $i++)
	{

		
		$use = $fet[$i]->MemberId;
		
		$count++;
		
		$mncondition = "SpilloverId = '".$use."'";
		
		$check_rows_use = $this->common_model->GetRowCount($mncondition,"arm_members");
		
		if($check_rows_use > 0)
		{
		   $this->count_downlines($use,$count);
		}
	}
	 
  }
   
  if($count=='')
  {
    $count = 0;
  }
  return $count;
}

public function user_ta1($userid)
{

$gendata="";
	$umcondition = "SpilloverId= '".$userid."'";
	$select_count = $this->common_model->GetRowCount($umcondition,'arm_members');
	$select = $this->common_model->GetResults($umcondition,'arm_members');

	if($select_count>0)
	{
	  $gendata.='<ul class="collapse">';
	
	  for($j=0; $j<$select_count; $j++)
	  {
			$uncondition = "SpilloverId= '".$select[$j]->MemberId."'";
			$uocondition = "MemberId= '".$select[$j]->MemberId."'";
			$inner_fata_count = $this->common_model->GetRowCount($uncondition,'arm_members');
			$inner_fata = $this->common_model->GetRow($uocondition,'arm_members');
			//print_r($inner_fata);
			if($inner_fata_count>0)
			{
			  $gendata.= $this->call_from($select[$j]->MemberId);
			}
			else
			{
				
			  $gendata.='<li id="beer" style="cursor: s-resize;"><img src='.$this->rankimage($inner_fata->MemberId).' style=margin-bottom:-42px; />
      <h1>'.ucwords($this->getname($inner_fata->MemberId)).' ('.$this->count_downlines($inner_fata->MemberId,'').') </h1>
    </li>'; 
			}
	  }
		
	  $gendata.='</ul>';
	}
	
	return $gendata;

}


public function call_from($userid)
{
	$gendatagof ="";
	 $cmcondition ="MemberId = '".$userid."'";
	 $select_high =$this->common_model->GetRow($cmcondition,"arm_members");

	 $gendatagof.= '<li id="beer" class="collapsed" style="cursor: s-resize;"><div class="node"><img src='.$this->rankimage($select_high->MemberId).' style=margin-bottom:-42px; />
  				    <h1>'.ucwords($this->getname($select_high->MemberId)).'  ('.$this->count_downlines($select_high->MemberId,'').')</h1>
   				 </div><ul>';
	 $cncondition = "SpilloverId = '".$userid."'";
	 $run_count = $this->common_model->GetRowCount($cncondition,"arm_members");
  	$run = $this->common_model->GetResults($cncondition,'arm_members');
	 for($i=0; $i<$run_count; $i++)
	 {
	 		$cocondition ="MemberId = '".$run[$i]->MemberId."'";
			$inner_fata = $this->common_model->GetRow($cocondition,"arm_members");
			$inner_fata_count = $this->common_model->GetRowCount($cocondition,"arm_members");
			if($inner_fata_count >0)
			{
			 $gendatagof.= '<li id="beer" class="collapsed"><div class="node"><img src='.$this->rankimage($inner_fata->MemberId).' style=margin-bottom:-42px; />
     					 <h1>'.ucwords($this->getname($inner_fata->MemberId)).' ('.$this->count_downlines($inner_fata->MemberId,'').') </h1>
   					 </div>';
			   $gendatagof.= $this->user_ta1($inner_fata->MemberId,$gendatagof);
			 $gendatagof.= '</li>';
			}
			else
			{
			  $gendatagof.='<li id="beer" class="expanded collapse" style="cursor: s-resize;"><div class="node"><img src='.$this->rankimage($inner_fata[$i]->MemberId).' style=margin-bottom:-42px; />
      <h1>'.ucwords($this->getname($inner_fata[$i]->MemberId)).' ('.$this->count_downlines($inner_fata[$i]->MemberId,'').')</h1>
    </div></li>'; 
			}
	 }
	 
	 $gendatagof.= '</ul></li>';
	
	 return $gendatagof;
}


////new file end here/////


//// old files start here/////


//// old files end here/////
    
   
	
}
