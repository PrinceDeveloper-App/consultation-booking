<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contactus extends CI_Controller
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

		$data['pageid'] = "contact";
		$data['breadcrumb'] = "contact us";
		$data['pagename'] = "Contact Us";
		$data['sticky_button'] = "sticky";
		$this->load->view('contactUsPage', $data);
	}
	public function send_mail()
	{
		$name    = $this->input->post('name');
		$email   = $this->input->post('email');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');

		// Basic validation
		if (empty($name) || empty($email) || empty($subject) || empty($message)) {
			echo json_encode([
				"status" => "error",
				"message" => "All fields are required."
			]);
			return;
		}

		// Load email library
		$this->load->library('email');

		$this->email->from($email, $name);
		$this->email->to('isha@ikic.ca'); // receiving email
		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()) {
			echo json_encode([
				"status" => "success",
				"message" => "Message sent successfully!"
			]);
		} else {
			echo json_encode([
				"status" => "error",
				"message" => "Unable to send email. Please try again."
			]);
		}
	}
}
