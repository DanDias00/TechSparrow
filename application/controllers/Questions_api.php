<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Questions_api extends REST_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->service('question_service', '', TRUE);
        $this->load->service('answer_service', '', TRUE);
        $this->load->service('comment_service', '', TRUE);


        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }
       
        
    }

    public function questions_get() {

      
        if (!$this->session->userdata('logged_in')) {
            // User not logged in, send a 401 Unauthorized response and redirect to login
            $this->response([
                'status' => FALSE,
                'message' => 'User not logged in',
                'redirect' => '#login'
            ], REST_Controller::HTTP_UNAUTHORIZED);
            return;
        }

        // Fetch all questions using the question service
        $questions = $this->question_service->all_questions_service();
    
        // Check if questions were successfully retrieved
        if ($questions) {
            // Questions found, send them back with 200 OK status
            $this->response($questions, REST_Controller::HTTP_OK);
        } else {
            // No questions found, send a 404 Not Found status
            $this->response([
                'status' => FALSE,
                'message' => 'No questions were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function view_question_get($question_id){
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            // Respond with 401 Unauthorized
            $this->response([
                'status' => FALSE,
                'message' => 'User not logged in',
                'redirect' => '#login'
            ], REST_Controller::HTTP_UNAUTHORIZED);
            return;
        }
    
        // Try to get the question data
        $question = $this->question_service->get_question_service($question_id);
        $answers = $this->answer_service->get_answers_with_comments_service($question_id);
    
        if (!$question) {
            // No question found with the given ID, respond with 404 Not Found
            $this->response([
                'status' => FALSE,
                'message' => 'No question found'
            ], REST_Controller::HTTP_NOT_FOUND);
            return;
        }
    
        // Prepare the data to return
        $data = [
            'question' => $question,
            'answers' => $answers
        ];
    
        // Respond with 200 OK and the data
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function submit_question_post(){
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            $this->response('logged in issue',REST_Controller::HTTP_UNAUTHORIZED);
           // redirect('login');
        }
       

      
            $title = $this->input->post('title');
            $question = $this->input->post('body');
            $tagString = $this->input->post('tags');
            $tags = array_unique(array_map('trim', explode(',', $tagString))); // Split the string into an array, trim whitespace, and remove duplicates
            $user_id = $this->session->userdata('user_id');

            if ($this->question_service->submit_question_service($title,$question, $user_id,$tags)) {

                $this->session->set_flashdata('question_submitted', 'Question submitted successfully');
                log_message('info', 'Question submitted successfully');
                $this->response(REST_Controller::HTTP_OK);
               // redirect('questions');
            } else {
                $this->session->set_flashdata('question_failed', 'Failed to submit question');
                log_message('error', 'Failed to submit question');
                $this->response(REST_Controller::HTTP_UNAUTHORIZED);
               // redirect('ask_question');
            }
        }


        public function search_get() {
            // Check if the user is logged in
            if (!$this->session->userdata('logged_in')) {
                // If not logged in, send an unauthorized status code and message
                $this->response([
                    'status' => FALSE,
                    'message' => 'User not logged in'
                ], REST_Controller::HTTP_UNAUTHORIZED);
                return;
            }
        
            // Get the search term from the query parameters
            $search = $this->input->get('q');
            if(!$search) {
                // If the search term is not provided, send a bad request status code and message
                $this->response([
                    'status' => FALSE,
                    'message' => 'No search query provided'
                ], REST_Controller::HTTP_BAD_REQUEST);
                return;
            }
        
            // Use the question service to search for questions
            $questions = $this->question_service->search_questions_service($search);
            if($questions) {
                // If questions are found, send them with an OK status code
                $this->response( $questions, REST_Controller::HTTP_OK);
            } else {
                // If no questions are found, send a not found status code and message
                $this->response([
                    'status' => FALSE,
                    'message' => 'No questions found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
        

    
    
   
