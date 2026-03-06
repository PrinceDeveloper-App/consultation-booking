<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once('vendor/autoload.php');

class Payment extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('email');
		$this->load->library('calendar');
		$this->load->library('stripe_lib');
		//$this->load->library('encrypt'); 
		$this->load->helper(array('cookie', 'url'));
		$this->load->model('Consultation_model');
		$this->load->model('Invoice_model');
		//$this->load->library('user_agent');
		$this->load->database();
	}

    public function charge() {

        \Stripe\Stripe::setApiKey("");
        //$data = $this->input->post();
        $payment_method = $this->input->post('payment_method');
        $amount = 1000; // ₹10.00 → 1000 paise (Stripe uses smallest currency unit)

        try {
            // 1. Create PaymentIntent
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'cad',
                'payment_method' => $payment_method,
                'confirmation_method' => 'manual',
                'confirm' => true,
            ]);

            echo json_encode(["status" => "success", "message" => "Payment successful!"]);
        } catch (\Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}
