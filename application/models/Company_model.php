<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_company()
    {
        $query = $this->db->get('company_credentials');
        return $query->row_array();
    }
    public function get_company_by_user($user_id)
    {
        return $this->db->where('user_id', $user_id)->get('company_credentials')->row_array();
    }

    public function add_or_update_company($user_id, $data)
    {
        $existing = $this->get_company_by_user($user_id);
        if ($existing) {
            $this->db->where('user_id', $user_id);
            return $this->db->update('company_credentials', $data);
        } else {
            $data['user_id'] = $user_id;
            return $this->db->insert('company_credentials', $data);
        }
    }
    public function update_company($data)
    {
        $this->db->where('id', 1); // Assuming we're always updating the first record
        return $this->db->update('company_credentials', $data);
    }

    public function add_company($data)
    {
        return $this->db->insert('company_credentials', $data);
    }

    public function save_company($user_id, $data)
    {
        $existing = $this->get_company_by_user($user_id);
        if ($existing) {
            $this->db->where('user_id', $user_id);
            return $this->db->update('company_credentials', $data);
        } else {
            $data['user_id'] = $user_id;
            return $this->db->insert('company_credentials', $data);
        }
    }
}