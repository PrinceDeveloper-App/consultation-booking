<script>
    // $('#mySelect2').select2({
    //     placeholder: "Select Times",
    //     allowClear: true
    // });

    let clickedCell = null;

    $(document).on("click", ".ui-datepicker-calendar td", function() {
        if ($(this).hasClass("ui-state-disabled")) return; // ignore blank cells

        clickedCell = $(this); // store the clicked td
    });

    $('#remove-slot').on('submit', function(e) {
        e.preventDefault();
        //alert("hi");
        var time = $('#time_slot_selected').val();
        var date = $('#time_date').val();
        console.log(date);
        console.log(time);

        //console.log(selectedValues); 
        $.ajax({
            url: "<?php echo base_url('Administrator/Employer/Schedule/delete_slot'); ?>",
            type: "POST",
            data: {
                time: time,
                date: date
            }, // 🚀 send array
            dataType: "json",
            //dataType: "json",
            success: function(res) {
                console.log(res);
                if (res.status == "success") {
                    location.reload();
                    /*let times = res.times;
                    let slotcount = res.slotcount;
                    console.log(slotcount);
                    $('#errmsg').html("<p style='color:green'>The slot deleted successfully</p>").fadeOut(5000);;
                    $('#grid').empty();
                    $('#grid').append('<div class="item_date" style="display: none;">' + date + '</div> ');
                    $('#time_date').val(date);
                    $.each(times, function(index, value) {
                        //console.log("Time " + (index + 1) + ": " + value);
                        $('#grid').append('<div class="item">' + value + '</div> ');
                    });
                    console.log(clickedCell);
                    if (clickedCell) {
                        clickedCell.find(".slot-info").html("0 slots"); // change HTML content
                    }*/

                    // cell.find(".slot-info").remove();
                    // cell.append('<span class="slot-info">' + slotcount + ' slots</span>');
                    // $('#userForm')[0].reset();
                } else {
                    $('#errmsg').html("<p style='color:red'>" + res.message + "</p>").fadeOut(5000);;
                }
            }
        });
    });
</script>