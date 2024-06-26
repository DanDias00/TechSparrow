<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Comment_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->service('comment_service', '', TRUE);
      
    }

    public function submit_comment() {
        if (!$this->session->userdata('logged_in')) {
            // Redirect or handle the case where the user is not logged in
            redirect('users/login');
            return;
        }

        $answer_id = $this->input->post('answer_id');
        $user_id = $this->session->userdata('user_id');
        $body = $this->input->post('comment_body');
        $question_id = $this->input->post('question_id');
    

        if (!empty($body)||!empty($answer_id)||!empty($user_id)) {
            $this->comment_service->add_comment_service($answer_id, $user_id, $body);
    
        }

        redirect('questions/view_question/' . $question_id);
    }
}
