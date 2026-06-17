<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends MY_Controller
{
    public function index()
    {
        $this->load->view('contactUsPage', [
            'pageid'        => 'contact',
            'breadcrumb'    => 'contact us',
            'pagename'      => 'Contact Us',
            'sticky_button' => 'sticky',
        ]);
    }

    public function send_mail()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[255]');
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim|max_length[200]');
        $this->form_validation->set_rules('message', 'Message', 'required|trim|max_length[5000]');

        if ($this->form_validation->run() === FALSE) {
            $this->json_error('All fields are required.');
            return;
        }

        $this->load->library('email_service');
        $sent = $this->email_service->send_contact_message(
            $this->post('email'),
            $this->post('name'),
            $this->post('subject'),
            $this->post('message')
        );

        if ($sent) {
            $this->json_success('Message sent successfully!');
        } else {
            $this->json_error('Unable to send email. Please try again.');
        }
    }
}
