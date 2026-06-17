<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Employer scheduling data access for admin dashboard.
 */
class Schedullingmodel extends CI_Model
{
    protected $slots_table = 'emp_slots';
    protected $times_table = 'a_times';

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
     * @return array Available time options
     */
    public function getTimes()
    {
        return $this->db->get($this->times_table)->result_array();
    }
}
