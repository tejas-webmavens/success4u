<?php 

class Filterip extends CI_Controller {
	

	public function filter()
	{
		$this->load->helper('ipfilter');

		// these are the logged IP addresses, possibly read from DB
		$logs = array(
			'192.168.4.56',
			'192.168.35.68',
			'123.4.51.89',
			'99.104.156.34'
		);

		$add_to_log = array();

		foreach($logs as $item)
		{
			// exclude ips from the log if they are in the filter list
			if( ! ipfilter($item) )
			{
				$add_to_log[] = $item;
			}
		}

		var_dump($add_to_log); exit;
	}
}