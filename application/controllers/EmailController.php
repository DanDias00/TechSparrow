<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the email library here, assuming it will be used in multiple methods
        $this->load->library('email');
    }

    public function sendMail($to, $subject, $message, $from = null) {
        // Load custom email configuration
        $this->load->config('email_config');
        $emailSettings = $this->config->item('email_settings');
        $this->email->initialize($emailSettings);
        
        // Optionally set a default from address if not provided
        if (!$from) {
            $from = array('email' => 'default_email@example.com', 'name' => 'Default Name');
        }
        
        // Set email parameters
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        
        // Send the email
        if (!$this->email->send()) {
            // Log or handle email sending failure
            log_message('error', 'Email sending failed: ' . $this->email->print_debugger(array('headers')));
            return false;
        }
        return true;
    }

    // Method to send a registration success email
    public function sendRegistrationSuccessEmail($to) {
        $subject = 'Registration Successful';
        $message = 'Thank you for registering with us. Your account has been successfully created.';
        return $this->sendMail($to, $subject, $message);
    }
}
