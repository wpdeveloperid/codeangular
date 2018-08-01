<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('config_model');
        $this->load->model('product_model');
        $this->load->library('form_validation');
        $this->load->helper('url_helper');
        $this->load->helper('crop_helper');
    }
        
    public function index()
    {        
        $this->load->view('header');
        $this->load->view('product');
        $this->load->view('footer');
    }
    
    public function head()
    {
        $data = $this->config_model->get_head();
        echo json_encode($data);
    }
    
    public function list()
    {
        $input['query']=($this->input->get('query'))?$this->input->get('query'):"";
        $input['minprice']=($this->input->get('minprice'))?$this->input->get('minprice'):0;
        $input['maxprice']=($this->input->get('maxprice'))?$this->input->get('maxprice'):1000000000000000;
        $input['orderby']=($this->input->get('orderby'))?$this->input->get('orderby'):"newest";
        $input['page']=($this->input->get('page'))?$this->input->get('page'):1;
        $this->form_validation->set_data($input);
        $this->form_validation->set_rules('query', 'Search Query', 'alpha_numeric_spaces');
        $this->form_validation->set_rules('minprice', 'Minimum Price', 'numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('maxprice', 'Maximum Price', 'numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('orderby', 'Sorting Criteria', 'in_list[newest,lowprice,highprice,az,za]');
        $this->form_validation->set_rules('page', 'Page Number', 'integer|greater_than[0]');
        if ($this->form_validation->run()) {
            $ad=null;
            $o=$input['orderby'];
            if ($o=='newest') {
                $sort="id";
                $ad='desc';
            } elseif ($o=='lowprice') {
                $sort="price";
            } elseif ($o=='highprice') {
                $sort='price';
                $ad='desc';
            } elseif ($o=='az') {
                $sort='name';
            } else {
                $sort='name';
                $ad='desc';
            }
            if ($input['minprice']<=$input['maxprice']) {
                $data = $this->product_model->list($input, $sort, $ad);
                $result_count=$this->product_model->count($input);
                $pages_count=ceil($result_count/12);
                if (count($data)>0) {
                    $img_folder = './assets/img/';
                    $img_url = base_url()."assets/img/";
                    foreach ($data as $item) {
                        if ($item->image===""||!file_exists($img_folder."upload/".$item->image."square.jpg")) {
                            $item->src=$img_url."defaultsquare.jpg";
                        } else {
                            $item->src=$img_url."upload/".$item->image."square.jpg";
                        }
                    }
                    $output['items']= $data;
                    $output['items_count']=$result_count;
                    $output['pages_count']=$pages_count;
                    $output['page']=$input['page'];
                } else {
                    $output['message']= 'No result';
                }
            } else {
                $output['message']= 'Minimum Price must be less than or equal to Maximum Price';
            }
        } else {
            $output['message']= strip_tags(validation_errors()) ;
        }
        echo json_encode($output);
    }
    
    public function add()
    {
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg';
        $config['file_name'] = 'upload.jpg';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('image')) {
            echo $this->upload->display_errors();
        } else {
            echo json_encode($this->upload->data());
            $image_data = $this->upload->data();
            echo advanced_resize($image_data, 200, 200, "square");
        }
        
        $data = array(
            'name'=>$this->input->post('name'),
            'price'=>$this->input->post('price'),
            'image'=>$image_data['raw_name']
        );
        $this->product_model->add($data);
    }
    public function detail()
    {
        $result=$this->product_model->detail($this->input->get('id'));
        if (count($result)>0) {
            $img_folder = './assets/img/';
            $img_url = base_url()."assets/img/";
            foreach ($result as $item) {
                if ($item->image===""||!file_exists($img_folder."upload/".$item->image.".jpg")) {
                    $item->src=$img_url."defaultdisplay.jpg";
                } else {
                    $item->src=$img_url."upload/".$item->image.".jpg";
                }
            }

            $result[0]->posted_at=strtotime($result[0]->created_at)*1000;
            echo json_encode($result);
        }
    }
}
