<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

	public function __construct()
        {
			parent::__construct();
			$this->load->helper('url_helper');
			$this->load->helper('form');
			$this->load->library('session');
        }

	public function index(){	
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		} else {			
			$this->load->view('header');
			$this->load->view('admin/dashboard');
			$this->load->view('footer');
		}		
	}
	
	public function addproduct(){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->view('header');
		$this->load->view('admin/addproduct');
		$this->load->view('footer');
	}
}
