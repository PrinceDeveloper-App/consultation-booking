<?php
class User_model extends CI_Model {

    public function get_user($username, $password) {
        // For demo only — hash passwords in real use!
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('users');

        return $query->row();
    }
}
