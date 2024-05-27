<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Answer extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->service('answer_service', '', TRUE);
        $this->load->service('vote_service', '', TRUE);
        
    }

        public function submit_post() {
            $question_id = $this->input->post('question_id');
            $answer_body = $this->input->post('body');

            // Retrieve the logged-in user's ID
            $user_id = $this->session->userdata('user_id');

            if (!$this->session->userdata('logged_in')) {
                $this->response(['status' => 'error', 'message' => 'user not logged in'], REST_Controller::HTTP_UNAUTHORIZED);
            } else {
                $result = $this->answer_service->submit_answer($question_id, $answer_body, $user_id);
                if ($result['success']) {
                    $this->session->set_flashdata('answer_submitted', $result['message']);
                    $this->response(['status' => 'success', 'message' => 'answer submitted.'], REST_Controller::HTTP_OK);
                    
                } else {
                    $this->session->set_flashdata('answer_error', $result['message']);
                    $this->response(['status' => 'error', 'message' => 'submit failed'], REST_Controller::HTTP_BAD_REQUEST);
                    
                }
                
            }
        }

        public function vote_post() {
            if (!$this->session->userdata('logged_in')) {
                $this->response(['status' => 'error', 'message' => 'User not logged in'], REST_Controller::HTTP_UNAUTHORIZED);
                return;
            }
            $answer_id = $this->post('answer_id');
            $user_id = $this->post('user_id');
            $type = $this->uri->segment(4);
          
            log_message('debug', 'Answer ID: ' . $answer_id);
            log_message('debug', 'Vote type: ' . $type);
            log_message('debug', 'User ID: ' . $user_id);
          
            if ($this->vote_service->hasVotedService($answer_id, $user_id)) {
                $this->response(['status' => 'error', 'message' => 'User has already voted on this answer'], REST_Controller::HTTP_BAD_REQUEST);
                return;
            }
            
            $new_vote_count = NULL;
    
            if ($type === 'upvote') {
                $new_vote_count = $this->vote_service->upvote($answer_id);
            } elseif ($type === 'downvote') {
                $new_vote_count = $this->vote_service->downvote($answer_id);
            } else {
                $this->response(['status' => 'error', 'message' => 'Invalid vote type'], REST_Controller::HTTP_BAD_REQUEST);
                return;
            }
    
            if ($new_vote_count !== NULL) {
                $this->response(['status' => 'success', 'vote_count' => $new_vote_count], REST_Controller::HTTP_OK);
            } else {
                $this->response(['status' => 'error', 'message' => 'Voting failed'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }

          //  If the voting process was successful, insert a record into the user votes table
            if ($new_vote_count !== NULL) {
                // Insert record into the user votes table
                $this->vote_service->insertUserVoteService($user_id, $answer_id, $type);
                // Return the updated vote count
                $this->response(['status' => 'success', 'vote_count' => $new_vote_count], REST_Controller::HTTP_OK);
            } else {
                $this->response(['status' => 'error', 'message' => 'Voting failed'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }      
    }
        
