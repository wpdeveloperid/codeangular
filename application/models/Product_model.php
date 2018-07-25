<?php
class Product_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
        
    public function list($page)
    {
        $query = $this->db->order_by('id', 'desc')->limit(12, 12*$page)->get('product');
        return $query->result();
    }
        
    public function add($data)
    {
        return $this->db->insert('product', $data);
    }
}
