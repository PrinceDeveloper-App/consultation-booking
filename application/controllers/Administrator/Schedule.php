<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Master schedule management for admin.
 */
class Schedule extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Schedullingmodel');
    }

    public function create()
    {
        $current_date = date('Y-m-d');
        $this->load->view('admin/schedullingPage', [
            'pageid'     => 'schedule',
            'breadcrumb' => 'Scheduling',
            'schedules'  => $this->Schedullingmodel->getSchedules($current_date),
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
        $query = $this->db->get('slots');
        echo json_encode($query->result_array());
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
        $response = $this->booking_service->save_slots($times, $date, 'slots');
        echo json_encode($response);
    }

    public function delete_slot()
    {
        $time = $this->post('time');
        $date = $this->post('date');

        $this->load->library('booking_service');
        $response = $this->booking_service->delete_admin_slot($time, $date, 'slots', 'appointment_slotes');
        echo json_encode($response);
    }
}
