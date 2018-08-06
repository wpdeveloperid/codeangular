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

    public function update($data){
        $this->db->set('name',$data['name']);
        $this->db->set('price',$data['price']);
        $this->db->set('description',$data['description']);
        if($data['image']){
            $this->db->set('image',$data['image']);
        }        
        $this->db->where('id',$data['id']);
        $query=$this->db->update('product');

        return $query;
    }
    
    public function detail($id)
    {
        $query=$this->db->where('id', $id)->get('product');
        return $query->result();
    }
}
