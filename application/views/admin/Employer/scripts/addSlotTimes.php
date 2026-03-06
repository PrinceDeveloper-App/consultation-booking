<script>
    // $('#mySelect2').select2({
    //     placeholder: "Select Times",
    //     allowClear: true
    // });

    $('#time-add-form').on('submit', function(e) {
        e.preventDefault();
        //alert("hi");
        var times = $('#mySelect2').val();
        var date = $('#time_date').val();
        //console.log(selectedValues); 
        $.ajax({
            url: "<?php echo base_url('Administrator/Employer/Schedule/timeSave'); ?>",
            type: "POST",
            data: {
                times: times,
                date: date
            }, // 🚀 send array
            dataType: "json",
            //dataType: "json",
            success: function(res) {
                //console.log(res);
                if (res.status == "success") {
                    location.reload();
                    /*$('#msg').html("<p style='color:green'>" + res.message + "</p>");
                    $('#grid').empty();
                    $('#grid').append('<div class="item_date" style="display: none;">' + date + '</div> ');
                    $('#time_date').val(date);
                    $.each(times, function(index, value) {
                        $('#grid').append('<div class="item">' + value + '</div> ');
                    });*/
                } else {
                    $('#msg').html("<p style='color:red'>" + res.message + "</p>");
                }
            }
        });
    });
</script>