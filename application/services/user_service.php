<?php
class user_service{

   
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance(); // Access the CI superobject
        $this->CI->load->model('User_model');
      
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
        return $this->CI->User_model->get_user($username);
    }

    public function get_user_info($user_id) {
        return $this->CI->User_model->get_user_by_id($user_id);
    }
}
?> 