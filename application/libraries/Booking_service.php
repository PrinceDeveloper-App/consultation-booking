<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Handles slot management (availability checks, booking, deletion).
 * Works with both applicant and employer slot tables.
 */
class Booking_service
{
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    /**
     * Removes a booked time slot from the slots table within a transaction.
     *
     * @param string $booking_time Time string to remove
     * @param string $booking_date Date in Y-m-d format
     * @param string $table        Slots table name ('slots' or 'emp_slots')
     * @return bool
     */
    public function remove_slot($booking_time, $booking_date, $table = 'slots')
    {
        $record = $this->CI->db->get_where($table, ['date' => $booking_date])->row();

        if (!$record) {
            return false;
        }

        $slots      = str_replace(['{', '}'], '', $record->slot_times);
        $slot_array = array_map('trim', explode(',', $slots));
        $new_count  = $record->slot_count - 1;

        $slot_array    = array_values(array_diff($slot_array, [$booking_time]));
        $updated_slots = '{' . implode(',', $slot_array) . '}';

        $this->CI->db->set('slot_times', $updated_slots);
        $this->CI->db->set('slot_count', $new_count);
        $this->CI->db->where('date', $booking_date);
        $this->CI->db->update($table);

        if ($new_count <= 0) {
            $this->CI->db->where('date', $booking_date);
            $this->CI->db->where('slot_count <=', 0);
            $this->CI->db->delete($table);
        }

        return true;
    }

    /**
     * Saves or updates time slots for a given date.
     *
     * @param array  $times Array of time strings
     * @param string $date  Date string (will be converted to Y-m-d)
     * @param string $table Slots table name
     * @return array Response array with status and message
     */
    public function save_slots($times, $date, $table = 'slots')
    {
        $slotcount = count($times);
        $curly     = '{ ' . implode(', ', $times) . ' }';
        $newDate   = date('Y-m-d', strtotime(str_replace('/', '-', $date)));

        $this->CI->db->where('date', $newDate);
        $query = $this->CI->db->get($table);

        if ($query->num_rows() > 0) {
            $this->CI->db->where('date', $newDate);
            $this->CI->db->update($table, [
                'slot_times' => $curly,
                'slot_count' => $slotcount,
            ]);
            return ['status' => 'success', 'message' => 'Slot updated successfully.'];
        }

        $this->CI->db->insert($table, [
            'slot_times' => $curly,
            'date'       => $newDate,
            'slot_count' => $slotcount,
        ]);
        return ['status' => 'success', 'message' => 'New slot inserted.'];
    }

    /**
     * Deletes a specific time slot, checking for existing appointments first.
     *
     * @param string $time             Time to delete
     * @param string $date             Date of the slot
     * @param string $slots_table      Slots table name
     * @param string $bookings_table   Appointment bookings table name
     * @return array Response with status and data
     */
    public function delete_admin_slot($time, $date, $slots_table = 'slots', $bookings_table = 'appointment_slotes')
    {
        $this->CI->db->where('appointment_date', $date);
        $this->CI->db->where('appointment_time', $time);
        $query = $this->CI->db->get($bookings_table);

        if ($query->num_rows() > 0) {
            return [
                'status'  => 'fail',
                'message' => 'You cannot delete this slot because an appointment is already booked for this time.',
            ];
        }

        $formatted_date = date('Y-m-d', strtotime(str_replace('/', '-', $date)));
        $record = $this->CI->db->get_where($slots_table, ['date' => $formatted_date])->row();

        if (!$record) {
            return ['status' => 'fail', 'message' => 'Slot not found.'];
        }

        $slots          = str_replace(['{', '}'], '', $record->slot_times);
        $slot_array     = array_map('trim', explode(',', $slots));
        $new_slot_count = $record->slot_count - 1;
        $slot_array     = array_values(array_diff($slot_array, [$time]));
        $updated_slots  = '{' . implode(',', $slot_array) . '}';

        $this->CI->db->set('slot_times', $updated_slots);
        $this->CI->db->set('slot_count', $new_slot_count);
        $this->CI->db->where('date', $formatted_date);
        $this->CI->db->update($slots_table);

        if ($new_slot_count <= 0) {
            $this->CI->db->where('date', $formatted_date);
            $this->CI->db->where('slot_count <=', 0);
            $this->CI->db->delete($slots_table);
        }

        return [
            'status'    => 'success',
            'slotcount' => $new_slot_count,
            'times'     => $slot_array,
        ];
    }

    /**
     * Removes past time slots for today based on Mountain Time.
     *
     * @param string $table Slots table name
     */
    public function cleanup_past_slots($table = 'slots')
    {
        date_default_timezone_set('America/Edmonton');
        $today     = date('Y-m-d');
        $currentMT = date('h:i A');

        $this->CI->db->where('date', $today);
        $rows = $this->CI->db->get($table)->result();

        foreach ($rows as $row) {
            $slotTimes = json_decode($row->slot_times, true);
            if (!is_array($slotTimes)) continue;

            $updatedSlots = [];
            foreach ($slotTimes as $time) {
                if (strtotime($time) > strtotime($currentMT)) {
                    $updatedSlots[] = $time;
                }
            }

            $this->CI->db->where('id', $row->id);
            $this->CI->db->update($table, ['slot_times' => json_encode($updatedSlots)]);
        }
    }

    /**
     * Deletes all slots for today.
     *
     * @param string $table Slots table name
     */
    public function delete_expired_rows($table = 'slots')
    {
        date_default_timezone_set('America/Edmonton');
        $today = date('Y-m-d');

        $this->CI->db->where('date', $today);
        $this->CI->db->delete($table);
    }
}
