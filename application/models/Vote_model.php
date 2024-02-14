<?php
class Vote_model extends CI_Model {

// Method to add or update a vote
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
}
?>
