<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Template extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('session');
    }
    public function productlist()
    {
        $this->load->view('ngtemplate/productlist');
    }
    public function productdetail()
    {
        $this->load->view('ngtemplate/productdetail');
    }
    public function dashboard()
    {
        if(!$this->session->userdata('logged_in')){
			redirect('login');
        }
        $this->load->view('ngtemplate/dashboard');
    }    
    public function manageproduct()
    {
        if(!$this->session->userdata('logged_in')){
			redirect('login');
        }
        $this->load->view('ngtemplate/manageproduct');
    }
    public function productform()
    {
        if(!$this->session->userdata('logged_in')){
			redirect('login');
        }
        $this->load->view('ngtemplate/productform');
    }
    public function password(){
        if(!$this->session->userdata('logged_in')){
			redirect('login');
        }
        $this->load->view('ngtemplate/password');
    }
}
