<?php
class User_model extends CI_Model {

        public function __construct()
        {
		$this->load->database();
        }
        
        public function check($username_input)
        {                
                $query = $this->db->get_where('user', array('username' => $username_input));
                return $query->result();
        }
        
        public function update_password($username,$new_password){
                $this->db->set('password', password_hash($new_password, PASSWORD_DEFAULT));
                $this->db->where('username', $username);
                return $this->db->update('user');
        }

        public function add($username,$password){
                $this->db->set('username',$username);
                $this->db->set('password',password_hash($password, PASSWORD_DEFAULT));
                return $this->db->insert('user');
        }
}  
