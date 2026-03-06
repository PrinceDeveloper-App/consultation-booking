<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
      function __construct(){
			parent::__construct();	
			$this->load->helper('url');	
			$this->load->helper('form');
			$this->load->library('email');
			//$this->load->library('encrypt'); 
			$this->load->helper(array('cookie', 'url'));
			$this->load->model('admin/User_model');
			$this->load->database();
	  }
	
	public function index()
	{
		
		$data['pageid']="login";
		$this->load->view('admin/loginpage',$data); 
		
		
	}
	public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->get_user($username, $password);

        if ($user) {
			//$u_id=$user->id;
			//echo $u_id;
            $this->session->set_userdata('user_id', $user->id);
            echo json_encode([
                'status' => 'success',
                'message' => 'Login successful!',
                'redirect' => base_url('Administrator/Dashboard')
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid email or password.'
            ]);
        }
    }
}