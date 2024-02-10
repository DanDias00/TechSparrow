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
}
?> 