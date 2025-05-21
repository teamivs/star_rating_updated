<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keywords extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Keywords_model');
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');

        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        // Get user role
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);

        // Allow access if user is admin or super admin
        if (!$user || ($user['role'] !== 'admin' && $user['role'] !== 'super_admin')) {
            redirect('login');
        }
    }

    /**
     * Display all keywords
     */
    public function index()
    {
        $admin_id = $this->session->userdata('user_id');

        // Fetch user data to check role
        $user = $this->User_model->get_user_by_id($admin_id);
        $is_super_admin = ($user['role'] === 'super_admin');

        $keyword = $this->input->get('keyword');
        $category = $this->input->get('category');

        // Get keywords based on role
        $data['keywords'] = $this->Keywords_model->get_filtered_keywords($is_super_admin ? null : $admin_id, $keyword, $category);
        $data['categories'] = $this->Keywords_model->get_categories($is_super_admin ? null : $admin_id);
        $data['title'] = 'Keywords Management';
        $data['admin_id'] = $admin_id;
        $data['is_super_admin'] = $is_super_admin;

        $this->load->view('templates/header', $data);
        $this->load->view('keywords/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Display a form to add a new keyword
     */
    public function add()
    {
        $data['title'] = 'Add Keyword';
        $data['admin_id'] = $this->session->userdata('user_id');
        $data['categories'] = $this->Keywords_model->get_categories($data['admin_id']);

        $this->load->view('templates/header', $data);
        $this->load->view('keywords/add', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Display a form to add a new category
     */
    public function add_category()
    {
        $data['title'] = 'Add Category';
        $data['admin_id'] = $this->session->userdata('user_id');

        $this->load->view('templates/header', $data);
        $this->load->view('keywords/add_category', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Save a new keyword
     */
    public function save()
    {
        // Validate input
        $this->load->library('form_validation');

        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('keyword', 'Keyword', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('keywords/add');
        }

        // Prepare data
        $data = [
            'category' => $this->input->post('category'),
            'keyword' => $this->input->post('keyword'),
            'is_active' => 1,
            'admin_id' => $this->session->userdata('user_id')
        ];

        // Save the keyword
        if ($this->Keywords_model->add_keyword($data)) {
            $this->session->set_flashdata('success', 'Keyword added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add keyword.');
        }

        redirect('keywords');
    }

    /**
     * Save a new category
     */
    public function save_category()
    {
        // Validate input
        $this->load->library('form_validation');

        $this->form_validation->set_rules('category', 'Category', 'required|is_unique[keywords.category]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('keywords/add_category');
        }

        // Prepare data
        $data = [
            'category' => $this->input->post('category'),
            'keyword' => 'placeholder', // Required field, will be updated later
            'is_active' => 1,
            'admin_id' => $this->session->userdata('user_id')
        ];

        // Save the category
        if ($this->Keywords_model->add_keyword($data)) {
            $this->session->set_flashdata('success', 'Category added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add category.');
        }

        redirect('keywords');
    }

    /**
     * Toggle the active status of a keyword
     */
    public function toggle_status($id)
    {
        $admin_id = $this->session->userdata('user_id');
        $result = $this->Keywords_model->toggle_status($id, $admin_id);

        if ($this->input->is_ajax_request()) {
            if ($result) {
                $this->output->set_content_type('application/json')
                    ->set_output(json_encode(['success' => true]));
            } else {
                $this->output->set_status_header(400)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => 'Failed to update status']));
            }
            return;
        }

        if ($result) {
            $this->session->set_flashdata('success', 'Keyword status updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update keyword status.');
        }

        redirect('keywords');
    }

    /**
     * Delete a keyword
     */
    public function delete($id)
    {
        $admin_id = $this->session->userdata('user_id');
        if ($this->Keywords_model->delete_keyword($id, $admin_id)) {
            $this->session->set_flashdata('success', 'Keyword deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete keyword.');
        }

        redirect('keywords');
    }
}
