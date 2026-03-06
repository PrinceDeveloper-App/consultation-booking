<script>
    $(function() {
  let times = ["9:00 AM", "10:30 AM", "12:00 PM", "2:00 PM", "4:00 PM", "6:00 PM"];
  times.forEach(t => $("#multiTime").append(`<option value="${t}">${t}</option>`));

  // Get selected
  $("#multiTime").on("change", function() {
    let selected = $(this).val(); // returns an array
    console.log("Selected Times:", selected);
  });
  });
</script>