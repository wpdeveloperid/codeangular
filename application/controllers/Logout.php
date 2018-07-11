<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logout extends CI_Controller {

	public function __construct()
        {
			parent::__construct();
			$this->load->helper('url_helper');
			$this->load->model('user_model');
			$this->load->library('session');
        }

	public function index(){
	
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');
		echo "Anda sudah logout";
	}
}
