<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->service('user_service', '', TRUE);
    }

    // Show registration page
    public function register() {
        // Assume validation and input processing here
         // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() === TRUE) {
            if ($this->user_service->register($this->input->post('username'), $this->input->post('email'), $this->input->post('password'))) {
                // Registration success
                $this->session->set_flashdata('user_registered', 'You are now registered and can log in');
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
                    'logged_in' => true
                ];
                $this->session->set_userdata($user_data);

                $this->session->set_flashdata('user_loggedin', 'You are now logged in.');
                redirect('Home/view');
            } else {
                // Login failed
                $this->session->set_flashdata('login_failed', 'Login is invalid. Please check your username and password.');
                redirect('User/login');
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
