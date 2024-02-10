<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailSender {

    protected $CI;

    public function __construct() {
        // Get the CodeIgniter superobject
        $this->CI =& get_instance();
        // Load email library and custom config within the library
        $this->CI->load->library('email');
        $this->CI->load->config('email_config');
        $this->CI->email->initialize($this->CI->config->item('email_settings'));
    }

    // General method to send an email
    private function sendMail($to, $subject, $message, $from = null) {
        if (!$from) {
            $from = ['email' => 'admin@techsparrow.com', 'name' => 'Dan'];
        }

        // Set email parameters
        $this->CI->email->from($from['email'], $from['name']);
        $this->CI->email->to($to);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);

        // Attempt to send the email
        if (!$this->CI->email->send()) {
            log_message('error', 'Email sending failed: ' . $this->CI->email->print_debugger(['headers']));
            return false;
        }
        return true;
    }

    // Method to send a registration success email
    public function sendRegistrationSuccessEmail($to, $message) {
        $subject = 'Registration Confirmation';
        return $this->sendMail($to, $subject, $message);
    }
}
