<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> -->
<style>
    .form-control {
        width: 98% !important;
    }

    /* Submit Button */
    #contact-submit {
        border: none;
        padding: 15px 0;
        width: 100%;
        margin: 0;
        background: #000;
        color: #fff;
        border-radius: 0;
    }

    #time-submit {
        border: none;
        padding: 15px 0;
        width: 100%;
        margin: 0;
        background: #000;
        color: #fff;
        border-radius: 0;
    }

    .select2-container .select2-selection--multiple {
        min-height: 80px !important;
        height: auto !important;
        overflow-y: auto !important;
    }

    .select2-container .select2-selection__choice {
        margin-top: 5px !important;
    }

    .select2-results__options {
        max-height: 300px !important;
    }

    .time-select {
        width: 100%;
        margin-bottom: 25px;
        font-size: 16px;
        font-weight: 600;
        text-align: center;
        height: 175px;
        border-radius: 10px;
    }

    select option {
        padding-top: 10px;
        padding-bottom: 10px;
    }
</style>
<section class="page-wrapper">
    <div class="contact-section">
        <div class="container">
            <div class="row">
                <?php include_once(VIEWPATH . "admin/common/dashboardMenu.php") ?>
                <!-- Contact Form -->
                <div class="contact-form col-md-6 ">
                    <h3>Schedule Dates</h3>
                    <!-- <form id="contact-form" method="post" action="" role="form"> -->

                    <div class="form-group">
                        <!-- <input type="text" id="datepicker"> -->
                        <div id="datepicker-container"></div>
                        <div id="slotContainer" style="margin-top:10px;"></div>
                        <!-- <div class="mbsc-form-group">
                                <div class="mbsc-form-group-title">Select date & time</div>
                                <div id="booking-datetime" class="booking-datetime"></div>
                            </div> -->
                    </div>
                    <!-- <div id="cf-submit">
                            <input type="submit" id="contact-submit" class="btn btn-transparent" value="Submit">
                        </div>

                    </form> -->
                </div>
                <!-- ./End Contact Form -->

                <!-- Contact Details -->
                <div class="contact-details col-md-3 ">
                    <h3>Schedule Times</h3>
                    <form id="remove-slot" method="post" action="" role="form">

                        <div class="form-group" style="padding-top: 45px;">
                            <!-- <ul class="contact-short-info">
                                <li><a href="#!" class="btn btn-main btn-medium btn-round-full">Full Round Button</a></li>
                                <li><a href="#!" class="btn btn-main btn-medium btn-round-full">Full Round Button</a></li>
                                <li><a href="#!" class="btn btn-main btn-medium btn-round-full">Full Round Button</a></li>
                            </ul> -->
                            <?php 
                            if(isset($schedules) && count($schedules) > 0){
                            foreach ($schedules as $schedule) {
                                $time_string = $schedule['slot_times'];
                                // Clean and explode
                                $cleaned = trim($time_string, '{}');
                                $times = array_map('trim', explode(',', $cleaned));
                               
                            }
                                //print_r($times);
                            } 
                             $current_date = date('d-m-Y');
                            ?>
                            <div id="grid">
                                <?php 
                                if(isset($times)){
                                foreach ($times as $t) { ?>
                                    <div class="item" id="schedules_by_date"><?php echo $t; ?></div>
                                <?php } } ?>
                                <div class="item_date" id="active_date" style="display: none;"><?php echo $current_date ?></div>
                            </div>
                        </div>
                        <input type="hidden" name="time_slot_selected" value="" id="time_slot_selected">
                        <div id="errmsg"></div>
                        <div id="cf-submit">
                            <input type="submit" id="contact-submit" class="btn btn-transparent" value="Remove">
                        </div>
                    </form>
                    <!--/. End Footer Social Links -->
                </div>
                <!-- / End Contact Details -->
                <div class="contact-details col-md-3 ">
                    <h3>Select Times</h3>
                    <form id="time-add-form" style="margin-top: 52px;">
                        <input type="hidden" name="time_date" value="<?php echo $current_date ?>" id="time_date">
                        <select id="mySelect2" class="time-select" name="times" multiple="multiple" style="width: 100%; margin-bottom: 25px;">
                            <?php if (isset($timesadd)) {
                                foreach ($timesadd as $ta) { ?>
                                    <option value="<?php echo $ta['time'] ?>"><?php echo $ta['time'] ?></option>
                            <?php }
                            } ?>
                        </select>
                        <!-- <div class="form-group" style="padding-top: 45px;">
                            <select id="multiTime" multiple size="6"></select>
                        </div> -->
                        <div id="msg"></div>
                        <div id="cf-submit">
                            <button type="submit" id="time-submit" class="btn btn-transparent">Add To Schedule</button>
                        </div>
                    </form>
                    <!--/. End Footer Social Links -->
                </div>


            </div> <!-- end row -->
        </div> <!-- end container -->
    </div>
</section>