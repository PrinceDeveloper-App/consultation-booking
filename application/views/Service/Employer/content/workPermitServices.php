<style>
    .styled-list {
        list-style-type: disc;
        /* disc | circle | square | none */

        line-height: 1.6;
        font-size: 16px;
        padding: 10px 40px;
    }
</style>
<section class="about section" style="padding-top: 10px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 img-home" style="padding-top: 50px;">
                <img class="img-responsive" src="<?php echo base_url() ?>resources/images/service/service-01.png" style="border-radius: 5%;">
            </div>
            <div class="col-md-6">
                <h1 class="mt-40" style="text-align: center;">Work Permit Services (New or Existing TFWs)</h1>
                <p style="font-size: 16px;"><span style="font-weight: 600;">Purpose:</span> Assist with work permit applications and extensions.</p>
                <p style="font-size: 16px;"><span style="font-weight: 600;">Includes:</span></p>
                <ul class="styled-list">
                    <li>New Work Permit filing under approved LMIA or LMIA-exempt stream.</li>
                    <li>Renewal tracking and extension before expiry.</li>
                    <li>IRCC form preparation and status updates.</li>
                </ul>
                <p style="font-size: 16px;"><span style="font-weight: 600;">Outcome:</span> Uninterrupted employment and maintained worker status.</p>
                <?php include_once(VIEWPATH . "common/employerConsultationLink.php") ?>

            </div>
        </div>
    </div>
</section>