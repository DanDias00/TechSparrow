<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Votes extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->service('vote_service');
}

public function upvote($answer_id) {
    if (!$this->session->userdata('logged_in')) {
        // Handle the case where the user is not logged in
        // Could be a redirect or an error message
        redirect('users/login');
        return;
    }

    $user_id = $this->session->userdata('user_id');
    $this->vote_service->submit_vote_service($answer_id, $user_id, 1);
    
    // Redirect back or send a JSON response if using AJAX
}

public function downvote($answer_id) {
    if (!$this->session->userdata('logged_in')) {
        // Handle the case where the user is not logged in
        redirect('users/login');
        return;
    }

    $user_id = $this->session->userdata('user_id');
    $this->vote_service->submit_vote($answer_id, $user_id, -1);
    
    // Redirect back or send a JSON response if using AJAX
}
}
?>
