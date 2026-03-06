<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cronemp extends CI_Controller
{

    public function update_slots_based_on_mt()
    {
        date_default_timezone_set('America/Edmonton'); // Mountain Time
        $today = date("Y-m-d");

        
        $currentMT = date("h:i A"); // example: 12:34 PM

        // 1. Fetch all rows that contain slot times
        $this->db->where('date', $today);
        $slots = $this->db->get('emp_slots')->result();

        foreach ($slots as $row) {

            // Convert DB string to array
            $slotTimes = json_decode($row->slot_times, true);
            if (!is_array($slotTimes)) continue;

            $updatedSlots = [];

            foreach ($slotTimes as $time) {

                // Compare each slot with MT time
                $slotTimestamp   = strtotime($time);
                $currentTimestamp = strtotime($currentMT);

                if ($slotTimestamp > $currentTimestamp) {
                    // keep future slots
                    $updatedSlots[] = $time;
                }
            }

            // Update DB with remaining future slots
            $this->db->where('id', $row->id);
            $this->db->update('emp_slots', [
                'slot_times' => json_encode($updatedSlots)
            ]);
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Past time slots removed based on Mountain Time.'
        ]);
    }
}
