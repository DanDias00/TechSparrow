<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends CI_Controller {


    public function __construct() {
        parent::__construct();
    
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->service('question_service', '', TRUE);
    }

    public function all_questions(){

        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $data['questions'] = $this->question_service->all_questions_service();
        $this->load->view('templates/header');
        $this->load->view('questions/question_view', $data);
        $this->load->view('templates/footer');
        }

        // View a question
        public function view_question($question_id){
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $data['question'] = $this->question_service->get_question_service($question_id);
        $this->load->view('templates/header');
        $this->load->view('questions/view_question', $data);
        $this->load->view('templates/footer');
         }

        // Ask a question
    public function ask_question(){
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->view('templates/header');
        $this->load->view('questions/ask_question');
        $this->load->view('templates/footer');
    }

    // Submit a question

    public function submit_question(){
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('question', 'Question', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('questions/ask_question');
            $this->load->view('templates/footer');
        } else {
            $question = $this->input->post('question');
            $user_id = $this->session->userdata('user_id');
            if ($this->question_service->submit_question_service($question, $user_id)) {
                $this->session->set_flashdata('question_submitted', 'Question submitted successfully');
                redirect('questions/all_questions');
            } else {
                $this->session->set_flashdata('question_failed', 'Failed to submit question');
                redirect('questions/ask_question');
            }
        }
    }

    public function search(){
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $search = $this->input->get('q');
        $data['questions'] = $this->question_service->search_questions_service($search);
        $this->load->view('templates/header');
        $this->load->view('questions/question_view', $data);
        $this->load->view('templates/footer');
    }


}



