<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Centralized email service. Loads SMTP config from application/config/email.php.
 */
class Email_service
{
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('email');
        $this->CI->load->config('email');
    }

    /**
     * Initializes the email library with SMTP settings from config.
     */
    private function init()
    {
        $config = [
            'protocol'    => $this->CI->config->item('protocol'),
            'smtp_crypto' => $this->CI->config->item('smtp_crypto'),
            'smtp_host'   => $this->CI->config->item('smtp_host'),
            'smtp_port'   => $this->CI->config->item('smtp_port'),
            'smtp_user'   => $this->CI->config->item('smtp_user'),
            'smtp_pass'   => $this->CI->config->item('smtp_pass'),
            'mailtype'    => $this->CI->config->item('mailtype'),
            'charset'     => $this->CI->config->item('charset'),
            'newline'     => $this->CI->config->item('newline'),
            'priority'    => $this->CI->config->item('priority'),
        ];
        $this->CI->email->initialize($config);
        $this->CI->email->from(
            $this->CI->config->item('email_from'),
            $this->CI->config->item('email_from_name')
        );
        $this->CI->email->set_mailtype('html');
    }

    /**
     * Sends a booking confirmation email with an optional PDF attachment.
     *
     * @param string      $to           Recipient email
     * @param string      $booking_time Booking time string
     * @param string      $booking_date Booking date (Y-m-d)
     * @param string|null $pdf_path     Path to invoice PDF
     * @return bool
     */
    public function send_booking_confirmation($to, $booking_time, $booking_date, $pdf_path = null)
    {
        $this->init();
        $this->CI->email->to($to);
        $this->CI->email->subject('Confirmation email for IKIC consultation booking');
        $this->CI->email->message($this->build_confirmation_html($booking_time, $booking_date));

        if ($pdf_path && file_exists($pdf_path)) {
            $this->CI->email->attach($pdf_path);
        }

        $sent = $this->CI->email->send();

        if (!$sent) {
            log_message('error', 'Email send failed to ' . $to . ': ' . $this->CI->email->print_debugger(['headers']));
        }

        return $sent;
    }

    /**
     * Sends a contact form message to the admin inbox.
     *
     * @param string $from_email Sender email
     * @param string $from_name  Sender name
     * @param string $subject    Message subject
     * @param string $message    Message body
     * @return bool
     */
    public function send_contact_message($from_email, $from_name, $subject, $message)
    {
        $this->init();
        $this->CI->email->reply_to($from_email, $from_name);
        $this->CI->email->to($this->CI->config->item('email_from'));
        $this->CI->email->subject($subject);
        $this->CI->email->message(nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')));

        return $this->CI->email->send();
    }

    /**
     * Builds the confirmation email HTML.
     */
    private function build_confirmation_html($booking_time, $booking_date)
    {
        $year = date('Y');

        return '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Consultation Booking Confirmation</title>
    <style>
        body { font-family: "Arial", sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .email-container { max-width: 600px; margin: 30px auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background-color: #000; color: #ffffff; text-align: center; padding: 20px; font-size: 22px; font-weight: bold; }
        .content { padding: 25px; color: #333333; line-height: 1.6; font-size: 16px; }
        .content h3 { color: #0d6efd; margin-bottom: 10px; }
        .details { background-color: #f8f9fa; border: 1px solid #e0e0e0; padding: 15px; border-radius: 5px; margin-top: 10px; }
        .details p { margin: 5px 0; }
        .note { font-size: 14px; color: #666666; margin-top: 15px; border-left: 3px solid #000; padding-left: 10px; }
        .footer { text-align: center; font-size: 14px; color: #999999; padding: 15px; border-top: 1px solid #eeeeee; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">Consultation Confirmed</div>
        <div class="content">
            <p>Thank you &mdash; your <strong>consultation</strong> is booked.</p>
            <p>Your booking details are as follows:</p>
            <div class="details">
                <p><strong>Consultation Date:</strong> ' . htmlspecialchars($booking_date, ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Consultation Time:</strong> ' . htmlspecialchars($booking_time, ENT_QUOTES, 'UTF-8') . '</p>
            </div>
            <div class="note">
                <p><strong>Note:</strong> The appointment date and time are based on
                <strong>Mountain Time (MT) &ndash; Alberta, Canada</strong>. Please be
                available for the consultation according to your local time zone.</p>
            </div>
        </div>
        <div class="footer">
            &copy; ' . $year . ' <a href="https://ikic.ca/">IKIC</a>. All rights reserved.
        </div>
    </div>
</body>
</html>';
    }
}
