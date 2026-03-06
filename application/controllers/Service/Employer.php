<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer extends CI_Controller {
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
	
	public function lmiaApplication()
	{
		
		$data['pageid']="services";
        $data['breadcrumb'] = "services";
        $data['breadcrumb_sub'] = "LMIA Application";
        $data['pagename'] = "Service For Employers";
		$data['sticky_button'] = "sticky";
		$this->load->view('Service/Employer/lmiaApplication',$data); 
		
		
	}
    public function workPermitServices()
	{
		
		$data['pageid']="services";
        $data['breadcrumb'] = "services";
        $data['breadcrumb_sub'] = "Work Permit Services";
        $data['pagename'] = "Service For Employers";
		$data['sticky_button'] = "sticky";
		$this->load->view('Service/Employer/workPermitServices',$data); 
		
		
	}
    public function francophoneMobility()
	{
		
		$data['pageid']="services";
        $data['breadcrumb'] = "services";
        $data['breadcrumb_sub'] = "Francophone Mobility Work Permit";
        $data['pagename'] = "Service For Employers";
		$data['sticky_button'] = "sticky";
		$this->load->view('Service/Employer/francophoneMobility',$data); 
		
		
	}
    public function aipDesignations()
	{
		
		$data['pageid']="services";
        $data['breadcrumb'] = "services";
        $data['breadcrumb_sub'] = "Atlantic Immigration Program (AIP) Designations";
        $data['pagename'] = "Service For Employers";
		$data['sticky_button'] = "sticky";
		$this->load->view('Service/Employer/aipDesignations',$data); 
		
		
	}
    public function tfwService()
	{
		
		$data['pageid']="services";
        $data['breadcrumb'] = "services";
        $data['breadcrumb_sub'] = "TFW & Workforce Management Service";
        $data['pagename'] = "Service For Employers";
		$data['sticky_button'] = "sticky";
		$this->load->view('Service/Employer/tfwService',$data); 
		
		
	}
}