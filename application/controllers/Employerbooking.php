<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Employerbooking extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('email');
    $this->load->library('calendar');
    //$this->load->library('encrypt'); 
    $this->load->helper(array('cookie', 'url'));
    $this->load->model('Employer_model');
    //$this->load->library('user_agent');
    $this->load->database();
  }

  public function index()
  {

    $data['pageid'] = "booking";
    $data['breadcrumb'] = "Booking";
    $data['pagename'] = "Book Your Consultation";

    ////Get The slot on next working day

    $date = date('Y-m-d', strtotime('+1 day'));
    $day  = date('N', strtotime($date)); // 1 = Monday, 7 = Sunday

    // If Saturday (6), move to Monday
    if ($day == 6) {
      $date = date('Y-m-d', strtotime($date . ' +2 days'));
    }
    // If Sunday (7), move to Monday
    elseif ($day == 7) {
      $date = date('Y-m-d', strtotime($date . ' +1 day'));
    }

    $next_working_day = $date;
    
    $data['schedules'] = $this->Employer_model->getSchedules($next_working_day);
    $this->load->view('employerbookconsultation', $data);
  }
  public function getSchedules()
  {

    $data['pageid'] = "schedule";
    $data['breadcrumb'] = "Schedulling";
    $current_date = $this->input->post('date');
    $data = $this->Employer_model->getSchedules($current_date);
    // Return JSON response
    echo json_encode($data);
    //$this->load->view('admin/schedullingPage', $data);

  }
  public function get_slots()
  {
    $this->load->database();
    $query = $this->db->get('emp_slots');
    $result = $query->result_array();
    echo json_encode($result);
  }
  /////////////////////Save Appointment Data /////////////////////////////////////
  public function save()
  {
    $postData = $this->input->post();
    if ($postData) {
      $business_year = $postData['business_year'];
      $field_of_business = $postData['field_of_business'];
      $other_field = $postData['other_field'];
      $first_name = $postData['first_name'];
      $last_name = $postData['last_name'];
      $email = $postData['email'];
      $phone = $postData['phone'];
      $additional_notes = $postData['additional_notes'];
      $meeting_method = $postData['meeting_method'];
      $booking_date = $postData['booking_date'];
      $booking_time = $postData['booking_time'];
      $appointment_status = "active";
      $appointmentData = array(
        'business_year' => $business_year,
        'field_of_business' => $field_of_business,
        'other_field' => $other_field,
        'first_name' => $first_name,
        'client_last_name' => $last_name,
        'client_email' => $email,
        'client_phone' => $phone,
        'additional_notes' => $additional_notes,
        'prefered_meeting_method' => $meeting_method,
        'appointment_status' => $appointment_status

      );
      $applicant_id = $this->Employer_model->insertAppointmentData($appointmentData);
      $bookingData = array(
        'appointment_id' => $applicant_id,
        'appointment_date' => $booking_date,
        'appointment_time' => $booking_time,
        'active_status' => "active"
      );
      $this->Employer_model->insertbookingData($bookingData);
      $datetime = DateTime::createFromFormat('d-m-Y', $booking_date);
      $new_date = $datetime->format('Y-m-d');  //Output: 2025-11-13
      $this->delete_slot($booking_time, $new_date);
      $this->send_email($email, $booking_time, $new_date);


      echo "success";
    } else {
      echo "fail";
    }
    //return false;
  }

  public function delete_slot($booking_time, $booking_date)
  {


    // Get the current slots
    $record = $this->db->get_where('emp_slots', ['date' => $booking_date])->row();

    if ($record) {
      // Clean braces and convert to array
      $slots = str_replace(['{', '}'], '', $record->slot_times);
      $slot_array = array_map('trim', explode(',', $slots));
      $slot_count = $record->slot_count;
      $new_slot_count = $slot_count - 1;
      // Remove the selected slot
      $slot_array = array_diff($slot_array, [$booking_time]);

      // Rebuild and update the string
      $updated_slots = '{' . implode(',', $slot_array) . '}';
      $this->db->set('slot_times', $updated_slots);
      $this->db->set('slot_count', $new_slot_count);
      $this->db->where('date', $booking_date);
      $this->db->update('emp_slots');

      // 2. If slot_count = 0 → delete that row
      $this->db->where('date', $booking_date);
      $this->db->where('slot_count', 0);
      $this->db->delete('emp_slots');
      //$this->db->update('slots', ['slot_times' => $updated_slots]);

      //echo 'Slot deleted successfully';
    }
  }

  public function send_email($email, $booking_time, $new_date)
  {


    // Email configuration

    $config = array(
      'protocol' => "smtp",
      'smtp_crypto' => "ssl",
      'email_smtp_crypto' => "ssl",
      'newline'     => "\r\n",
      'priority'     => 1,
      'smtp_host' => "mail.ikic.ca",
      'smtp_port' => 465,
      'smtp_user' => "isha@ikic.ca",
      'smtp_pass' => "Ik@139****",
      'mailtype'  => "html",
      'charset'   => "iso-8859-1"
    );
    $this->load->library('email', $config);
    $this->email->from('isha@ikic.ca', 'Isha Kapoor Immigration Consulting Inc.');
    $this->email->set_mailtype("html");
    $this->email->to($email);
    $this->email->subject('Confirmation email for IKIC consultation booking');
    //$message = file_get_contents(FCPATH . 'email_templates/consultation_confirm.html');
    $message = $this->confirmation_email_message($booking_time, $new_date);
    $this->email->message($message);
    $this->email->send();
  }

  public function confirmation_email_message($booking_time, $new_date)
  {

    $year = date('Y');

    $message = '
		<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Consultation Booking Confirmation</title>
    <style>
      body {
        font-family: "Arial", sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
      }
      .email-container {
        max-width: 600px;
        margin: 30px auto;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
      }
      .header {
        background-color: #000;
        color: #ffffff;
        text-align: center;
        padding: 20px;
        font-size: 22px;
        font-weight: bold;
      }
      .content {
        padding: 25px;
        color: #333333;
        line-height: 1.6;
        font-size: 16px;
      }
      .content h3 {
        color: #0d6efd;
        margin-bottom: 10px;
      }
      .details {
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
        padding: 15px;
        border-radius: 5px;
        margin-top: 10px;
      }
      .details p {
        margin: 5px 0;
      }
      .note {
        font-size: 14px;
        color: #666666;
        margin-top: 15px;
        border-left: 3px solid #000;
        padding-left: 10px;
      }
      .footer {
        text-align: center;
        font-size: 14px;
        color: #999999;
        padding: 15px;
        border-top: 1px solid #eeeeee;
      }
    </style>
  </head>
  <body>
    <div class="email-container">
      <div class="header">Consultation Confirmed</div>

      <div class="content">
        <p>Thank you — your <strong>free consultation</strong> is booked.</p>
        <p>Your booking details are as follows:</p>

        <div class="details">
          <p><strong>Consultation Date:</strong> ' . $new_date . '</p>
          <p><strong>Consultation Time:</strong> ' . $booking_time . '</p>
        </div>

        <div class="note">
          <p>
            <strong>Note:</strong> The appointment date and time are based on
            <strong>Mountain Time (MT) – Alberta, Canada</strong>. Please be
            available for the consultation according to your local time zone.
          </p>
        </div>
      </div>

      <div class="footer">
        © <span id="year">' . $year . '</span> <a href="https://ikic.ca/">IKIC</a>. All
        rights reserved.
      </div>
    </div>
  </body>
</html>';

    return $message;
  }

  public function success_message()
  {
    $data['pageid'] = "booking";
    $data['breadcrumb'] = "Suceess";
    $data['pagename'] = "Success Message";
    $data['success_message'] = "success";
    $this->load->view('bookingSuccess', $data);
  }
  public function fail_message()
  {
    $data['pageid'] = "booking";
    $data['breadcrumb'] = "Failed";
    $data['pagename'] = "Failure Message";
    $data['fail_message'] = "fail";
    $this->load->view('bookingFail', $data);
  }
}
