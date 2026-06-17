<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Email Configuration
| -------------------------------------------------------------------
|
| SMTP credentials are loaded from .env file.
| See .env.example for the required variables.
*/
$config['protocol']        = 'smtp';
$config['smtp_crypto']     = env('SMTP_CRYPTO', 'ssl');
$config['smtp_host']       = env('SMTP_HOST', '');
$config['smtp_port']       = (int) env('SMTP_PORT', 465);
$config['smtp_user']       = env('SMTP_USER', '');
$config['smtp_pass']       = env('SMTP_PASS', '');
$config['mailtype']        = 'html';
$config['charset']         = 'utf-8';
$config['newline']         = "\r\n";
$config['priority']        = 1;
$config['email_from']      = env('EMAIL_FROM', '');
$config['email_from_name'] = env('EMAIL_FROM_NAME', '');
