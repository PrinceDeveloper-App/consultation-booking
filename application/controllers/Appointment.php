<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Timezone conversion API for appointment slots.
 */
class Appointment extends MY_Controller
{
    public function get_slots()
    {
        $selectedTimezone = $this->post('timezone');

        if (empty($selectedTimezone)) {
            $this->json_error('Timezone is required.');
            return;
        }

        $slots = [
            '2025-11-06 09:00:00',
            '2025-11-06 13:30:00',
            '2025-11-06 16:00:00',
        ];

        $this->load->library('timezone_service');
        $converted = $this->timezone_service->convert_slots($slots, $selectedTimezone);
        echo json_encode($converted);
    }
}
