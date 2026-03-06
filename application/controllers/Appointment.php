<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {

    public function get_slots()
    {
        // Time slots stored in Mountain Time (AB)
        $mountainTimezone = new DateTimeZone('America/Edmonton');
        $selectedTimezone = $this->input->post('timezone');

        // Example: slots from database (in 24-hr format)
        $slots = [
            '2025-11-06 09:00:00',
            '2025-11-06 13:30:00',
            '2025-11-06 16:00:00'
        ];

        $convertedSlots = [];
        foreach ($slots as $slot) {
            $date = new DateTime($slot, $mountainTimezone);
            $date->setTimezone(new DateTimeZone($selectedTimezone));
            $convertedSlots[] = [
                'utc' => gmdate('Y-m-d\TH:i:s\Z', strtotime($slot)),
                'local' => $date->format('Y-m-d H:i:s')
            ];
        }

        echo json_encode($convertedSlots);
    }
}
