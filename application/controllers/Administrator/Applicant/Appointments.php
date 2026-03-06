<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appointments extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        //$this->load->library('encrypt'); 
        $this->load->helper(array('cookie', 'url'));
        $this->load->model('admin/Applicant/Appointmentmodel');
        //$this->load->library('user_agent');
        $this->load->database();
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $data['pageid'] = "aapp";
            $data['breadcrumb'] = "Applicant Appointments";
            $data['appointments'] = $this->Appointmentmodel->getAppointments();
            $this->load->view('admin/Applicant/appointmentData', $data);
        } else {
            redirect(base_url());
        }
    }
    public function update_status()
    {
        $id     = $this->input->post('id');
        $status = $this->input->post('status');
        $result = $this->Appointmentmodel->update_status($id, $status);

        echo json_encode([ "success" => $result ]);
    }
}
