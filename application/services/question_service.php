<?php
class question_service{

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance(); // Access the CI superobject
        $this->CI->load->model('Question_model');
        $this->CI->load->service('answer_service', '', TRUE);
        $this->CI->load->service('question_service', '', TRUE);
      
    }

    public function all_questions_service() {
    
        $questions = $this->CI->Question_model->get_all_questions();
       
        $questions_with_answer_count = [];

        foreach ($questions as $question) {
            // Getting the question ID
            $question_id = $question['id'];
            // Get the answer count for the current question
            $answer_count = $this->CI->question_service->get_answer_count_service($question_id);

            // Add answer count to the question details
            $question['answer_count'] = $answer_count;

            // Append the modified question to the new array
            $questions_with_answer_count[] = $question;
        }

        return $questions_with_answer_count;

    }

    public function get_question_service($question_id) {
        return $this->CI->Question_model->get_question($question_id);
    }

    public function submit_question_service($title,$question, $user_id,$tags) {

        
        $data = array(
            'title'=>$title,
            'body' => $question,
            'user_id' => $user_id,
        

        );
        return $this->CI->Question_model->submit_question($data,$tags);
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

    public function get_answer_count_service($question_id) {
        return $this->CI->Question_model->get_answer_count($question_id);
    }



}
?> 