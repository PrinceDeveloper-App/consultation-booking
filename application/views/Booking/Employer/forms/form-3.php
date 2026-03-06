<style>
  .meeting-method-modern {
    margin: 15px 0;
  }

  .meeting-method-modern .title {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
    font-size: 16px;
  }

  /* Flex row for two options */
  .options-row {
    display: flex;
    gap: 15px;
    /* space between boxes */
  }

  .option-box {
    flex: 1;
    /* both take equal width */
    cursor: pointer;
  }

  .option-box input[type="radio"] {
    display: none;
    /* hide default radio */
  }

  .option-box .box {
    padding: 14px 75px;
    border: 2px solid #dcdcdc;
    border-radius: 12px;
    text-align: center;
    transition: all 0.3s ease;
    background: #fff;
  }

  .option-box:hover .box {
    border-color: #8bbafc;
    background: #f0f6ff;
  }

  .option-box input[type="radio"]:checked+.box {
    border-color: #0066ff;
    background: #e8f0ff;
    box-shadow: 0 0 8px rgba(0, 102, 255, 0.3);
  }

  .option-box .text {
    font-size: 15px;
    font-weight: 500;
    color: #333;
  }
</style>

<form id="form-3" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
  <div class="row" style="margin-left: 10px;margin-right: 10px;">
    <div class="col-md-6">
      <div id="datepicker-container" style="margin-bottom: 10px;"></div>
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
  </div>
  <div class="row" style="margin-left: 10px;margin-right: 10px;">
    <div class="col-md-6">
      <div class="meeting-method-modern">
        <label class="title">Select Preferred Meeting Method</label>

        <label class="option-box">
          <input type="radio" class="form-select form-control" name="meeting_method" value="Zoom/Video" required>
          <div class="box">
            <span class="text">Zoom / Video</span>
          </div>
        </label>

        <label class="option-box">
          <input type="radio" class="form-select form-control" name="meeting_method" value="Phone Call" required>
          <div class="box">
            <span class="text">Phone Call</span>
          </div>
        </label>
      </div>
    </div>
    
  </div>
  <div class="col" style="margin-left: 25px;">
      <input type="checkbox" class="form-check-input" id="save-info" required>&nbsp;&nbsp;
      <label class="form-check-label" for="save-info" style="font-size: 16px;">I agree to be contacted regarding my inquiry.</label>
    </div>
</form>