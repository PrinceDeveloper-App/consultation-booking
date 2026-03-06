<script>
$(".status").on("change", function () {
    let status = $(this).val();
    let id = $(this).data("id");
console.log(id);
    $.ajax({
        url: "<?php echo base_url('Administrator/Employer/Appointments/update_status'); ?>",
        type: "POST",
        data: { id: id, status: status },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.success) {
                $("#msg").html("<span style='color:green;'>Status updated!</span>");
            } else {
                $("#msg").html("<span style='color:red;'>Update failed!</span>");
            }
        },
        error: function () {
            $("#msg").html("<span style='color:red;'>Server error!</span>");
        }
    });
});
</script>