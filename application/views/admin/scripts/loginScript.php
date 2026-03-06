<script>
$('#loginForm').on('submit', function(e) {
  e.preventDefault();

  $.ajax({
    url: '<?= base_url("Administrator/Auth/login") ?>',   // controller/method
    type: 'POST',
    dataType: 'json',
    data: $(this).serialize(),
    success: function(res) {
        console.log(res);
      if (res.status === 'success') {
        $('#response').html('<span style="color:green;">' + res.message + '</span>');
        window.location.href = res.redirect; // redirect if needed
      } else {
        $('#response').html('<span style="color:red;">' + res.message + '</span>');
      }
    },
    error: function() {
      $('#response').html('<span style="color:red;">Server error!</span>');
    }
  });
});
</script>