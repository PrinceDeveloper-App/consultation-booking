<?php
class Schedullingmodel extends CI_Model
{
    public function getSchedules($current_date)
    {
        // $query = $this->db->get('schedulling_tb');
        // return $query->result_array();
        
        $query = $this->db->get_where('slots', ['date' => $current_date]);
        //echo $this->db->last_query();
        //die();

        if ($query->num_rows() > 0) {
            //$result = $query->row();
            return $query->result_array();
        } 
        // else {
        //     $query = $this->db->get_where('slots', ['date' => '0000-00-00']);
        //     return $query->result_array();
        // }

        //$result = $query->result();
    }
    public function getTimes()
    {
         $query = $this->db->get('a_times');
         return $query->result_array();
    }
}
