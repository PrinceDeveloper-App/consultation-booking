<script>
  $(function() {
    // Initialize datepicker and display it always
    $("#datepicker-container").datepicker({
      inline: true, // Makes it always visible
      dateFormat: "dd-mm-yy",
      changeMonth: true,
      changeYear: true,
      minDate: 0, // Disable all dates before today
      onSelect: function(dateText) {
        let parts = dateText.split("-");  // ["01", "11", "2025"]
        let formatted = `${parts[2]}-${parts[1]}-${parts[0]}`;
        console.log("Selected dates: " + formatted);
        $.ajax({
          url: '<?= base_url("Administrator/Schedule/getSchedules") ?>', // controller route
          type: 'POST',
          dataType: 'json',
          data: {
            date: dateText
          },
          success: function(response) {

            if (response.status === 'not found') {
              alert('User not found!');
            } else {
              //console.log(response);
              $.each(response, function(index, item) {
                //console.log("ID:", item.schedule_id);
                //console.log("Date:", item.date);
                let date = item.date;
                var timeData = item.time;
                var times = timeData.replace(/[{}]/g, '').split(',').map(item => item.trim());
                //console.log(times);
                $('#grid').empty();
                $('#grid').append('<div class="item_date" style="display: none;">' + dateText + '</div> ');
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
      }, // Minimum date is 1 month ago
      maxDate: "+2m", // Maximum date is 1 year from now
      showWeek: true,
      firstDay: 1 // Start week on Monday
    });
  });
</script>