<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


    public function __construct() {
        parent::__construct();
        
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('EmailSender');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->service('user_service', '', TRUE);
    }

    public function questions_view()
{
        $this->load->model('question_model');
        $data['questions'] = $this->question_model->get_questions();
        $this->load->view('templates/header');
        $this->load->view('questions/question_view', $data);
        $this->load->view('templates/footer');
        
}
}



