<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        //$this->load->library('encrypt'); 
        $this->load->helper(array('cookie', 'url'));
        $this->load->model('admin/Employer/Schedullingmodel');
        //$this->load->library('user_agent');
        $this->load->database();
    }

    public function create()
    {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $data['pageid'] = "employer";
            $data['breadcrumb'] = "Employer Schedulling";
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
            $data['schedules'] = $this->Schedullingmodel->getSchedules($next_working_day);
            $data['timesadd'] = $this->Schedullingmodel->getTimes();
            $this->load->view('admin/Employer/schedullingPage', $data);
        } else {
            redirect(base_url());
        }
    }
    public function getSchedules()
    {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $data['pageid'] = "employer";
            $data['breadcrumb'] = "Schedulling";
            $current_date = $this->input->post('date');
            $data = $this->Schedullingmodel->getSchedules($current_date);
            // Return JSON response
            if (isset($data) && is_countable($data)) {
                $response = [
                    'status' => 'success',
                    'data' => $data
                ];
                echo json_encode($response);
            } else {

                $response = [
                    'status' => 'not found'
                ];
                echo json_encode($response);
            }

            //echo json_encode($data);
            //$this->load->view('admin/schedullingPage', $data);
        } else {
            redirect(base_url());
        }
    }
    public function get_slots()
    {
        $this->load->database();
        $query = $this->db->get('emp_slots');
        $result = $query->result_array();
        echo json_encode($result);
    }
    public function timeSave()
    {
        $times = $this->input->post('times');  // receives array
        $date = $this->input->post('date');
        $slotcount = count($times);
        $curly = "{ " . implode(', ', array_map(function ($t) {
            return '' . $t . '';
        }, $times)) . " }";
        $newDate = date("Y-m-d", strtotime(str_replace('/', '-', $date)));
        // Check if row exists
        $this->db->where('date', $newDate);
        $query = $this->db->get('emp_slots');

        if ($query->num_rows() > 0) {
            //$newValue = "6:00 PM";
            //$array[] = $times;
            // Row exists – update slot
            $this->db->where('date', $newDate);
            $this->db->update('emp_slots', [
                'slot_times' => $curly,
                'slot_count' => $slotcount
            ]);

            $response = [
                'status' => 'success',
                'message' => 'Slot updated successfully.'
            ];
        } else {
            // Row does not exist – insert new row
            if ($curly == "" || $newDate == "") {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'All fields are required'
                ]);
                return;
            }

            $data = [
                'slot_times'  => $curly,
                'date' => $newDate,
                'slot_count' => $slotcount
            ];

            $this->db->insert('emp_slots', $data);

            $response = [
                'status' => 'success',
                'message' => 'New slot inserted.'
            ];
        }
        $this->session->set_flashdata('success', 'Time added successfully!');
        $this->session->set_flashdata('date', $date);
        echo json_encode($response);
    }
    public function delete_slot()
    {


        $time = $this->input->post('time');  // receives array
        $date = $this->input->post('date');
        // Check if any appointments
        $this->db->where('appointment_date', $date);
        $this->db->where('appointment_time', $time);
        $query = $this->db->get('emp_appointment_slotes');

        if ($query->num_rows() == 0) {
            $date = date("Y-m-d", strtotime(str_replace('/', '-', $date)));
            // Get the current slots
            $record = $this->db->get_where('slots', ['date' => $date])->row();

            if ($record) {
                // Clean braces and convert to array
                $slots = str_replace(['{', '}'], '', $record->slot_times);
                $slot_array = array_map('trim', explode(',', $slots));
                $slot_count = $record->slot_count;
                $new_slot_count = $slot_count - 1;
                // Remove the selected slot
                $slot_array = array_diff($slot_array, [$time]);

                // Rebuild and update the string
                $updated_slots = '{' . implode(',', $slot_array) . '}';
                $this->db->set('slot_times', $updated_slots);
                $this->db->set('slot_count', $new_slot_count);
                $this->db->where('date', $date);
                $this->db->update('emp_slots');

                // 2. If slot_count = 0 → delete that row
                $this->db->where('date', $date);
                $this->db->where('slot_count', 0);
                $this->db->delete('emp_slots');
                $this->session->set_flashdata('delete', 'Time added successfully!');
                $this->session->set_flashdata('date', $date);
                // $response = [
                //     'status' => 'success',
                //     'times' => $updated_slots
                // ];
                $response = [
                    'status' => 'success',
                    'slotcount' => $new_slot_count,
                    'times' => $slot_array
                ];
                echo json_encode($response);
                //$this->db->update('slots', ['slot_times' => $updated_slots]);

                //echo 'Slot deleted successfully';
            }
        } else {
            $response = [
                'status' => 'fail',
                'message' => 'You cannot delete this slot because an appointment is already booked for this time.'
            ];
            echo json_encode($response);
        }
    }
}
