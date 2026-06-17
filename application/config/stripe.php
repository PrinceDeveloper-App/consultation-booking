<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Stripe API Configuration
| -------------------------------------------------------------------
|
| Keys are loaded from .env file. Never commit real keys to the repo.
| See .env.example for the required variables.
*/
$config['stripe_api_key']         = env('STRIPE_API_KEY', '');
$config['stripe_publishable_key'] = env('STRIPE_PUBLISHABLE_KEY', '');
$config['stripe_currency']        = env('STRIPE_CURRENCY', 'cad');
$config['stripe_payment_amount']  = (float) env('STRIPE_PAYMENT_AMOUNT', 86.62);
