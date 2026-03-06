<script src="<?php echo base_url() ?>resources/calendar-appointment/js/evk_calendar_jk.js"></script>
<script type="text/javascript">
$(document).ready(function(){

  $('#cale').evkJKcalendar({
    initDate: '2024-04-20',
    minDate: "-1m", // Minimum date is 1 month ago
    maxDate: "+1y", // Maximum date is 1 year from now
  });

  // Events
  $("#cale").on('change',function(e, date){
    alert('date: '+date);
  }).on('month_prev',function(e, month){
    log('month: '+month);
  }).on('month_next',function(e, month){
    log('month: '+month);
  }).on('year_prev',function(e, year){
    log('year: '+year);
  }).on('year_next',function(e, year){
    log('year: '+year);
  });

});
</script>
<!-- <script src="<?php //echo base_url() ?>resources/calendar-appointment/js/evk_calendar_jk.js"></script>

<script>
  mobiscroll.setOptions({
    locale: mobiscroll.localeEn, // Specify language like: locale: mobiscroll.localePl or omit setting to use default
    theme: 'ios', // Specify theme like: theme: 'ios' or omit setting to use default
    themeVariant: 'light' // More info about themeVariant: https://mobiscroll.com/docs/jquery/datepicker/api#opt-themeVariant
  });

  $(function() {
    // var now = new Date();
    // now.setHours(0, 0, 0, 0);
    // var min = now.toISOString().slice(0, 16);
    var now = new Date();
    var min = now.toISOString().slice(0, 16);
    //console.log(formatted);
    //var min = '2025-10-16T00:00';
    var max = '2026-04-16T00:00';



    $('#booking-datetime')
      .mobiscroll()
      .datepicker({
        display: 'inline', // Specify display mode like: display: 'bottom' or omit setting to use default
        controls: ['calendar'], // More info about controls: https://mobiscroll.com/docs/jquery/datepicker/api#opt-controls
        min: min, // More info about min: https://mobiscroll.com/docs/jquery/datepicker/api#opt-min
        max: max, // More info about max: https://mobiscroll.com/docs/jquery/datepicker/api#opt-max
        //minTime: '08:00',
        //maxTime: '19:59',
        //stepMinute: 60,
        width: null, // More info about width: https://mobiscroll.com/docs/jquery/datepicker/api#opt-width
        // onPageLoading: function (event, inst) {  // More info about onPageLoading: https://mobiscroll.com/docs/jquery/datepicker/api#event-onPageLoading
        //   getDatetimes(event.firstDay, function callback(bookings) {
        //     inst.setOptions({
        //       labels: bookings.labels,           // More info about labels: https://mobiscroll.com/docs/jquery/datepicker/api#opt-labels
        //       invalid: bookings.invalid,         // More info about invalid: https://mobiscroll.com/docs/jquery/datepicker/api#opt-invalid
        //     });
        //   });
        // },
        onCellClick: function(selected, inst) {
          // date is a moment object representing the clicked date
          let dateValue = selected.date;
          //console.log(dateValue);
          handleDateClick(dateValue); // Format as needed
        },
      });

    function handleDateClick(selectedDate) {
      let day = String(selectedDate.getDate()).padStart(2, '0');
      let month = String(selectedDate.getMonth() + 1).padStart(2, '0'); // months are 0-indexed
      let year = selectedDate.getFullYear();

      let formattedDate = `${day}-${month}-${year}`;
      console.log(formattedDate); // 👉 "24-10-2025"
      // console.log(selectedDate);
    }

    // function getDatetimes(day, callback) {
    //   var invalid = [];
    //   var labels = [];

    //   mobiscroll.getJson(
    //     'https://trial.mobiscroll.com/getbookingtime/?year=' + day.getFullYear() + '&month=' + day.getMonth(),
    //     function (bookings) {
    //       for (var i = 0; i < bookings.length; ++i) {
    //         var booking = bookings[i];
    //         var bDate = new Date(booking.d);
    //         console.log(bDate);
    //         if (booking.nr > 0) {
    //           labels.push({
    //             start: bDate,
    //             title: booking.nr + ' SPOTS',
    //             textColor: '#e1528f',
    //           });

    //           $.merge(invalid, booking.invalid);
    //         } else {
    //           invalid.push(bDate);
    //         }
    //       }
    //       callback({ labels: labels, invalid: invalid });
    //     },
    //     'jsonp',
    //   );
    // }


  });
</script> -->