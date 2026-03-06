<?php
defined('BASEPATH') or exit('No direct script access allowed');

/** 
 * Stripe Library for CodeIgniter 3.x 
 * 
 * Library for Stripe payment gateway. It helps to integrate Stripe payment gateway 
 * in CodeIgniter application. 
 * 
 * This library requires the Stripe PHP bindings and it should be placed in the third_party folder. 
 * It also requires Stripe API configuration file and it should be placed in the config directory. 
 * 
 * @package     CodeIgniter 
 * @category    Libraries 
 * @author      CodexWorld 
 * @license     http://www.codexworld.com/license/ 
 * @link        http://www.codexworld.com 
 * @version     3.0 
 */

class CI_Stripe_lib
{
    var $CI;
    var $api_error;

    function __construct()
    {
        $this->api_error = '';
        $this->CI = &get_instance();
        $this->CI->load->config('stripe');

        // Include the Stripe PHP bindings library 
        require APPPATH . 'third_party/stripe-php/init.php';

        // Set API key 
        \Stripe\Stripe::setApiKey($this->CI->config->item('stripe_api_key'));
    }

    function addCustomer($email, $token)
    {


        try {
            // Add customer to stripe 
            // Set your secret key. Remember to switch to your live secret key in production.
            // See your keys here: https://dashboard.stripe.com/apikeys
            \Stripe\Stripe::setApiKey('');

            $customer = \Stripe\Customer::create([
                'email' => $email,
                'source'  => $token

            ]);

            return $customer;
        } catch (Exception $e) {
            $this->api_error = $e->getMessage();
            return false;
        }
    }

    function createCharge($customerId, $itemName, $itemPrice)
    {
        // Convert price to cents 
        $itemPriceCents = ($itemPrice * 100);
        $currency = $this->CI->config->item('stripe_currency');
        //echo $itemName;
        //echo $customerId;
        //die();

        try {
            \Stripe\Stripe::setApiKey('');
            $stripe = \Stripe\Charge::create(array(
                'customer' => $customerId,
                'amount'   => $itemPriceCents,
                'currency' => $currency,
                'description' => $itemName,
                'statement_descriptor_suffix' => 'IKIC'
            ));
            
            $chargeJson = $stripe->jsonSerialize();
            return $chargeJson;
        } catch (Exception $e) {
            $this->api_error = $e->getMessage();
            return false;
        }
    }
    function retrieveCharge($chargeId)
    {
        echo $chargeId;

        try {
            \Stripe\Stripe::setApiKey('');
            $charge = \Stripe\Charge::retrieve(array(
                $chargeId
            ));
            return $charge;
        } catch (Exception $e) {
            $this->api_error = $e->getMessage();
            return false;
        }
    }
}
