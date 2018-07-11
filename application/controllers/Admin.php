<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

	public function __construct()
        {
			parent::__construct();
			$this->load->helper('url_helper');
			$this->load->library('session');
        }

	public function index(){
	
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		} else {
			echo "Anda sudah login.";
		}
		
	}
	
}
