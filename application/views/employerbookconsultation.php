
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
                        <!-- <p style="text-align: center;text-align-last: unset;">Connect with a Licensed Immigration Consultant</p> -->
                        <p style="text-align: center;text-align-last: unset;"><span style="font-weight: 600;">Book a 30-Minute Strategy Session</span></p>
                        <!-- <p style="text-align: center;text-align-last: unset;">Speak with IKIC about your hiring or immigration needs.</p> -->
                    </div>
                    <?php include_once("Booking/Employer/consultationForm.php") ?>
                </div>

            </div>
    </section>
    <?php include_once("common/sectionFooter.php") ?>
    <?php include_once("scripts/mainScript.php") ?>
    <?php include_once("Booking/Employer/scripts/wizardScript.php") ?>
    <?php include_once("Booking/Employer/scripts/slotCount.php") ?>
    <?php include_once("Booking/Employer/scripts/gridScript.php") ?>
    
</body>

</html>