<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comments_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load database connection
    }

    public function get_reviews($admin_id = null)
    {
        if ($admin_id) {
            $this->db->where('admin_id', $admin_id);
        }
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
    public function get_rating_counts($admin_id = null)
    {
        $this->db->select('star_rating, COUNT(*) as count');
        if ($admin_id) {
            $this->db->where('admin_id', $admin_id);
        }
        $this->db->where('star_rating <=', 3); // Only get ratings <= 3
        $this->db->group_by('star_rating');
        $this->db->order_by('star_rating', 'DESC');
        $query = $this->db->get('comments');
        return $query->result_array();
    }
    public function get_review_count_last_week($admin_id = null)
    {
        $last_week = date('Y-m-d H:i:s', strtotime('-7 days'));
        $this->db->select('COUNT(*) as count');
        $this->db->where('created_at >=', $last_week);
        if ($admin_id) {
            $this->db->where('admin_id', $admin_id);
        }
        $query = $this->db->get('comments');
        $result = $query->row();
        return $result ? $result->count : 0;
    }

    public function get_recent_reviews($admin_id = null, $limit = 5)
    {
        $this->db->select('name_add as user_name, comments as action, created_at as timestamp, mobile_no, is_bot, star_rating');
        if ($admin_id) {
            $this->db->where('admin_id', $admin_id);
        }
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('comments');
        return $query->result_array();
    }

    public function get_monthly_review_trends($admin_id = null)
    {
        $this->db->select("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count");
        if ($admin_id) {
            $this->db->where('admin_id', $admin_id);
        }
        $this->db->group_by("DATE_FORMAT(created_at, '%Y-%m')");
        $this->db->order_by('month', 'ASC');
        $this->db->limit(6); // Last 6 months
        $query = $this->db->get('comments');
        return $query->result_array();
    }

    /**
     * Get bot-generated reviews
     * @param int $admin_id Admin ID to filter reviews
     * @param int $limit Number of reviews to return
     * @return array
     */
    public function get_bot_reviews($admin_id = null, $limit = 10)
    {
        $this->db->where('is_bot', 1);
        if ($admin_id) {
            $this->db->where('admin_id', $admin_id);
        }
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('comments');
        return $query->result_array();
    }

    public function get_daily_review_trends($admin_id = null)
    {
        $this->db->select("DATE_FORMAT(created_at, '%Y-%m-%d') as date, COUNT(*) as count");
        if ($admin_id) {
            $this->db->where('admin_id', $admin_id);
        }
        $this->db->group_by("DATE_FORMAT(created_at, '%Y-%m-%d')");
        $this->db->order_by('date', 'DESC');
        $this->db->limit(10); // Last 10 days
        $query = $this->db->get('comments');
        return $query->result_array();
    }

    public function get_average_rating_for_period($admin_id = null, $start_date = null, $end_date = null)
    {
        $this->db->select('AVG(star_rating) as avg_rating');
        if ($admin_id) {
            $this->db->where('admin_id', $admin_id);
        }
        if ($start_date) {
            $this->db->where('created_at >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('created_at <=', $end_date);
        }
        $query = $this->db->get('comments');
        $result = $query->row();
        return $result ? round($result->avg_rating, 1) : 0;
    }
}
