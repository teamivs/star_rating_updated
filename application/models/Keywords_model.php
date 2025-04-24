<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keywords_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all active keywords
     * @return array
     */
    public function get_all_active_keywords()
    {
        $this->db->where('is_active', 1);
        $query = $this->db->get('keywords');
        return $query->result_array();
    }

    /**
     * Get keywords by category
     * @param string $category
     * @return array
     */
    public function get_keywords_by_category($category)
    {
        $this->db->where('category', $category);
        $this->db->where('is_active', 1);
        $query = $this->db->get('keywords');
        return $query->result_array();
    }

    /**
     * Get random keywords for review generation
     * @param int $limit
     * @return array
     */
    public function get_random_keywords($limit = 5)
    {
        $this->db->where('is_active', 1);
        $this->db->order_by('RAND()');
        $this->db->limit($limit);
        $query = $this->db->get('keywords');
        return $query->result_array();
    }

    /**
     * Get keywords for a category
     */
    public function get_keywords($category = null)
    {
        if ($category) {
            $this->db->where('category', $category);
        }
        
        $this->db->select('keyword');
        $this->db->from('keywords');
        $this->db->where('is_active', 1);
        $this->db->order_by('RAND()');
        $this->db->limit(5);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $keywords = [];
            foreach ($query->result() as $row) {
                $keywords[] = $row->keyword;
            }
            return $keywords;
        }
        
        return [];
    }

    /**
     * Get all categories
     */
    public function get_categories()
    {
        $this->db->select('DISTINCT(category)');
        $this->db->from('keywords');
        $this->db->where('status', 1);
        $this->db->order_by('category', 'ASC');
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $categories = [];
            foreach ($query->result() as $row) {
                $categories[] = $row->category;
            }
            return $categories;
        }
        
        return [];
    }

    /**
     * Add a new keyword
     * @param array $data
     * @return bool
     */
    public function add_keyword($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        
        return $this->db->insert('keywords', $data);
    }

    /**
     * Update a keyword
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update_keyword($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->where('id', $id);
        return $this->db->update('keywords', $data);
    }

    /**
     * Delete a keyword
     * @param int $id
     * @return bool
     */
    public function delete_keyword($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('keywords', ['status' => 0]);
    }

    /**
     * Toggle the active status of a keyword
     * @param int $id
     * @return bool
     */
    public function toggle_status($id)
    {
        // Get the current status
        $this->db->where('id', $id);
        $query = $this->db->get('keywords');
        $keyword = $query->row_array();
        
        if ($keyword) {
            // Toggle the status
            $new_status = $keyword['is_active'] ? 0 : 1;
            
            $this->db->where('id', $id);
            return $this->db->update('keywords', ['is_active' => $new_status]);
        }
        
        return false;
    }
}
?> 