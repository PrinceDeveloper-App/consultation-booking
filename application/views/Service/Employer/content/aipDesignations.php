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
                <h1 class="mt-40" style="text-align: center;">Atlantic Immigration Program (AIP) Designations</h1>
                <p style="font-size: 16px;"><span style="font-weight: 600;">Purpose:</span> Help employers in Atlantic provinces hire foreign workers.</p>
                <ul class="styled-list">
                    <li>Apply for employer designation status.</li>
                    <li>Prepare endorsement applications.</li>
                    <li>Assist with settlement plan coordination.</li>
                </ul>
                <p style="font-size: 16px;"><span style="font-weight: 600;">Outcome:</span> Access to long-term employees ready to settle in Atlantic Canada.</p>
                <?php include_once(VIEWPATH . "common/employerConsultationLink.php") ?>

            </div>
        </div>
    </div>
</section>