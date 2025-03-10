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
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('users/show_users', $data);
    }

    public function delete($id)
    {
        if ($this->User_model->delete_user($id)) {
            $this->session->set_flashdata('success', 'User deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Error deleting user.');
        }
        redirect('index.php/users');
    }

    public function edit($id)
    {
        $data['user'] = $this->User_model->get_user_by_id($id);
        if (!$data['user']) {
            redirect('users');
        }

        if ($this->input->post()) {
            $update_data = [
                'username' => $this->input->post('username'),
                'name' => $this->input->post('name'),
            ];

            // Only update password if provided
            $password = $this->input->post('password');
            if (!empty($password)) {
                $update_data['password'] = $password; // No hashing
            }

            if ($this->User_model->update_user($id, $update_data)) {
                $this->session->set_flashdata('success', 'User updated successfully.');
                redirect('users');
            } else {
                $this->session->set_flashdata('error', 'Error updating user.');
            }
        }

        $this->load->view('users/edit_user', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('users/add_user');
        } else {
            $data = [
                'username' => $this->input->post('username'),
                'name' => $this->input->post('name'),
                'password' => $this->input->post('password') // No hashing
            ];

            if ($this->User_model->insert_user($data)) {
                $this->session->set_flashdata('success', 'User added successfully!');
                redirect('index.php/users');
            } else {
                $this->session->set_flashdata('error', 'Error adding user.');
                redirect('users/add');
            }
        }
    }
}
