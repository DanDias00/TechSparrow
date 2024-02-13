<?php
class Answer_model extends CI_Model {

public function __construct() {
    $this->load->database();
}

public function save_answer($data) {
    return $this->db->insert('answers', $data);

}

public function get_answers($question_id) {
    $this->db->select('answers.body, users.username');
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
    
    }
?>