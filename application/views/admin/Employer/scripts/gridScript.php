<script>
    $(function() {
      $("#grid").selectable({
        stop: function() {
          let selected = $(".ui-selected").map(function() {
            return $(this).text();
          }).get();
          //console.log("Selected items:", selected);
          let value = selected[0];
          $('#time_slot_selected').val(value);
          console.log(value);
          let selectedDate = $(".item_date").html();
          console.log(selectedDate);
        }
      });
    });
  </script>