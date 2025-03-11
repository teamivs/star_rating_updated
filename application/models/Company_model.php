<?php
class Company_model extends CI_Model
{

    public function get_company()
    {
        return $this->db->get('company_credentials')->row_array();
    }

    public function save_company($data)
    {
        // Check if a company already exists
        $existing = $this->db->get('company_credentials')->row_array();

        if ($existing) {
            // Update existing record
            return $this->db->update('company_credentials', $data, ['id' => $existing['id']]);
        } else {
            // Insert new record
            return $this->db->insert('company_credentials', $data);
        }
    }
}