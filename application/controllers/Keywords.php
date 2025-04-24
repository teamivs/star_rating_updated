<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keywords extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Keywords_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }
    
    /**
     * Display all keywords
     */
    public function index()
    {
        $data['keywords'] = $this->Keywords_model->get_all_active_keywords();
        $data['title'] = 'Keywords Management';
        
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
        
        $this->load->view('templates/header', $data);
        $this->load->view('keywords/add', $data);
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
            'is_active' => 1
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
     * Toggle the active status of a keyword
     */
    public function toggle_status($id)
    {
        if ($this->Keywords_model->toggle_status($id)) {
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
        if ($this->Keywords_model->delete_keyword($id)) {
            $this->session->set_flashdata('success', 'Keyword deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete keyword.');
        }
        
        redirect('keywords');
    }
}
?> 