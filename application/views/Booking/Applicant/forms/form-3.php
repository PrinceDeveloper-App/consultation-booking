<form id="form-3" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
  <div class="col-md-6">
    <div id="datepicker-container"></div>
    <div id="slotContainer" style="margin-top:10px;"></div>

  </div>
  <?php
  if (isset($schedules) && count($schedules) > 0) {
    foreach ($schedules as $schedule) {
      $time_string = $schedule['slot_times'];
      $booking_date = $schedule['date'];
      // Clean and explode
      $cleaned = trim($time_string, '{}');
      $times = array_map('trim', explode(',', $cleaned));
      $formatted_date = date("d-m-Y", strtotime($booking_date));
      //next_working_day
     // $current_date = date('d-m-Y');
      //print_r($times);
    }
  }
  ?>
  <div class="col-md-6">
    <div id="grid">
      <?php if (isset($times)) {

        foreach ($times as $t) { ?>
          <div class="item" id="schedules_by_date"><?php echo $t; ?></div>


        <?php }
      } else { ?>
        <div class="no-slots" id="no_schdules"><span style="font-size: 20px; font-weight: 600;margin-top: 50px;"> No Slot's Available</span></div>
      <?php } ?>
      <?php if (isset($formatted_date)) { ?>
        <input class="item_date" id="active_date" name="booking_date" value="<?php echo $formatted_date ?>" style="display: none;" required>
      <?php } ?>

    </div>
    <div class="time-zone-message" id="time_zone_message" style="margin-top: 50px;">
      <?php if (isset($times)) { ?>

        <span style="font-size: 18px; font-weight: 600;margin-top: 50px;">
          Note: The appointment slots are based on Mountain Time (MT)
          – Alberta, Canada. Please be available for the consultation according to your local time zone.
        </span>

      <?php } ?>
    </div>
    <input class="booking-time" id="active_time" name="booking_time" value="" style="display: none;" required>
  </div>

</form>