<?php
class Appointmentmodel extends CI_Model
{
    public function getAppointments()
    {
        $this->db->select('appointment_data.*,  appointment_slotes.*');
        $this->db->from('appointment_data');
        $this->db->join('appointment_slotes', 'appointment_data.appointment_id = appointment_slotes.appointment_id');
        
        $query = $this->db->get();
        return $query->result_array();
    }
     public function update_status($id, $status)
    {
        $this->db->set('appointment_status', $status);
        $this->db->where('appointment_id', $id);
        return $this->db->update('appointment_data');  // your table name
    }
}
