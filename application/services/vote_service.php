
<?php
class Vote_service {
    protected $CI;

    public function __construct() {

        $this->CI =& get_instance();

        $this->CI->load->model('Answer_model');
        $this->CI->load->model('Vote_model');
    }

    public function upvote($answer_id) {
        
        $vote_count = $this->CI->Answer_model->upvote($answer_id);

        // Return the vote count
        return $vote_count;
    }

    public function downvote($answer_id) {
    
       $vote_count= $this->CI->Answer_model->downvote($answer_id);
         return $vote_count;
    }

    public function hasVotedService($answer_id, $user_id) {
        return $this->CI->Vote_model->hasVoted($answer_id, $user_id);
    }

    public function insertUserVoteService($user_id,$answer_id, $vote) {
        return $this->CI->Vote_model->saveVoteDetails($user_id,$answer_id, $vote);
    }


}
?>
