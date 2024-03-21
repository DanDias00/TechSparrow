<?php
class Question_model extends CI_Model {

public function __construct() {
    $this->load->database();
}

public function get_all_questions() {
    // Selecting question data along with the associated username and tags
    $this->db->select('
        questions.*, 
        users.username,
        GROUP_CONCAT(tags.name ORDER BY tags.name ASC SEPARATOR ", ") AS tags'
    );
    $this->db->from('questions');
    $this->db->join('users', 'users.user_id = questions.user_id');
    
    // Join with the question_tags intermediate table and then tags table to get the tags
    $this->db->join('question_tags', 'question_tags.question_id = questions.id', 'left');
    $this->db->join('tags', 'tags.id = question_tags.tag_id', 'left');

    // Group by question ID to aggregate all tags for each question
    $this->db->group_by('questions.id');
    $this->db->order_by('questions.created_at', 'DESC'); // Optional: order the questions

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $questions = $query->result_array();
        
        // Process tags to be an array if needed
        foreach ($questions as &$question) {
            if (!empty($question['tags'])) {
                $question['tags'] = explode(', ', $question['tags']);
            } else {
                $question['tags'] = [];
            }
        }
        return $questions; // Return the array of questions with usernames and tags
    } else {
        return array(); // Return an empty array if no questions are found
    }
}

    

public function get_question($question_id) {
    $query = $this->db->get_where('questions', array('id' => $question_id));
    return $query->row_array();
}

public function submit_question($data,$tags) {
    $this->db->insert('questions', $data);
    $question_id=$this->db->insert_id();

    foreach ($tags as $tagName) {
        // Check if the tag already exists in the 'tags' table
        $query = $this->db->get_where('tags', array('name' => $tagName));
        if ($query->num_rows() == 0) {
            // If the tag does not exist, insert it into the 'tags' table
            $this->db->insert('tags', array('name' => $tagName));
            $tag_id = $this->db->insert_id();
        } else {
            // If the tag exists, get its id
            $tag_id = $query->row()->id;
        }

        // Insert the relationship into the 'question_tags' table
        $this->db->insert('question_tags', array(
            'question_id' => $question_id,
            'tag_id' => $tag_id
        ));
    }

    if ($this->db->trans_status() === FALSE) {
        return FALSE;
    } else {
        return TRUE;
    }
}

public function search_questions($search) {
    // Selecting question data along with the associated username and concatenated tags
    $this->db->select('
        questions.*, 
        users.username,
        GROUP_CONCAT(tags.name ORDER BY tags.name ASC SEPARATOR ", ") AS tags'
    );
    $this->db->from('questions');
    $this->db->join('users', 'users.user_id = questions.user_id');

    // Join with the question_tags intermediate table and then tags table to get the tags
    $this->db->join('question_tags', 'question_tags.question_id = questions.id', 'left');
    $this->db->join('tags', 'tags.id = question_tags.tag_id', 'left');

    // Apply the search condition to the title and body fields
    $this->db->group_start(); // Start grouping for OR condition
    $this->db->like('questions.title', $search);
    $this->db->or_like('questions.body', $search);
    $this->db->group_end(); // End grouping

    // Group by question ID to aggregate all tags for each question
    $this->db->group_by('questions.id');
    $this->db->order_by('questions.created_at', 'DESC'); // Optional: order the questions

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $questions = $query->result_array();
        
        // Process tags to be an array if needed
        foreach ($questions as &$question) {
            if (!empty($question['tags'])) {
                $question['tags'] = explode(', ', $question['tags']);
            } else {
                $question['tags'] = [];
            }
        }
        return $questions; // Return the array of questions with usernames and tags
    } else {
        return array(); // Return an empty array if no questions are found
    }
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

public function increment_answer_count($question_id) {
    $this->db->set('answer_count', 'answer_count+1', FALSE);
    $this->db->where('id', $question_id);
    $this->db->update('questions');
}

public function get_answer_count($question_id) {
    $this->db->select('answer_count');
    $this->db->from('questions');
    $this->db->where('id', $question_id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row()->answer_count; // Return the answer count
    } else {
        return 0; // Return 0 if no answers are found
    }
}


}

?>
