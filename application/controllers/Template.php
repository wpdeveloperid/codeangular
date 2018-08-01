<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Template extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
    }
    public function productlist()
    {
        $this->load->view('ngtemplate/productlist');
    }
    public function productdetail()
    {
        $this->load->view('ngtemplate/productdetail');
    }
    public function manageproduct()
    {
        echo "OK";
    }
}
