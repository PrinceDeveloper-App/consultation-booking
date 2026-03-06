<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applicant extends CI_Controller {
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
	
	public function tfwProgrammes()
	{
		
		$data['pageid']="services";
        $data['breadcrumb'] = "services";
        $data['breadcrumb_sub'] = "TFW Programes";
        $data['pagename'] = "Service For Applicants";
		$data['sticky_button'] = "sticky";
		$this->load->view('Service/Applicant/tfwProgrames',$data); 
		
		
	}
    public function visitorVisa()
	{
		
		$data['pageid']="services";
        $data['breadcrumb'] = "services";
        $data['breadcrumb_sub'] = "Visitor Visa & Temporary Resident Visa";
        $data['pagename'] = "Service For Applicants";
		$data['sticky_button'] = "sticky";
		$this->load->view('Service/Applicant/trvProgrames',$data); 
		
		
	}
    public function studentVisa()
	{
		
		$data['pageid']="services";
        $data['breadcrumb'] = "services";
        $data['breadcrumb_sub'] = "Study In Canada";
        $data['pagename'] = "Service For Applicants";
		$data['sticky_button'] = "sticky";
		$this->load->view('Service/Applicant/studentVisa',$data); 
		
		
	}
    public function permanentResidency()
	{
		
		$data['pageid']="services";
        $data['breadcrumb'] = "services";
        $data['breadcrumb_sub'] = "PR & PNP";
        $data['pagename'] = "Service For Applicants";
		$data['sticky_button'] = "sticky";
		$this->load->view('Service/Applicant/permanentResidency',$data); 
		
		
	}
    public function familySponsorship()
	{
		
		$data['pageid']="services";
        $data['breadcrumb'] = "services";
        $data['breadcrumb_sub'] = "Family Sponsorship Programs";
        $data['pagename'] = "Service For Applicants";
		$data['sticky_button'] = "sticky";
		$this->load->view('Service/Applicant/familySponsorship',$data); 
		
		
	}
}