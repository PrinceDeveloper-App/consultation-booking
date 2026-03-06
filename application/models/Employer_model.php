<?php
class Employer_model extends CI_Model
{
    public function getSchedules($current_date)
    {
        // $query = $this->db->get('schedulling_tb');
        // return $query->result_array();
        
        $query = $this->db->get_where('emp_slots', ['date' => $current_date]);
        //echo $this->db->last_query();
        //die();

        if ($query->num_rows() > 0) {
            //$result = $query->row();
            return $query->result_array();
        }

        //$result = $query->result();
    }
    public function insertAppointmentData($where_arr='')
	{
		$query=$this->db->insert('emp_appointment_data',$where_arr);
		return $this->db->insert_id();
	}
    public function insertbookingData($where_arr='')
	{
		$query=$this->db->insert('emp_appointment_slotes',$where_arr);
		//return $this->db->insert_id();
	}
}
