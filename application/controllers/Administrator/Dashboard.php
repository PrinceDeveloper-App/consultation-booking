<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('email');
		//$this->load->library('encrypt'); 
		$this->load->helper(array('cookie', 'url'));
		//$this->load->model('Homepage_model');
		//$this->load->library('user_agent');
		$this->load->database();
	}

	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		if ($user_id) {
			$data['pageid'] = "dash";
			$data['breadcrumb'] = "Dashboard";
			$this->load->view('admin/dashboard', $data);
		} else {
			redirect(base_url());
		}
	}
}
