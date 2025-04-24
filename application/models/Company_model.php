<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

    public function update_company($data)
    {
        $this->db->where('id', 1); // Assuming we're always updating the first record
        return $this->db->update('company_credentials', $data);
    }

    public function add_company($data)
    {
        return $this->db->insert('company_credentials', $data);
    }
}