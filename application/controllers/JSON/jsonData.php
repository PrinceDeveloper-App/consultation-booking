<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jsonData extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        header('Content-Type: application/json');
    }

    // 🟢 Create user (Insert JSON data)
    public function save() {
        $json = json_decode($this->input->raw_input_stream, true); // get JSON data

        $data = [
            'name'    => $json['name'],
            'email'   => $json['email'],
            'details' => json_encode($json['details'])
        ];

        $insert_id = $this->User_model->insert_user($data);

        echo json_encode(['status' => 'success', 'insert_id' => $insert_id]);
    }

    // 🟡 Read user(s)
    public function get() {
        $users = $this->User_model->get_users();
        echo json_encode(['status' => 'success', 'data' => $users]);
    }

    // 🔵 Update user
    public function update($id) {
        $json = json_decode($this->input->raw_input_stream, true);

        $data = [
            'name'    => $json['name'],
            'email'   => $json['email'],
            'details' => json_encode($json['details'])
        ];

        $this->User_model->update_user($id, $data);
        echo json_encode(['status' => 'success', 'message' => 'User updated']);
    }
}
