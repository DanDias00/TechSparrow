<?php
class answer_service{

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance(); // Access the CI superobject
        $this->CI->load->model('Answer_model');
        $this->CI->load->model('Question_model');

      
    }

    public function submit_answer($question_id, $answer_body, $user_id) {
        // Validate input
        if (empty($question_id) || empty($answer_body)) {
            redirect('questions/view_question/' . $question_id);
            return ['success' => false, 'message' => 'Please fill in all fields.'];
        }

        // Save answer and increment answer count
        
        if ($this->CI->Answer_model->save_answer($question_id, $answer_body, $user_id)) {
            //increment answer count in questions table
            $this->CI->Question_model->increment_answer_count($question_id);
            return ['success' => true, 'message' => 'Your answer has been submitted successfully.'];
        } else {
            return ['success' => false, 'message' => 'There was a problem submitting your answer. Please try again.'];
        }
    }


    public function get_answers_service($question_id) {
        return $this->CI->Answer_model->get_answers($question_id);
    }


    public function get_answers_with_comments_service($question_id) {
        
        $answers = $this->CI->answer_service->get_answers_service($question_id);
        $answers_with_comments = [];
    
        foreach ($answers as $answer) {
            $comments = $this->CI->comment_service->get_comments_by_answer_service($answer['id']);
            $answer['comments'] = $comments;
            $answers_with_comments[] = $answer;
        }
    
        return $answers_with_comments;
    }
    

  
}
?>