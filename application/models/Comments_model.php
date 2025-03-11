<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comments_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load database connection
    }

    public function get_reviews()
    {
        return $this->db->get('comments')->result_array(); // Fetch all reviews
    }
    public function save_review($data)
    {
        return $this->db->insert('comments', $data);
    }
    public function get_rating_counts()
    {
        $this->db->select('star_rating, COUNT(*) as count');
        $this->db->group_by('star_rating');
        $query = $this->db->get('comments');
        return $query->result_array();
    }
    public function get_review_count_last_week()
    {
        $last_week = date('Y-m-d H:i:s', strtotime('-7 days'));
        $this->db->where('created_at >=', $last_week);
        return $this->db->count_all_results('comments');
    }


}
?>