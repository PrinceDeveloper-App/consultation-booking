<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> -->
<section class="page-wrapper">
    <div class="contact-section">
        <div class="container">
            <div class="row">
                <?php include_once(VIEWPATH . "admin/common/dashboardMenu.php") ?>
                <!-- Date Picker Section -->
                <div class="contact-form col-md-6 ">
                    <h3>Schedule Dates</h3>
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-common" role="alert"><i class="tf-ion-thumbsup"></i>
                            <span>Well done!</span> You have succesfully added time slots to <?= $this->session->flashdata('date'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <div id="datepicker-container"></div>
                        <div id="slotContainer" style="margin-top:10px;"></div>
                    </div>
                </div>
                <!-- ./End Date Picker Section -->

                <!-- List Scheduled Times -->
                <div class="contact-details col-md-3 ">
                    <h3>Active Slots</h3>

                    <?php if ($this->session->flashdata('delete')): ?>
                        <div class="alert alert-danger alert-common" role="alert">
                            <i class="tf-ion-close-circled"></i><span>Deleted!</span>
                            You have successfully deleted the time slot from <?= $this->session->flashdata('date'); ?>
                        </div>
                    <?php endif; ?>
                    <form id="remove-slot" method="post" action="" role="form">

                        <div class="form-group" style="padding-top: 45px;">
                            <?php
                            if (isset($schedules) && count($schedules) > 0) {
                                foreach ($schedules as $schedule) {
                                    $time_string = $schedule['slot_times'];
                                    $booking_date = $schedule['date'];
                                    $formatted_date = date("d-m-Y", strtotime($booking_date));
                                    // Clean and explode
                                    $cleaned = trim($time_string, '{}');
                                    $times = array_map('trim', explode(',', $cleaned));
                                }
                            }
                            if (!isset($formatted_date)) {
                                $formatted_date = date('d-m-Y', strtotime('+1 day'));
                            }
                            ?>
                            <div id="grid">
                                <?php
                                if (isset($times)) {
                                    foreach ($times as $t) { ?>
                                        <div class="item" id="schedules_by_date"><?php echo $t; ?></div>
                                    <?php }
                                } else { ?>
                                    <div class="item" id="schedules_by_date">No Slots Available</div>
                                <?php } ?>
                                <div class="item_date" id="active_date" style="display: none;"><?php echo $formatted_date ?></div>
                            </div>
                        </div>
                        <input type="hidden" name="time_slot_selected" value="" id="time_slot_selected">
                        <div id="errmsg"></div>
                        <div id="cf-submit">
                            <?php
                            if (isset($times)) { ?>
                                <input type="submit" id="contact-submit" class="btn btn-transparent" value="Remove">
                            <?php } ?>
                        </div>
                    </form>
                    <!--/. End Form -->

                    <div class="instruction-box">
                        <h4>Instructions To Remove Slots</h4>
                        <ol>
                            <li>Select date from the date picker</li>
                            <li>Select slot time want to delete</li>
                            <li>Click the remove button</li>
                        </ol>
                    </div>

                </div>
                <!-- / End Listing -->

                <!-- Slot Adding Section -->
                <div class="contact-details col-md-3 ">
                    <h3>Select Times</h3>

                    <!-- Form Begin -->
                    <form id="time-add-form" style="margin-top: 52px;">
                        <input type="hidden" name="time_date" value="<?php echo $formatted_date ?>" id="time_date">
                        <select id="mySelect2" class="time-select" name="times" multiple="multiple" style="width: 100%; margin-bottom: 25px;">
                            <?php if (isset($timesadd)) {
                                foreach ($timesadd as $ta) { ?>
                                    <option value="<?php echo $ta['time'] ?>"><?php echo $ta['time'] ?></option>
                            <?php }
                            } ?>
                        </select>
                        <div id="msg"></div>
                        <div id="cf-submit">
                            <button type="submit" id="time-submit" class="btn btn-transparent">Add To Schedule</button>
                        </div>
                    </form>
                    <!--/. End Form -->

                    <div class="instruction-box">
                        <h4>Instructions To Add Slots</h4>
                        <ol>
                            <li>Select date from the date picker</li>
                            <li>Select the times you want to add to the time slots from the above time box.</li>
                            <li>Click the Add To Schedule button</li>
                        </ol>
                    </div>

                </div>

                <!-- End Slot adding Section -->

            </div> <!-- end row -->
        </div> <!-- end container -->
    </div>
</section>