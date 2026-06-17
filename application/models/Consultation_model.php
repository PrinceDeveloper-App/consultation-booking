<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/Booking_model.php';

/**
 * Handles applicant booking data access.
 */
class Consultation_model extends Booking_model
{
    protected $slots_table       = 'slots';
    protected $appointment_table = 'appointment_data';
    protected $booking_table     = 'appointment_slotes';

    /**
     * @param array $data Payment transaction data
     * @return int Insert ID
     */
    public function insertOrder($data)
    {
        $this->db->insert('stripe_payments', $data);
        return $this->db->insert_id();
    }
}
