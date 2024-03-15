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
        
    }

        public function submit_post() {
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
                    $this->response(['status' => 'success', 'message' => 'answer submitted.'], REST_Controller::HTTP_OK);
                    redirect('questions');
                } else {
                    $this->session->set_flashdata('answer_error', $result['message']);
                    $this->response(['status' => 'error', 'message' => 'submit failed'], REST_Controller::HTTP_UNAUTHORIZED);
                    
                }
                redirect('questions/view_question/' . $question_id);
            }
        }
}
