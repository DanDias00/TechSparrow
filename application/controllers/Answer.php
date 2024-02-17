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
            // Redirect to login page or show an error message
            redirect('login');
        }else{
     
        if (empty($question_id) || empty($answer_body)) {
            // Set flash data for errors
            $this->session->set_flashdata('answer_error', 'Please fill in all fields.');
            redirect('questions/view_question/' . $question_id);
        }

        // Save the answer to the database
        if ($this->answer_service->save_answer_service($question_id, $answer_body,$user_id)) {
            $this->answer_service->increment_answer_count_service($question_id);
      
          
            $this->session->set_flashdata('answer_submitted', 'Your answer has been submitted successfully.');

            redirect('questions');
        } else {
            // Handle errors or set flash data for errors
            $this->session->set_flashdata('answer_error', 'There was a problem submitting your answer. Please try again.');
            redirect('questions/view_question/' . $question_id);
        }
    }

    }
}
