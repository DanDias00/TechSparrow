<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;
class Comments extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Comment_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->service('comment_service', '', TRUE);
      
    }

    public function submit_post() {
        if (!$this->session->userdata('logged_in')) {
            $this->response(['status' => 'error', 'message' => 'not logged in'], REST_Controller::HTTP_UNAUTHORIZED);
            return;
        }

        $answer_id = $this->input->post('answer_id');
        $user_id = $this->session->userdata('user_id');
        $body = $this->input->post('comment_body');
        $question_id = $this->input->post('question_id');
    

        if (!empty($body)||!empty($answer_id)||!empty($user_id)) {
            
            $result = $this->comment_service->add_comment_service($answer_id, $user_id, $body);
            
            if ($result) {
                $this->response(['status' => 'success', 'message' => 'comment submitted.'], REST_Controller::HTTP_OK);
            } else {
                $this->response(['status' => 'error', 'message' => 'submit failed'], REST_Controller::HTTP_BAD_REQUEST);
            }
    
        }else{
            $this->response(['status' => 'error', 'message' => 'submit failed'], REST_Controller::HTTP_UNAUTHORIZED);
        }

        
    }
}
