<?php
class question_service{

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance(); // Access the CI superobject
        $this->CI->load->model('Question_model');
      
    }

    public function all_questions_service() {
    
        return $this->CI->Question_model->get_all_questions();
    }

    public function get_question_service($question_id) {
        return $this->CI->Question_model->get_question($question_id);
    }

    public function submit_question_service($question, $user_id) {
        $data = array(
            'question' => $question,
            'user_id' => $user_id
        );
        return $this->CI->Question_model->submit_question($data);
    }

  

    public function search_questions_service($search) {
        return $this->CI->Question_model->search_questions($search);
    }

    public function get_user_questions_service($user_id) {
        return $this->CI->Question_model->get_user_questions($user_id);
    }

    public function delete_question_service($question_id) {
        return $this->CI->Question_model->delete_question($question_id);
    }

    public function update_question_service($question_id, $question) {
        return $this->CI->Question_model->update_question($question_id, $question);
    }




}
?> 