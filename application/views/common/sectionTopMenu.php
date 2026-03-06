<style>
	.navigation .dropdown-slide .dropdown-menu li a {
		text-transform: none;
		font-size: 14px;
	}
</style>
<!-- Main Menu Section -->
<section class="menu">
	<nav class="navbar navigation">
		<div class="container">
			<div class="navbar-header">
				<h2 class="menu-title">Main Menu</h2>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
					aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div><!-- / .navbar-header -->

			<!-- Navbar Links -->
			<div id="navbar" class="navbar-collapse collapse text-center">
				<ul class="nav navbar-nav">

					<!-- Home -->
					<li class="dropdown ">
						<a href="<?php echo base_url() ?>" class="active ikic-menu">Home</a>
					</li><!-- / Home -->

					<!-- / About Us -->
					<li class="dropdown ">
						<a href="<?php echo base_url() ?>Aboutus" class="ikic-menu">About Us</a>
					</li><!-- / About Us -->

					<!-- Services -->
					<!-- <li class="dropdown dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350"
							role="button" aria-haspopup="true" aria-expanded="false">Services <span
								class="tf-ion-ios-arrow-down"></span></a>
						<ul class="dropdown-menu" style="margin-top: -15px;">
							<li><a href="<?php echo base_url() ?>Services/applicants">Services for Applicants</a></li>
							<li><a href="<?php echo base_url() ?>Services/employers">Services for Employers</a></li>
						</ul>
					</li> -->
					<!-- / Services -->

					<!-- Elements -->
					<li class="dropdown dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="" data-delay="350"
							role="button" aria-haspopup="true" aria-expanded="false">Services <span
								class="tf-ion-ios-arrow-down"></span></a>
						<div class="dropdown-menu">
							<div class="row" style="margin-top: -10px;">

								<!-- Basic -->
								<div class="col-lg-6 col-md-6 mb-sm-3">
									<ul>
										<li class="dropdown-header" style="font-size: 16px;font-weight: 600; color: #000;text-transform: uppercase;">Applicants</li>
										<li role="separator" class="divider"></li>
										<li><a href="<?php echo base_url() ?>service/applicant/temporary-Foreign-Worker-programs">Temporary Foreign Worker (TFW) Programs</a></li>
										<li><a href="<?php echo base_url() ?>service/applicant/visitor-visa-temporary-resident-visa">Visitor Visa & Temporary Resident Visa (TRV)</a></li>
										<li><a href="<?php echo base_url() ?>service/applicant/study-in-canada">Study In Canada</a></li>
										<li><a href="<?php echo base_url() ?>service/applicant/permanent-residency">Permanent Residency: EE, PNP, RCIP, AIP</a></li>
										<!-- <li><a href="<?php //echo base_url() ?>service/applicant/community-regional-immigration-pathways">Community & Regional Immigration Pathways</a></li> -->
										<li><a href="<?php echo base_url() ?>service/applicant/family-sponsorship-programs">Family Sponsorship Programs</a></li>
									</ul>
								</div>

								<!-- Layout -->
								<div class="col-lg-6 col-md-6 mb-sm-3">
									<ul>
										<li class="dropdown-header" style="font-size: 16px;font-weight: 600; color: #000;text-transform: uppercase;">Employers</li>
										<li role="separator" class="divider"></li>
										<li><a href="<?php echo base_url() ?>service/employer/lmia-application">LMIA Application</a></li>
										<li><a href="<?php echo base_url() ?>service/employer/work-permit-services">Work Permit Services (New or Existing TFWs)</a></li>
										<li><a href="<?php echo base_url() ?>service/employer/francophone-mobility-work-permit">Francophone Mobility Work Permit</a></li>
										<li><a href="<?php echo base_url() ?>service/employer/atlantic-immigration-program-designations">Atlantic Immigration Program (AIP) Designations</a></li>
										<li><a href="<?php echo base_url() ?>service/employer/tfw-workforce-management-service">TFW & Workforce Management Service</a></li>
									</ul>
								</div>

							</div><!-- / .row -->
						</div><!-- / .dropdown-menu -->
					</li><!-- / Elements -->

					
					<!-- / Contact -->
					<li class="dropdown ">
						<a href="<?php echo base_url() ?>Contactus" class="ikic-menu">Contact</a>
					</li><!-- / Contact -->
				</ul><!-- / .nav .navbar-nav -->
			</div>
			<!--/.navbar-collapse -->
		</div><!-- / .container -->
	</nav>
</section>