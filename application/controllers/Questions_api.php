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
       
        
    }

    public function questions_get() {
        
        $questions = $this->question_service->all_questions_service();

        if ($questions) {
            $this->response($questions, REST_Controller::HTTP_OK);
           
           
        } else {
            $this->response(NULL, REST_Controller::HTTP_NOT_FOUND);
        }
        
    }

    }
   
