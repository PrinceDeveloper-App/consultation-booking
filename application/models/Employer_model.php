<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/Booking_model.php';

/**
 * Handles employer booking data access.
 */
class Employer_model extends Booking_model
{
    protected $slots_table       = 'emp_slots';
    protected $appointment_table = 'emp_appointment_data';
    protected $booking_table     = 'emp_appointment_slotes';
}
