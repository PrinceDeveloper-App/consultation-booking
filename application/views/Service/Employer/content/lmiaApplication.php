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
                <h1 class="mt-40" style="text-align: center;">LMIA Application</h1>
                <p style="font-size: 16px;"><span style="font-weight: 600;">Purpose:</span> Hire foreign workers under the TFW Program.</p>
                <p style="font-size: 16px;">IKIC prepares, reviews, and submits complete LMIA applications.</p>
                <p style="font-size: 16px;"><span style="font-weight: 600;">Includes:</span></p>
                <ul class="styled-list">
                    <li>Position & wage validation (ESDC median wage review)</li>
                    <li>Proof of advertising (Job Bank & external sites)</li>
                    <li>Application form completion & submission</li>
                    <li>Ongoing support for officer queries</li>
                </ul>
                <p style="font-size: 16px;"><span style="font-weight: 600;">Outcome:</span> Positive LMIA decision → eligible to hire foreign worker.</p>
                <?php include_once(VIEWPATH . "common/employerConsultationLink.php") ?>

            </div>
        </div>
    </div>
</section>