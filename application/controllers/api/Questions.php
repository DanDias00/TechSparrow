<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Questions extends REST_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->service('question_service', '', TRUE);
        $this->load->service('answer_service', '', TRUE);
        $this->load->service('comment_service', '', TRUE);


        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
          

        }
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
    
        // Checking if questions were successfully retrieved
        if ($questions) {
           
            $this->response($questions, REST_Controller::HTTP_OK);
        } else {
           
            $this->response([
                'status' => FALSE,
                'message' => 'No questions were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function view_question_get($question_id){
        // Checking if user is logged in
        if (!$this->session->userdata('logged_in')) {
    
            $this->response([
                'status' => FALSE,
                'message' => 'User not logged in',
                'redirect' => '#login'
            ], REST_Controller::HTTP_UNAUTHORIZED);
            return;
        }
    
       
        $question = $this->question_service->get_question_service($question_id);
        $answers = $this->answer_service->get_answers_with_comments_service($question_id);
    
        if (!$question) {
          
            $this->response([
                'status' => FALSE,
                'message' => 'No question found'
            ], REST_Controller::HTTP_NOT_FOUND);
            return;
        }
    
        $data = [
            'question' => $question,
            'answers' => $answers
        ];
    
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function submit_question_post(){
      
        if (!$this->session->userdata('logged_in')) {
            $this->response('logged in issue',REST_Controller::HTTP_UNAUTHORIZED);
         
        }
    
            $title = $this->input->post('title');
            $question = $this->input->post('body');
            $tagString = $this->input->post('tags');
            $tags = array_unique(array_map('trim', explode(',', $tagString))); // Split the string into an array, trim whitespace, and remove duplicates
            $user_id = $this->session->userdata('user_id');

            if ($this->question_service->submit_question_service($title,$question, $user_id,$tags)) {

                $this->session->set_flashdata('question_submitted', 'Question submitted successfully');
                log_message('info', 'Question submitted successfully');
                $this->response(['success'=>'Question submitted successfully'],REST_Controller::HTTP_OK);
             
            } else {
                $this->session->set_flashdata('question_failed', 'Failed to submit question');
                log_message('error', 'Failed to submit question');
                $this->response(['error'=>'Failed to submit question'],REST_Controller::HTTP_UNAUTHORIZED);
              
            }
        }


        public function search_get() {
        
            if (!$this->session->userdata('logged_in')) {
               
                $this->response([
                    'status' => FALSE,
                    'message' => 'User not logged in'
                ], REST_Controller::HTTP_UNAUTHORIZED);
                return;
            }
        
            // Getting the search term from the query parameters
            $search = $this->input->get('q');
            if(!$search) {
         
                $this->response([
                    'status' => FALSE,
                    'message' => 'No search query provided'
                ], REST_Controller::HTTP_BAD_REQUEST);
                return;
            }
        
          
            $questions = $this->question_service->search_questions_service($search);
            if($questions) {
              
                $this->response( $questions, REST_Controller::HTTP_OK);
            } else {
               
                $this->response([
                    'status' => FALSE,
                    'message' => 'No questions found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
        

    
    
   
