<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My404 extends CI_Controller {

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
	public function index()
	{
		// $this->load->view('404');
		if (strpos(current_url(),'admin') !== false) {
			$this->load->view('my404');
		} else {
			$this->load->view('user/my404');
			// if(site_info('site_status')=='off'){
			// 	$this->data['message'] = site_info('site_offline_msg');
			// } else {
			// 	$this->data['message'] = '404';
			// }
			// $this->load->view('user/my404', $this->data);
		}
	}
}
