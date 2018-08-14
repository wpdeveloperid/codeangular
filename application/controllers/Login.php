<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	public function __construct()
        {
			parent::__construct();
			$this->load->helper('url_helper');
			$this->load->helper('form');
			$this->load->library('session');
			$this->load->model('user_model');
        }

	public function index(){		
		if(!$this->session->userdata('logged_in')){
			$this->load->view('login');		
		} else {
			redirect('admin');
		}		
	}
	
	public function action(){
		$username_input = $this->input->post('username');
		$password_input = $this->input->post('password');
		$users = $this->user_model->check($username_input);
		if(sizeof($users)===1){
			if(password_verify ( $password_input , $users[0]->password )){
				$user_data = array(
						'user_id' => $users[0]->id,
						'username' => $users[0]->username,
						'logged_in' => true
					);
				$this->session->set_userdata($user_data);
				$output['message']= "Berhasil login.";
				$output['logged_in']=true;
			}else{				
				$output['message']= "Gagal login. Password salah.";
				$output['logged_in']=false;
			}
		}else{			
			$output['message']= "Gagal login. Username salah/tidak ada.";
				$output['logged_in']=false;
		}
		echo json_encode($output);
	}
}
