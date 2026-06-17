<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Handles employer consultation booking with email confirmation.
 */
class Employerbooking extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employer_model');
    }

    public function index()
    {
        $next_working_day = $this->get_next_working_day();
        $this->load->view('employerbookconsultation', [
            'pageid'     => 'booking',
            'breadcrumb' => 'Booking',
            'pagename'   => 'Book Your Consultation',
            'schedules'  => $this->Employer_model->getSchedules($next_working_day),
        ]);
    }

    public function getSchedules()
    {
        $current_date = $this->post('date');
        $data = $this->Employer_model->getSchedules($current_date);
        echo json_encode($data);
    }

    public function get_slots()
    {
        echo json_encode($this->Employer_model->getAllSlots());
    }

    /**
     * Processes employer booking, saves appointment, sends confirmation email.
     */
    public function save()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[255]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim|max_length[20]');
        $this->form_validation->set_rules('booking_date', 'Booking Date', 'required|trim');
        $this->form_validation->set_rules('booking_time', 'Booking Time', 'required|trim');
        $this->form_validation->set_rules('business_year', 'Business Year', 'required|trim');
        $this->form_validation->set_rules('field_of_business', 'Field of Business', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            echo 'fail';
            return;
        }

        $email        = $this->post('email');
        $first_name   = $this->post('first_name');
        $last_name    = $this->post('last_name');
        $booking_date = $this->post('booking_date');
        $booking_time = $this->post('booking_time');

        $this->db->trans_start();

        $appointment_id = $this->Employer_model->insertAppointmentData([
            'business_year'          => $this->post('business_year'),
            'field_of_business'      => $this->post('field_of_business'),
            'other_field'            => $this->post('other_field'),
            'first_name'             => $first_name,
            'client_last_name'       => $last_name,
            'client_email'           => $email,
            'client_phone'           => $this->post('phone'),
            'additional_notes'       => $this->post('additional_notes'),
            'prefered_meeting_method'=> $this->post('meeting_method'),
            'appointment_status'     => 'active',
        ]);

        $this->Employer_model->insertBookingData([
            'appointment_id'   => $appointment_id,
            'appointment_date' => $booking_date,
            'appointment_time' => $booking_time,
            'active_status'    => 'active',
        ]);

        $datetime = DateTime::createFromFormat('d-m-Y', $booking_date);
        $date_ymd = $datetime ? $datetime->format('Y-m-d') : $booking_date;

        $this->load->library('booking_service');
        $this->booking_service->remove_slot($booking_time, $date_ymd, 'emp_slots');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            log_message('error', 'Transaction failed for employer booking: ' . $email);
            echo 'fail';
            return;
        }

        $this->load->library('email_service');
        $this->email_service->send_booking_confirmation($email, $booking_time, $date_ymd);

        log_message('info', 'Employer booking completed: ' . $email . ' on ' . $date_ymd);
        echo 'success';
    }

    public function success_message()
    {
        $this->load->view('bookingSuccess', [
            'pageid'          => 'booking',
            'breadcrumb'      => 'Success',
            'pagename'        => 'Success Message',
            'success_message' => 'success',
        ]);
    }

    public function fail_message()
    {
        $this->load->view('bookingFail', [
            'pageid'       => 'booking',
            'breadcrumb'   => 'Failed',
            'pagename'     => 'Failure Message',
            'fail_message' => 'fail',
        ]);
    }
}
