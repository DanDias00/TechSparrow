<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
    }

    // Show registration page
    public function register() {

         // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');

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
        } else {
            $enc_password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $this->UserModel->register($enc_password);
            // Set message
            $this->session->set_flashdata('user_registered', 'You are now registered and can log in');
            redirect('users/login');
        }
    }

    // User login
    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('login');
        } else {
            // Get username
            $username = $this->input->post('username');
            // Get and encrypt the password
            $password = $this->input->post('password');

            // Login user
            $user_id = $this->UserModel->login($username, $password);

            if ($user_id) {
                // Create session
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);

                // Set message
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                redirect('home');
            } else {
                // Set message
                $this->session->set_flashdata('login_failed', 'Login is invalid');
                redirect('users/login');
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
        redirect('users/login');
    }

    // User profile
    public function profile() {
        // Ensure user is logged in
        if(!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        // Get user data from model, pass to view
        $data['user'] = $this->UserModel->get_user_info($this->session->userdata('user_id'));
        $this->load->view('profile', $data);
    }
}
