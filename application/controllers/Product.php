<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {

	public function __construct()
        {
                parent::__construct();
                $this->load->model('config_model');
                $this->load->model('product_model');
                $this->load->helper('url_helper');
        }
        
	public function index(){
		
		$this->load->view('product/product_template');
		
	}
	
	public function head(){
		$data = $this->config_model->get_head();
		echo json_encode($data);
	}
	
	public function list(){
		$data = $this->product_model->list();
		echo json_encode($data);
	}
	
	public function add(){
		$data = array(
			'name'=>$this->input->post('name'),
			'price'=>$this->input->post('price'),
		);
		$this->product_model->add($data);
	}
}
