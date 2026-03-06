<style>
    @media (max-width: 480px) {
  .img-home {
    display: none;
  }
  .btn-applicant {
    margin-top: 10px;
  }
}
</style>
<section class="about section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 img-home">
                <img class="img-responsive img-home" src="<?php echo base_url() ?>resources/images/logo-ikic-02.jpg" style="margin-top: 30px;">
            </div>
            <div class="col-md-6">
                <h1 class="mt-40" style="">Isha Kapoor Immigration Consulting Inc.</h1>
                <p style="font-size: 20px;">Delivering trusted and strategic immigration solutions across Canada.</p>
                <!-- <p style="font-weight: 700;">Professional. Compliant. Compassionate.</p> -->
                <div class="main-link-div">
                    <!-- <a href="<?php echo base_url() ?>Services/employers" class="round-link">I'm an Employer</a> -->
                     <a href="<?php echo base_url() ?>Services/employers" class="btn btn-main btn-large btn-round-full btn-employer">I am an Employer</a>
                     <a href="<?php echo base_url() ?>Services/applicants" class="btn-applicant btn btn-main btn-large btn-round-full">I am an Applicant</a>
                    <!-- <a href="<?php echo base_url() ?>Services/applicants" class="round-link-applicant">I'm an Applicant</a> -->
                </div>
                <!-- <a href="<?php echo base_url() ?>Bookconsultation" class="btn btn-main mt-20">Book Your Consultation</a> -->
            </div>
        </div>
    </div>
</section>