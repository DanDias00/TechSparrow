<?php
class Answer_model extends CI_Model {

public function __construct() {
    $this->load->database();
}

public function save_answer($data) {
    return $this->db->insert('answers', $data);

}

public function get_answers($question_id) {
    $this->db->select('answers.id,answers.body,answers.answer_count, users.username');
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

public function increment_answer_count($question_id) {
    $this->db->set('answer_count', 'answer_count+1', FALSE);
    $this->db->where('question_id', $question_id);
    $this->db->update('answers');
}

public function get_answer_count($question_id) {
    $this->db->select('answer_count');
    $this->db->from('answers');
    $this->db->where('question_id', $question_id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row()->answer_count; // Return the answer count
    } else {
        return 0; // Return 0 if no answers are found
    }
}
    
}
?>