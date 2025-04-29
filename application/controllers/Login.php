<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library(['session']);
        $this->load->model('User_model'); // Ensure this model exists
    }

    public function index()
    {
        // If user is already logged in, redirect to appropriate page
        if ($this->session->userdata('user_id')) {
            if ($this->User_model->is_super_admin($this->session->userdata('user_id'))) {
                redirect('users');
            } else {
                redirect('reviews/dashboard');
            }
        }
        
        $this->load->view('login_view'); // Make sure this view exists
    }
    public function process()
    {
        // Get input values
        $username = $this->input->post('username');
        $password = $this->input->post('u_pass');  // Check if form input name matches 'u_pass'

        // Retrieve the user based on the username
        $user = $this->User_model->get_user_by_username($username);

        if ($user) {
            // Check if the password matches
            if ($user['password'] === $password) {
                // Set session data
                $this->session->set_userdata([
                    'username' => $user['username'],
                    'user_id' => $user['id'],
                    'role' => $user['role']
                ]);
                
                // Redirect based on role
                if ($user['role'] === 'super_admin') {
                    redirect('users');
                } else {
                    redirect('reviews/dashboard');
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid password');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('error', 'User not found');
            redirect('login');
        }
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
