<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Converts time slots between Mountain Time and a target timezone.
 */
class Timezone_service
{
    const MOUNTAIN_TIMEZONE = 'America/Edmonton';

    /**
     * Converts an array of datetime strings from Mountain Time to the target timezone.
     *
     * @param array  $slots            Datetime strings in Y-m-d H:i:s format
     * @param string $target_timezone  IANA timezone string
     * @return array Converted slots with 'utc' and 'local' keys
     */
    public function convert_slots($slots, $target_timezone)
    {
        $mountain = new DateTimeZone(self::MOUNTAIN_TIMEZONE);
        $target   = new DateTimeZone($target_timezone);
        $result   = [];

        foreach ($slots as $slot) {
            $date = new DateTime($slot, $mountain);
            $utc  = gmdate('Y-m-d\TH:i:s\Z', strtotime($slot));
            $date->setTimezone($target);

            $result[] = [
                'utc'   => $utc,
                'local' => $date->format('Y-m-d H:i:s'),
            ];
        }

        return $result;
    }
}
