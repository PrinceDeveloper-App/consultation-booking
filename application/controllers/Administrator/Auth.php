<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin authentication controller with bcrypt password verification.
 */
class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/User_model');
    }

    public function index()
    {
        if ($this->session->userdata('user_id')) {
            redirect(base_url('admin'));
            return;
        }

        $this->load->view('admin/loginpage', ['pageid' => 'login']);
    }

    public function login()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->json_error('Please enter a valid email and password.');
            return;
        }

        $username = $this->post('username');
        $password = $this->post('password');

        $user = $this->User_model->get_user($username, $password);

        if ($user) {
            $this->session->sess_regenerate(TRUE);
            $this->session->set_userdata('user_id', $user->id);

            log_message('info', 'Admin login successful: ' . $username);

            $this->json_success('Login successful!', [
                'redirect' => base_url('admin'),
            ]);
        } else {
            log_message('warning', 'Failed admin login attempt: ' . $username);
            $this->json_error('Invalid email or password.');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        redirect(base_url('admin/login'));
    }
}
