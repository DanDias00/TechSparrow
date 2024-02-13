<?php
class answer_service{

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance(); // Access the CI superobject
        $this->CI->load->model('Answer_model');
      
    }

    public function save_answer_service($question_id, $answer_body,$user_id) {
        $data = array(
            'question_id' => $question_id,
            'body' => $answer_body,
            'user_id' => $user_id
        );
        return $this->CI->Answer_model->save_answer($data);
    }

    public function get_answers_service($question_id) {
        return $this->CI->Answer_model->get_answers($question_id);
    }

  
}
?>