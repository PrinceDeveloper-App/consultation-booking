<script>
    $(function() {
        let slotData = {};
        $("#datepicker-container").datepicker({
            inline: true, // Makes it always visible
            dateFormat: "dd-mm-yy",
            //   changeMonth: true,
            //   changeYear: true,
            minDate: 1, // Disable all dates before today
            beforeShowDay: function(date) {
                let yyyy = date.getFullYear();
                let mm = String(date.getMonth() + 1).padStart(2, '0');
                let dd = String(date.getDate()).padStart(2, '0');
                let key = yyyy + '-' + mm + '-' + dd;

                var day = date.getDay();

                // Disable Saturday (6) and Sunday (0)
                if (day === 0 || day === 6) {
                    return [false];
                }
                
                let slotText = slotData[key] ? slotData[key] + " slots" : "";
                //console.log(slotText);
                // Create custom tooltip
                return [true, "", slotText];
            },
            onChangeMonthYear: function(year, month, inst) {
                //console.log("Month:", month);
                setTimeout(() => updateCalendarCells(year, month), 0);
                //setTimeout(addSlotLabels, 0);
            },
            onSelect: function(dateText) {
                let parts = dateText.split("-"); // ["01", "11", "2025"]
                let formatedDate = `${parts[2]}-${parts[1]}-${parts[0]}`;
                console.log("Selected date: " + formatedDate);
                $.ajax({
                    url: '<?= base_url("Administrator/Employer/Schedule/getSchedules") ?>', // controller route
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        date: formatedDate
                    },
                    success: function(response) {

                        if (response.status === 'not found') {
                             $('#grid').empty();
                            $('#time_date').val(dateText);
                            $('#grid').append('<div class="item" id="schedules_by_date">No Slots Available</div>');
                            $('#cf-submit').empty();
                        } else {
                            console.log(response);
                            $.each(response.data, function(index, item) {
                                //console.log("ID:", item.schedule_id);
                                //console.log("Date:", item.date);
                                let date = item.date;
                                var timeData = item.slot_times;
                                var times = timeData.replace(/[{}]/g, '').split(',').map(item => item.trim());
                                console.log(times);
                                $('#grid').empty();
                                $('#cf-submit').empty();
                                $('#grid').append('<div class="item_date" style="display: none;">' + dateText + '</div> ');
                                $('#cf-submit').append('<input type="submit" id="contact-submit" class="btn btn-transparent" value="Remove">');
                                $('#time_date').val(dateText);
                                $.each(times, function(index, value) {
                                    console.log("Time " + (index + 1) + ": " + value);
                                    $('#grid').append('<div class="item">' + value + '</div> ');
                                });

                            });


                            // $('#result').html(
                            //     `<strong>Name:</strong> ${response.name}<br>
                            //      <strong>Email:</strong> ${response.email}`
                            // );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
                setTimeout(addSlotLabels, 0);
            },
            maxDate: "+2m", // Maximum date is 1 year from now
            //   showWeek: true,
            firstDay: 1 // Start week on Monday
        });
        // Load slot data via AJAX when page loads
        $.ajax({
            url: '<?= base_url("Administrator/Employer/Schedule/get_slots") ?>',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                // Store slot data in an object like { "2025-10-31": 4, ... }
                data.forEach(function(item) {
                    slotData[item.date] = item.slot_count;
                });
                //console.log(data);

                // Initialize datepicker after data is loaded


                // Add slot numbers as labels in the calendar
                addSlotLabels();
            }
        });
        // Run on initial page load too
        //setTimeout(addSlotLabels, 0);
        function updateCalendarCells(year, month) {
            const today = new Date();
            const todayStr = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, "0")}-${String(today.getDate()).padStart(2, "0")}`;
            //alert("hi");
            $(".ui-datepicker-calendar td").each(function() {
                let cell = $(this);
                let dateText = cell.text();
                //console.log(dateText);
                if (!dateText) return;

                // Construct date in yyyy-mm-dd format
                //let currentDate = $("#datepicker").datepicker("getDate");
                //console.log(currentDate);
                //if (!currentDate) currentDate = new Date(); // fallback to today if no date selected
                let currentDate = $("#datepicker-container").datepicker("getDate");

                // If no date selected or it's not a Date object, fallback to today's date
                if (!(currentDate instanceof Date) || isNaN(currentDate)) {
                    currentDate = new Date();
                }

                //let month = currentDate.getMonth() + 1;
                //console.log(month);
                let year = currentDate.getFullYear();
                let dateStr = year + '-' + String(month).padStart(2, '0') + '-' + String(dateText).padStart(2, '0');
                // compare dateStr with todayStr
                if (new Date(dateStr) < new Date(todayStr)) {
                    // past date → gray out and hide slot count
                    $(this)
                        .addClass("past-date")
                        .append(`<span class="slot-info" style="color:#ccc;">—</span>`);
                    return;
                }
                ////console.log(dateStr);
                if (slotData[dateStr]) {
                    //console.log("hi");
                    cell.find(".slot-info").remove();
                    cell.append('<span class="slot-info">' + slotData[dateStr] + ' slots</span>');
                }
            });
        }

        function addSlotLabels() {
            const today = new Date();
            const todayStr = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, "0")}-${String(today.getDate()).padStart(2, "0")}`;
            $(".ui-datepicker-calendar td").each(function() {
                let cell = $(this);
                let dateText = cell.text();
                //console.log(dateText);
                if (!dateText) return;

                // Construct date in yyyy-mm-dd format
                //let currentDate = $("#datepicker").datepicker("getDate");
                //console.log(currentDate);
                //if (!currentDate) currentDate = new Date(); // fallback to today if no date selected
                let currentDate = $("#datepicker-container").datepicker("getDate");

                // If no date selected or it's not a Date object, fallback to today's date
                if (!(currentDate instanceof Date) || isNaN(currentDate)) {
                    currentDate = new Date();
                }

                let month = currentDate.getMonth() + 1;
                //console.log(month);
                let year = currentDate.getFullYear();
                let dateStr = year + '-' + String(month).padStart(2, '0') + '-' + String(dateText).padStart(2, '0');
                // compare dateStr with todayStr
                if (new Date(dateStr) < new Date(todayStr)) {
                    // past date → gray out and hide slot count
                    $(this)
                        .addClass("past-date")
                        .append(`<span class="slot-info" style="color:#ccc;">—</span>`);
                    return;
                }
                ////console.log(dateStr);
                if (slotData[dateStr]) {
                    //console.log("hi");
                    cell.find(".slot-info").remove();
                    cell.append('<span class="slot-info">' + slotData[dateStr] + ' slots</span>');
                }
            });
        }
    });
</script>