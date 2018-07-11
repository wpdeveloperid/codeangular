<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {

	public function __construct()
        {
                parent::__construct();
                $this->load->model('config_model');
                $this->load->helper('url_helper');
        }
        
	public function index(){
		//$this->load->helper('url');
		$this->load->view('product/product_template');
		//return '<h1>hola</h1>halo';
	}
	
	public function head(){
		$data = $this->config_model->get_head();
		echo json_encode($data);
	}
}
