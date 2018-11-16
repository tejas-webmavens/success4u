<?php 

	 
	 
	//Get the navigation bar in header
	function CMSNav($slug)
	{
		$CI =& get_instance();
		$CI->db->where('navSlug', $slug);
		$query=$CI->db->get('arm_navigation');
		foreach($query->result_array() as $n):
			
			$totSegments = $CI->uri->total_segments();
		
			if(!is_numeric($CI->uri->segment($totSegments))){
				$current = "/".$CI->uri->segment($totSegments);
			} else if(is_numeric($CI->uri->segment($totSegments))){
				$current = "/".$CI->uri->segment($totSegments-1);
			}
  			
			if ($current == "/") {$current = base_url();};
			
			$nav = str_replace('<li><a href="'.$current.'">', '<li class=""><a href="'.$current.'">', $n['navHTML']);
			echo $nav;
			// echo ;
			// $is_logged_in = $CI->session->userdata('logged_in');
			$memberid=$CI->session->MemberID;
			$checkmember=$CI->common_model->GetRow("MemberId='".$memberid."'","arm_members");
			if($checkmember)
			{
				$usertype=$checkmember->UserType;
				if($usertype==2)
				{
					echo $nav = '<li class=""><a href="'.base_url().'login/logout">Logout</a></li>';
				}
				else
				{
					if($CI->session->userdata('logged_in') && $CI->session->userdata('user_login') && $CI->session->userdata('MemberID')) 
					{
						echo $nav = '<li class=""><a href="'.base_url().'login/logout">Logout</a></li>';
						echo $nav = '<li class=""><a href="'.base_url().'user/dashboard">My Account</a></li>';
					}

					else{
						// print_r($CI->session->userdata($array));
						echo $nav = '<li class=""><a href="'.base_url().'login">Login</a></li>';
						echo $nav = '<li class=""><a href="'.base_url().'user/register">Join us</a></li>';
					}
				}
			}
			else
			{
				if($CI->session->userdata('logged_in') && $CI->session->userdata('user_login') && $CI->session->userdata('MemberID')) 
				{
					echo $nav = '<li class=""><a href="'.base_url().'login/logout">Logout</a></li>';
					echo $nav = '<li class=""><a href="'.base_url().'user/dashboard">My Account</a></li>';
				}

				else{
					// print_r($CI->session->userdata($array));
					echo $nav = '<li class=""><a href="'.base_url().'login">Login</a></li>';
					echo $nav = '<li class=""><a href="'.base_url().'user/register">Join us</a></li>';
				}
			}
			
			
		endforeach;

	}

	//Get the navigation bar in footer
	function FooterCMSNav($slug)
	{
		$CI =& get_instance();
		$CI->db->where('navSlug', $slug);
		$query=$CI->db->get('arm_navigation');
		foreach($query->result_array() as $n):
			$totSegments = $CI->uri->total_segments();
			if(!is_numeric($CI->uri->segment($totSegments))){
			$current = "/".$CI->uri->segment($totSegments);
			} else if(is_numeric($CI->uri->segment($totSegments))){
			$current = "/".$CI->uri->segment($totSegments-1);
			}
			if ($current == "/") {$current = base_url();};
			$nav = str_replace('<li><a href="'.$current.'">', '<li class=""><a href="'.$current.'">', $n['navHTML']);
			$nav = str_replace('nav navbar-nav','',$nav);
			echo $nav;

			// echo $nav2 = '<li class=""><a href="'.base_url().'user/latestnews">LatestNews';
			// echo $nav2 = '<li class=""><a href="'.base_url().'user/faq">Faq';
			// $is_logged_in = $CI->session->userdata('logged_in');
			$memberid=$CI->session->MemberID;
			$checkmember=$CI->common_model->GetRow("MemberId='".$memberid."'","arm_members");
			if($checkmember)
			{
				$usertype=$checkmember->UserType;
				if($usertype==2)
				{
					echo $nav = '<li class=""><a href="'.base_url().'login/logout">Logout</a></li>';
				}
				else
				{
					if($CI->session->userdata('logged_in') && $CI->session->userdata('user_login') && $CI->session->userdata('MemberID')) 
					{
						echo $nav = '<li class=""><a href="'.base_url().'login/logout">Logout</a></li>';
						echo $nav = '<li class=""><a href="'.base_url().'user/dashboard">My Account</a></li>';
					}

					else{
						// print_r($CI->session->userdata($array));
						echo $nav = '<li class=""><a href="'.base_url().'login">Login</a></li>';
						echo $nav = '<li class=""><a href="'.base_url().'user/register">Join us</a></li>';
					}
				}
			}
			else
			{
				if($CI->session->userdata('logged_in') && $CI->session->userdata('user_login') && $CI->session->userdata('MemberID')) 
				{
					echo $nav = '<li class=""><a href="'.base_url().'login/logout">Logout</a></li>';
					echo $nav = '<li class=""><a href="'.base_url().'user/dashboard">My Account</a></li>';
				}

				else{
					// print_r($CI->session->userdata($array));
					echo $nav = '<li class=""><a href="'.base_url().'login">Login</a></li>';
					echo $nav = '<li class=""><a href="'.base_url().'user/register">Join us</a></li>';
				}
			}
			
		endforeach;
	}


	//Get the index page content
	function indexContent() {
		$CI =& get_instance();
		$CI->db->where('navTitle', 'index');
		$CI->db->where('isDelete', '0');
		$CI->db->where('Status', '1');
		$query=$CI->db->get('arm_cms_page');
		if ($query->num_rows()>0) {
			$content = $query->row();
			if($content->pageContent)
			echo urldecode($content->pageContent);
		}
	}

	function currency() {
		$CI =& get_instance();
		$CI->db->where('Status', '1');
		$query=$CI->db->get('arm_currency');
		$currency = $query->row();
		return $currency->CurrencySymbol;
	}

	function site_info() {
		$CI =& get_instance();
		$CI->db->select('KeyValue, ContentValue');
		$CI->db->where('Page', 'sitesetting');
		$query=$CI->db->get('arm_setting');
		$site_data = $query->result();
		foreach ($site_data as $row) {
			$site_datas[$row->KeyValue] = $row->ContentValue;
		}
		return $site_datas;
	}

	function Siteaddress() {
		$CI =& get_instance();
		$CI->db->select('KeyValue, ContentValue');
		$CI->db->where('KeyValue', 'address');
		$CI->db->where('Page', 'sitesetting');
		$query=$CI->db->get('arm_setting');
		$site_data = $query->row();
		return $site_data->ContentValue;
		
	}

	//Get the register page content
	function Registercontent() {
		$CI =& get_instance();
		$CI->db->where('navTitle', 'registerpage');
		$CI->db->where('isDelete', '0');
		$CI->db->where('Status', '1');
		$query=$CI->db->get('arm_cms_page');
		if ($query->num_rows()>0) {
			$content = $query->row();
			if($content->pageContent)
			echo urldecode($content->pageContent);
		}
	}
