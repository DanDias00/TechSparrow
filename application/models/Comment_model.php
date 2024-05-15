<?php
class Comment_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function save_comment($data) {
        return $this->db->insert('comments', $data);
    }

    public function get_comments_by_answer($answer_id) {
        $this->db->select('comments.*, users.username');
        $this->db->from('comments');
        $this->db->join('users', 'comments.user_id = users.user_id');
        $this->db->where('answer_id', $answer_id);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>
