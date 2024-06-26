<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;
class User extends REST_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('EmailSender');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->service('user_service', '', TRUE);
        $this->load->model('User_model');

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');  
        }

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }
      
    }

    public function register_post() {

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === TRUE) {
            log_message('info', 'Registration form validation passed');
            if ($this->user_service->register($this->input->post('username'), $this->input->post('email'), $this->input->post('password'))) {
                $this->response(['status' => 'success', 'message' => 'registration completed.'], REST_Controller::HTTP_OK);
                // Prepare the email content
                $data = [
                    'username' => $this->input->post('username'),
                 
                ];
                $emailContent = $this->load->view('templates/registration_email', $data, TRUE);
               // Send registration success email
                $userEmail = $this->input->post('email');
                if ($this->emailsender->sendRegistrationSuccessEmail($userEmail,$emailContent)) {
                    log_message('info', 'Registration email sent to ' . $userEmail);
                    $this->response(['status' => 'success', 'message' => 'email sent.'], REST_Controller::HTTP_OK);
                } else {
                    log_message('error', 'Failed to send registration email to ' . $userEmail);
                    $this->response(['status' => 'error', 'message' => 'Registration successful. However, we were unable to send a confirmation email.'], REST_Controller::HTTP_BAD_REQUEST);
                }
                log_message('info', 'User registered: ' . $this->input->post('username'));
                
            } else {
                // Registration failed
                $this->response(['status' => 'error', 'message' => 'registration failed.'], REST_Controller::HTTP_BAD_REQUEST);
                
            }
        } else {
            $this->response(['status' => 'error', 'message' => 'validation failed.'], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
      

    // User login
    public function login_post() {
        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Validation failed
            $this->response(['status' => 'error', 'message' => 'validation failed.'], REST_Controller::HTTP_BAD_REQUEST);

        } else {
            // Validation successful
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($username=='' || $password=='') {
                $this->response(['status' => 'error', 'message' => 'You are banned.'], REST_Controller::HTTP_UNAUTHORIZED);
            }
            
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
                log_message('info', 'logged in: ' .  $this->session->userdata('logged_in'));
                
                $this->response(['status' => 'success', 'message' => $user_data], REST_Controller::HTTP_OK);

            } else {
                // Login failed
                $this->response(['status' => 'error', 'message' => 'Authentication failed. Invalid username or password.'], REST_Controller::HTTP_UNAUTHORIZED);

                }
            }
    }

    // Logout user
    public function logout_get() {
        // Unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        log_message('info', 'User logged out');
        $this->response(['status' => 'success', 'message' => 'logged out.'], REST_Controller::HTTP_OK);
   
    }

    // User profile
    public function profile_get() {
        // Ensure user is logged in
        if(!$this->session->userdata('logged_in')||!$this->session->userdata('user_id') || !$this->session->userdata('username')) {
            log_message('error', 'User not logged in');
            $this->response(['status' => 'error', 'message' => ' No active user.'], REST_Controller::HTTP_UNAUTHORIZED);
        }else{
        log_message('info', 'User profile accessed: ' . $this->session->userdata('username'));
        // Get user data from model, pass to view
        $data['user'] = $this->user_service->get_user_info($this->session->userdata('user_id'));
        log_message('debug', 'User data: ' . print_r($data['user'], TRUE));
        $this->response(['status' => 'success', 'message' => $data['user']], REST_Controller::HTTP_OK);
        }
    }

    //password reset
    public function forgot_password_post() {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        
        if ($this->form_validation->run() === FALSE) {
            $this->response([
                'status' => FALSE,
                'message' => validation_errors()
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $email = $this->input->post('email');
            $result = $this->user_service->forgotPassword($email);
            $this->response($result, $result['status'] ? REST_Controller::HTTP_OK : REST_Controller::HTTP);
        }
    }

    public function reset_password_post() {
        
        // Set form validation for password
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Form validation failed
            $this->response([
                'status' => FALSE,
                'message' => validation_errors()
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $user_id = $this->input->post('user_id');
            $password = $this->input->post('password');
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Update the user's password
            if ($this->User_model->update_password($user_id, $hashed_password)) {
                // Password updated successfully
                $this->response([
                    'status' => TRUE,
                    'message' => 'Password reset successful.'
                ], REST_Controller::HTTP_OK);
            } else {
                // Password update failed
                $this->response([
                    'status' => FALSE,
                    'message' => 'Failed to reset password.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function delete_post() {
        // Retrieve user ID from the URL segment
        $user_id = $this->uri->segment(4);
        log_message('info', 'User ID: ' . $user_id);
        
        // Check if user ID is not provided or not numeric
        if (!$user_id || !is_numeric($user_id)) {
            $this->response([
                'status' => FALSE,
                'message' => 'Invalid user ID provided.'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        
        log_message('info', 'User ID: ' . $user_id);
        
        if ($this->user_service->deleteAccountService($user_id)) {
            $this->response([
                'status' => TRUE,
                'message' => 'Account deleted successfully.'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed to delete account.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    } 
}
