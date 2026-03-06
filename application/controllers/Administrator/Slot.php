<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slot extends CI_Controller {

  public function get_slots() {
    $month = $this->input->post('month');
    $year  = $this->input->post('year');

    // Example: mock slot data
    $slots = [
      "$year-$month-01" => ["9:00 AM", "10:30 AM", "4:00 PM"],
      "$year-$month-02" => ["11:00 AM", "1:30 PM"],
      "$year-$month-03" => ["2:00 PM", "5:30 PM"]
    ];

    echo json_encode($slots);
  }
}
