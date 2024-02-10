<?php
class User_model extends CI_Model {

public function __construct() {
    $this->load->database();
}

public function register($data) {
    return $this->db->insert('users', $data);
}

public function login($username, $password) {
    $this->db->where('username', $username);
    $result = $this->db->get('users');

    if ($result->num_rows() == 1) {
        $hashed_password = $result->row(0)->password;
        if (password_verify($password, $hashed_password)) {
            return $result->row(0)->user_id;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
}
?>
