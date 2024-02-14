
<?php
class Vote_service {
    protected $vote_model;

    public function __construct() {
        $this->load->model('vote_model');
        $this->vote_model = new Vote_model();
    }

    public function submit_vote_service($answer_id, $user_id, $vote) {
       
        return $this->vote_model->submit_vote($answer_id, $user_id, $vote);
    }
}
?>
