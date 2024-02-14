<?php
class Question_model extends CI_Model {

public function __construct() {
    $this->load->database();
}

public function get_all_questions() {
   
        $this->db->select('questions.*, users.username');
        $this->db->from('questions');
        $this->db->join('users', 'users.user_id = questions.user_id');
        $this->db->order_by('questions.created_at', 'DESC'); // Optional: order the questions
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result_array(); // Return the array of questions with usernames
        } else {
            return array(); // Return an empty array if no questions are found
        }
}
    

public function get_question($question_id) {
    $query = $this->db->get_where('questions', array('id' => $question_id));
    return $query->row_array();
}

public function submit_question($data) {
    return $this->db->insert('questions', $data);
}

public function search_questions($search) {
     // Select fields from the questions table and the username from the users table
     $this->db->select('questions.*, users.username');
    
     // Perform a join with the users table where questions.user_id equals users.id
     $this->db->join('users', 'users.user_id = questions.user_id');
     
     // Apply the search condition to the title and body fields
     $this->db->group_start(); // Start grouping for OR condition
     $this->db->like('questions.title', $search);
     $this->db->or_like('questions.body', $search);
     $this->db->group_end(); // End grouping
     
     // Get the result from the questions table
     $query = $this->db->get('questions');
     
     // Return the result as an array of arrays
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
