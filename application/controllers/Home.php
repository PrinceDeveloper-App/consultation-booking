<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
      function __construct(){
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
		
		$data['pageid']="home";
		$data['sticky_button'] = "sticky";
		$this->load->view('homepage',$data); 
		
		
	}
}