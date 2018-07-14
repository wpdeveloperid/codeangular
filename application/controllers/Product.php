<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {

	public function __construct()
        {
                parent::__construct();
                $this->load->model('config_model');
                $this->load->model('product_model');
                $this->load->helper('url_helper');
                $this->load->helper('crop_helper');
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
		
		$config['upload_path'] = './assets/img/upload/';
		$config['allowed_types'] = 'jpg';
		$config['file_name'] = 'upload.jpg';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload('image')){
			echo $this->upload->display_errors();
		} else {
			echo json_encode($this->upload->data());
			$image_data = $this->upload->data();
			echo advanced_resize($image_data,200,200,"square");
		}
		
		$data = array(
			'name'=>$this->input->post('name'),
			'price'=>$this->input->post('price'),
			'image'=>$image_data['raw_name']
		);
		$this->product_model->add($data);
	}
}
