<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('EmailSender');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->service('user_service', '', TRUE);
        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }
      
    }

    // Show registration page
    public function register() {

         // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() === TRUE) {
            log_message('info', 'Registration form validation passed');
            if ($this->user_service->register($this->input->post('username'), $this->input->post('email'), $this->input->post('password'))) {
                // Prepare the email content
                $data = [
                    'username' => $this->input->post('username'),
                 
                ];
                $emailContent = $this->load->view('templates/registration_email', $data, TRUE);
               // Send registration success email
                $userEmail = $this->input->post('email');
                if ($this->emailsender->sendRegistrationSuccessEmail($userEmail,$emailContent)) {
                    log_message('info', 'Registration email sent to ' . $userEmail);
                    $this->session->set_flashdata('email_sent', 'Registration successful. Please check your email for confirmation.');
                } else {
                    $this->session->set_flashdata('email_failed', 'Registration successful. However, we were unable to send a confirmation email.');
                    log_message('error', 'Failed to send registration email to ' . $userEmail);
                }

                // Registration success
                $this->session->set_flashdata('user_registered', 'You are now registered and can log in');
                log_message('info', 'User registered: ' . $this->input->post('username'));
                redirect('User/login');
            } else {
                // Registration failed
                $this->session->set_flashdata('registration_failed', 'Registration failed. Please try again.');
                redirect('register');
            }
        } else {
            $this->load->view('register');
        }
    }
      

    // User login
    public function login() {
        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            
            // Validation failed, load the login view again with errors
            $this->load->view('users/login');
        } else {
            // Validation successful
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            

            if ($this->user_service->login($username, $password)) {
                // Login successful
                $user_data = [
                    'username' => $username,
                    'logged_in' => true,
                    'user_id' => $this->user_service->get_user_id($username)
                ];
                $this->session->set_userdata($user_data);
                log_message('debug', 'Session User ID: ' . $this->session->userdata('user_id'));
                log_message('info', 'User logged in: ' .  $this->session->userdata('username'));

                $this->session->set_flashdata('user_loggedin', 'You are now logged in.');
                redirect('questions');
            } else {
                // Login failed
                $this->session->set_flashdata('login_failed', 'Login is invalid. Please check your username and password.');
                redirect('login');
                }
            }
    }

    // Logout user
    public function logout() {
        // Unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');

        // Set message
        $this->session->set_flashdata('user_loggedout', 'You are now logged out');
        redirect('Home/view');
      
        
    }

    // User profile
    public function profile() {
        // Ensure user is logged in
        if(!$this->session->userdata('logged_in')) {
            log_message('error', 'User not logged in');
            redirect('users/login');
        }

        log_message('info', 'User profile accessed: ' . $this->session->userdata('username'));
        // Get user data from model, pass to view
        $data['user'] = $this->user_service->get_user_info($this->session->userdata('user_id'));
        log_message('debug', 'User data: ' . print_r($data['user'], TRUE));
        $this->load->view('templates/profile', $data);
    }
}
