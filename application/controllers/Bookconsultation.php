<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Handles applicant consultation booking with Stripe payment and email confirmation.
 */
class Bookconsultation extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Consultation_model');
        $this->load->model('Invoice_model');
    }

    public function index()
    {
        $next_working_day = $this->get_next_working_day();
        $this->load->view('bookconsultation', [
            'pageid'     => 'booking',
            'breadcrumb' => 'Booking',
            'pagename'   => 'Book Your Consultation',
            'schedules'  => $this->Consultation_model->getSchedules($next_working_day),
        ]);
    }

    public function bookingType()
    {
        $this->load->view('selectBookingType', [
            'pageid'     => 'booking',
            'breadcrumb' => 'Booking Types',
            'pagename'   => 'Select Consultation Type',
        ]);
    }

    /**
     * Processes applicant payment, saves appointment, generates invoice, sends email.
     */
    public function payment()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('payment_method', 'Payment Method', 'required|trim');
        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[255]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim|max_length[20]');
        $this->form_validation->set_rules('booking_date', 'Booking Date', 'required|trim');
        $this->form_validation->set_rules('booking_time', 'Booking Time', 'required|trim');
        $this->form_validation->set_rules('country_of_residence', 'Country', 'required|trim');
        $this->form_validation->set_rules('program_of_interest', 'Program', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            echo 'fail';
            return;
        }

        $email          = $this->post('email');
        $payment_method = $this->post('payment_method');
        $first_name     = $this->post('first_name');
        $last_name      = $this->post('last_name');
        $booking_date   = $this->post('booking_date');
        $booking_time   = $this->post('booking_time');

        $this->load->library('payment_service');
        $result = $this->payment_service->charge($email, $payment_method);

        if (!$result['success']) {
            echo 'fail';
            return;
        }

        $this->db->trans_start();

        $appointment_id = $this->Consultation_model->insertAppointmentData([
            'country_of_residence' => $this->post('country_of_residence'),
            'program_of_interest'  => $this->post('program_of_interest'),
            'client_first_name'    => $first_name,
            'client_last_name'     => $last_name,
            'client_email'         => $email,
            'client_phone'         => $this->post('phone'),
            'additional_notes'     => $this->post('additional_notes'),
            'appointment_status'   => 'active',
        ]);

        $this->Consultation_model->insertBookingData([
            'appointment_id'   => $appointment_id,
            'appointment_date' => $booking_date,
            'appointment_time' => $booking_time,
            'active_status'    => 'active',
        ]);

        $invoice_no = $this->Invoice_model->get_next_invoice_number();
        $datetime   = DateTime::createFromFormat('d-m-Y', $booking_date);
        $date_ymd   = $datetime ? $datetime->format('Y-m-d') : $booking_date;

        $this->load->library('booking_service');
        $this->booking_service->remove_slot($booking_time, $date_ymd, 'slots');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            log_message('error', 'Transaction failed for applicant booking: ' . $email);
            echo 'fail';
            return;
        }

        $this->load->library('invoice_service');
        $pdf_path = $this->invoice_service->generate([
            'invoice_no' => $invoice_no,
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'email'      => $email,
            'date'       => date('d-m-Y'),
        ]);

        $this->load->library('email_service');
        $this->email_service->send_booking_confirmation($email, $booking_time, $date_ymd, $pdf_path);

        log_message('info', 'Applicant booking completed: ' . $email . ' on ' . $date_ymd);
        echo 'success';
    }

    public function success_message()
    {
        $this->load->view('paymentSuccess', [
            'pageid'          => 'booking',
            'breadcrumb'      => 'Success',
            'pagename'        => 'Success Message',
            'success_message' => 'success',
        ]);
    }

    public function fail_message()
    {
        $this->load->view('paymentFail', [
            'pageid'       => 'booking',
            'breadcrumb'   => 'Failed',
            'pagename'     => 'Failure Message',
            'fail_message' => 'fail',
        ]);
    }

    public function getSchedules()
    {
        $current_date = $this->post('date');
        $data = $this->Consultation_model->getSchedules($current_date);
        echo json_encode($data);
    }

    public function get_slots()
    {
        echo json_encode($this->Consultation_model->getAllSlots());
    }
}
