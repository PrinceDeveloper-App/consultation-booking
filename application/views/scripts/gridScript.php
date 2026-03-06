<script>
    $(function() {
      $("#grid").selectable({
        stop: function() {
          let selected = $(".ui-selected").map(function() {
            return $(this).text();
          }).get();
          //console.log("Selected items:", selected);
          let value = selected[0];
          console.log(value);
          $('#active_time').val(value);
          let selectedDate = $(".item_date").html();
          //console.log(selectedDate);
        }
      });
    });
  </script>