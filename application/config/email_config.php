<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Email configuration
$config['email_settings'] = array(
    'protocol'  => 'smtp',
    'smtp_host' => 'smtp.gmail.com',
    'smtp_user' => '',
    'smtp_pass' => '',
    'smtp_crypto' => 'tls',
    'smtp_port' => 587,
    'mailtype'  => 'html',
    'charset'   => 'utf-8',
    'newline'   => "\r\n"
);
