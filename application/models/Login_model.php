<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function validate_user($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password); // Insecure: Hash passwords in real applications
        $query = $this->db->get('login');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }
}
