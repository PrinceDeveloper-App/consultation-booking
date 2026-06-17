<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin management of employer appointments.
 */
class Appointments extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Employer/Appointmentmodel');
    }

    public function index()
    {
        $this->load->view('admin/Employer/appointmentData', [
            'pageid'       => 'eapp',
            'breadcrumb'   => 'Employer Appointments',
            'appointments' => $this->Appointmentmodel->getAppointments(),
        ]);
    }

    public function update_status()
    {
        $id     = $this->post('id');
        $status = $this->post('status');

        if (empty($id) || empty($status)) {
            $this->json_error('ID and status are required.');
            return;
        }

        $result = $this->Appointmentmodel->update_status($id, $status);
        echo json_encode(['success' => $result]);
    }
}
