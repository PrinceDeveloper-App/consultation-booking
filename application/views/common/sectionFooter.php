<style>
	.sticky-btn {
		position: fixed;
		bottom: 50px;
		/* distance from bottom */
		right: 20px;
		/* distance from right */
		padding: 12px 25px;
		background-color: #000;
		color: #fff;
		border-radius: 50px;
		border: none;
		font-size: 16px;
		cursor: pointer;
		z-index: 9999;
		/* stays above all elements */
		box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
	}

	.sticky-btn:hover {
		box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
		border: 1px solid #000;
		border-color: #000;
		background-color: #FFFF;
		color: #000;
	}
</style>
<footer class="footer section text-center" style="padding-top: 0px !important;padding-bottom: 80px;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php if (isset($sticky_button)): ?>
					<a href="<?php echo base_url() ?>book-consultation/select-booking-type" class="sticky-btn">BOOK YOUR CONSULTATION</a>
				<?php endif; ?>
				<!-- <ul class="social-media">
					<li>
						<a href="https://www.facebook.com/themefisher">
							<i class="tf-ion-social-facebook"></i>
						</a>
					</li>
					<li>
						<a href="https://www.instagram.com/themefisher">
							<i class="tf-ion-social-instagram"></i>
						</a>
					</li>
					<li>
						<a href="https://www.twitter.com/themefisher">
							<i class="tf-ion-social-twitter"></i>
						</a>
					</li>
					<li>
						<a href="https://www.pinterest.com/themefisher/">
							<i class="tf-ion-social-pinterest"></i>
						</a>
					</li>
				</ul> -->
				<ul class="footer-menu text-uppercase">
					<li>
						<a href="<?php echo base_url() ?>Aboutus">About Us</a>
					</li>

					<li>
						<a href="<?php echo base_url() ?>book-consultation/select-booking-type">Book Consultation</a>
					</li>

					<li>
						<a href="#">PRIVACY POLICY</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>Contactus">CONTACT</a>
					</li>
				</ul>
				<p class="copyright-text" style="text-align: center;text-align-last: center;">
					Copyright &copy;&nbsp;<?php echo date("Y"); ?>, Designed &amp; Developed by
					<a href="https://acode.ca/">Acode</a>
				</p>
			</div>
		</div>
	</div>
</footer>