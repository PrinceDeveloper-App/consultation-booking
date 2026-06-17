<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base model for booking operations. Subclassed by Consultation_model and Employer_model.
 */
class Booking_model extends CI_Model
{
    protected $slots_table;
    protected $appointment_table;
    protected $booking_table;

    /**
     * @param string $current_date Date in Y-m-d format
     * @return array|null
     */
    public function getSchedules($current_date)
    {
        $query = $this->db->get_where($this->slots_table, ['date' => $current_date]);
        return ($query->num_rows() > 0) ? $query->result_array() : null;
    }

    /**
     * @param array $data Appointment data
     * @return int Insert ID
     */
    public function insertAppointmentData($data)
    {
        $this->db->insert($this->appointment_table, $data);
        return $this->db->insert_id();
    }

    /**
     * @param array $data Booking slot data
     */
    public function insertBookingData($data)
    {
        $this->db->insert($this->booking_table, $data);
    }

    /**
     * @return array All slots
     */
    public function getAllSlots()
    {
        return $this->db->get($this->slots_table)->result_array();
    }
}
