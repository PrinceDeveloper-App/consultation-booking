<script src="<?php echo base_url() ?>resources/calendar-appointment/js/mobiscroll.jquery.min.js"></script>

<script>
$('#demo-booking-datetime').mobiscroll().datepicker({
    controls: ['calendar', 'timegrid'],
    min: '2025-10-17T00:00',
    max: '2026-04-17T00:00',
    minTime: '08:00',
    maxTime: '19:59',
    stepMinute: 60,
    // example for today's labels and invalids
    labels: [{
        start: '2025-10-17',
        textColor: '#e1528f',
        title: '2 SPOTS'
    }],
    invalid: [{
        start: '2025-10-17T08:00',
        end: '2025-10-17T13:00'
    }, {
        start: '2025-10-17T15:00',
        end: '2025-10-17T17:00'
    }, {
        start: '2025-10-17T19:00',
        end: '2025-10-17T20:00'
    }]
});
</script>