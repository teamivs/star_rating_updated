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
    public function get_smtp_credentials($user_id = null)
    {
        if ($user_id === null) {
            $user_id = $this->session->userdata('user_id');
        }
        return $this->db->where('user_id', $user_id)->get('smtp_credentials')->row_array();
    }
    public function get_smtp_by_id($id)
    {
        return $this->db->where('id', $id)->get('smtp_credentials')->row_array();
    }

    public function save_credentials($data)
    {
        $user_id = $this->session->userdata('user_id');
        $existing = $this->get_smtp_credentials($user_id);

        if ($existing) {
            $this->db->where('user_id', $user_id);
            return $this->db->update('smtp_credentials', $data);
        } else {
            $data['user_id'] = $user_id;
            return $this->db->insert('smtp_credentials', $data);
        }
    }

    public function update_credentials($id, $data)
    {
        $user_id = $this->session->userdata('user_id');
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        return $this->db->update('smtp_credentials', $data);
    }
    public function update_smtp($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('smtp_credentials', $data);
    }

}
?>