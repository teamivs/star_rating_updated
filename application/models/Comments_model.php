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
        // Set default values for required fields if not provided
        if (!isset($data['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }
        
        if (!isset($data['is_bot'])) {
            $data['is_bot'] = 0;
        }
        
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

    public function get_recent_reviews($limit = 10)
    {
        $this->db->select('name_add as user_name, comments as action, created_at as timestamp, is_bot');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('comments');
        return $query->result_array();
    }

    public function get_monthly_review_trends()
    {
        $this->db->select("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count");
        $this->db->group_by("DATE_FORMAT(created_at, '%Y-%m')");
        $this->db->order_by('month', 'ASC');
        $this->db->limit(6); // Last 6 months
        $query = $this->db->get('comments');
        return $query->result_array();
    }
    
    /**
     * Get bot-generated reviews
     * @param int $limit Number of reviews to return
     * @return array
     */
    public function get_bot_reviews($limit = 10)
    {
        $this->db->where('is_bot', 1);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('comments');
        return $query->result_array();
    }
}
?>