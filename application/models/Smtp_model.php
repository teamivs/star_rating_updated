<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Smtp_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load database connection
    }
    public function insert_smtp($data)
    {
        return $this->db->insert('smtp_credentials', $data);
    }
    public function get_smtp_credentials()
    {
        return $this->db->get('smtp_credentials')->row_array(); // Fetch first record
    }
    public function get_smtp_by_id($id)
    {
        return $this->db->where('id', $id)->get('smtp_credentials')->row_array();
    }

    public function update_credentials($id, $data)
    {
        $this->db->where('id', $id)->update('smtp_credentials', $data);
    }
    public function update_smtp($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('smtp_credentials', $data);
    }

}
?>