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
     * Get all active keywords for a specific admin
     * @param int $admin_id
     * @return array
     */
    public function get_all_active_keywords($admin_id = null)
    {
        if ($admin_id) {
            $this->db->where('admin_id', $admin_id);
        }
        $this->db->where('is_active', 1);
        $this->db->order_by('category', 'ASC');
        $this->db->order_by('keyword', 'ASC');
        $query = $this->db->get('keywords');
        return $query->result_array();
    }

    /**
     * Get keywords by category for a specific admin
     * @param string $category
     * @param int $admin_id
     * @return array
     */
    public function get_keywords_by_category($category, $admin_id)
    {
        $this->db->where('category', $category);
        $this->db->where('is_active', 1);
        $this->db->where('admin_id', $admin_id);
        $query = $this->db->get('keywords');
        return $query->result_array();
    }

    /**
     * Get random keywords for review generation for a specific admin
     * @param int $admin_id
     * @param int $limit
     * @return array
     */
    public function get_random_keywords($admin_id, $limit = 5)
    {
        $this->db->where('is_active', 1);
        $this->db->where('admin_id', $admin_id);
        $this->db->order_by('RAND()');
        $this->db->limit($limit);
        $query = $this->db->get('keywords');
        return $query->result_array();
    }

    /**
     * Get keywords for a category for a specific admin
     */
    public function get_keywords($admin_id, $category = null)
    {
        if ($category) {
            $this->db->where('category', $category);
        }

        $this->db->select('keyword');
        $this->db->from('keywords');
        $this->db->where('is_active', 1);
        $this->db->where('admin_id', $admin_id);
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
     * Get all categories for a specific admin
     */
    public function get_categories($admin_id = null)
    {
        if ($admin_id) {
            $this->db->where('admin_id', $admin_id);
        }
        $this->db->distinct();
        $this->db->select('category');
        $this->db->order_by('category', 'ASC');
        $query = $this->db->get('keywords');
        return array_column($query->result_array(), 'category');
    }

    /**
     * Add a new keyword
     * @param array $data
     * @return bool
     */
    public function add_keyword($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['is_active'] = 1;

        return $this->db->insert('keywords', $data);
    }

    /**
     * Update a keyword
     * @param int $id
     * @param array $data
     * @param int $admin_id
     * @return bool
     */
    public function update_keyword($id, $data, $admin_id)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where('id', $id);
        $this->db->where('admin_id', $admin_id);
        return $this->db->update('keywords', $data);
    }

    /**
     * Delete a keyword
     * @param int $id
     * @param int $admin_id
     * @return bool
     */
    public function delete_keyword($id, $admin_id)
    {
        $this->db->where('id', $id);
        $this->db->where('admin_id', $admin_id);
        return $this->db->delete('keywords');
    }

    /**
     * Toggle the active status of a keyword
     * @param int $id
     * @param int $admin_id
     * @return bool
     */
    public function toggle_status($id, $admin_id)
    {
        // Get the current status
        $this->db->where('id', $id);
        $this->db->where('admin_id', $admin_id);
        $query = $this->db->get('keywords');
        $keyword = $query->row_array();

        if ($keyword) {
            // Toggle the status
            $new_status = $keyword['is_active'] ? 0 : 1;

            $this->db->where('id', $id);
            $this->db->where('admin_id', $admin_id);
            return $this->db->update('keywords', ['is_active' => $new_status]);
        }

        return false;
    }

    public function get_filtered_keywords($admin_id = null, $keyword = null, $category = null)
    {
        if ($admin_id) {
            $this->db->where('admin_id', $admin_id);
        }
        if ($keyword) {
            $this->db->like('keyword', $keyword);
        }
        if ($category) {
            $this->db->where('category', $category);
        }
        $this->db->order_by('category', 'ASC');
        $this->db->order_by('keyword', 'ASC');
        return $this->db->get('keywords')->result_array();
    }
}
