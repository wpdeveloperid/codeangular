<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

	public function __construct()
        {
			parent::__construct();
			$this->load->helper('url_helper');
			$this->load->helper('form');
        	$this->load->library('form_validation');
			$this->load->library('session');
			$this->load->model('user_model');
        }

	public function index(){	
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		} else {			
			$this->load->view('header');
			$this->load->view('admin');
			$this->load->view('footer');
		}		
	}

	public function changepassword(){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('oldpass', 'Old Password', 'required');
		$this->form_validation->set_rules('newpass', 'New Password', 'required');
		$this->form_validation->set_rules('confpass', 'Password Confirmation', 'required');
		if ($this->form_validation->run()) {
			$username = $this->session->userdata('username');
			$users = $this->user_model->check($username);
			$oldpass=$this->input->post('oldpass');
			if(password_verify ( $oldpass , $users[0]->password )){
				$newpass=$this->input->post('newpass');
				$confpass=$this->input->post('confpass');
				if($newpass===$confpass){
					$output['status']=$this->user_model->update_password($username,$newpass);
					$output['message']="Password changed.";
				}else{
					$output['message']="New password and password confirmation must be the same.";
				}
			}else{
				$output['message']="Old password field is incorrect.";
			}			
		}else{
			$output['message']=strip_tags(validation_errors());
		}
		echo json_encode($output);
	}

	public function reg(){
		$username=$this->input->get('username');
		$password=$this->input->get('password');
		//echo $this->user_model->add($username,$password);
	}

	public function reset(){
		$username=$this->input->get('username');
		$password=$this->input->get('password');
		//$output['status']=$this->user_model->update_password($username,$password);
	}
}
