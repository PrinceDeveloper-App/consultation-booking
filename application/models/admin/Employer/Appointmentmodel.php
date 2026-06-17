<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Employer appointment data access for admin dashboard.
 */
class Appointmentmodel extends CI_Model
{
    protected $data_table    = 'emp_appointment_data';
    protected $booking_table = 'emp_appointment_slotes';

    /**
     * @return array All employer appointments joined with booking slots
     */
    public function getAppointments()
    {
        $this->db->select($this->data_table . '.*, ' . $this->booking_table . '.*');
        $this->db->from($this->data_table);
        $this->db->join(
            $this->booking_table,
            $this->data_table . '.appointment_id = ' . $this->booking_table . '.appointment_id'
        );
        $this->db->order_by($this->booking_table . '.appointment_date', 'DESC');
        return $this->db->get()->result_array();
    }

    /**
     * @param int    $id
     * @param string $status
     * @return bool
     */
    public function update_status($id, $status)
    {
        $this->db->set('appointment_status', $status);
        $this->db->where('appointment_id', $id);
        return $this->db->update($this->data_table);
    }
}
