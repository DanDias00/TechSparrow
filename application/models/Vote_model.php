<?php
class Vote_model extends CI_Model {
    
public function __construct() {
    $this->load->database();
}

public function submit_vote($answer_id, $user_id, $vote) {
    // Check if the user has already voted on this answer
    $this->db->where('answer_id', $answer_id);
    $this->db->where('user_id', $user_id);
    $exists = $this->db->get('answer_votes')->row_array();

    if ($exists) {
        // Update the existing vote
        $this->db->where('id', $exists['id']);
        return $this->db->update('answer_votes', ['vote' => $vote]);
    } else {
        // Insert a new vote
        return $this->db->insert('answer_votes', [
            'answer_id' => $answer_id,
            'user_id' => $user_id,
            'vote' => $vote
        ]);
    }    
}

public function hasVoted($answer_id, $user_id) {
    $this->db->where('answer_id', $answer_id);
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('votes');

    return $query->num_rows() > 0;
}
public function saveVoteDetails($user_id,$answer_id, $vote) {
    $data = array(
        'user_id' => $user_id,
        'answer_id' => $answer_id,
        'vote_type' => $vote
    );
    return $this->db->insert('votes', $data);

}
}
?>
