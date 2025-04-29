<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{    

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_user_by_id($id)
    {
        return $this->db->where('id', $id)->get('login')->row_array();
    }
    public function get_user_by_username($username)
    {
        return $this->db->where('username', $username)->get('login')->row_array();
    }
    public function update_user($id, $data)
    {
        return $this->db->where('id', $id)->update('login', $data);
    }

    // Insert user into database
    public function insert_user($data)
    {
        return $this->db->insert('login', $data);  // Insert into 'login' table
    }
    public function get_all_users()
    {
        return $this->db->get('login')->result_array();
    }

    public function delete_user($id)
    {
        // Prevent deleting the super admin
        $user = $this->get_user_by_id($id);
        if ($user && $user['role'] === 'super_admin') {
            return false;
        }
        return $this->db->where('id', $id)->delete('login');
    }

    public function is_super_admin($user_id)
    {
        $user = $this->get_user_by_id($user_id);
        return $user && $user['role'] === 'super_admin';
    }

    public function is_admin($user_id)
    {
        $user = $this->get_user_by_id($user_id);
        return $user && ($user['role'] === 'admin' || $user['role'] === 'super_admin');
    }
}
