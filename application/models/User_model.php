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

public function get_user($username) {
    $this->db->select('user_id');
    $this->db->where('username', $username);
    $result = $this->db->get('users');

    if ($result->num_rows() > 0) {
        $row = $result->row();
        return $row->user_id; // Return the user_id
    } else {
        return null; // Return null if user not found
    }
}

public function get_user_by_id($user_id) {
    $this->db->where('user_id', $user_id);
    $result = $this->db->get('users');

    if ($result->num_rows() > 0) {
        return $result->row();
    } else {
        return null;
    }
}
}
?>
