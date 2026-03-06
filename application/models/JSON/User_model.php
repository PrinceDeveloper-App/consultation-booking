<?php
class User_model extends CI_Model {

    public function insert_user($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function get_users() {
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
}
