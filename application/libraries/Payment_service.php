<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Handles Stripe payment processing.
 * Stripe API key is loaded from config (sourced from .env).
 */
class Payment_service
{
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->config('stripe');

        $api_key = $this->CI->config->item('stripe_api_key');
        if (!empty($api_key)) {
            \Stripe\Stripe::setApiKey($api_key);
        }
    }

    /**
     * Processes a payment through Stripe.
     *
     * @param string $email          Customer email
     * @param string $payment_method Stripe payment method ID
     * @param float  $amount         Amount in dollars
     * @param string $currency       Currency code
     * @return array ['success' => bool, 'payment_intent_id' => string|null, 'error' => string|null]
     */
    public function charge($email, $payment_method, $amount = null, $currency = null)
    {
        if ($amount === null) {
            $amount = $this->CI->config->item('stripe_payment_amount');
        }
        if ($currency === null) {
            $currency = $this->CI->config->item('stripe_currency');
        }

        $amount_cents = (int) round($amount * 100);

        try {
            $customer = \Stripe\Customer::create(['email' => $email]);

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount'                    => $amount_cents,
                'currency'                  => $currency,
                'customer'                  => $customer->id,
                'payment_method'            => $payment_method,
                'confirm'                   => true,
                'automatic_payment_methods' => [
                    'enabled'         => true,
                    'allow_redirects' => 'never',
                ],
            ]);

            log_message('info', 'Stripe payment success: ' . $paymentIntent->id . ' for ' . $email);

            return [
                'success'           => true,
                'payment_intent_id' => $paymentIntent->id,
                'error'             => null,
            ];
        } catch (\Stripe\Exception\CardException $e) {
            log_message('error', 'Stripe card error: ' . $e->getMessage());
            return ['success' => false, 'payment_intent_id' => null, 'error' => $e->getMessage()];
        } catch (\Exception $e) {
            log_message('error', 'Stripe error: ' . $e->getMessage());
            return ['success' => false, 'payment_intent_id' => null, 'error' => $e->getMessage()];
        }
    }
}
