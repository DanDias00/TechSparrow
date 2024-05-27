<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Answer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->service('answer_service', '', TRUE);
        
    }

    public function submit() {
        $question_id = $this->input->post('question_id');
        $answer_body = $this->input->post('body');

         // Retrieve the logged-in user's ID
        $user_id = $this->session->userdata('user_id');

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else {
        
            $result = $this->answer_service->submit_answer($question_id, $answer_body, $user_id);

            if ($result['success']) {
                $this->session->set_flashdata('answer_submitted', $result['message']);
                redirect('questions');
            } else {
                $this->session->set_flashdata('answer_error', $result['message']);
                
            }
            redirect('questions/view_question/' . $question_id);
        }
}
}
