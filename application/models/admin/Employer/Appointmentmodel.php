<?php
class Appointmentmodel extends CI_Model
{
    public function getAppointments()
    {
        $this->db->select('emp_appointment_data.*,  emp_appointment_slotes.*');
        $this->db->from('emp_appointment_data');
        $this->db->join('emp_appointment_slotes', 'emp_appointment_data.appointment_id = emp_appointment_slotes.appointment_id');
        
        $query = $this->db->get();
        return $query->result_array();
    }
     public function update_status($id, $status)
    {
        $this->db->set('appointment_status', $status);
        $this->db->where('appointment_id', $id);
        return $this->db->update('emp_appointment_data');  // your table name
    }
}
