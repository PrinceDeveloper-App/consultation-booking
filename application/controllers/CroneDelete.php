<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function delete_expired_rows()
    {
        // Prevent direct browser access if you want
        // if (php_sapi_name() !== 'cli') exit('CLI only.');

        $today = date('Y-m-d');  // Today in Y-m-d

        $this->db->where('slot_date', $today);
        $this->db->delete('your_table_name'); // replace table name

        echo "Rows deleted for date = " . $today;
    }
}
