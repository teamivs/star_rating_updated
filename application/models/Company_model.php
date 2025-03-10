<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company_model extends CI_Model
{

    public function get_company()
    {
        return $this->db->get_where('company_credentials', ['id' => 1])->row_array();
    }

    public function save_company($data)
    {
        if ($this->db->get_where('company_credentials', ['id' => 1])->num_rows() > 0) {
            return $this->db->update('company_credentials', $data, ['id' => 1]);
        } else {
            return $this->db->insert('company_credentials', $data);
        }
    }
}
