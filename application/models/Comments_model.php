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
}
?>