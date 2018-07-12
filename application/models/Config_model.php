<?php
class Config_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function get_head()
        {
			$query = $this->db->get('config');
			return $query->result();
        }
} 
