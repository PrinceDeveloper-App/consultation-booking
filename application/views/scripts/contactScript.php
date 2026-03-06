<script>
    $('#contact-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "<?php echo base_url('Contactus/send_mail'); ?>", // your controller function
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $("#msg").html("Sending...");
            },
            success: function(response) {
                if (response.status === "success") {
                    $("#msg").html("<span style='color:green'>" + response.message + "</span>");
                    $('#contact-form')[0].reset();
                    // Fade after 10 seconds
                    setTimeout(function() {
                        $("#msg").fadeOut("slow", function() {
                            $(this).html("").show();
                        });
                    }, 10000);
                } else {
                    $("#msg").html("<span style='color:red'>" + response.message + "</span>");
                    // Fade after 10 seconds
                    setTimeout(function() {
                        $("#msg").fadeOut("slow", function() {
                            $(this).html("").show();
                        });
                    }, 10000);
                }
            },
            error: function() {
                $("#msg").html("<span style='color:red'>Something went wrong!</span>");
                // Fade after 10 seconds
                setTimeout(function() {
                    $("#msg").fadeOut("slow", function() {
                        $(this).html("").show();
                    });
                }, 10000);
            }
        });
    });
</script>