<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Standalone payment processing endpoint.
 */
class Payment extends MY_Controller
{
    public function charge()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('payment_method', 'Payment Method', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->json_error('Payment method is required.');
            return;
        }

        $payment_method = $this->post('payment_method');

        $this->load->library('payment_service');
        $result = $this->payment_service->charge('', $payment_method, 10.00);

        if ($result['success']) {
            $this->json_success('Payment successful!');
        } else {
            $this->json_error($result['error'] ?: 'Payment failed.');
        }
    }
}
