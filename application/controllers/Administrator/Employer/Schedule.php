<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin management of employer scheduling slots.
 */
class Schedule extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Employer/Schedullingmodel');
    }

    public function create()
    {
        $next_working_day = $this->get_next_working_day();
        $this->load->view('admin/Employer/schedullingPage', [
            'pageid'     => 'employer',
            'breadcrumb' => 'Employer Scheduling',
            'schedules'  => $this->Schedullingmodel->getSchedules($next_working_day),
            'timesadd'   => $this->Schedullingmodel->getTimes(),
        ]);
    }

    public function getSchedules()
    {
        $current_date = $this->post('date');
        $data = $this->Schedullingmodel->getSchedules($current_date);

        if ($data) {
            $this->json_success('Schedules found', $data);
        } else {
            $this->json_response(['status' => 'not found']);
        }
    }

    public function get_slots()
    {
        echo json_encode($this->db->get('emp_slots')->result_array());
    }

    public function timeSave()
    {
        $times = $this->input->post('times');
        $date  = $this->input->post('date');

        if (empty($times) || empty($date)) {
            $this->json_error('All fields are required');
            return;
        }

        $this->load->library('booking_service');
        $response = $this->booking_service->save_slots($times, $date, 'emp_slots');

        $this->session->set_flashdata('success', 'Time added successfully!');
        $this->session->set_flashdata('date', $date);
        echo json_encode($response);
    }

    public function delete_slot()
    {
        $time = $this->post('time');
        $date = $this->post('date');

        $this->load->library('booking_service');
        $response = $this->booking_service->delete_admin_slot($time, $date, 'emp_slots', 'emp_appointment_slotes');

        if ($response['status'] === 'success') {
            $this->session->set_flashdata('delete', 'Slot deleted successfully!');
            $this->session->set_flashdata('date', $date);
        }

        echo json_encode($response);
    }
}
