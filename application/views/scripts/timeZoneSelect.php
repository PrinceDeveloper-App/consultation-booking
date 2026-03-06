<script>
$(document).ready(function() {
  // Detect browser time zone for default selection
  const detectedTZ = Intl.DateTimeFormat().resolvedOptions().timeZone;
  $("#timezoneSelect").val(detectedTZ);

  // Function to load and display slots
  function loadSlots(timezone) {
    $.ajax({
      url: "<?php echo base_url() ?>Appointment/get_slots", // Change base_url to your project base
      type: "POST",
      dataType: "json",
      data: { timezone: timezone },
      success: function(response) {
        $("#slotList").empty();
        $("#slotList").append("<h4>Available Slots (" + timezone + ")</h4>");

        $.each(response, function(i, slot) {
          const local = new Date(slot.local).toLocaleString("en-US", {
            timeZone: timezone,
            hour: "2-digit",
            minute: "2-digit",
            hour12: true
          });

          $("#slotList").append("<div class='slot'>" + local + "</div>");
        });
      },
      error: function(xhr, status, error) {
        console.error("Error loading slots:", error);
      }
    });
  }

  // Initial load
  loadSlots($("#timezoneSelect").val());

  // Reload on time zone change
  $("#timezoneSelect").on("change", function() {
    loadSlots($(this).val());
  });
});
</script>