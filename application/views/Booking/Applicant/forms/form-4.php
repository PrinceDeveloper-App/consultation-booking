
<link rel="stylesheet" href="<?php echo base_url() ?>resources/css/custom/checkout.css">
<style>
    #card-element {
    background: #fff;
    padding: 12px 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    margin-bottom: 10px;
}

#card-element.StripeElement--focus {
    border-color: #6772e5;
    box-shadow: 0 0 5px rgba(103,114,229,0.5);
}

#card-element.StripeElement--invalid {
    border-color: #e53e3e;
}

#card-element.StripeElement--complete {
    border-color: #38a169;
}

</style>
<form id="form-4" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
    <div class="row">
        <div class="col-md-8">
            <div class="payment margin-top-30">
                <div class="payment-tab  payment-tab-active">
                    <div class="payment-tab-trigger">
                       
                        <img class="payment-logo" src="<?php echo base_url(); ?>resources/images/stripe-badge-transparent.png" style="top: 0px;height: 100px;" alt="">
                    </div>
                    <div class="payment-tab-content" style="padding-top: 75px;margin-top: 25px;">
                        <div class="form-row">
                            <label for="card-element">Credit/Debit Card</label>
                            <div id="card-element"></div>
                        </div>

                        <input type="hidden" id="payment_method" name="payment_method">

                        

                        <div id="payment-errors" style="color:red;"></div>
                    </div>
                </div>
                <!-- <div class="checkbox margin-top-20" style="margin-left: 18px;margin-bottom: 20px;">
                <input type="checkbox" id="two-step" required="">
                <label for="two-step"><span class="checkbox-icon"></span> I agree to the <a href="#small-dialog" class="popup-with-zoom-anim">Terms and Conditions</a></label>
              </div> -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="product-checkout-details">
                <div class="block">
                    <h4 class="widget-title">Consultation Fee</h4>
                    <div class="media product-card">
                        <!-- <a class="pull-left" href="product-single.html">
                    <img
                      class="media-object"
                      src="images/shop/cart/cart-1.jpg"
                      alt="Image" />
                  </a> -->
                        <div class="media-body">
                            <h4 class="media-heading" style="font-weight: 600;font-size: 16px;">
                                $&nbsp;80 CAD (45-minute session)
                            </h4>

                        </div>
                    </div>
                    <!-- <div class="discount-code">
                  <p>
                    Have a discount ?
                    <a data-toggle="modal" data-target="#coupon-modal" href="#!">enter it here</a>
                  </p>
                </div> -->

                    <ul class="summary-prices">
                        <li>
                            <span>Subtotal:</span>
                            <span class="price">$&nbsp;80 CAD</span>
                        </li>
                        <li>
                            <span>TAX (5%):</span>
                            <span>$&nbsp;4.00</span>
                        </li>
                        <li>
                            <span>Transaction Fee:</span>
                            <span>$&nbsp;2.62</span>
                        </li>
                    </ul>
                    <div class="summary-total" style="margin-bottom: 15px;">
                        <span>Total</span>
                        <span>$&nbsp;86.62 CAD</span>
                    </div>
                    <div class="col">
                        <input type="checkbox" class="form-check-input" id="save-info" required>&nbsp;&nbsp;
                        <label class="form-check-label" for="save-info">I agree to the terms and conditions</label>
                    </div>
                    <!-- <div class="verified-icon">
                  <img src="images/shop/verified.png" />
                </div> -->
                </div>
            </div>
        </div>
    </div>
</form>