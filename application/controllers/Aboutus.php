<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus extends CI_Controller {
      function __construct(){
			parent::__construct();	
			$this->load->helper('url');	
			$this->load->helper('form');
			$this->load->library('email');
			$this->load->helper(array('cookie', 'url'));
			$this->load->database();
	  }
	
	public function index()
	{
		
		$data['pageid']="about";
        $data['breadcrumb'] = "about us";
        $data['pagename'] = "About IKIC";
		$data['sticky_button'] = "sticky";
		$this->load->view('aboutUsPage',$data); 
		
		
	}
}