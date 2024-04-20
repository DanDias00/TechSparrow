<?php
class Answer_model extends CI_Model {

public function __construct() {
    $this->load->database();
}

public function save_answer($question_id, $answer_body, $user_id) {
    $data = array(
        'question_id' => $question_id,
        'body' => $answer_body,
        'user_id' => $user_id
    );
    return $this->db->insert('answers', $data);

}

public function get_answers($question_id) {
    $this->db->select('answers.id,answers.body, users.username, answers.votes');
    $this->db->from('answers');
    $this->db->join('users', 'users.user_id = answers.user_id');
    $this->db->where('answers.question_id', $question_id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result_array(); // Return the array of answers with usernames
    } else {
        return array(); // Return an empty array if no answers are found
    }
}

public function upvote($answer_id) {
    $this->db->set('votes', 'votes+1', FALSE);
    $this->db->where('id', $answer_id);
    $this->db->update('answers');

     // Query for the updated vote count
     $this->db->select('votes');
     $this->db->from('answers');
     $this->db->where('id', $answer_id);
     $query = $this->db->get();
 
     if ($query->num_rows() > 0) {
         $row = $query->row();
         return $row->votes; // Return the updated vote count
     } else {
         return false; // Return false if the answer does not exist
     }
}

public function downvote($answer_id) {
    $this->db->set('votes', 'votes-1', FALSE);
    $this->db->where('id', $answer_id);
    $this->db->update('answers');

    // Query for the updated vote count
    $this->db->select('votes');
    $this->db->from('answers');
    $this->db->where('id', $answer_id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->votes; // Return the updated vote count
    } else {
        return false; // Return false if the answer does not exist
    }

}

public function get_vote_count($answer_id) {
    $query = $this->db->get_where('answers', array('id' => $answer_id));
    if ($query->num_rows() > 0) {
        return $query->row()->vote;
    }
    return NULL;
}
    
}

?>