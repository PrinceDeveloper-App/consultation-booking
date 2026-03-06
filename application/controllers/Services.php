<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {
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
	
	public function applicants()
	{
		
		$data['pageid']="services";
        $data['breadcrumb'] = "services";
        $data['pagename'] = "Services For Applicants";
		$data['sticky_button'] = "sticky";
		$this->load->view('serviceForApplicants',$data); 
		
		
	}
    public function employers()
	{
		
		$data['pageid']="services";
        $data['breadcrumb'] = "services";
        $data['pagename'] = "Services For Employers";
		$data['sticky_button'] = "sticky";
		$this->load->view('serviceForEmployers',$data); 
		
		
	}
}