<?php
class user_service{

   
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance(); // Access the CI superobject
        $this->CI->load->model('User_model');
        $this->CI->load->library('emailsender');
      
    }

    public function register($username, $email, $password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $password_hash,
        );

        return $this->CI->User_model->register($data);
    }

    public function login($username, $password) {
        return $this->CI->User_model->login($username, $password);
    }

    public function get_user_id($username) {
        return $this->CI->User_model->get_user_id($username);
    }

    public function get_user_info($user_id) {
        return $this->CI->User_model->get_user_by_id($user_id);
    }

    public function forgotPassword($email) {
        $user = $this->CI->User_model->get_user_by_email($email);
        
        if ($user) {
            $reset_link = 'http://localhost/TechSparrowFrontend/public/#reset_password/' . $user->user_id;
            $email_content = $this->CI->load->view('templates/password_reset_email', [
                'reset_link' => $reset_link,
                'username' => $user->username
            ], TRUE);

            if ($this->CI->emailsender->passwordResetEmail($email, $email_content)) {
                return [
                    'status' => TRUE,
                    'message' => 'Password reset instructions have been sent to ' . $email
                ];
            } else {
                return [
                    'status' => FALSE,
                    'message' => 'Failed to send password reset instructions.'
                ];
            }
        } else {
            return [
                'status' => FALSE,
                'message' => 'No account found with that email address.'
            ];
        }
    }


}
?> 