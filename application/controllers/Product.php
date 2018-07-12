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
			$this->load->library('image_lib');
			$w = $image_data['image_width']; // original image's width
			$h = $image_data['image_height']; // original images's height
			$n_w = 400; // destination image's width
			$n_h = 300; // destination image's height
			$s_r = $w / $h;
			$n_r = $n_w / $n_h;
			$config['source_image'] = $image_data['full_path'];
			$config['maintain_ratio'] = FALSE;
			$config['new_image'] = $image_data['file_path'].$image_data['raw_name'].'resized'.$image_data['file_ext'];
			$new_path = $config['new_image'];
			if($n_r > $s_r ){
				$config['width'] = $w;
				$config['height'] = round($w/$n_r);
				$config['y_axis'] = round(($h - $config['height'])/2);
				
			} else {
				$config['width'] = round($h * $n_r);
				$config['height'] = $h;
				$config['x_axis'] = round(($w - $config['width'])/2);
			}
			$this->image_lib->initialize($config);
			$this->image_lib->crop();
			$this->image_lib->clear();
			
			$config['source_image'] = $new_path;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = $n_w;
			$config['height'] = $n_h;
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()){
				echo $this->image_lib->display_errors();
			} else {
				echo "done";
			}
		}
		
		$data = array(
			'name'=>$this->input->post('name'),
			'price'=>$this->input->post('price'),
			'image'=>$image_data['raw_name']
		);
		$this->product_model->add($data);
	}
}
