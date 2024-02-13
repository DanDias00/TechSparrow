<?php
class Question_model extends CI_Model {

public function __construct() {
    $this->load->database();
}

public function get_all_questions() {
    $this->db->order_by('created_at', 'DESC');
    $query = $this->db->get('questions');
    return $query->result_array();
}

public function get_question($question_id) {
    $query = $this->db->get_where('questions', array('id' => $question_id));
    return $query->row_array();
}

public function submit_question($data) {
    return $this->db->insert('questions', $data);
}



public function search_questions($search) {
    $this->db->like('question', $search);
    $query = $this->db->get('questions');
    return $query->result_array();
}

public function get_user_questions($user_id) {
    $this->db->order_by('created_at', 'DESC');
    $query = $this->db->get_where('questions', array('user_id' => $user_id));
    return $query->result_array();
}

public function delete_question($question_id) {
    $this->db->where('id', $question_id);
    return $this->db->delete('questions');
}

public function update_question($question_id, $question) {
    $data = array(
        'question' => $question
    );
    $this->db->where('id', $question_id);
    return $this->db->update('questions', $data);
}



}

?>
