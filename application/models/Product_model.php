<?php
class Product_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
        
    public function list($input, $sort, $ad)
    {
        $search_query = $input['query'];
        $min_price=$input['minprice'];
        $max_price=$input['maxprice'];
        $page=$input['page'];
        
        $query = $this->db->like('name', $search_query)
        ->where('price>=', $min_price)
        ->where('price<=', $max_price)
        ->order_by($sort, $ad)
        ->limit(12, 12*($page-1))
        ->get('product');
        return $query->result();
    }

    public function count($input)
    {
        $search_query = $input['query'];
        $min_price=$input['minprice'];
        $max_price=$input['maxprice'];

        $query = $this->db->like('name', $search_query)
        ->where('price>=', $min_price)
        ->where('price<=', $max_price)
        ->count_all_results('product');

        return $query;
    }
        
    public function add($data)
    {
        return $this->db->insert('product', $data);
    }
}
