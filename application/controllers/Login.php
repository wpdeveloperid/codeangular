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
	
		$this->load->view('adminheader');
		$this->load->view('login');
		$this->load->view('adminfooter');
		
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
				echo "Berhasil login.";
			}else{
				echo "Gagal login. Password salah.";
			}
		}else{
			echo "Gagal login. Username salah/tidak ada.".json_encode($users);
		}
	}
}
