
<?php include_once("common/resourceHeader.php") ?>

<body id="body">
    <?php include_once("common/sectionTopHeader.php") ?>
    <?php include_once("common/sectionTopMenu.php") ?>
    <?php //include_once("common/pageHeader.php") 
    ?>
    <section class="about section" style="padding-top: 25px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="consult-head" style="margin-bottom: 50px;">
                        <h2 style="text-align: center;">Book Your Consultation</h2>
                        <p style="text-align: center;text-align-last: unset;">Professional immigration consultation with<span style="font-weight: 600;"> Isha Kapoor, RCIC (R1040882)</span></p>
                        <p style="text-align: center;text-align-last: unset;">45-minute personalized session to review your case, assess eligibility, and plan your next steps.</p>
                    </div>
                    <?php include_once("Booking/Applicant/consultationForm.php") ?>
                </div>

            </div>
    </section>
    <?php include_once("common/sectionFooter.php") ?>
    <?php include_once("scripts/mainScript.php") ?>
    <?php //include_once("scripts/stripeScript.php") 
    ?>
    <?php include_once("scripts/wizardScript.php") ?>
    <?php include_once("scripts/slotCount.php") ?>
    <?php //include_once("scripts/timeZoneSelect.php") ?>
    <?php include_once("scripts/timePicker.php") ?>
    <?php include_once("scripts/gridScript.php") ?>
    
</body>

</html>