<?php
class Product_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function list()
        {
			$query = $this->db->get('product');
			return $query->result();
        }
        
        public function add($data){
			return $this->db->insert('product', $data);
        }
} 
 
