<?php
class comment_service{

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance(); // Access the CI superobject
        $this->CI->load->model('Comment_model');
      
    }

    public function add_comment_service($answer_id, $user_id, $body) {
        $data = array(
            'answer_id' => $answer_id,
            'body' => $body,
            'user_id' => $user_id
        );
        return $this->CI->Comment_model->save_comment($data);
    }

    public function get_comments_by_answer_service($answer_id) {
        return $this->CI->Comment_model->get_comments_by_answer($answer_id);
    }
}
?>