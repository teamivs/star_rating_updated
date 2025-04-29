<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'form_validation']);
        $this->load->model('User_model');

        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        // Check if user is super admin
        if (!$this->User_model->is_super_admin($this->session->userdata('user_id'))) {
            $this->session->set_flashdata('error', 'Access denied. Super admin privileges required.');
            redirect('reviews/dashboard');
        }
    }

    public function index()
    {
        $data['users'] = $this->User_model->get_all_users();
        $data['is_super_admin'] = $this->User_model->is_super_admin($this->session->userdata('user_id'));
        $data['title'] = 'Users Management';

        $this->load->view('templates/header', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer');
    }
    public function impersonate($id)
    {
        // Only super admin can impersonate
        if (!$this->User_model->is_super_admin($this->session->userdata('user_id'))) {
            $this->session->set_flashdata('error', 'Access denied.');
            redirect('users');
        }

        $user = $this->User_model->get_user_by_id($id);
        if ($user && $user['role'] !== 'super_admin') {
            // Set session as the selected user
            $this->session->set_userdata([
                'username' => $user['username'],
                'user_id' => $user['id'],
                'role' => $user['role']
            ]);
            $this->session->set_flashdata('success', 'You are now logged in as ' . $user['username']);
            redirect('reviews/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Cannot impersonate this user.');
            redirect('users');
        }
    }

    public function delete($id)
    {
        // Only super admin can delete users
        if (!$this->User_model->is_super_admin($this->session->userdata('user_id'))) {
            $this->session->set_flashdata('error', 'Access denied. Super admin privileges required.');
            redirect('users');
        }

        if ($this->User_model->delete_user($id)) {
            $this->session->set_flashdata('success', 'User deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete user or cannot delete super admin.');
        }

        redirect('users');
    }

    public function edit($id)
    {
        // Only super admin can edit users
        if (!$this->User_model->is_super_admin($this->session->userdata('user_id'))) {
            $this->session->set_flashdata('error', 'Access denied. Super admin privileges required.');
            redirect('users');
        }

        $data['user'] = $this->User_model->get_user_by_id($id);
        $data['title'] = 'Edit User';

        if (!$data['user']) {
            show_404();
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('role', 'Role', 'required');

            if ($this->form_validation->run() === TRUE) {
                $user_data = [
                    'name' => $this->input->post('name'),
                    'username' => $this->input->post('username'),
                    'role' => $this->input->post('role')
                ];

                // Only update password if provided
                if ($this->input->post('password')) {
                    $user_data['password'] = $this->input->post('password');
                }

                if ($this->User_model->update_user($id, $user_data)) {
                    $this->session->set_flashdata('success', 'User updated successfully.');
                    redirect('users');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update user.');
                }
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('users/edit', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        // Only super admin can add users
        if (!$this->User_model->is_super_admin($this->session->userdata('user_id'))) {
            $this->session->set_flashdata('error', 'Access denied. Super admin privileges required.');
            redirect('users');
        }

        $data['title'] = 'Add User';

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[login.username]');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('role', 'Role', 'required');

            if ($this->form_validation->run() === TRUE) {
                $user_data = [
                    'name' => $this->input->post('name'),
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'role' => $this->input->post('role')
                ];

                if ($this->User_model->insert_user($user_data)) {
                    $this->session->set_flashdata('success', 'User added successfully.');
                    redirect('users');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add user.');
                }
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('users/add');
        $this->load->view('templates/footer');
    }
}
